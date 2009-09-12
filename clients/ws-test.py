
#!/usr/bin/env python
#-*- coding: utf-8 -*-

"""
Sample Moodle WS python client
Patrick Pollet patrick.pollet@insa-lyon.fr
Adjust URL of Moodle server if remote client 
Set login_name and password to a regular Moodle user
 (with admin rights for full testing)
"""


import SOAPpy

proxy= proxy = SOAPpy.WSDL.Proxy('http://localhost/moodle/wspp/wsdl_pp.php')
print proxy.methods
proxy.show_methods()

a,b=proxy.login ("xxxx","zzzz");

#print proxy.get_resources(a,b,[],"")
print proxy.get_resources(a,b,[2],"id")
print proxy.get_resources(a,b,["dummy"],"idnumber")
#print proxy.get_user(a,b,"ppollet","username")

#get a list of courses by id, including an invalid one 
#print proxy.get_courses(a,b,[1,2,3,-1],'id')

#print proxy.get_users(a,b,["admin","guest","unknown"],"username")

#print proxy.get_course_byid(a,b,2)

#print proxy.get_my_courses(a,b)

#print proxy.get_last_changes(a,b,2,'id',10)
proxy.logout(a,b)

