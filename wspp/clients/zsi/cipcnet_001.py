#!/usr/bin/env python
#-- coding: utf-8 --

""" Sample Moodle WS !WSpp! python client 
Joseph Boiteau josephboiteau@gmail.com
Set login_name and password to a regular Moodle user (with admin rights for full testing) """

# first, instanciate the generated requester
from MoodleWS_services import *
loc = MoodleWSLocator()
# enable debug into an external file out.txt
import os
fp=open('out.txt', 'w')
kw = { 'tracefile' : fp }
portType = loc.getMoodleWSPortType(**kw)

# login
request = loginRequest()
request._username = "xxxxx"
request._password = "xxxxx"
response = portType.login(request) # no problem
login=response._return
print "[login]Client: %i -- Session key: %s" % (login._client, login._sessionkey)

# get_user
request = get_userRequest()
request._client = login._client
request._sesskey = login._sessionkey
request._userid = "ppollet"
request._idfield = "username"
response = portType.get_user(request)
print response._return._users
print "[get_user]User firstname: %s " % response._return._users[0]._firstname
print "[get_user]User lasename: %s" % response._return._users[0]._lastname
print "[get_user]User email: %s" % response._return._users[0]._email

# get_users
request = get_usersRequest()
request._client = login._client
request._sesskey = login._sessionkey
request._userids = ("alexis", "astrid", "nonExistingUser")
request._idfield = "username"
response = portType.get_users(request)
for each_user in response._return._users:
	print each_user
	if each_user._error:
		print "[get_users]User error: %s" % each_user._error
	else:	
		print "[get_users]User firstname: %s " % each_user._firstname
		print "[get_users]User lasename: %s" % each_user._lastname
		print "[get_users]User email: %s" % each_user._email

# get_course_byid
request = get_course_byRequest()
request._client = login._client
request._sesskey = login._sessionkey
request._info = "3665"
response = portType.get_course_byid(request)
print response._return._courses
if response._return._courses[0]._error:
	print "[get_course_byid]Course error: %s" % response._return._courses[0]._error
else:
	print "[get_course_byid]Course fullname: %s " % response._return._courses[0]._fullname
	print "[get_course_byid]Course teacher: %s" % response._return._courses[0]._teacher
	
# get_last_changes
request = get_last_changesRequest()
request._client = login._client
request._sesskey = login._sessionkey
request._courseid = "3"
request._idfield = "id"
request._limit = 10
response = portType.get_last_changes(request)
print response._return._changes
for changes in response._return._changes:
	if changes._error:
		print "[get_last_changes]Course error: %s" % changes._error
	else:
		print "[get_last_changes]Course name: %s " % changes._name
		print "[get_last_changes]Course date: %s" % changes._date
	
#logout
request = logoutRequest()
request._client = login._client
request._sesskey = login._sessionkey
response = portType.logout(request)
print "Logout ? %s" % response._return
