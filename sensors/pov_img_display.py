#!/usr/bin/python

import time

import pov_img_display
import pov_img_factory as pif
import RPi.GPIO as GPIO
import numpy as np
from dotstar import Adafruit_DotStar

""" Not used right now.
def sensorHallback():
  global timediff  
  timediff = time.perf_counter()
"""
""" def buttonCallback():
    global presses
    if presses == None:
        presses == 0
    else:
        presses += 1 """

#buttonCallback()
data = 10
clk = 11
strip = Adafruit_DotStar(0,data,clk)
""" GPIO.setmode(GPIO.BCM)
GPIO.setup(17 , GPIO.IN, pull_up_down=GPIO.PUD_UP)
GPIO.add_event_detect(17, GPIO.FALLING, callback=sensorCallback, bouncetime=1) """
seconds_delay = 0.5
window_time = 0.0001
img = pif.LmImage()
pixels = img.pix_ary
width = len(pixels[0,:])

img_sequence = [bytearray(40*4) for x in range(width)]

for im in range(len(img_sequence)): #for each image in the sequence
    for j in range(5): # for each column of the image
        if j <= im:
            j8 = j*8
            if not j%2: #if even
                img_sequence[im][j8:j8+32] = pixels[:,width-1-im-j]
            else: # if odd
                img_sequence[im][j8:j8+32] = np.flipud(pixels[:,width-1-im-j])
        else:
            pass

timestamp1 = time.time()
timediff = 0.0
while timediff < 1.0:
    for im in range(len(img_sequence)):
        strip.show(img_sequence[im])
        time.sleep(0.001)
    timediff = time.time - timestamp1

                