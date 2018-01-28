#!/usr/bin/python2.7
import sys
import time

import Adafruit_DHT
from SoundSensor import SoundSensor
from MCP3008ADC import MCP3008ADC
import RPi.GPIO as GPIO

import pymongo
from datetime import datetime
from pytz import timezone

duration = 5
sensorDHT = 22
pinDHT = 26
pinGate = 21
pinEnvelope = 1
pinAudio = 0
GPIO.setmode(GPIO.BCM)
GPIO.setup(pinGate, GPIO.IN)

myMCP = MCP3008ADC()
mySoundSensor = SoundSensor(pinGate,pinEnvelope,pinAudio)

connection = pymongo.MongoClient("mongodb://admin:admin@ds217898.mlab.com:17898/ambilampdb")
db = connection.ambilampdb
sounds = db.sound
humidities = db.hum
temperatures = db.temp

# Note that sometimes you won't get a reading and
# the results will be null (because Linux can't
# guarantee the timing of calls to read the sensor).
# If this happens try again!
while 1:
    # Try to grab a sensor reading.  Use the read_retry method which will retry up
    # to 15 times to get a sensor reading (waiting 2 seconds between each retry).
    humidity, temperature = Adafruit_DHT.read_retry(sensorDHT, pinDHT)

    # Un-comment the line below to convert the temperature to Fahrenheit.
    temperature = temperature * 9/5.0 + 32
    
    dto = datetime.now(timezone('UTC'))
    dto_pacific = dto.astimezone(timezone('US/Pacific'))
    dts = datetime.strftime(dto_pacific,"%Y-%m-%d %H:%M:%S")

    gateVal=GPIO.input(mySoundSensor.get_gate())
    envelopeVal = myMCP.read(mySoundSensor.get_envelope())
    audioVal = myMCP.read(mySoundSensor.get_audio())

    
    if humidity is not None and temperature is not None:
        sound_entry = {'time':dts, 'gate':gateVal, 'envelope':envelopeVal,'audio':audioVal}
        sounds.insert_one(sound_entry)
        humidity_entry = {'time':dts, 'val':humidity}
        humidities.insert_one(humidity_entry)
        temperature_entry = {'time':dts, 'val':temperature}
        temperatures.insert_one(temperature_entry)
#        print('Temp={0:0.1f}*  Humidity={1:0.1f}%'.format(temperature, humidity))
        time.sleep(duration)
#end
