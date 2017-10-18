from error import Error

import PythonMagick
import pyPdf
import glob

def convert_pdf2img(file_name, file_path):
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