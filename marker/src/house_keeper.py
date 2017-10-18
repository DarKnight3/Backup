#!C:/Python36-32/python.exe
"""
house_keeper.py
This is a file containing static house keeping functions.
The operations are as follows:
    -> create_dirs()
    -> delete_dirs()
"""
import os
import shutil
"""
@author     TechTitans
@since      Python3.6.2
@version    1.0.0
"""

"""
Creates directories that are used for marking

@param num_questions    total number of questions in an answer script
@param sub_list         an array containing the number of subquestions for each question
"""
def create_dirs(num_questions, sub_list):
    delete_dirs(num_questions)
    if not os.path.isdir("sliced_images/"):
        os.mkdir("sliced_images/")

    # create the 'question' folders
    for i in range(0, num_questions):
        folder_path = "sliced_images/q_"+str((i+1))
        os.mkdir(folder_path)
        for j in range(0, sub_list[i]):
            os.mkdir(folder_path+"/q_"+str(i+1)+"."+str(j+1))

        # create the 'extra' folder
        os.mkdir("sliced_images/extra_"+str(i+1))

        # create the 'all_steps' folders
        os.mkdir("all_steps_"+str(i+1))

        # create the 'ready_images' folder
        os.mkdir("ready_images_"+str(i+1))

    # create the 'marked final' folder
    if not os.path.isdir("marked_final"):
        os.mkdir("marked_final")
    return

"""
Deletes the directories created by the system

@param num_questions    total number of questions in an answer script
"""
def delete_dirs(num_questions):
    if os.path.isdir("sliced_images"):
        shutil.rmtree("sliced_images")

    for i in range(0, num_questions):
        if os.path.isdir("all_steps_"+str(i+1)):
            shutil.rmtree("all_steps_"+str(i+1))
        if os.path.isdir("ready_images_"+str(i+1)):
            shutil.rmtree("ready_images_"+str(i+1))

    if os.path.isdir("marked_final"):
        shutil.rmtree("marked_final")
