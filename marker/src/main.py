#!C:/Python36-32/python.exe
import sys
sys.path.insert(0, 'C:/Python36-32/Lib/site-packages')
"""
main.py
"""
from content_reader import ContentReader
from error import Error
from image_processor import ImageProcessor
from paper_marker import Marker

import db_controller
from PIL import Image
import glob
import house_keeper
import image_annotator
import pdf_converter

"""
@author     TechTitans
@since      Python3.6.2
@version    2.0.0

"""

# Read command line arguments
file_path = sys.argv[1]
q_memo_id = sys.argv[2]
mark_sheet_id_ = sys.argv[3]

# Get database information
num_of_questions = db_controller.get_num_questions(q_memo_id)
assess_type = str(db_controller.get_assesment_type(q_memo_id))
memo_src = db_controller.get_memo_path(q_memo_id)
subq_array = db_controller.get_subquestions_count(q_memo_id)

house_keeper.create_dirs(num_of_questions, subq_array)

# Initialize variables
answer_scripts_file = "../answer_scripts/unprocessed/"+str(file_path)
answer_scripts_path = "../answer_scripts/unprocessed/"+db_controller.get_assesment_type(q_memo_id);
num_questions = 0
question_num = 1
ext = ""
exam_number = file_path[file_path.rfind("/")+1:file_path.find(".")]
reader_obj = ContentReader(23)
img_processor = ImageProcessor(num_of_questions, subq_array)

if(file_path.lower().endswith('.zip')):
    questions = img_processor.unzip_files(answer_scripts_file)
    ext = "zip"
elif(file_path.lower().endswith('.pdf')):
    try:
        questions = img_processor.convert_pdf2img(answer_scripts_file, answer_scripts_path)
        ext = "pdf"
    except Error as e:
        e.print_error()
        house_keeper.delete_dirs(num_of_questions)
        sys.exit(0)

obt_mark = None
result_status = None
ink_color = None

# Begin Image Processing
for index in range(0, len(questions)):
    file_name = questions[index]
    img_processor.read_img(file_name)
    img_processor.execute_slicer(index + 1, reader_obj)


# Begin Content Reading
reader_obj.execute_content_reader(question_num,
                                    img_processor.get_page_steps(),
                                    assess_type,
                                    False,
                                    num_of_questions,
                                    subq_array,
                                    exam_number)

scripts = glob.glob("../answer_scripts/processed/"+assess_type+"/"+exam_number+".json")

# Begin Marking
for script in scripts:
    marker_obj = Marker("../"+memo_src)
    try:
        marker_obj.smart_mark(script, "../"+memo_src)
    except Error as e:
        e.print_error()
        #house_keeper.delete_dirs(num_of_questions)
        sys.exit(0)
    obt_mark = round(marker_obj.get_percentage_score(), 1)
    db_controller.save_marks(obt_mark, mark_sheet_id_)
    img_processor.execute_imagestacker(num_questions)

# Finalize annotation
if(obt_mark >= 75.0):
    result_status = "Execellent!"
    class_="success"
    color="green"
    ink_color = (0, 255, 0)
elif(obt_mark >= 50 and obt_mark <= 74.9):
    result_status = "Pass!"
    class_="warning"
    color="blue"
    ink_color = (255, 0, 0)
else:
    result_status = "Fail!"
    class_="danger"
    color="red"
    ink_color = (0, 0, 255)

image_annotator.write_mark(obt_mark, result_status, ink_color)
img_list = sorted(glob.glob("marked_final/*.jpg"), key=lambda name: int(name[33:-4]))
img_processor.convert_to_pdf(img_list, file_path, ext)

# Notify completion
full_name_="../marker/marked_scripts/"+str(file_path);
full_name__=str(file_path);
file_name_=str(full_name_[0:full_name_.rfind(ext)])+"pdf";
file_name__=str(full_name__[0:full_name__.rfind(ext)])+"pdf";

# if(db_controller.update_num_scripts(q_memo_id)):
print("{\"mark\":"+str(obt_mark)+", \"download\":\""+file_name_+"\", \"file\":\""+file_name__+"\"}")

# print("<center><div class='result'><p  class='label-marks' style='font-size:20pt;color:"+color+"'>Mark obtained</p><div class='label-marks' style='color:"+color+"'>"+str(obt_mark)+"%</div><br/><a target='_blank' href='"+file_name_+"' class='btn btn-primary'>Download script</a><br/><br/><div class='alert alert-success'>Finished Marking</div></div></center>")
# else:
# print("<center><div class='result'><p  class='label-marks' style='font-size:20pt'>Mark obtained</p><div class='label-marks'>"+str(obt_mark)+"%</div><br/><a target='_blank' href='"+file_name_+"' class='btn btn-primary'>Download script</a><br/><br/><div class='alert alert-info'>Finished Marking</div></div></center>")
asses_id = db_controller.get_assesment_id(q_memo_id)
no_papers_marked = db_controller.get_num_scripts_marked(q_memo_id)+1
db_controller.update_num_scripts(q_memo_id, no_papers_marked, asses_id)
#house_keeper.delete_dirs(num_of_questions)
