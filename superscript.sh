#!/bin/sh
sudo /var/www/html/PiBits/ServoBlaster/user/servod --cycle-time=2550 --min=0 --max=255 --invert
echo 1=100% > /dev/servoblaster
echo 3=100% > /dev/servoblaster
echo 4=100% > /dev/servoblaster