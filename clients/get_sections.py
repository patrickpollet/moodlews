
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

proxy = SOAPpy.WSDL.Proxy('http://localhost/moodle/wspp/wsdl_pp.php')
#print proxy.methods
#proxy.show_methods()

a,b=proxy.login ("astrid","bpitt1");

res=proxy.get_sections(a,b,[116],"id")
print res
print SOAPpy.Types.simplify(res)
proxy.logout(a,b)

