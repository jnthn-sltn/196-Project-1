#!/usr/bin/python

# --------------------------------------------------------------------------
# DotStar Light Painter for Raspberry Pi.
#
# Hardware requirements:
# - Raspberry Pi computer (any model)
# - DotStar LED strip (any length, but 144 pixel/m is ideal):
#   www.adafruit.com/products/2242
# - Five momentary pushbuttons for controls, such as:
#   www.adafruit.com/products/1010
# - One 74AHCT125 logic level shifter IC:
#   www.adafruit.com/products/1787
# - High-current, high-capacity USB battery bank such as:
#   www.adafruit.com/products/1566
# - Perma-Proto HAT for Raspberry Pi:
#   www.adafruit.com/products/2310
# - Various bits and bobs to integrate the above parts.  Wire, Perma-Proto
#   PCB, 3D-printed enclosure, etc.  Your approach may vary...improvise!
#
# Software requirements:
# - Raspbian (2015-05-05 "Wheezy" version recommended; can work with Jessie
#   or other versions, but Wheezy's a bit smaller and boots to the command
#   line by default).
# - Adafruit DotStar library for Raspberry Pi:
#   github.com/adafruit/Adafruit_DotStar_Pi
# - usbmount:
#   sudo apt-get install usbmount
#   See file "99_lightpaint_mount" for add'l info.
#
# Written by Phil Burgess / Paint Your Dragon for Adafruit Industries.
#
# Adafruit invests time and resources providing this open source code,
# please support Adafruit and open-source hardware by purchasing products
# from Adafruit!
# --------------------------------------------------------------------------

import os
import select
import signal
import time
import RPi.GPIO as GPIO
from dotstar import Adafruit_DotStar
from lightpaint import LightPaint
from PIL import Image

# CONFIGURABLE STUFF -------------------------------------------------------

num_leds   = 144    # Length of LED strip, in pixels
order      = 'brg'  # 'brg' for current DotStars, 'gbr' for pre-2015 strips
vflip      = 'true' # 'true' if strip input at bottom, else 'false'

# DotStar strip data & clock MUST connect to hardware SPI pins
# (GPIO 10 & 11).  12000000 (12 MHz) is the SPI clock rate; this is the
# fastest I could reliably operate a 288-pixel strip without glitching.
# You can try faster, or may need to set it lower, no telling.
# If using older (pre-2015) DotStar strips, declare "order='gbr'" above
# for correct color order.
strip = Adafruit_DotStar(num_leds, 12000000, order=order)

gamma          = (2.8, 2.8, 2.8) # Gamma correction curves for R,G,B
color_balance  = (128, 255, 180) # Max brightness for R,G,B (white balance)
power_settings = (1450, 1550)    # Battery avg and peak current

# INITIALIZATION -----------------------------------------------------------

# Set control pins to inputs and enable pull-up resistors.
# Buttons should connect between these pins and ground.

strip.begin() # Initialize SPI pins for output

ledBuf     = strip.getPixels() # Pointer to 'raw' LED strip data
clearBuf   = bytearray([0xFF, 0, 0, 0] * num_leds)
imgNum     = 0    # Index of currently-active image
duration   = 2.0  # Image paint time, in seconds
filename   = None # List of image files (nothing loaded yet)
lightpaint = None # LightPaint object for currently-active image (none yet)

# FUNCTIONS ----------------------------------------------------------------

# Load image, do some conversion and processing as needed before painting.
def loadImage(index):
	num_images = len(filename)
	lower      =  index      * num_leds / num_images
	upper      = (index + 1) * num_leds / num_images
	for n in range(lower, upper):
		strip.setPixelColor(n, 0x010000) # Red = loading
	strip.show()
	#print("Loading '" + filename[index] + "'...")
	startTime = time.time()
	
    # Load image, convert to RGB if needed
	#img = Image.open(os.path.join(path, filename[index])).convert("RGB")
	#print("\t%dx%d pixels" % img.size)
	img 
	# Convert raw RGB pixel data to a bytes or string buffer.
	# The C module can easily work with this format.
	try:
		# Current/preferred PIL method
		pixels = img.tobytes()
	except:
		# Oldschool PIL (deprecated)
		pixels = img.tostring()
	print("\t%f seconds" % (time.time() - startTime))

	# Do external C processing on image; this provides 16-bit gamma
	# correction, diffusion dithering and brightness adjustment to
	# match power source capabilities.
	for n in range(lower, upper):
		strip.setPixelColor(n, 0x010100) # Yellow
	strip.show()
	print("Processing...")
	startTime  = time.time()
	# Pixel buffer, image size, gamma, color balance and power settings
	# are REQUIRED arguments.  One or two additional arguments may
	# optionally be specified:  "order='gbr'" changes the DotStar LED
	# color component order to be compatible with older strips (same
	# setting needs to be present in the Adafruit_DotStar declaration
	# near the top of this code).  "vflip='true'" indicates that the
	# input end of the strip is at the bottom, rather than top (I
	# prefer having the Pi at the bottom as it provides some weight).
	# Returns a LightPaint object which is used later for dithering
	# and display.
	lightpaint = LightPaint(pixels, (len(pixels[0,:]), len(pixels[:0])), gamma, color_balance, power_settings, order=order, vflip=vflip)
	print("\t%f seconds" % (time.time() - startTime))

	# Success!
	for n in range(lower, upper):
		strip.setPixelColor(n, 0x000100) # Green
	strip.show()
	time.sleep(0.25) # Tiny delay so green 'ready' is visible
	print("Ready!")

	strip.clear()
	strip.show()
	return lightpaint


# MAIN LOOP ----------------------------------------------------------------

# Init some stuff for speed selection...
max_time    = 10.0
min_time    =  0.1
time_range  = (max_time - min_time)
speed_pixel = int(num_leds * (duration - min_time) / time_range)
duration    = min_time + time_range * speed_pixel / (num_leds - 1)
prev_btn    = 0
rep_time    = 0.2
lightpaint = loadImage(imgNum)

try:
	while True:
		if lightpaint != None:
			# Paint!
			startTime = time.time()
			while True:
				t1        = time.time()
				elapsed   = t1 - startTime
				if elapsed > duration: break
				# dither() function is passed a
				# destination buffer and a float
				# from 0.0 to 1.0 indicating which
				# column of the source image to
				# render.  Interpolation happens.
				lightpaint.dither(ledBuf,
					elapsed / duration)
				strip.show(ledBuf)
			strip.show(clearBuf)
except KeyboardInterrupt:
	print("Cleaning up")
	GPIO.cleanup()
	strip.clear()
	strip.show()
	print("Done!")

