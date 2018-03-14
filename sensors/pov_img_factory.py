import json
import os
import numpy as np
import sys
import Adafruit_DHT
from PIL import Image
from urllib.request import urlopen


def build_dict():
    with open('excel_font.txt') as bmap:
        d = {' ':('00000000', '00000000', '00000000', '00000000', '00000000')}
        for line in bmap:
            str_read = line.split(', ')
            str1 = str_read[0:5]
            str1 = [''.join(['{:>04b}'.format(int(d, 16)) for d in word[2:]]) for word in str1]
            strchar = str_read[5].replace('\\\\  ', '').replace('\n', '')
            str1 = tuple(str1)
            d[strchar] = str1
    return d

def lu_array(ch):
    ary = np.zeros((5,8))
    bittp = char_dict[ch]
    ary[:][0] = list(bittp[0])
    ary[:][1] = list(bittp[1])
    ary[:][2] = list(bittp[2])
    ary[:][3] = list(bittp[3])
    ary[:][4] = list(bittp[4])
    return ary.transpose()

def img_array(str_arg):
    strlist = list(str_arg)
    ary = np.zeros((len(strlist),8,5))
    for i in range(len(strlist)):
        ary[i][:][:] = lu_array(strlist[i])
    return ary    

def pix_ary_factory(string2write):
    b = 255*img_array(string2write).astype(int)
    pixels = np.zeros((5*len(b[:,0,0]),len(b[0,:,0])),bytearray)
    for h in range(len(b[:,0,0])):
        for i in range(8):    # for every pixel:
            for j in range(5):
                a = h*5+j
                pixels[a,i] = bytearray((0xFF,b[h,i,j], b[h,i,j], b[h,i,j])) # set the colour accordingly
    """ Debugging code
    if readingType=='w':
        img_fp = 'weather_image.bmp'
    elif readingType == 'p':
        img_fp = 'ping_image.bmp'
    else:
        img_fp = 'DHT_image.bmp'
    img.save(img_fp) 
    """
    return pixels
    
def get_weather():
    with urlopen('http://api.wunderground.com/api/9c6e446e51d7322c/geolookup/conditions/q/CA/San_Diego.json') as f:
        json_string = f.read()
        parsed_json = json.loads(json_string)
        location = parsed_json['location']['city']
        temp_f = parsed_json['current_observation']['temp_f']
        temp_f = '%d+' % temp_f
    return get_timestring() + " %s: %s" %(location, temp_f)

def get_ping():
    pingAddress = '8.8.8.8'
    rawPingFile = os.popen('ping -n 1 %s' % (pingAddress))
    rawPingData = rawPingFile.readlines()
    rawPingFile.close()
    # Extract the ping time
    if len(rawPingData) < 2:
        # Failed to find a DNS resolution or route
        failed = True
        latency = 0
    else:
        index = rawPingData[2].find('time=')
        if index == -1:
            # Ping failed or timed-out
            failed = True
            latency = 0
        else:
            # We have a ping time, isolate it and convert to a number
            failed = False
            latency = rawPingData[2][index + 5:]
            latency = latency[:latency.find('m')]
            latency = int(latency)
    # Set our outputs
    if failed:
        outmessage='Failed'
    else:
        # Ping stored in latency in milliseconds
        outmessage = get_timestring() + ' Ping: %d ms' % (latency)
    return outmessage

def get_dht():
    sensor = 22
    pin = 26
    humidity, temperature = Adafruit_DHT.read_retry(sensor, pin,retries=100,delay_seconds=0.0001)
    if humidity is not None and temperature is not None:
        temperature = temperature * 9/5.0 + 32
        outmessage = get_timestring() + ' %.1f+F  %.1f' % (temperature, humidity) + '%'
    else:
        print('Failed to get reading. Try again!')
    return outmessage

def get_timestring():
    from datetime import datetime
    from pytz import timezone
    #return = datetime.strftime(datetime.now(timezone('US/Pacific')),"%Y-%m-%d %-H:%M:%S")
    return datetime.strftime(datetime.now(timezone('US/Pacific')),"%I:%M %p")

def pix2col(pixels):
    width = len(pixels[0,:])
    height = len(pixels[:,0])
    cols = [bytearray(height << 2) for x in range(width)]
    for i in range(width):
        for j in range(height):
            jshift = j<<2
            cols[i][jshift:jshift+4] =[0xFF, pixels[i,j][0], pixels[i,j][1], pixels[i,j][2], pixels[i,j][3]]
    return cols

class LmImage(object):
    def __init__(self,typestring='t'):
        if typestring == 'w':
            img_string = get_weather()
        elif typestring == 'p':
            img_string = get_ping()
        elif typestring == 'd':
            img_string = get_dht()
        else:
            img_string = get_timestring()
        self.pix_ary = pix2col(pix_ary_factory(img_string))
    
char_dict = build_dict()    

""" Debugging Code
printstring = get_weather()
print (printstring) 
ary2img(printstring,'w')

printstring = get_ping()
print (printstring) 
ary2img(printstring,'p')

printstring = get_dht()
print (printstring) 
ary2img(printstring,'d')
 """
 