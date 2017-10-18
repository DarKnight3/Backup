#!C:/Python36-32/python.exe
"""
paper_marker.py
This class implements operations that will be used to mark the answer script.
The class operations are as follows:
    -> smart_mark()
    -> get_percentage_score()
    -> get_score()
    -> update_ticks()
"""
from error import Error

import glob
from PIL import Image
import image_annotator
import json
import os
"""
@author     TechTitans
@since      Python3.6.2
@version    2.0.0
"""
class Marker:
    """
    Class Constructor

    @param  src     file path for memo json file
    """
    def __init__(self, src):
        self.marks = list()
        self.score = 0

        # Retrieve memo and initialize stacker
        with open(src) as json_data:
            self.memo = json.load(json_data)


        # Initialize marks and ticks list
        for q in self.memo['answers']:
            for sq in q['sub_questions']:
                for st in sq['steps']:
                    self.marks.append(st['score'])


    """
    Updates the ticks for this paper

    """
    def update_ticks(self, ticks):
        del self.ticks[:]
        self.ticks = ticks


    """
    gets the total marks for this question

    @return     total marks for this question
    """
    def get_score(self):
        score = 0
        for sub_score in self.marks:
            score = score + sub_score

        return score

    """
    Returns percentage of the marked paper

    @return         percentage value
    """
    def get_percentage_score(self):
        return (self.score/self.get_score()*100)

    """
    Marks an answer script against the given memo

    @param  answer_src    file path for json answer script
    @param  memo          file path for json memo script
    @see                  #question_marker.update_ticks()
    """
    def smart_mark(self, answer_src, memo):

        if(os.path.isfile(answer_src) == False):
            err = Error("Missing Answer Script!")
            raise err

        if(os.path.isfile(memo) == False):
            err = Error("Missing Memo File!")
            raise err

        # Open Memo Script
        with open(memo) as json_data:
            memo_src = json.load(json_data)

        # Open Answer Script
        with open(answer_src) as json_data:
            a_script = json.load(json_data)

        total_score = 0
        index = 0
        q_index = -1

        # Marking question by question
        for q in a_script['answers']:

            image_list =  sorted(glob.glob("all_steps_"+str(q_index+2)+"/full_sliced_img_*"), key=lambda name: int(name[name.find('g_')+2:-4]))
            if(len(image_list) == 0):
                err = Error("Paper Marker: Missing Steps!")
                raise err
            index = 0

            q_index = q_index + 1
            sub_index = -1
            # Marking sub_question by sub_question
            for sq in q['sub_questions']:
                sub_index = sub_index + 1
                last_tick = 0
                n_space = 0
                missed = 1

                # Marking step by step
                for st in sq['steps']:
                    correct = False
                    n_space = last_tick
                    missed = 1
                    # For every step in memo for current sub_question
                    for m_step in memo_src['answers'][q_index]['sub_questions'][sub_index]['steps']:
                        # Make sure to start marking from last tick
                        if (n_space > 0):
                            n_space = n_space - 1
                            continue

                        #Actual comparing
                        if(st['step'] == m_step['step']):
                            image_annotator.draw_correct(image_list[index])
                            last_tick = last_tick + missed
                            missed = 1
                            total_score = total_score + m_step['score']
                            correct = True
                            break
                        else:
                            missed = missed + 1

                    if (correct is False):
                        image_annotator.draw_incorrect(image_list[index])

                    index = index + 1
        self.score = total_score
