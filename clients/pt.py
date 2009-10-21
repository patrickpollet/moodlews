#!/usr/bin/env python
#-- coding: utf-8 --

import SOAPpy

def show_methods(proxy): 
  """modified version of SOAPPy.WSDL.Proxy.show_methods (with sorting by method name)""" 
  keys=proxy.methods.keys() 
  keys.sort() 
  for key in keys: 
    method = proxy.methods[key] 
    print "Method Name:", key.ljust(15) 
    print 
    inps = method.inparams 
    for parm in range(len(inps)): 
       details = inps[parm] 
       print " In #%d: %s (%s)" % (parm, details.name, details.type) 
       print 
    outps = method.outparams 
    for parm in range(len(outps)): 
      details = outps[parm] 
      print " Out #%d: %s (%s)"  % (parm, details.name, details.type) 
      print

proxy = SOAPpy.WSDL.Proxy("http://cipcnet/moodle/wspp/wsdl_pp.php") 
print len(proxy.methods) 
show_methods(proxy) 
