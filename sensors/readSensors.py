#!/usr/bin/python
import sys
import time
import Adafruit_DHT


duration = 5
sensorDHT = 22
pinDHT = 26



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
    if humidity is not None and temperature is not None:
        print('Temp={0:0.1f}*  Humidity={1:0.1f}%'.format(temperature, humidity))
        time.sleep(duration)
#end