#!C:/Python36-32/python.exe
"""
error.py
This class implements error and exception handling
The class operations are as follows:
    -> print_error()

@author     TechTitans
@since      Python3.6.2
@version    1.0.0
"""

class Error(Exception):
	"""
    Class Constructor
    """
	def __init__(self, msg):
		self.message = msg

	"""
    Prints out an error message for raised exceptions
    """
	def print_error(self):
		print(self.message)
