#!C:/Python36-32/python.exe
import sys
# sys.path.insert(0, 'C:/Python36-32/Lib/site-packages')
"""
db_controller.py
This file acts as a controller static class to facilitate communication between the back-end application and database.
The operations are as follows:
    -> database_connect()
    -> database_disconnect()
    -> get_num_questions()
    -> get_memo_path()
    -> get_assesment_id()
    -> get_assesment_type()
    -> save_marks()
"""

import pymysql

"""
@author     TechTitans
@since      Python3.6.2
@version    2.0.0
"""

"""
connects to the database
@return     the connected database object, cursor (query executor)
"""
def database_connect():
    pymysql.install_as_MySQLdb()
    server = "localhost"
    username = "mkdevhub_caracal_user"
    password = "6~5Ke.7*oH}I!"
    databas_name = "mkdevhub_caracal_db"
    db = pymysql.connect(server, username, password, databas_name)
    cursor = db.cursor()
    return [db, cursor]

"""
Disconnects from the database

@param db   connected database object
"""
def database_disconnect(db):
    db.close()
    return

"""
Gets the number of questions for an answer script

@param  q_memo_id   The memorandum identifier in the database
@return             The number of questions for an answer script
"""
def get_num_questions(q_memo_id):
    arr = database_connect()
    db_ = arr[0]
    cursor = arr[1]

    sql = "SELECT total_number_of_questions FROM memo WHERE memo_id="+str(q_memo_id)
    num_questions = 0

    try:
        cursor.execute(sql)
        results = cursor.fetchall()
        for row in results:
            num_questions = row[0]
    except:
        print("Could not get number of questions.")
    database_disconnect(db_)
    return num_questions

def get_num_scripts_marked(q_memo_id):
    assesment_id = get_assesment_id(q_memo_id)
    arr = database_connect()
    db_ = arr[0]
    cursor = arr[1]

    sql = "SELECT no_papers_marked FROM assesment WHERE assesment_id="+str(assesment_id)
    num_questions = 0

    try:
        cursor.execute(sql)

        results = cursor.fetchall()
        for row in results:
            num_questions = row[0]
    except:
        print("Could not get number of scripts.")
    database_disconnect(db_)
    return num_questions

def update_num_scripts(q_memo_id, no_papers_marked, assesment_id):
    #no_papers_marked = get_num_scripts_marked(q_memo_id)+1
    #assesment_id = get_assesment_id(q_memo_id)
    arr = database_connect()
    db_ = arr[0]
    cursor = arr[1]

    sql = "UPDATE assesment SET no_papers_marked="+str(no_papers_marked)+" WHERE assesment_id="+str(assesment_id)
    try:
        cursor.execute(sql)
        db_.commit()
    except:
        print("Could not update the assessment.")

    database_disconnect(db_)
    return 

"""
Gets the array of number of sub-questions for each question

@param  q_memo_id   The memorandum identifier in the database
@return             The number of sub-questions for each question
"""
def get_subquestions_count(q_memo_id):
    arr = database_connect()
    db_ = arr[0]
    cursor = arr[1]

    sql = "SELECT sub_question_count FROM memo WHERE memo_id="+str(q_memo_id)
    sub_questions_count = ""

    try:
        cursor.execute(sql)
        results = cursor.fetchall()
        for row in results:
            sub_questions_count = row[0]
    except:
        print("Could not number of sub questions.")
    database_disconnect(db_)

    sub_questions_arr = sub_questions_count.split(",")
    sub_questions = [0 for x in range(len(sub_questions_arr))]

    for x in range(0, len(sub_questions_arr)):
        sub_questions[x] = int(sub_questions_arr[x])
    return sub_questions

"""
Gets the memo json file path

@param  q_memo_id   The memorandum identifier in the database
@return the memo json file path
"""
def get_memo_path(q_memo_id):
    arr = database_connect()
    db_ = arr[0]
    cursor = arr[1]

    sql = "SELECT file_path FROM memo WHERE memo_id="+str(q_memo_id)
    memo_path = None

    try:
        cursor.execute(sql)
        results = cursor.fetchall()
        for row in results:
            memo_path = "memo/"+str(row[0])
    except:
        print("Could not get memo path.")
    database_disconnect(db_)
    return memo_path

"""
Gets the assessment id for the assessment

@param  q_memo_id   The memorandum identifier in the database
@return the assessment id for the assessment
"""
def get_assesment_id(q_memo_id):
    arr = database_connect()
    db_ = arr[0]
    cursor = arr[1]

    sql = "SELECT assesment_id FROM memo WHERE memo_id="+str(q_memo_id)
    assesment_id = None

    try:
        cursor.execute(sql)
        results = cursor.fetchall()
        for row in results:
            assesment_id = row[0]
    except:
        print("Could not get assesment id.")
    database_disconnect(db_)
    return assesment_id

"""
Gets the assessment type for the assessment

@param  q_memo_id   The memorandum identifier in the database
@return the assessment type for the assessment
"""
def get_assesment_type(q_memo_id):
    arr = database_connect()
    db_ = arr[0]
    cursor = arr[1]
    assesment_id=get_assesment_id(q_memo_id)
    
    sql = "SELECT type FROM assesment WHERE assesment_id="+str(assesment_id)
    assesment_type = None

    try:
        cursor.execute(sql)
        results = cursor.fetchall()
        for row in results:
            assesment_type = row[0]
    except:
        print("Could not get assesment type.")
    database_disconnect(db_)
    return assesment_type

"""
Saves marks to database

@param  mark_sheet_id   The script identifier in the database
@param  obt_mark        the mark obtained
"""
def save_marks(obt_mark, mark_sheet_id):
    arr = database_connect()
    db_ = arr[0]
    cursor = arr[1]
    sql = "UPDATE mark_sheet SET mark="+str(obt_mark)+" WHERE mark_sheet_id="+str(mark_sheet_id)

    try:
        cursor.execute(sql)
        db_.commit()
    except:
        print("Could not save marks.")
    database_disconnect(db_)
    return
