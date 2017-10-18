#!C:/Python36-32/python.exe
"""
content_reader.py
This class implements operations that will be used for reading content from the images.
The class operations are as follows:
    -> read_content()
    -> batch_ocr()
    -> check_img_keys()
    -> execute_content_reader()
"""
from error import Error

import base64
from PIL import Image
import glob
import json
import requests.packages.urllib3
import sys

"""
@author     TechTitans
@since      Python3.6.2
@version    2.0.0
"""

class ContentReader:
    """
    Default constructor
    @param  img_count   the total number of sliced images for the current paper
    """
    def __init__(self, img_count):
        self.img_count = img_count
        self.img_list = [img_count]
        self.file_name_list = [img_count]
        self.main_folder = "sliced_images/"
        self.x = 0

    """
    Reads content of the sliced images and creates a json a file for the whole image

    @param  question_num image identifier
    @param  steps        valid mathematical steps in json form
    """
    def read_content(self, question_num, steps, assesment_type, is_memo, num_q, sub_l, script_id):
        if(num_q == 0):
            err = Error("No Questions Provided!")
            raise err

        if(len(sub_l) == 0):
            err = Error("No Sub-Questions Provided!")
            raise err

        if(num_q != len(sub_l)):
            err = Error("Invalid Number of Questions or Sub-Questions!")
            raise err

        file_name = ""

        # retrieve memo_id, num_questions, and num_sub_questions from database
        num_questions = num_q
        confidence_lvl = 0
        sub_list = [0 for x in range(num_questions)]

        # initialize answer script in json format
        data = {}
        data['memo_id'] = script_id
        data['num_questions'] = num_questions
        data['confidence_level'] = confidence_lvl
        data['answers'] = [0 for x in range(num_questions)]
        tot_num_steps = 0
        sub_list = sub_l

        # append question and sub_question section to json data
        for i in range(0, num_questions):
            data['answers'][i] = {}
            data['answers'][i]['num_sub_questions'] = sub_list[i]
            data['answers'][i]['sub_questions'] = [0 for x in range(sub_list[i])]

            for j in range(0, sub_list[i]):
                data['answers'][i]['sub_questions'][j] = {}

        # input the contents into json data
        for i in range(0, num_questions):
            directories = sorted(glob.glob("sliced_images/q_"+str(i+1)+"/*"), key=lambda name: int(name[name.find('.')+1]))
            if(len(directories) != sub_list[i] or len(directories) == 0):
                err = Error("Missing Folders!")
                raise err

            num_sub = len(directories)
            num_sub_q = 0
            index = 0
            # input for every sub_question in current main question
            for folder in directories:
                data['answers'][i]['sub_questions'][num_sub_q]['q_id'] = folder
                img_files = sorted(glob.glob(folder+"/sliced_img_*"), key=lambda name: int(name[name.find('g_')+2:-4]))
                if(len(img_files) == 0):
                    err = Error(folder+"! Content Reader: Missing Steps!")
                    raise err

                data['answers'][i]['sub_questions'][num_sub_q]['num_steps'] = len(img_files)
                data['answers'][i]['sub_questions'][num_sub_q]['steps'] = [0 for x in range(len(img_files))]
                counter = 0
                # input for every step in current sub_question
                for img_file in img_files:

                    obj_list = steps['q'+str(question_num)+'_step_'+str(index+1)]
                    data['answers'][i]['sub_questions'][num_sub_q]['steps'][counter] = {}

                    data['answers'][i]['sub_questions'][num_sub_q]['steps'][counter]['step'] = obj_list['latex']
                    if(is_memo == True):
                        data['answers'][i]['sub_questions'][num_sub_q]['steps'][counter]['score'] = 1
                    else:
                        data['answers'][i]['sub_questions'][num_sub_q]['steps'][counter]['confidence_level'] = obj_list['latex_confidence']
                        data['confidence_level'] = data['confidence_level'] + obj_list['latex_confidence']
                        data['answers'][i]['sub_questions'][num_sub_q]['steps'][counter]['img_width'] = obj_list['img_width']
                        data['answers'][i]['sub_questions'][num_sub_q]['steps'][counter]['img_height'] = obj_list['img_height']
                    tot_num_steps = tot_num_steps + 1
                    counter = counter + 1
                    index = index + 1
                num_sub_q = num_sub_q + 1
            question_num = question_num + 1
        # calculate confidence level
        data['confidence_level'] = data['confidence_level']/(tot_num_steps) * 100

        # save json data as answer script json file
        json_data = json.dumps(data, indent=4, sort_keys=False)
        json_file = None
        if(is_memo == False):
            json_file = open("../answer_scripts/processed/"+assesment_type+"/"+script_id+".json", "w")
        else:
            json_file = open("../../../../marker/memo/"+assesment_type+"/"+script_id+".json", "w")
        json_file.write(json_data)
        json_file.close()
        return

    """
    uses Mathpix OCR reader to detect content from an image

    @param  src_p        an array of sliced images
    @see                 #check_img_keys()
    @return              content read from image as json object
    """
    def batch_ocr(self, src_p, restart):
        if(len(src_p) == 0):
            err = Error("No Image Data For OCR!")
            raise err

        src = sorted(src_p, key=lambda name: int(name[name.find("g_")+2:-4]))

        # initialise images to be sent to Mathpix
        data = {}
        data['urls'] = {}
        data['callback'] = {}
        data['callback']['post'] = "https://requestb.in/1hee59v1"
        # append sliced images to data json
        if (restart):
            self.x = self.x - 23

        for img in src:
            self.x = self.x + 1
            data['urls']['img_'+str(self.x)] = "data:image/jpeg;base64," + base64.b64encode(open(img, "rb").read()).decode("utf-8")

        # post data json to mathpix api
        r = requests.post(
            "https://api.mathpix.com/v3/batch", data=json.dumps(data),
            headers={
                'app_id': 'lsg',
                'app_key': '851562083f16c98fe08e7c3b918066ba',
                'content-type': 'application/json'
            },
            timeout=30
        )

        reply = json.loads(r.text)

        while(True):
            #print("Checking Image Keys...")
            results = requests.get("https://api.mathpix.com/v3/batch/"+reply['batch_id'], headers={
                'app_id': 'lsg',
                'app_key': '851562083f16c98fe08e7c3b918066ba',
            })
            if(self.check_img_keys(json.loads(results.content))):
                break
           

        # Check for the last image key
        while(True):
            #print("Checking Last Image Key...")
            results = requests.get("https://api.mathpix.com/v3/batch/"+reply['batch_id'], headers={
                'app_id': 'lsg',
                'app_key': '851562083f16c98fe08e7c3b918066ba',
            })
            if(self.check_end_img_keys(json.loads(results.content))):
                break       

        return json.loads(results.content)

    """
    checks if all keys are present

    @param  json_data        results from Mathpix API
    @return                  boolean value
    """
    def check_img_keys(self, json_data):
        for index in range(self.x - 23, self.x-1):
            if 'img_'+str(index+1) not in json_data['results']:
                #print('img_'+str(index+1))
                return False
        return True

    def check_end_img_keys(self, json_data):
        if 'img_'+str(self.x) not in json_data['results']:
            return False
        return True

    """
    executes the whole class
    @param  question_num    image identifier
    @param  steps           valid mathematical steps in json form
    @see                    #read_content()
    """
    def execute_content_reader(self, question_num, steps, assesment_type, is_memo, num_q, sub_l, script_id):
        try:
            self.read_content(question_num, steps, assesment_type, is_memo, num_q, sub_l, script_id)
        except Error as e:
            e.print_error()
            sys.exit(0)
        return
