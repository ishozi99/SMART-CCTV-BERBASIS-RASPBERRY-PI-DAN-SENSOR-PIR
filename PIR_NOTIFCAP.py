import os, picamera, sys, time
import RPi.GPIO as GPIO
import subprocess
import time
import httplib, urllib

# Setup GPIO using Broadcom SOC channel numbering instead of RPI one
GPIO.setmode(GPIO.BCM)

# define GPIO port for motion detection
PIR_SENSOR = 19

# GPIO port for status LED, light up when motion is detected by PIR sensor
LED = 13

###### FOR TAKING MOTION AS PICTURE
# camera mode
PHOTO = "Photos"
VIDEO = "Videos"

# location on raspberry pi to store photos and videos
LOCAL_DIRECTORY = "/var/www/html/galeri/rpi-cam-save"


# video recording time in seconds
RECORDING_TIME = 15

# time to wait after taking photo or video in seconds
DELAY = 10

# generate a file name based on the local date and time 
# year-month-day-hour-minutes-seconds-timezone
def generate_file_name():
	return time.strftime("%Y-%m-%d-%H-%M-%S-%Z", time.localtime())     # e.g., 2014-09-14-15-23-45-PST

def motion_detected(pir_sensor):
	fname = LOCAL_DIRECTORY + generate_file_name()
	print "rpi-cam: Motion detected!"	
	if camera_mode == PHOTO:
		fname = fname + ".jpg"
		snap_photo(fname)
	else:
		fname = fname + ".h264"
		record_video(fname, RECORDING_TIME)	
	print "rpi-cam: " + fname + " saved."

# take a photo and store it a file with a unique name
# based on the current date and time	
def snap_photo(file_name):
	camera.resolution = (1024, 768)	
	camera.capture(file_name)
	print "rpi-cam: Photo taken."

# record video for the specified number of seconds and
# store it in a file with a unique name based on the
# current date and time	
def record_video(file_name, rec_time):
	camera.resolution = (650,480)		
	camera.start_recording(file_name)  
	print "rpi-cam: Video recording started."
	camera.wait_recording(rec_time)
	camera.stop_recording()
	print "rpi-cam: Video recording stopped."

	
###### FOR SENDING NOTIFICATION
# Pushover API setup
PUSH_TOKEN = "awoy6issdqxut3ksm7mvh1vjidzbfh" 	# API Token/Key
PUSH_USER = "ufr4932qr4at6kzzhevvnbcq6ap6mt" 	# Your User Key
PUSH_MSG = "Motion detected!" 					# Push Message you want sent

# This function sends the push message using Pushover.
# Pass in the message that you want sent
def sendPush( msg ):
    conn = httplib.HTTPSConnection("api.pushover.net:443")
    conn.request("POST", "/1/messages.json",
        urllib.urlencode({
            "token": PUSH_TOKEN,
            "user": PUSH_USER,
            "message": msg,
        }), { "Content-type": "application/x-www-form-urlencoded" })
 
    conn.getresponse()
    return


###### MAIN PROCESS
# the switch specified on the command determines whether 
# a photo or video should be captured and uploaded
# the program can be started one of three ways:
#   
#   'sudo python rpi-cam.py -p'         snaps photos
#   'sudo python rpi-cam.py -v'         capture video 
#   'sudo python rpi-cam.py -firsttime' runs first time configuration 
#   'sudo python rpi-cam.py -test'      tests to make sure upload is working

# determine what command line parameters were specified
if len(sys.argv) > 1:
	if sys.argv[1] == "-p":
		camera_mode = PHOTO
	elif sys.argv[1] == "-v":
		camera_mode = VIDEO
 	else:
		print "Invalid option specified"
		sys.exit()
else:
	print "Valid options are:"
	print "  -p          Snap photos when motion is detected"
	print "  -v          Record video when motion is detected"
 	sys.exit()

print "rpi-cam: Raspberry Pi motion sensitive camera started."
print "rpi-cam: " + camera_mode + " will be captured when motion is detected."

# Setup raspberry pi camera
camera = picamera.PiCamera()
camera.hflip = True
camera.vflip = True

# GPIO Setup PIN
GPIO.setup(LED, GPIO.OUT)									# LED 
GPIO.setup(PIR_SENSOR, GPIO.IN, pull_up_down=GPIO.PUD_UP)	# Sensor

 
try:
	# Infinite loop. Waiting for sensor.
	while True:
		GPIO.wait_for_edge(PIR_SENSOR, GPIO.RISING)
		GPIO.output(LED, True)
		
		# Push message
		print("Push: " + PUSH_MSG)
		sendPush(PUSH_MSG)
		
		# Send to dropbox
		motion_detected(PIR_SENSOR)
			
		
		# Sleep for DELAY time, giving enough time for next signal
		time.sleep(DELAY)
		# After delay, turn LED off
		GPIO.output(LED, False)
except KeyboardInterrupt:
	# Clean up the message
	GPIO.cleanup()
