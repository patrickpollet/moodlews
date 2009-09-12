<?php // $Id: wsdl.php,v 1.5 2007/04/28 04:05:36 PP Exp $

/**
 * This file creates a WSDL file for the web service interfaced running on
 * this server with URL paths relative to the currently running server.
 * 
 * When referring to this file, you must call it as:
 * 
 * http://www.yourhost.com/ ... /wspp/wsdl_pp.php
 * 
 * Where ... is the path to your Moodle root.  This is so that your web server
 * will process the PHP statemtents within the file, which returns a WSDL
 * file to the web services call (or your browser).
 * 
 * @version $Id: wsdl.php,v 1.4 2007/04/24 04:05:36 jfilip Exp $
 * @author Justin Filip <jfilip@oktech.ca>
 * @author Open Knowledge Technologies - http://www.oktech.ca/  
 * @author PP 
 *           removed the mdl_soapserver. )
 *           added extra API calls
 *           added plural when an array of whatever is required 
 *           so defined get_xxx with ONE id and return one record 
 *               and get_xxxs with array of id and  return array of record             
 * when modifiying this file to add new API calls, run the provided
 * wsdl2php.php utility (or mkclasses.sh script) to generate uptodate 
 * class names files (needed by PHP5 clients AND server) and MoodleWS class
 * (needed only by PHP5 clients) 
 * rev 1.5.9 :
 *   corrected wrong parameters in get_my_courses_by* calls (removed extraneous idfield if get_my_coursesRequest) 
 *   added has_primaryrole_incourse 
 */


    require_once('../config.php');


//    header('Content-Type: application/xml; charset=UTF-8');
     
  header('Content-Type: text/xml; charset=UTF-8');

  header('Content-Disposition: attachment; filename="moodlews.wsdl"');

    echo '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/"
  xmlns:si="http://soapinterop.org/xsd"
  xmlns:tns="' . $CFG->wwwroot . '/wspp/wsdl"
  xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
  xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/"
  xmlns="http://schemas.xmlsoap.org/wsdl/"
  targetNamespace="' . $CFG->wwwroot . '/wspp/wsdl">
  <types>
    <xsd:schema targetNamespace="' . $CFG->wwwroot . '/wspp/wsdl">
      <xsd:import namespace="http://schemas.xmlsoap.org/soap/encoding/" />
      <xsd:import namespace="http://schemas.xmlsoap.org/wsdl/" />
      <xsd:complexType name="userRecord">
        <xsd:all>
          <xsd:element name="error" type="xsd:string" />
          <xsd:element name="id" type="xsd:integer" />
          <xsd:element name="confirmed" type="xsd:integer" />
          <xsd:element name="policyagreed" type="xsd:integer" />
          <xsd:element name="deleted" type="xsd:integer" />
          <xsd:element name="username" type="xsd:string" />
          <xsd:element name="idnumber" type="xsd:string" />
          <xsd:element name="firstname" type="xsd:string" />
          <xsd:element name="lastname" type="xsd:string" />
          <xsd:element name="email" type="xsd:string" />
          <xsd:element name="icq" type="xsd:string" />
          <xsd:element name="skype" type="xsd:string" />
          <xsd:element name="yahoo" type="xsd:string" />
          <xsd:element name="aim" type="xsd:string" />
          <xsd:element name="msn" type="xsd:string" />
          <xsd:element name="phone1" type="xsd:string" />
          <xsd:element name="phone2" type="xsd:string" />
          <xsd:element name="institution" type="xsd:string" />
          <xsd:element name="department" type="xsd:string" />
          <xsd:element name="address" type="xsd:string" />
          <xsd:element name="city" type="xsd:string" />
          <xsd:element name="country" type="xsd:string" />
          <xsd:element name="lang" type="xsd:string" />
          <xsd:element name="timezone" type="xsd:integer" />
          <xsd:element name="lastip" type="xsd:string" />
          <xsd:element name="description" type="xsd:string" nillable="true" />
          <xsd:element name="role" type="xsd:integer" />
        </xsd:all>
      </xsd:complexType>
      <xsd:complexType name="groupRecord">
        <xsd:all>
          <xsd:element name="error" type="xsd:string" />
          <xsd:element name="id" type="xsd:integer" />
          <xsd:element name="courseid" type="xsd:integer" />
          <xsd:element name="name" type="xsd:string" />
          <xsd:element name="description" type="xsd:string" />
	  <xsd:element name="lang" type="xsd:string" />
	  <xsd:element name="theme" type="xsd:string" />
	  <xsd:element name="picture" type="xsd:integer"/>
	  <xsd:element name="hidepicture" type="xsd:integer"/>
	  <xsd:element name="timecreated" type="xsd:integer" />
	  <xsd:element name="timemodified" type="xsd:integer" />
       </xsd:all>
      </xsd:complexType>

      <xsd:complexType name="courseRecord">
        <xsd:all>
          <xsd:element name="error" type="xsd:string" />
          <xsd:element name="id" type="xsd:integer" />
          <xsd:element name="category" type="xsd:integer" />
          <xsd:element name="sortorder" type="xsd:integer" />
          <xsd:element name="password" type="xsd:string" />
          <xsd:element name="fullname" type="xsd:string" />
          <xsd:element name="shortname" type="xsd:string" />
          <xsd:element name="idnumber" type="xsd:string" />
          <xsd:element name="summary" type="xsd:string" />
          <xsd:element name="format" type="xsd:string" />
          <xsd:element name="showgrades" type="xsd:integer" />
          <xsd:element name="newsitems" type="xsd:integer" />
          <xsd:element name="teacher" type="xsd:string" />
          <xsd:element name="teachers" type="xsd:string" />
          <xsd:element name="student" type="xsd:string" />
          <xsd:element name="students" type="xsd:string" />
          <xsd:element name="guest" type="xsd:integer" />
          <xsd:element name="startdate" type="xsd:integer" />
          <xsd:element name="enrolperiod" type="xsd:integer" />
          <xsd:element name="numsections" type="xsd:integer" />
          <xsd:element name="marker" type="xsd:integer" />
          <xsd:element name="maxbytes" type="xsd:integer" />
          <xsd:element name="visible" type="xsd:integer" />
          <xsd:element name="hiddensections" type="xsd:integer" />
          <xsd:element name="groupmode" type="xsd:integer" />
          <xsd:element name="groupmodeforce" type="xsd:integer" />
          <xsd:element name="lang" type="xsd:string" />
          <xsd:element name="theme" type="xsd:string" />
          <xsd:element name="cost" type="xsd:string" />
          <xsd:element name="timecreated" type="xsd:integer" />
          <xsd:element name="timemodified" type="xsd:integer" />
          <xsd:element name="metacourse" type="xsd:integer" />
        </xsd:all>
      </xsd:complexType>
       <xsd:complexType name="userDatum">
        <xsd:all>
          <xsd:element name="action" type="xsd:string" />
          <xsd:element name="confirmed" type="xsd:integer" />
          <xsd:element name="policyagreed" type="xsd:integer" />
          <xsd:element name="deleted" type="xsd:integer" />
          <xsd:element name="username" type="xsd:string" />
	  <xsd:element name="auth" type="xsd:string" />
          <xsd:element name="password" type="xsd:string" />
          <xsd:element name="idnumber" type="xsd:string" />
          <xsd:element name="firstname" type="xsd:string" />
          <xsd:element name="lastname" type="xsd:string" />
          <xsd:element name="email" type="xsd:string" />
          <xsd:element name="icq" type="xsd:string" />
          <xsd:element name="skype" type="xsd:string" />
          <xsd:element name="yahoo" type="xsd:string" />
          <xsd:element name="aim" type="xsd:string" />
          <xsd:element name="msn" type="xsd:string" />
          <xsd:element name="phone1" type="xsd:string" />
          <xsd:element name="phone2" type="xsd:string" />
          <xsd:element name="institution" type="xsd:string" />
          <xsd:element name="department" type="xsd:string" />
          <xsd:element name="address" type="xsd:string" />
          <xsd:element name="city" type="xsd:string" />
          <xsd:element name="country" type="xsd:string" />
          <xsd:element name="lang" type="xsd:string" />
          <xsd:element name="timezone" type="xsd:integer" />
          <xsd:element name="lastip" type="xsd:string" />
          <xsd:element name="description" type="xsd:string" />
          <xsd:element name="mnethostid" type="xsd:integer" />
        </xsd:all>
      </xsd:complexType>
       <xsd:complexType name="courseDatum">
        <xsd:all>
          <xsd:element name="action" type="xsd:string" />
          <xsd:element name="id" type="xsd:integer" />
          <xsd:element name="category" type="xsd:integer" />
          <xsd:element name="sortorder" type="xsd:integer" />
          <xsd:element name="password" type="xsd:string" />
          <xsd:element name="fullname" type="xsd:string" />
          <xsd:element name="shortname" type="xsd:string" />
          <xsd:element name="idnumber" type="xsd:string" />
          <xsd:element name="summary" type="xsd:string" />
          <xsd:element name="format" type="xsd:string" />
          <xsd:element name="showgrades" type="xsd:integer" />
          <xsd:element name="newsitems" type="xsd:integer" />
          <xsd:element name="teacher" type="xsd:string" />
          <xsd:element name="teachers" type="xsd:string" />
          <xsd:element name="student" type="xsd:string" />
          <xsd:element name="students" type="xsd:string" />
          <xsd:element name="guest" type="xsd:integer" />
          <xsd:element name="startdate" type="xsd:integer" />
          <xsd:element name="enrolperiod" type="xsd:integer" />
          <xsd:element name="numsections" type="xsd:integer" />
          <xsd:element name="marker" type="xsd:integer" />
          <xsd:element name="maxbytes" type="xsd:integer" />
          <xsd:element name="visible" type="xsd:integer" />
          <xsd:element name="hiddensections" type="xsd:integer" />
          <xsd:element name="groupmode" type="xsd:integer" />
          <xsd:element name="groupmodeforce" type="xsd:integer" />
          <xsd:element name="lang" type="xsd:string" />
          <xsd:element name="theme" type="xsd:string" />
          <xsd:element name="cost" type="xsd:string" />
          <xsd:element name="timecreated" type="xsd:integer" />
          <xsd:element name="timemodified" type="xsd:integer" />
          <xsd:element name="metacourse" type="xsd:integer" />
        </xsd:all>
      </xsd:complexType>
      
      <xsd:complexType name="gradeRecord">
        <xsd:all>
          <xsd:element name="name" type="xsd:string" />
          <xsd:element name="maxgrade" type="xsd:integer" />
          <xsd:element name="grade" type="xsd:string" />
          <xsd:element name="percent" type="xsd:string" />
          <xsd:element name="weight" type="xsd:float" />
          <xsd:element name="weighted" type="xsd:float" />
          <xsd:element name="sortOrder" type="xsd:integer" />
        </xsd:all>
      </xsd:complexType>
      <xsd:complexType name="gradeStatsRecord">
        <xsd:all>
          <xsd:element name="gradeItems" type="xsd:integer" />
          <xsd:element name="allgrades" type="xsd:string" />
          <xsd:element name="points" type="xsd:integer" />
          <xsd:element name="totalpoints" type="xsd:integer" />
          <xsd:element name="percent" type="xsd:float" />
          <xsd:element name="weight" type="xsd:float" />
          <xsd:element name="weighted" type="xsd:float" />
        </xsd:all>
      </xsd:complexType>
      
      <xsd:complexType name="studentRecord">
        <xsd:all>
          <xsd:element name="userid" type="xsd:integer" />
          <xsd:element name="course" type="xsd:integer" />
          <xsd:element name="timestart" type="xsd:integer" />
          <xsd:element name="timeend" type="xsd:integer" />
          <xsd:element name="timeaccess" type="xsd:integer" />
          <xsd:element name="enrol" type="xsd:string" />
        </xsd:all>
      </xsd:complexType>
      
      <xsd:complexType name="eventRecord">
        <xsd:all>
          <xsd:element name="error" type="xsd:string" />
          <xsd:element name="id" type="xsd:integer" />
          <xsd:element name="name" type="xsd:string" />
          <xsd:element name="description" type="xsd:string" />
          <xsd:element name="format" type="xsd:integer" />
          <xsd:element name="courseid" type="xsd:integer" />
          <xsd:element name="groupid" type="xsd:integer" />
          <xsd:element name="userid" type="xsd:integer" />
          <xsd:element name="repeatid" type="xsd:integer" />
          <xsd:element name="modulename" type="xsd:string" />
          <xsd:element name="instance" type="xsd:integer" />
          <xsd:element name="eventtype" type="xsd:string" />
          <xsd:element name="timestart" type="xsd:integer" />
          <xsd:element name="timeduration" type="xsd:integer" />
          <xsd:element name="visible" type="xsd:integer" />
          <xsd:element name="uuid" type="xsd:string" />
          <xsd:element name="sequence" type="xsd:integer" />
          <xsd:element name="timemodified" type="xsd:integer" />
        </xsd:all>
     </xsd:complexType>

     <xsd:complexType name="changeRecord">
       <xsd:all>
          <xsd:element name="error" type="xsd:string" />
          <xsd:element name="id" type="xsd:integer" />
	  <xsd:element name="courseid" type="xsd:integer" />
          <xsd:element name="instance" type="xsd:integer" />
 	  <xsd:element name="resid" type="xsd:integer" />
          <xsd:element name="name" type="xsd:string" />
	  <xsd:element name="date" type="xsd:string" />
          <xsd:element name="timestamp" type="xsd:integer" />
	  <xsd:element name="type" type="xsd:string" />
          <xsd:element name="author" type="xsd:string" />
          <xsd:element name="link" type="xsd:string" />
          <xsd:element name="url" type="xsd:string" />
          <xsd:element name="visible" type="xsd:integer" />
        </xsd:all>
      </xsd:complexType>
      <xsd:complexType name="roleRecord">
        <xsd:all>
          <xsd:element name="error" type="xsd:string" />
          <xsd:element name="id" type="xsd:integer" />
          <xsd:element name="name" type="xsd:string" />
          <xsd:element name="shortname" type="xsd:string" />
          <xsd:element name="description" type="xsd:string" />
          <xsd:element name="sortorder" type="xsd:integer" />
        </xsd:all>
      </xsd:complexType>
      <xsd:complexType name="categoryRecord">
        <xsd:all>
	  <xsd:element name="error" type="xsd:string" />
          <xsd:element name="id" type="xsd:integer" />
          <xsd:element name="name" type="xsd:string" />
          <xsd:element name="description" type="xsd:string"  nillable="true"/>
          <xsd:element name="parent" type="xsd:integer" />
          <xsd:element name="sortorder" type="xsd:integer" />
          <xsd:element name="coursecount" type="xsd:integer" />
          <xsd:element name="visible" type="xsd:integer" />
          <xsd:element name="timemodified" type="xsd:integer" />
          <xsd:element name="depth" type="xsd:integer" />
          <xsd:element name="path" type="xsd:string" />
        </xsd:all>
      </xsd:complexType>

                
      
      <xsd:complexType name="userRecords">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:userRecord[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>
      
   <xsd:complexType name="groupRecords">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:groupRecord[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>

      <xsd:complexType name="userData">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:userDatum[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>
     
      <xsd:complexType name="courseRecords">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:courseRecord[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>
     
      <xsd:complexType name="courseData">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:courseDatum[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>
      
      <xsd:complexType name="gradeRecords">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:gradeRecord[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>
      
      <xsd:complexType name="studentGradeRecord">
        <xsd:all>
          <xsd:element name="error" type="xsd:string" />
          <xsd:element name="courseid" type="xsd:string" />
          <xsd:element name="stats" type="tns:gradeStatsRecord" />
          <xsd:element name="grades" type="tns:gradeRecords" />
        </xsd:all>
      </xsd:complexType>
      <xsd:complexType name="studentGradeRecords">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:studentGradeRecord[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>
      <xsd:complexType name="studentRecords">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:studentRecord[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>
      <xsd:complexType name="roleRecords">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:roleRecord[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>
       <xsd:complexType name="eventRecords">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:eventRecord[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>
       <xsd:complexType name="categoryRecords">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:categoryRecord[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>

      <xsd:complexType name="changeRecords">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:changeRecord[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>
     
      <xsd:complexType name="loginReturn">
        <xsd:all>
          <xsd:element name="client" type="xsd:integer" />
          <xsd:element name="sessionkey" type="xsd:string" />
        </xsd:all>
      </xsd:complexType>
      <xsd:complexType name="editUsersInput">
        <xsd:all>
          <xsd:element name="users" type="tns:userData" />
        </xsd:all>
      </xsd:complexType>
      <xsd:complexType name="editUsersOutput">
        <xsd:all>
          <xsd:element name="users" type="tns:userRecords" />
        </xsd:all>
      </xsd:complexType>
      <xsd:complexType name="getUsersInput">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="xsd:string[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>

      <xsd:complexType name="getUsersReturn">
        <xsd:all>
          <xsd:element name="users" type="tns:userRecords" />
        </xsd:all>
      </xsd:complexType>
      <xsd:complexType name="editCoursesInput">
        <xsd:all>
          <xsd:element name="courses" type="tns:courseData" />
        </xsd:all>
      </xsd:complexType>
      <xsd:complexType name="editCoursesOutput">
        <xsd:all>
          <xsd:element name="courses" type="tns:courseRecords" />
        </xsd:all>
      </xsd:complexType>

     <xsd:complexType name="getCoursesInput">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="xsd:string[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>

      <xsd:complexType name="getCoursesReturn">
        <xsd:all>
          <xsd:element name="courses" type="tns:courseRecords" />
        </xsd:all>
      </xsd:complexType>

     <xsd:complexType name="getGradesInput">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="xsd:string[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>

      <xsd:complexType name="getGradesReturn">
        <xsd:all>
          <xsd:element name="grades" type="tns:studentGradeRecords" />
        </xsd:all>
      </xsd:complexType>

      <xsd:complexType name="enrolStudentsInput">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="xsd:string[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>


      <xsd:complexType name="enrolStudentsReturn">
        <xsd:all>
          <xsd:element name="error" type="xsd:string" />
          <xsd:element name="students" type="tns:studentRecords" />
        </xsd:all>
      </xsd:complexType>

      <xsd:complexType name="getRolesReturn">
        <xsd:all>
          <xsd:element name="roles" type="tns:roleRecords" />
        </xsd:all>
      </xsd:complexType>

      <xsd:complexType name="getGroupsReturn">
        <xsd:all>
          <xsd:element name="groups" type="tns:groupRecords" />
        </xsd:all>
      </xsd:complexType>

      <xsd:complexType name="getEventsReturn">
        <xsd:all>
          <xsd:element name="events" type="tns:eventRecords" />
        </xsd:all>
      </xsd:complexType>

      <xsd:complexType name="getLastChangesReturn">
        <xsd:all>
          <xsd:element name="changes" type="tns:changeRecords" />
        </xsd:all>
      </xsd:complexType>


      <xsd:complexType name="getCategoriesReturn">
        <xsd:all>
          <xsd:element name="categories" type="tns:categoryRecords" />
        </xsd:all>
      </xsd:complexType>

   <xsd:complexType name="activityRecord">
        <xsd:all>
          <xsd:element name="error" type="xsd:string" />
          <xsd:element name="id" type="xsd:integer" />
          <xsd:element name="time" type="xsd:integer" />
          <xsd:element name="userid" type="xsd:integer" />
          <xsd:element name="ip" type="xsd:string" />
          <xsd:element name="course" type="xsd:integer" />
          <xsd:element name="module" type="xsd:integer" />
          <xsd:element name="cmid" type="xsd:integer" />
          <xsd:element name="action" type="xsd:string" />
          <xsd:element name="url" type="xsd:string" />
          <xsd:element name="info" type="xsd:string" />
          <xsd:element name="DATE" type="xsd:string" />
          <xsd:element name="auth" type="xsd:string" />
          <xsd:element name="firstname" type="xsd:string" />
          <xsd:element name="lastname" type="xsd:string" />
          <xsd:element name="email" type="xsd:string" />
          <xsd:element name="firstaccess" type="xsd:integer" />
          <xsd:element name="lastaccess" type="xsd:integer" />
          <xsd:element name="lastlogin" type="xsd:integer" />
          <xsd:element name="currentlogin" type="xsd:integer" />
          <xsd:element name="DLA" type="xsd:string" />
          <xsd:element name="DFA" type="xsd:string" />
          <xsd:element name="DLL" type="xsd:string" />
          <xsd:element name="DCL" type="xsd:string" />
        </xsd:all>
      </xsd:complexType>



     <xsd:complexType name="activityRecords">
        <xsd:complexContent>
          <xsd:restriction base="SOAP-ENC:Array">
            <xsd:attribute ref="SOAP-ENC:arrayType"
              wsdl:arrayType="tns:activityRecord[]" />
          </xsd:restriction>
        </xsd:complexContent>
      </xsd:complexType>


     <xsd:complexType name="getActivitiesReturn">
        <xsd:all>
          <xsd:element name="activities" type="tns:activityRecords" />
        </xsd:all>
      </xsd:complexType>

    </xsd:schema>
  </types>


  <message name="loginRequest">
    <part name="username" type="xsd:string" />
    <part name="password" type="xsd:string" />
  </message>
  <message name="loginResponse">
    <part name="return" type="tns:loginReturn" />
  </message>
  <message name="logoutRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
  </message>
  <message name="logoutResponse">
    <part name="return" type="xsd:boolean" />
  </message>

  <message name="integerResponse">
    <part name="return" type="xsd:integer" />
  </message>

  <message name="booleanResponse">
    <part name="return" type="xsd:boolean" />
  </message>

  <message name="stringResponse">
    <part name="return" type="xsd:string" />
  </message>


  <message name="noinputRequest">
    <documentation> PP No further input needed </documentation>
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
  </message>

  <message name="oneValueRequest">
    <documentation>PP one value to search for </documentation>
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="value" type="xsd:string" />
  </message>

   <message name="valueAndIdRequest">
    <documentation>PP one value to search for in column id </documentation>
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="value" type="xsd:string" />
    <part name="id" type="xsd:string" />
  </message>

  <message name="twoValuesAndIdsRequest">
    <documentation>PP one value to search for in column id </documentation>
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="value1" type="xsd:string" />
    <part name="id1" type="xsd:string" />
    <part name="value2" type="xsd:string" />
    <part name="id2" type="xsd:string" />

  </message>

  <message name="edit_usersRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="users" type="tns:editUsersInput" />
  </message>

  <message name="edit_usersResponse">
    <part name="return" type="tns:editUsersOutput" />
  </message>
  <message name="get_usersRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="userids" type="tns:getUsersInput" />
    <part name="idfield" type="xsd:string" />
  </message>
  <message name="get_usersResponse">
    <part name="return" type="tns:getUsersReturn" />
  </message>

  <message name="edit_coursesRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="courses" type="tns:editCoursesInput" />
  </message>

  <message name="edit_coursesResponse">
    <part name="return" type="tns:editCoursesOutput" />
  </message>

  <message name="get_coursesRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="courseids" type="tns:getCoursesInput" />
    <part name="idfield" type="xsd:string" />
  </message>
  
  <message name="get_coursesResponse">
    <part name="return" type="tns:getCoursesReturn" />
  </message>
  
  <message name="get_groups_bycourseRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="courseid" type="xsd:string" />
    <part name="idfield" type="xsd:string" />
  </message>

  <message name="get_groupsResponse">
    <part name="return" type="tns:getGroupsReturn" />
  </message>

  <message name="get_group_membersRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="groupid" type="xsd:integer" />
  </message>

  <message name="get_courseRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="courseid" type="xsd:string" />
    <part name="idfield" type="xsd:string" />
  </message>

  <message name="get_course_byRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="info" type="xsd:string" />
  </message>

  <message name="get_group_byRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="info" type="xsd:string" />
    <part name="courseid" type="xsd:integer" />
  </message>


  <message name="get_userRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="userid" type="xsd:string" />
    <part name="idfield" type="xsd:string" />
  </message>


  <message name="get_gradesRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="userid" type="xsd:string" />
    <part name="courseids" type="tns:getGradesInput" />
    <part name="idfield" type="xsd:string" />
  </message>

  <message name="get_gradesResponse">
    <part name="return" type="tns:getGradesReturn" />
  </message>
  <message name="enrol_studentsRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="courseid" type="xsd:string" />
    <part name="userids" type="tns:enrolStudentsInput" />
    <part name="idfield" type="xsd:string" />
  </message>
  <message name="enrol_studentsResponse">
    <part name="return" type="tns:enrolStudentsReturn" />
  </message>


  <message name="get_rolesResponse">
    <part name="return" type="tns:getRolesReturn" />
  </message>

 <message name="get_categoriesResponse">
    <part name="return" type="tns:getCategoriesReturn" />
  </message>


<message name="get_eventsRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="eventtype" type="xsd:integer" />
    <part name="ownerid" type="xsd:integer" />
  </message>

  <message name="get_eventsResponse">
    <part name="return" type="tns:getEventsReturn" />
  </message>

 <message name="get_last_changesRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="courseid" type="xsd:string" />
    <part name="idfield" type="xsd:string" />
    <part name="limit" type="xsd:integer" />
  </message>


  <message name="get_last_changesResponse">
    <part name="return" type="tns:getLastChangesReturn" />
  </message>


   <message name="get_my_coursesRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="uid" type="xsd:integer" />
    <part name="sort" type="xsd:string" />
  </message>

  <message name="get_my_courses_byRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="uinfo" type="xsd:string" />
    <part name="sort" type="xsd:string" />
  </message>

   <message name="get_my_groupRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="courseid" type="xsd:integer" />
    <part name="uid" type="xsd:integer" />
  </message>

  <message name="get_my_groupsRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="uid" type="xsd:integer" />
  </message>


   <message name="get_courses_bycategoryRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="categoryid" type="xsd:integer" />
  </message>


  <message name="get_user_byRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="userinfo" type="xsd:string" />
  </message>

  <message name="get_users_bycourseRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="idcourse" type="xsd:string" />
    <part name="idfield" type="xsd:string" />
    <part name="idrole" type="xsd:integer" />
  </message>

   <message name="has_role_incourseRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="iduser" type="xsd:string" />
    <part name="iduserfield" type="xsd:string" />
    <part name="idcourse" type="xsd:string" />
    <part name="idcoursefield" type="xsd:string" />
    <part name="idrole" type="xsd:integer" />
  </message>

   <message name="get_primaryrole_incourseRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="iduser" type="xsd:string" />
    <part name="iduserfield" type="xsd:string" />
    <part name="idcourse" type="xsd:string" />
    <part name="idcoursefield" type="xsd:string" />
  </message>

  <message name="get_activitiesRequest">
    <part name="client" type="xsd:integer" />
    <part name="sesskey" type="xsd:string" />
    <part name="iduser" type="xsd:string" />
    <part name="iduserfield" type="xsd:string" />
    <part name="idcourse" type="xsd:string" />
    <part name="idcoursefield" type="xsd:string" />
    <part name="idlimit" type="xsd:integer" />
  </message>

  <message name="get_activitiesResponse">
    <part name="return" type="tns:getActivitiesReturn" />
  </message>

  <portType name="MoodleWSPortType">
    <operation name="login">
      <documentation>MoodleWS Client Login</documentation>
      <input message="tns:loginRequest" />
      <output message="tns:loginResponse" />
    </operation>
    <operation name="logout">
      <documentation>MoodleWS: Client Logout</documentation>
      <input message="tns:logoutRequest" />
      <output message="tns:logoutResponse" />
    </operation>

    <operation name="get_course">
      <documentation>MoodleWS: Get Course Information</documentation>
      <input message="tns:get_courseRequest" />
      <output message="tns:get_coursesResponse" />
    </operation>
    <operation name="get_course_byid">
      <documentation>MoodleWS: Get Course Information</documentation>
      <input message="tns:get_course_byRequest" />
      <output message="tns:get_coursesResponse" />
    </operation>
    <operation name="get_course_byidnumber">
      <documentation>MoodleWS: Get Course Information</documentation>
      <input message="tns:get_course_byRequest" />
      <output message="tns:get_coursesResponse" />
    </operation>

    <operation name="get_groups_bycourse">
      <documentation>MoodleWS: Get Course groups</documentation>
      <input message="tns:get_groups_bycourseRequest" />
      <output message="tns:get_groupsResponse" />
    </operation>

    <operation name="get_group_byid">
      <documentation>MoodleWS: Get Course Information</documentation>
      <input message="tns:get_group_byRequest" />
      <output message="tns:get_groupsResponse" />
    </operation>
    <operation name="get_groups_byname">
      <documentation>MoodleWS: Get Course Information</documentation>
      <input message="tns:get_group_byRequest" />
      <output message="tns:get_groupsResponse" />
    </operation>

   <operation name="get_user">
      <documentation>MoodleWS: Get one User Information</documentation>
      <input message="tns:get_userRequest" />
      <output message="tns:get_usersResponse" />
    </operation>


    <operation name="edit_users">
      <documentation>MoodleWS: Edit Users Information</documentation>
      <input message="tns:edit_usersRequest" />
      <output message="tns:edit_usersResponse" />
    </operation>
    <operation name="get_users">
      <documentation>MoodleWS: Get Users Information</documentation>
      <input message="tns:get_usersRequest" />
      <output message="tns:get_usersResponse" />
    </operation>

    <operation name="get_teachers">
      <documentation>MoodleWS: Get course teachers</documentation>
      <input message="tns:valueAndIdRequest" />
      <output message="tns:get_usersResponse" />
    </operation>

    <operation name="get_students">
      <documentation>MoodleWS: Get course students</documentation>
      <input message="tns:valueAndIdRequest" />
      <output message="tns:get_usersResponse" />
    </operation>

    <operation name="edit_courses">
      <documentation>MoodleWS: Edit Courses Information</documentation>
      <input message="tns:edit_coursesRequest" />
      <output message="tns:edit_coursesResponse" />
    </operation>
    <operation name="get_courses">
      <documentation>MoodleWS: Get Courses Information</documentation>
      <input message="tns:get_coursesRequest" />
      <output message="tns:get_coursesResponse" />
    </operation>
    <operation name="get_grades">
      <documentation>MoodleWS: Get User Grades</documentation>
      <input message="tns:get_gradesRequest" />
      <output message="tns:get_gradesResponse" />
    </operation>

    <operation name="enrol_students">
      <documentation>
        MoodleWS: Enrol students in a course
      </documentation>
      <input message="tns:enrol_studentsRequest" />
      <output message="tns:enrol_studentsResponse" />
    </operation>

    <operation name="get_roles">
      <documentation>MoodleWS: Get All roles defined in Moodle</documentation>
      <input message="tns:noinputRequest" />
      <output message="tns:get_rolesResponse" />
    </operation>

    <operation name="get_role_byid">
      <documentation>MoodleWS: Get one role defined in Moodle</documentation>
      <input message="tns:oneValueRequest" />
      <output message="tns:get_rolesResponse" />
    </operation>

   <operation name="get_role_byname">
      <documentation>MoodleWS: Get one role defined in Moodle</documentation>
      <input message="tns:oneValueRequest" />
      <output message="tns:get_rolesResponse" />
    </operation>


    <operation name="get_events">
      <documentation>MoodleWS: Get Moodle s events </documentation>
      <input message="tns:get_eventsRequest" />
      <output message="tns:get_eventsResponse" />
    </operation>

   <operation name="get_last_changes">
      <documentation>MoodleWS: Get last changes to a Moodle s course </documentation>
      <input message="tns:get_last_changesRequest" />
      <output message="tns:get_last_changesResponse" />
    </operation>

   <operation name="get_categories">
      <documentation>MoodleWS: Get  Moodle  course categories</documentation>
      <input message="tns:noinputRequest" />
      <output message="tns:get_categoriesResponse" />
    </operation>

    <operation name="get_category_byid">
      <documentation>MoodleWS: Get one category defined in Moodle</documentation>
      <input message="tns:oneValueRequest" />
      <output message="tns:get_categoriesResponse" />
    </operation>

   <operation name="get_category_byname">
      <documentation>MoodleWS: Get one category defined in Moodle</documentation>
      <input message="tns:oneValueRequest" />
      <output message="tns:get_categoriesResponse" />
    </operation>


   <operation name="get_my_courses">
      <documentation>MoodleWS: Get Courses user identified by id is member of </documentation>
      <input message="tns:get_my_coursesRequest" />
      <output message="tns:get_coursesResponse" />
    </operation>
   
    <operation name="get_my_courses_byidnumber">
      <documentation>MoodleWS: Get Courses current user identified by idnumber is  member of </documentation>
      <input message="tns:get_my_courses_byRequest" />
      <output message="tns:get_coursesResponse" />
    </operation>

   <operation name="get_my_courses_byusername">
      <documentation>MoodleWS: Get Courses current user identified by username is  member of </documentation>
      <input message="tns:get_my_courses_byRequest" />
      <output message="tns:get_coursesResponse" />
    </operation>


   <operation name="get_courses_bycategory">
      <documentation>MoodleWS: Get Courses belonging to category </documentation>
      <input message="tns:get_courses_bycategoryRequest" />
      <output message="tns:get_coursesResponse" />
    </operation>

    <operation name="get_user_byusername">
      <documentation>MoodleWS: Get user info from Moodle user login</documentation>
      <input message="tns:get_user_byRequest" />
      <output message="tns:get_usersResponse" />
    </operation>
    <operation name="get_user_byidnumber">
      <documentation>MoodleWS: Get user info from Moodle user id number</documentation>
      <input message="tns:get_user_byRequest" />
      <output message="tns:get_usersResponse" />
    </operation>
    <operation name="get_user_byid">
      <documentation>MoodleWS: Get user info from Moodle user id</documentation>
      <input message="tns:get_user_byRequest" />
      <output message="tns:get_usersResponse" />
    </operation>

   <operation name="get_users_bycourse">
      <documentation>MoodleWS: Get users having a role in a course</documentation>
      <input message="tns:get_users_bycourseRequest" />
      <output message="tns:get_usersResponse" />
    </operation>

    <operation name="count_users_bycourse">
      <documentation>MoodleWS: count users having a role in a course</documentation>
      <input message="tns:get_users_bycourseRequest" />
      <output message="tns:integerResponse" />
    </operation>


    <operation name="get_group_members">
      <documentation>MoodleWS: Get users members of a group in course</documentation>
      <input message="tns:get_group_membersRequest" />
      <output message="tns:get_usersResponse" />
    </operation>

   <operation name="get_my_group">
      <documentation>MoodleWS: Get user group in course</documentation>
      <input message="tns:get_my_groupRequest" />
      <output message="tns:get_groupsResponse" />
    </operation>

   <operation name="get_my_groups">
      <documentation>MoodleWS: Get user groups in all Moodle site</documentation>
      <input message="tns:get_my_groupsRequest" />
      <output message="tns:get_groupsResponse" />
    </operation>

    <operation name="get_my_id">
      <documentation>MoodleWS: get current user Moodle internal id (helper)</documentation>
      <input message="tns:noinputRequest" />
      <output message="tns:integerResponse" />
    </operation>

  <operation name="has_role_incourse">
      <documentation>MoodleWS: check if user has a given role in a given course </documentation>
      <input message="tns:has_role_incourseRequest" />
      <output message="tns:booleanResponse" />
    </operation>

  <operation name="get_primaryrole_incourse">
      <documentation>MoodleWS: returns  user s primary role in a given course </documentation>
      <input message="tns:get_primaryrole_incourseRequest" />
      <output message="tns:integerResponse" />
    </operation>


    <operation name="get_activities">
      <documentation>MoodleWS: Get user most recent activities in a Moodle course</documentation>
      <input message="tns:get_activitiesRequest" />
      <output message="tns:get_activitiesResponse" />
    </operation>

    <operation name="count_activities">
      <documentation>MoodleWS: count user most recent activities in a Moodle course</documentation>
      <input message="tns:twoValuesAndIdsRequest" />
      <output message="tns:integerResponse" />
    </operation>

  </portType>

  <binding name="MoodleWSBinding" type="tns:MoodleWSPortType">
    <soap:binding style="rpc"
      transport="http://schemas.xmlsoap.org/soap/http" />
    <operation name="login">
      <soap:operation
        soapAction="' . $CFG->wwwroot . '/wspp/wsdl#login"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>
    <operation name="logout">
      <soap:operation
        soapAction="' . $CFG->wwwroot . '/wspp/wsdl#logout"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>
    <operation name="edit_users">
      <soap:operation
        soapAction="' . $CFG->wwwroot . '/wspp/wsdl#edit_users"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>
    <operation name="get_users">
      <soap:operation
        soapAction="' . $CFG->wwwroot . '/wspp/wsdl#get_users"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>
    <operation name="edit_courses">
      <soap:operation
        soapAction="' . $CFG->wwwroot . '/wspp/wsdl#edit_courses"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>
    <operation name="get_courses">
      <soap:operation
        soapAction="' . $CFG->wwwroot . '/wspp/wsdl#get_courses"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>
    <operation name="get_grades">
      <soap:operation
        soapAction="' . $CFG->wwwroot . '/wspp/wsdl#get_grades"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>
    <operation name="enrol_students">
      <soap:operation
        soapAction="' . $CFG->wwwroot . '/wspp/wsdl#enrol_students"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="' . $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>
    <operation name="get_last_changes">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_last_changes"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>

    <operation name="get_events">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_events"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>

    <operation name="get_course">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_course"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>

 <operation name="get_course_byid">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_course_byid"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>

 <operation name="get_course_byidnumber">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_course_byidnumber"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>


    <operation name="get_user">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_user"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>


    <operation name="get_roles">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_roles"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>

   <operation name="get_role_byid">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_role_byid"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

    <operation name="get_role_byname">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_role_byname"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

    <operation name="get_categories">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_categories"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>

   <operation name="get_category_byid">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_category_byid"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

     <operation name="get_category_byname">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_category_byname"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>


    <operation name="get_my_courses">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_my_courses"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>

     <operation name="get_my_courses_byusername">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_my_courses_byusername"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>

     <operation name="get_my_courses_byidnumber">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_my_courses_byidnumber"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>



    <operation name="get_user_byusername">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_user_byusername"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>
    <operation name="get_user_byidnumber">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_user_byidnumber"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>
     <operation name="get_user_byid">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_user_byid"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
    </operation>
   <operation name="get_users_bycourse">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_users_bycourse"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

    <operation name="count_users_bycourse">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#count_users_bycourse"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

     <operation name="get_courses_bycategory">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_courses_bycategory"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

   <operation name="get_groups_bycourse">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_groups_bycourse"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

<operation name="get_group_byid">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_group_byid"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

  <operation name="get_groups_byname">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_groups_byname"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>


 <operation name="get_group_members">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_group_members"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

<operation name="get_my_id">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_my_id"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>


<operation name="get_my_group">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_my_group"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

<operation name="get_my_groups">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_my_groups"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>
  <operation name="get_teachers">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_teachers"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

   <operation name="get_students">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_students"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
   </operation>

  <operation name="has_role_incourse">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#has_role_incourse"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

     <operation name="get_primaryrole_incourse">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_primaryrole_incourse"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>


    <operation name="get_activities">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#get_activities"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>

<operation name="count_activities">
      <soap:operation
        soapAction="'. $CFG->wwwroot . '/wspp/wsdl#count_activities"
        style="rpc" />
      <input>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </input>
      <output>
        <soap:body use="encoded"
          namespace="'. $CFG->wwwroot . '/wspp/wsdl"
          encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
      </output>
     </operation>


  </binding>
  <service name="MoodleWS">
    <port name="MoodleWSPort" binding="tns:MoodleWSBinding">
      <soap:address
        location="' . $CFG->wwwroot . '/wspp/service_pp.php" />
    </port>
  </service>
</definitions>';

?>
