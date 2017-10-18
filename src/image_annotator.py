#!C:/Python36-32/python.exe
import sys
sys.path.insert(0, 'C:/Python36-32/Lib/site-packages')
"""
image_annotator.py
This file implements operations that will be used to annotate the script to be marked
The operations are as follows:
    -> draw_correct()
    -> draw_incorrect()
    -> write_mark()
"""
from PIL import Image

import cv2
import glob

"""
@author     TechTitans
@since      Python3.6.2
@version    2.0.0
"""

"""
Draws a correct tic to the given math step image

@param file_name    the filename of the current step
"""
def draw_correct(file_name):
    _img = cv2.imread(file_name)
    _img_width, _img_height = Image.open(file_name).size

    # Calculate the postion where to put the tic
    height_offset = int(_img_height * 0.75)
    x1 = _img_width - 600
    y1 = height_offset
    x2 = x1 + 10
    y2 = height_offset + 10

    # Draw the tick
    cv2.line(_img, (x1, y1), (x2, y2), (0, 255, 0), 2)
    cv2.line(_img, (x2, y2), (x2+10, int(height_offset*0.5)), (0, 255, 0), 2)
    # Save the annotated image
    cv2.imwrite(file_name, _img)
    return

"""
Draws a cross to the given math step image

@param file_name    the filename of the current step
"""
def draw_incorrect(file_name):
    _img = cv2.imread(file_name)
    _img_width, _img_height = Image.open(file_name).size

    # Calculate the postion where to put the tic
    height_offset = int(_img_height * 0.35)
    x1 = _img_width - 600
    y1 = height_offset
    x2 = x1 + 10
    y2 = height_offset * 2

    # Draw the tick
    cv2.line(_img, (x1, y1), (x2, y2), (0, 0, 255), 2)
    cv2.line(_img, (x1, y1+height_offset), (x2, y2-height_offset), (0, 0, 255), 2)
    # Save the annotated image
    cv2.imwrite(file_name, _img)
    return


"""
Writes the mark obtained on the paper

@param  obt_mark     the mark obtained
@param  res_status   pass or fail
@param  color        the color of the status i.e. red = fail and green = pass
"""
def write_mark(obt_mark, res_status, color):
    img_list = sorted(glob.glob("marked_final/*.jpg"), key=lambda name: int(name[33:-4]))
    first_img = img_list[0]
    img = cv2.imread(first_img)
    img_width, img_height = Image.open(first_img).size
    font = cv2.FONT_HERSHEY_SIMPLEX
    cv2.circle(img,(img_width-500, 80), 63, color, 1)
    cv2.putText(img, str(obt_mark)+"%", (img_width-550, 90), font, 1, color, 2, cv2.LINE_AA)
    cv2.putText(img, str(res_status), (img_width-440, 130), font, 1, color, 2, cv2.LINE_AA)
    cv2.imwrite(first_img, img)
    return
