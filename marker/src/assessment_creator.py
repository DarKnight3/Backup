#!C:/Python36-32/python.exe
import sys
sys.path.insert(0, 'C:/Python36-32/Lib/site-packages')
"""
assessment_creator.py
This class implements operations that will be used to upload the memo.
The class operations are as follows:
    -> prepare_memo()

"""
from content_reader import ContentReader
from error import Error
from image_processor import ImageProcessor
from PIL import Image
import db_controller
import house_keeper
"""
@author     TechTitans
@since      Python3.6.2
@version    1.0.0
"""
class AssessmentCreator:
    """
    Reads content of a memorandum paper and produces a json file

    @param  memo_path           The file path of the memorandum document
    @param  tot_num_questions   The total number of questions in the memorandum
    @param  sub_questions_arr   A list of all the total number of sub-questions in each question
    @param  memo_id             The memorandum identifier in the database
    """
    def prepare_memo(self, memo_path, tot_num_questions, sub_questions_arr, memo_id):
        memo_src = db_controller.get_memo_path(memo_id)
        subq_array = db_controller.get_subquestions_count(memo_id)        
        reader_obj = ContentReader(23)
        img_processor = ImageProcessor(tot_num_questions, subq_array)
        house_keeper.create_dirs(tot_num_questions, sub_questions_arr)
        file_path = db_controller.get_memo_path(memo_id)
        memo_script_id = file_path[file_path.rfind("/")+1:file_path.find(".")]

        if(memo_path.lower().endswith('.zip')):
            try:  
                questions = img_processor.unzip_files(memo_path)
                ext = "zip"
            except Error as e:
                e.print_error()
                sys.exit(0)
        elif(memo_path.lower().endswith('.pdf')):
            try:
                memo_scripts_path = "../../../../marker/memo/"+db_controller.get_assesment_type(memo_id)
                questions = img_processor.convert_pdf2img(memo_path, memo_scripts_path)
                ext = "pdf"
            except Error as e:
                e.print_error()
                sys.exit(0)

        for index in range(0, tot_num_questions):
            file_name = questions[index]
            img_processor.read_img(file_name)
            img_processor.execute_slicer(index + 1, reader_obj)


        question_num = 1
        reader_obj.execute_content_reader(question_num, img_processor.get_page_steps(), str(db_controller.get_assesment_type(memo_id)), True, tot_num_questions, sub_questions_arr, memo_script_id)
        house_keeper.delete_dirs(tot_num_questions)
        return

assmnt_creator_obj = AssessmentCreator()
assmnt_creator_obj.prepare_memo(sys.argv[1], db_controller.get_num_questions(sys.argv[2]), db_controller.get_subquestions_count(sys.argv[2]), sys.argv[2])
print("<center><div class='alert alert-success'>Finished Making Memo</div></center>")
