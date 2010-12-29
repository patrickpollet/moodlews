#!/usr/bin/env python
#-*- coding: utf-8 -*-

"""
These methods are to be called as External methods from a Zope/Plone
based portal to fetch relevant data from a Moodle Web Service.
It must be placed in Extensions directory of you Plone installation.

courseid received by these methods refers to Moodle's internal id
returned as a list of courses records by a call to 
get_my_courses(portal.portal_membership.getAuthenticatedMember())

MUST DO: adjust in login function the following values:
    your Moodle WSDL URL (if different of localhost)
    login and password of a Moodle "manual" user having enough rights
    to fetch most informations ( admin role)


(C) Mai 2007 Patrick Pollet <patrick.pollet@insa-lyon.fr>. 
"""


import SOAPpy


def login():
	proxy=SOAPpy.WSDL.Proxy('http://localhost/moodle/wspp/wsdl_pp.php')
	client,cle=proxy.login('xxxx','xxxxx')
	return proxy,client,cle
	
def logout (proxy,client,cle):
	return proxy.logout(client,cle)
	
def get_roles():
	proxy,client,cle=login()	
	res= proxy.get_roles(client,cle)
	logout(proxy,client,cle)
	return (SOAPpy.Types.simplify(res))['roles']['item']
	
# Plone uses AUTHENTICATED_USER as the main identifier
# known to all pages 
# so we call get_my_courses_byusername
def get_my_courses (username):
	proxy,client,cle=login()
	res= proxy.get_my_courses_byusername(client,cle,username)
	logout(proxy,client,cle)
	return force_array((SOAPpy.Types.simplify(res))['courses']['item'])

# we know the course Moodle's id 
def get_last_changes(courseid,limit):
	proxy,client,cle=login()
        res= proxy.get_last_changes(client,cle,courseid,'id',limit)
        logout(proxy,client,cle)
        return force_array((SOAPpy.Types.simplify(res))['changes']['item'])

def get_teachers(courseid):
        proxy,client,cle=login()
        res= proxy.get_teachers(client,cle,courseid,'id')
        logout(proxy,client,cle)
        return force_array((SOAPpy.Types.simplify(res))['users']['item'])

def get_students(courseid):
        proxy,client,cle=login()
        res= proxy.get_students(client,cle,courseid,'id')
        logout(proxy,client,cle)
        return force_array((SOAPpy.Types.simplify(res))['users']['item'])


def get_students_username(courseid,sorted=False):
	"""
	return a Python list with usernames only of students
	of course couseid
	Useful to save memory and Soap calls (i.e. intersecting this
	list with a SQL result from our main SI , such as 
	students who are, who are not registered to a course)
	"""
	res=get_students(courseid)
	return get_list_of_field(res,'username',sorted) 

def get_teachers_username(courseid,sorted=False):
        """
        return a Python list with usernames only of teachers
        of course couseid
        Useful to save memory and Soap calls (i.e. intersecting this
        list with a SQL result from our main SI , such as
        faculty members  who are, who are not teaching a course)
        """
        res=get_teachers(courseid)
        return get_list_of_field(res,'username',sorted)


def get_course_byid(courseid):
        proxy,client,cle=login()
        res= proxy.get_course_byid(client,cle,courseid)
        logout(proxy,client,cle)
        return (SOAPpy.Types.simplify(res))['courses']['item']

def count_students(courseid):
	proxy,client,cle=login()
        res= proxy.count_users_bycourse(client,cle,courseid,'id',5)
        logout(proxy,client,cle)
	return res 

def is_student_incourse(username,courseid):
	proxy,client,cle=login()
        res= proxy.has_role_incourse(client,cle,username,'username',courseid,'id',5)
        logout(proxy,client,cle)
        return res

def is_teacher_incourse(username,courseid):
        proxy,client,cle=login()
        res= proxy.has_role_incourse(client,cle,username,'username',courseid,'id',3)
        if not res: 
		 res= proxy.has_role_incourse(client,cle,username,'username',courseid,'id',4)
        logout(proxy,client,cle)
        return res

def is_editingteacher_incourse(username,courseid):
        proxy,client,cle=login()
        res= proxy.has_role_incourse(client,cle,username,'username',courseid,'id',3)
        logout(proxy,client,cle)
        return res


def get_list_of_field (res,field,sorted=False):
	"""
	return a list of all values of field in an array of results
	"""
	ret=[]
        for item in res:
                if not item['error']:
                        ret = ret+ [item[field]]
	if sorted:
		ret.sort()
	return ret 	




def test_count(courseid):
	proxy,client,cle=login()
        for i in range(6):
		print i, proxy.count_users_bycourse(client,cle,courseid,'id',i)
        logout(proxy,client,cle)



#for some reason SOAPpy convert an array with one item to a simple type
# and Zope do not like later to repeat on it ...
def force_array(object):
	if not isinstance(object,type([])):
		return [object]
	return object

if __name__=="__main__":
	#print get_roles()
	#print get_my_courses("pguy")
        #print get_course_byid(62)
        #print get_teachers(38)
        #test_count(63)
        print is_student_incourse("ppollet",2)
        print is_teacher_incourse("ppollet",2)
	print is_editingteacher_incourse("ppollet",2)
#	print get_students(2)
	print get_students_username(2,True) 
	print get_teachers_username(2,False)

