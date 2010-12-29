Some trials with ZSI Python library:
------------------------------------


1)Installation :

 Download ZSI (release 2.0) from http://sourceforge.net/projects/pywebsvcs/ 
and install it into local python by the usual procedure i.e. :

   - untar the archive

   - /path/to/zope/python setup.py build 

   - /path/to/zope/python setup.py install 



2) Run the wsdl2py utility:

  <pre>
/opt/Plone-2.5/Python-2.4.3/bin/wsdl2py -bu http://yourmoodle/wspp/wsdl_pp.php 
  </pre>

  You should find in the current directory the two generated files ( quite bulky BTW) :

with -b option
-rw-r--r--   1 root   root   74839 mai  7 00:34 MoodleWS_services.py
-rw-r--r--   1 root   root   72345 mai  7 00:34 MoodleWS_services_types.py

without -b option
-rw-r--r--   1 root   root   66437 mai  6 18:52 MoodleWS_services.py
-rw-r--r--   1 root   root   71084 mai  6 18:52 MoodleWS_services_types.py



Then, using both previous generated files, you can easily try your wspp :
see script cipcnet001.py as a sample and consult generated log file out.txt for detailled results.


Problems :

   Currently there seems to be a problem with some ZSI client that do not send back to Moodle the two cookies it has received at the first connexion, thus receiving at the second call an text/html error page with a session error message : 

<pre>

ppollet@prope:~/passage/tmp/moodle/ws/ZSI-2.0-rc3/testspp$ ppython cipcnet_001].py
[login]Client: 15311 -- Session key: f32957ef30094d80a64a42d555bdd0c6
Traceback (most recent call last):
  File "cipcnet_001].py", line 31, in ?
    response = portType.get_user(request)
  File "/home/ppollet/passage/tmp/moodle/ws/ZSI-2.0-rc3/testspp/MoodleWS_services.py", line 195, in get_user
    response = self.binding.Receive(typecode)
  File "/opt/Plone-2.5/Python-2.4.3/lib/python2.4/site-packages/ZSI/client.py", line 497, in Receive
    self.ReceiveSOAP(**kw)
  File "/opt/Plone-2.5/Python-2.4.3/lib/python2.4/site-packages/ZSI/client.py", line 390, in ReceiveSOAP
    raise TypeError(
TypeError: Response is "text/html", not "text/xml"
ppollet@prope:~/passage/tmp/moodle/ws/ZSI-2.0-rc3/testspp$      
</pre>

We are investigating it (see below) ; everything work if one comment out the following lines in lib/setup.php

<pre>
/*********************************************** TEMPO PP test ZSI WS ***
/// now do a session test to prevent random user switching - observed on some PHP/Apache combinations,
/// disable checks when working in cookieless mode
    if (empty($CFG->usesid) || !empty($_COOKIE['MoodleSession'.$CFG->sessioncookie])) {
        if ($SESSION != NULL) {
            if (empty($_COOKIE['MoodleSessionTest'.$CFG->sessioncookie])) {
                report_session_error();
            } else if (isset($SESSION->session_test) && $_COOKIE['MoodleSessionTest'.$CFG->sessioncookie] != $SESSION->session_test) {
                report_session_error();
            }
        }
    }
***********************************************/
</pre>


Patching ZSI client.py file:

 The previous problem seems to be due to the fact that Moodle appends a path=/ attribute to its two cookies :
<pre>
_________________________________ Fri Jan  4 15:43:07 2008 RESPONSE:
200
OK
-------
Date: Fri, 04 Jan 2008 14:42:54 GMT
Server: Apache/2.2.6 (Fedora)
X-Powered-By: PHP/5.2.1
Set-Cookie: MoodleSession=e2tica2rat4clqvtiq9eqddha1; path=/
Expires: Thu, 19 Nov 1981 08:52:00 GMT
Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
Pragma: no-cache
Set-Cookie: MoodleSessionTest=S76mx3LoMG; path=/
Content-Length: 1849
Connection: close
Content-Type: text/xml; charset=utf-8
</pre>

 And for some reasons, this extra attribute is not send back correctly (or not accepted by Moodle at the second call ?).   Our current fix is to modify the _addcookies method of script ZSI/client.py for it not to send back this attribute.

 Comment the 3 lines in bold below :

<pre>
  def __addcookies(self):
        '''Add cookies from self.cookies to request in self.h
        '''
        for cname, morsel in self.cookies.items():
            attrs = []
            value = morsel.get('version', '')
            if value != '' and value != '0':
                attrs.append('$Version=%s' % value)
            attrs.append('%s=%s' % (cname, morsel.coded_value))
	    #<b>l'attribut path semble perturber Moodle ??? 
            #value = morsel.get('path')
            #if value:
            #    attrs.append('$Path=%s' % value) </b>
            value = morsel.get('domain')
            if value:
                attrs.append('$Domain=%s' % value)
            self.h.putheader('Cookie', "; ".join(attrs))
	    if self.trace:
            	print >>self.trace, "Cookie renvoye","; ".join(attrs)
</pre>


