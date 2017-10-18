#!C:/Python36-32/python.exe
import sys
sys.path.insert(0, 'C:/Python36-32/Lib/site-packages')
"""
image_processor.py
This class implements operations that will be used for image processing to
prepare images for the marking phase. The class operations are as follows:
    -> read_img()
    -> unzip_files()
    -> convert_to_pdf()
    -> detect_lines()
    -> slice_image()
    -> get_image_count()
    -> get_page_steps()
    -> execute_slicer()
    -> image_vertical_stack()
    -> convert_pdf2img()
    -> execute_imagestacker()
"""
from error import Error
from PIL import Image

import cv2
import glob
import house_keeper
import img2pdf
import numpy as np
import PythonMagick
import pyPdf
import os
import shutil
import text_detector
import zipfile

"""
@author     TechTitans
@since      Python3.6.2
@version    2.0.0
"""

class ImageProcessor:
    """
    Default constructor
    """
    def __init__(self, num_of_questions, subq_array):
        self.img_script = None
        self.cv2_script = None
        self.steps_folder_path = "all_steps_"
        self.img_width, self.img_height = 0, 0
        self.line_list = [0]
        self.lines_to_crop = list()
        self.page_steps = {}
        self.main_folder = "sliced_images/"
        self.img_count = 0
        self.bounds_checker = 0
        self.num_q = num_of_questions
        self.s_q = subq_array

    """
    reads the given image

    @param file_name    image file path
    """
    def read_img(self, file_name):
        self.img_script = Image.open(file_name)
        # preparing for line detection
        self.cv2_script = cv2.imread(file_name)
        self.img_width, self.img_height = self.img_script.size

    """
    extracts the contents of the zip file

    @param file_path    zip file path
    @return             an array of image files
    """
    def unzip_files(self, file_path):
        zip_ref = zipfile.ZipFile(file_path, 'r')
        answer_scripts_folder = file_path[0:file_path.rfind("\\")]
        zip_ref.extractall(answer_scripts_folder)
        img_array = sorted(glob.glob(answer_scripts_folder+"/*.jpg"), key=lambda name: int(name[name.find('question')+8:-4]))
        zip_ref.close()

        if(len(img_array) == 0):
            err = Error("No Files To Unzip!")
            raise err

        return img_array

    """
    Converts the images into one pdf

    @param      img_list    An array of images
    @param      file_path   The file destination
    """
    def convert_to_pdf(self, img_list, file_path, ext):
        # sorted(glob.glob("marked_final/*.jpg"), key=lambda name: int(name[33:-4]))
        pdf_bytes = img2pdf.convert(img_list)
        full_file_name = "../marked_scripts/"+str(file_path)
        file_name = full_file_name[0:full_file_name.rfind(ext)]
        file = open(file_name+"pdf","wb")
        file.write(pdf_bytes)
        file.close()

    """
    Detects horizontal lines in an image
    """
    def detect_lines(self):
        del self.lines_to_crop[:]

        # Preparing image for line detection
        pil_img = self.img_script
        _img = self.cv2_script
        img_width = pil_img.width
        gray = cv2.cvtColor(_img,cv2.COLOR_BGR2GRAY)
        edges = cv2.Canny(gray,50,150,apertureSize = 3)

        # Get line coordinates of image
        lines = cv2.HoughLines(edges,1,np.pi/180,200)
        self.line_list = [0 for x in range(len(lines))]

        # For every line pair
        for i in range(0, len(lines)):
            for rho,theta in lines[i]:
                a = np.cos(theta)
                b = np.sin(theta)
                x0 = a*rho
                y0 = b*rho
                x1 = int(x0 + 1000*(-b))
                y1 = int(y0 + 1000*(a))
                x2 = int(x0 - 1000*(-b))
                y2 = int(y0 - 1000*(a))

                if(y2>0 and y2>90):
                    self.line_list[i] = y2

        self.line_list.sort()

        # Eliminate line gaps less than 10
        for y in range(0, len(self.line_list)):
            if(y < len(self.line_list)-1):
                if(self.line_list[y+1] - self.line_list[y] > 10):
                    cv2.line(_img,(0,self.line_list[y]),(img_width,self.line_list[y]),(0,0,255),1)
                    self.lines_to_crop.append(self.line_list[y])
            else:
                cv2.line(_img,(0,self.line_list[y]),(img_width,self.line_list[y]),(0,0,255),1)
                self.lines_to_crop.append(self.line_list[y])
        cv2.imwrite("file.jpg", _img)
        return

    """
    slices the image

    @param question_num image identifier
    @param con_reader   object that uses OCR to read from sliced images
    """
    def slice_image(self, question_num, con_reader):
        # Sort and remove all occurences of 0 (coordinates)
        vari = 0
        max_vari = 5
        init_bound = self.bounds_checker
        restart = False
        #print("Marking Question "+str(question_num))
        while(vari < max_vari):
            vari = vari + 1
            #print("Starting with variable "+str(vari))
            if (vari > 1):
                restart = True

            self.bounds_checker = init_bound
            self.lines_to_crop.sort()
            zero_occ = self.lines_to_crop.count(0)

            for index in range(0, zero_occ):
                self.lines_to_crop.remove(0)

            if(len(self.lines_to_crop) == 0):
                err = Error("Incorrect Image Format!")
                raise err

            if(self.img_script == None):
                err = Error("Failed To Read Image!")
                raise err

            from_height = 0
            img_id = 1

            # Slice image according to coordinates
            
            for index in range(0, len(self.lines_to_crop)):
                to_height = self.lines_to_crop[index]
                file_name_full = 'sliced_images/full_sliced_img_' + str(img_id) + '.jpg'
                area_to_crop_full = (0, from_height+4, (self.img_width), to_height-vari)
                cropped_img_full = self.img_script.crop(area_to_crop_full)
                cropped_img_full.save(file_name_full)

                from_height = to_height
                img_id += 1
                self.img_count += 1

            # Slice last image
            file_name_full = 'sliced_images/full_sliced_img_' + str(img_id) + '.jpg'
            area_to_crop_full = (0, from_height, (self.img_width), self.img_height)
            cropped_img_full = self.img_script.crop(area_to_crop_full)
            cropped_img_full.save(file_name_full)
            self.img_count += 1       

            # Use text detector to crop text area
            image_list =  sorted(glob.glob("sliced_images/full_sliced_img_*"), key=lambda name: int(name[name.find('g_')+2:-4]))
            text_detector.detect_text_region(image_list, vari*2)

            # Getting directories of where sliced images will be placed

            sub_folders = sorted(glob.glob("sliced_images/q_"+str(question_num)+"/*"), key=lambda name: int(name[name.find('.')+1]))
            if(len(sub_folders) == 0):
                err = Error("Missing Sub-Folders (Question "+str(question_num)+")")
                raise err

            sub = -1
            p_eof = 0
            started = False
            # Read the content from the sliced images using OCR
            try:
                json_data = con_reader.batch_ocr(sorted(glob.glob("sliced_images/sliced_img_*"),key=lambda name: int(name[name.find('g_')+2:-4])), restart)
            except Error as e:
                e.print_error()
                sys.exit(0)
            # A counter for every valid step
            step_counter = 1
            total_sliced_imgs = len(sorted(glob.glob("sliced_images/sliced_img_*"),key=lambda name: int(name[name.find('g_')+2:-4])))
            vari_changed = False
            #delete_files = False

            empties = 0
            valid_steps = 0
            for i in range(0, total_sliced_imgs):

                if (vari_changed and vari < max_vari):
                    vari_changed = False
                    if os.path.isdir("sliced_images\extra_"+str(question_num)):
                        shutil.rmtree("sliced_images\extra_"+str(question_num))

                    if os.path.isdir("sliced_images\q_"+str(question_num)):
                        shutil.rmtree("sliced_images\q_"+str(question_num))

                    os.mkdir("sliced_images/extra_"+str(question_num))
                    os.mkdir("sliced_images/q_"+str(question_num))

                    folder_path = "sliced_images/q_"+str(question_num)

                    for j in range(self.s_q[question_num-1]):
                        os.mkdir(folder_path+"/q_"+str(question_num)+"."+str(j+1))

                    restart = True
                    break

                if(self.bounds_checker < question_num*23):
                    self.bounds_checker = self.bounds_checker + 1

                # Get contents of a sliced image
                result = json_data['results']['img_'+str(self.bounds_checker)]

                # If the content of the sliced img is not a valid math step
                if(self.is_not_valid_math_step(result['latex']) or result['latex_confidence'] < 0.5):
                    shutil.move(os.path.join("sliced_images/","sliced_img_"+str(i+1)+".jpg"), os.path.join("sliced_images/", "extra_"+str(question_num)))
                    shutil.move(os.path.join("sliced_images/","full_sliced_img_"+str(i+1)+".jpg"), os.path.join("sliced_images/", "extra_"+str(question_num)))
                    empties = empties + 1
                    # Detected new sub question
                    p_eof = p_eof + 1
                    sub = sub + 1

                    # Detected more than 1 non-math line i.e. end of page indicator
                    if (p_eof > 1):
                        sub = sub - 1

                # Is a valid math step
                else:
                    # Detected more than 1 non-math line i.e. format wasn't followed or step wasn't read
                    if (p_eof > 2 and started != False):
                        vari_changed = True
                        if (vari > max_vari):
                            err = Error("Incorrect numbering format or Failed to read step!"+str(question_num))
                            raise err
                        continue

                    started = True
                    valid_steps = valid_steps + 1
                    p_eof = 0
                    # extract all valid math steps
                    self.page_steps['q'+str(question_num)+'_step_'+str(step_counter)] = {}
                    self.page_steps['q'+str(question_num)+'_step_'+str(step_counter)]['latex'] = result['latex']
                    self.page_steps['q'+str(question_num)+'_step_' + str(step_counter)]['latex_confidence'] = result['latex_confidence']
                    self.page_steps['q'+str(question_num)+'_step_' + str(step_counter)]['img_width'] = result['position']['width']
                    self.page_steps['q'+str(question_num)+'_step_' + str(step_counter)]['img_height'] = result['position']['height']
                    step_counter = step_counter + 1

                    shutil.copy("sliced_images/sliced_img_"+str(i+1)+".jpg", "all_steps_"+str(question_num)+"/")
                    shutil.copy("sliced_images/full_sliced_img_"+str(i+1)+".jpg", "all_steps_"+str(question_num)+"/")

                    if (sub > len(sub_folders)-1):
                        vari_changed = True
                        if (vari > max_vari):
                            err = Error("Failed to read step! Question "+str(question_num)+"."+str(sub))
                            raise err 
                        continue

                    shutil.move("sliced_images/sliced_img_"+str(i+1)+".jpg", sub_folders[sub])
                    shutil.move("sliced_images/full_sliced_img_"+str(i+1)+".jpg", sub_folders[sub])


            if ((valid_steps + empties) == total_sliced_imgs and (empties < valid_steps)):
                return
            elif (vari < max_vari):
                if os.path.isdir("sliced_images\extra_"+str(question_num)):
                    shutil.rmtree("sliced_images\extra_"+str(question_num))

                if os.path.isdir("sliced_images\q_"+str(question_num)):
                    shutil.rmtree("sliced_images\q_"+str(question_num))

                os.mkdir("sliced_images/extra_"+str(question_num))
                os.mkdir("sliced_images/q_"+str(question_num))

                folder_path = "sliced_images/q_"+str(question_num)
                    
                for j in range(self.s_q[question_num-1]):
                    os.mkdir(folder_path+"/q_"+str(question_num)+"."+str(j+1))
                    


        if (((valid_steps + empties) == total_sliced_imgs and (empties < valid_steps)) or vari > max_vari-1):
            return

    """
    gets the total number of sliced images

    @return the total number of sliced images
    """
    def get_image_count(self):
        return self.img_count

    def is_not_valid_math_step(self, step):
        return (step == "" or 
               step.find("cdot") > -1 or 
               step.find(".") == 1 or 
               len(step) == 1 or 
               step.find(",") == 1 or 
               step.isdigit() or
               (step.find("=") == -1 and
               step.find("leq") == -1 and step.find("geq") 
               and step.find("<") == -1 and 
               step.find(">") == -1))

    """
    gets all valid math steps

    @return all valid math steps in json format
    """
    def get_page_steps(self):
        return self.page_steps

    """
    executes the whole class

    @param question_num image identifier
    @param con_reader   object that uses OCR to read from sliced images
    @see                #detect_lines(), #slice_image()
    """
    def execute_slicer(self, question_num, con_reader):

        try:
            self.detect_lines()
            self.slice_image(question_num, con_reader)
        except Error as e:
            e.print_error()
            sys.exit(0)


    """
    stacks sliced (annotated) images vertically to form the whole image again

    @param  num_questions   total number of questions in an answer script
    """
    def image_vertical_stack(self, num_questions):

        extra_folder_list = sorted(glob.glob("sliced_images/extra_*"), key=lambda name: int(name[name.find('a_')+2]))
        if(len(extra_folder_list) == 0):
            err = Error("Missing Non-Math Folders!")
            raise err

        counter = 1

        for extra_folder_path in extra_folder_list:

            non_math_images = sorted(glob.glob(extra_folder_path+"/full_sliced_img_*"), key=lambda name: int(name[name.find('g_')+2:-4]))
            if(len(non_math_images) == 0):
                err = Error("Missing Non-Math Images!")
                raise err

            marked_images = sorted(glob.glob(self.steps_folder_path+str(counter)+"/full_sliced_img_*"), key=lambda name: int(name[name.find('g_')+2:-4]))
            if(len(marked_images) == 0):
                err = Error( "Missing Math Steps!")
                raise err

            for non_math_image in non_math_images:
                shutil.copy(non_math_image, "ready_images_"+str(counter)+"/")

            for marked_image in marked_images:
                shutil.copy(marked_image, "ready_images_"+str(counter)+"/")

            if(len(glob.glob("ready_images_"+str(counter)+"/*.jpg")) == 0):
                err = Error("Missing Ready Images: (Question "+str(counter)+")!")
                raise err

            images = [cv2.imread(img) for img in sorted(glob.glob("ready_images_"+str(counter)+"/*.jpg"), key=lambda name: int(name[31:-4]))]

            height = sum(image.shape[0] for image in images)
            width = max(image.shape[1] for image in images)
            output = np.zeros((height,width,3))

            y = 0
            for image in images:
                h,w,d = image.shape
                output[y:y+h,0:w] = image
                y += h

            cv2.imwrite("marked_final/marked_answer_sheet_"+str(counter)+".jpg", output)

            counter = counter + 1
        return

    """
    converts pdf to images

    @param file_name   document file name
    @param file_path   destination path
    """
    def convert_pdf2img(self, file_name, file_path):
        pdf_im = pyPdf.PdfFileReader(open(file_name, "rb"))
        npage = pdf_im.getNumPages()
        for p in range(0, npage):
            im = PythonMagick.Image()
            im.density('200')
            im.quality(80)
            im.read(file_name+'['+ str(p) +']')
            im.write(file_path+'/question' + str(p+1)+ '.jpg')
    
        img_array = sorted(glob.glob(file_path+"/*.jpg"), key=lambda name: int(name[name.find('question')+8:-4]))

        if(len(img_array) == 0):
            err = Error("No Files To Convert!")
            raise err

        return img_array

    """
    executes the whole class

    @param num_questions   total number of questions in an answer script
    @param marks           an array of marks that indicates which of the marked steps are correct or wrong
    @see                   #annotate_image(), #image_vertical_stack()
    """
    def execute_imagestacker(self, num_questions):
        try:
            self.image_vertical_stack(num_questions)
        except Error as e:
            e.print_error()
            sys.exit(0)
        return
