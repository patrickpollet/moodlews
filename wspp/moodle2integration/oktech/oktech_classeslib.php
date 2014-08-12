<?php 




// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see http://www.gnu.org/licenses.

/**
 * External course participation api.
 *
 * This api is mostly read only, the actual enrol and unenrol
 * support is in each enrol plugin.
 *
 * @package    oktech
 * @copyright  2011 Patrick Pollet
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();






class oktech_assignmentDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'assignmenttype'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'emailteachers'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'format'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'grade'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'maxbytes'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'preventlate'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'resubmit'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeavailable'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timedue'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'var1'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'var2'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'var3'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'var4'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'var5'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_assignmentRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_assignmentRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_assignmentRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'assignmenttype'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'emailteachers'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'format'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'grade'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'maxbytes'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'preventlate'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'resubmit'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeavailable'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timedue'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'var1'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'var2'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'var3'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'var4'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'var5'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_categoryDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'depth'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'parent'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'path'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'sortorder'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'theme'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'visible'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_categoryRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_categoryRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_categoryRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'coursecount'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'depth'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'parent'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'path'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'sortorder'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'visible'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_cohortDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'categoryid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'component'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'idnumber'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_cohortRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_cohortRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_cohortRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'component'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'contextid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'idnumber'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timecreated'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_courseDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'category'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'cost'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'enrolperiod'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'format'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'fullname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'groupmode'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'groupmodeforce'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'guest'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'hiddensections'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'idnumber'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lang'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'marker'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'maxbytes'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'metacourse'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'newsitems'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'password'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'shortname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'showgrades'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'sortorder'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'startdate'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'student'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'students'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'summary'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'teacher'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'teachers'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'theme'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'visible'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_courseRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_courseRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_courseRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'category'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'cost'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'enrolperiod'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'format'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'fullname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'groupmode'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'groupmodeforce'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'guest'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'hiddensections'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'idnumber'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lang'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'marker'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'maxbytes'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'metacourse'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'myrole'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'newsitems'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'numsections'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'password'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'shortname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'showgrades'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'sortorder'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'startdate'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'student'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'students'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'summary'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'teacher'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'teachers'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'theme'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timecreated'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'visible'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_databaseDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'addtemplatee'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'approval'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'asearchtemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'assessed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'comments'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'csstemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'defaultsort'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'defaultsortdir'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'editany'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'intro'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'jstemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'listtemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'listtemplatefooter'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'listtemplateheader'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'maxentries'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'notification'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'requiredentries'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'requiredentriestoview'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'ressarticles'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'rsstemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'rsstitletemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'scale'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'singletemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timeavailablefrom'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeavailableto'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeviewfrom'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeviewto'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_databaseRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_databaseRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_databaseRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'addtemplatee'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'approval'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'asearchtemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'assessed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'comments'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'csstemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'defaultsort'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'defaultsortdir'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'editany'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'intro'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'jstemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'listtemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'listtemplatefooter'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'listtemplateheader'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'maxentries'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'notification'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'requiredentries'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'requiredentriestoview'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'ressarticles'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'rsstemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'rsstitletemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'scale'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'singletemplate'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timeavailablefrom'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeavailableto'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeviewfrom'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeviewto'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_forumDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'assessed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'assesstimefinish'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'assesstimestart'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'blockafter'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'blockperiod'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'forcesubscribe'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'intro'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'maxbytes'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'rssarticles'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'rsstype'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'scale'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'trackingtype'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'type'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'warnafter'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_forumRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_forumRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_forumRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'assessed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'assesstimefinish'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'assesstimestart'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'blockafter'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'blockperiod'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'forcesubscribe'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'intro'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'maxbytes'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'rssarticles'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'rsstype'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'scale'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'trackingtype'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'type'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'warnafter'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_groupDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'courseid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'enrolmentkey'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'hidepicture'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'idnumber'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'picture'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_groupRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_groupRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_groupRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'courseid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'enrolmentkey'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'hidepicture'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'idnumber'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'picture'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timecreated'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_groupingDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'courseid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_groupingRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_groupingRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_groupingRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'configdata'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'courseid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timecreated'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_labelDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'content'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_labelRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_labelRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_labelRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'content'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_affectRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'status'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:boolean

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_pageWikiDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'author'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'content'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'created'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'flags'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'hits'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'lastmodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'meta'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'pagename'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'refs'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'userid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'version'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'wiki'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_pageWikiRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_pageWikiRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_pageWikiRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'author'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'content'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'created'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'flags'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'hits'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'lastmodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'meta'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'pagename'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'refs'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'userid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'version'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'wiki'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_sectionDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'section'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'sequence'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'summary'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'visible'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_sectionRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_sectionRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_sectionRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'section'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'sequence'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'summary'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'visible'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_userDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'address'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'aim'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'auth'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'city'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'confirmed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'country'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'deleted'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'department'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'email'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'emailstop'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'firstname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'icq'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'idnumber'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'institution'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lang'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lastip'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lastname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'mnethostid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'msn'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'password'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'passwordmd5'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'phone1'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'phone2'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'policyagreed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'skype'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'theme'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timezone'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'username'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'yahoo'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_userRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_userRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_userRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'address'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'aim'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'auth'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'city'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'confirmed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'country'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'deleted'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'department'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'email'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'emailstop'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'firstname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'icq'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'idnumber'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'institution'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lang'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lastip'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lastname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'mnethostid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'msn'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'phone1'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'phone2'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'policyagreed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'profile'		=>	new oktech_profileitemRecordArray('',VALUE_OPTIONAL,false),//tns:profileitemRecordArray 
	 'role'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'skype'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'theme'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timezone'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'username'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'yahoo'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_profileitemRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_profileitemRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_profileitemRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'value'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_wikiDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'disablecamelcase'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'ewikiacceptbinary'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'ewikiprinttitle'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'htmlmode'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'initialcontent'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'pagename'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'removepages'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'revertchanges'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'setpageflags'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'strippages'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'summary'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'wtype'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_wikiRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_wikiRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_wikiRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'disablecamelcase'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'ewikiacceptbinary'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'ewikiprinttitle'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'htmlmode'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'initialcontent'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'pagename'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'removepages'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'revertchanges'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'setpageflags'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'strippages'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'summary'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'wtype'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_stringArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new external_value(PARAM_CLEAN,'')  ,$desc,$required,$default);
     }
}


class oktech_enrolRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_enrolRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_enrolRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'course'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'enrol'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timeaccess'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeend'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timestart'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'userid'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_assignmentDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_assignmentDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}


class oktech_categoryDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_categoryDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}


class oktech_courseDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_courseDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}


class oktech_databaseDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_databaseDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}


class oktech_forumDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_forumDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}


class oktech_groupingDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_groupingDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}


class oktech_groupDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_groupDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}


class oktech_labelDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_labelDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}


class oktech_pageWikiDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_pageWikiDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}


class oktech_sectionDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_sectionDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}


class oktech_userDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_userDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}


class oktech_wikiDatumArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_wikiDatum('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_forumDiscussionDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'message'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'subject'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_forumDiscussionRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_forumDiscussionRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_forumDiscussionRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'assessed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'firstpost'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'forum'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'groupid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'post'		=>	new oktech_forumPostRecord('',VALUE_OPTIONAL,false),//tns:forumPostRecord 
	 'timeend'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timestart'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'userid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'usermodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_forumPostRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'attachment'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'children'		=>	new oktech_forumPostRecordArray('',VALUE_OPTIONAL,false),//tns:forumPostRecordArray 
	 'created'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'discussion'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'email'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'firstname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'imagealt'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lastname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'mailed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'mailnow'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'message'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'messageformat'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'messagetrust'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'modified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'parent'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'picture'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'subject'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'totalscore'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'userid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_forumPostRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_forumPostRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_forumPostDatum extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'message'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'subject'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_activityRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_activityRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_activityRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'DATE'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'DCL'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'DFA'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'DLA'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'DLL'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'action'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'auth'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'cmid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'currentlogin'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'email'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'firstaccess'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'firstname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'info'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'ip'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lastaccess'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'lastlogin'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'lastname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'module'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'time'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'url'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'userid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_quizRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_quizRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_quizRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'data'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'intro'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'questions'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'shuffleanswers'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'shufflequestions'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeclose'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timelimit'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeopen'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_assignmentSubmissionRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_assignmentSubmissionRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_assignmentSubmissionRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'assignment'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'assignmenttype'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'data1'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'data2'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'files'		=>	new oktech_fileRecordArray('',VALUE_OPTIONAL,false),//tns:fileRecordArray 
	 'format'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'grade'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'mailed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'numfiles'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'submissioncomment'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'teacher'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timecreated'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemarked'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'useremail'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'userid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'useridnumber'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'userusername'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_fileRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_fileRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_fileRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'filecontent'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'filename'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'filepath'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'filesize'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'fileurl'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_booleanArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new external_value(PARAM_INT,'')  ,$desc,$required,$default);
     }
}


class oktech_gradeRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_gradeRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_gradeRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'feedback'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'grade'		=>	new external_value(PARAM_NUMBER,'',VALUE_OPTIONAL),//xsd:float 
	 'itemid'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'str_grade'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_eventRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_eventRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_eventRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'courseid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'eventtype'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'format'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'groupid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'instance'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'modulename'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'repeatid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'sequence'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timeduration'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timestart'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'userid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'uuid'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'visible'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_floatArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new external_value(PARAM_NUMBER,'')  ,$desc,$required,$default);
     }
}


class oktech_resourceRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_resourceRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_resourceRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'alltext'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'course'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'coursemodule'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'groupingid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'groupmembersonly'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'groupmode'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'options'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'popup'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'reference'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'section'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'summary'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timemodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timemodified_ut'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'type'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'url'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'visible'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_intArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new external_value(PARAM_INT,'') ,$desc,$required,$default);
     }
}


class oktech_changeRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_changeRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_changeRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'author'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'courseid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'date'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'instance'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'link'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'resid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'timestamp'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'type'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'url'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'visible'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_contactRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_contactRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_contactRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'address'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'aim'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'auth'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'city'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'confirmed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'country'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'deleted'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'department'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'email'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'emailstop'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'firstname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'icq'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'idnumber'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'institution'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lang'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lastip'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lastname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'messagecount'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'mnethostid'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'msn'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'online'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'phone1'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'phone2'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'policyagreed'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'profile'		=>	new oktech_profileitemRecordArray('',VALUE_OPTIONAL,false),//tns:profileitemRecordArray 
	 'role'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'skype'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'theme'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timezone'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'username'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'yahoo'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_messageRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_messageRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_messageRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'contexturl'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'contexturlname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'email'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'firstname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'fullmessage'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'fullmessageformat'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'fullmessagehtml'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'imagealt'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'lastname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'notification'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'picture'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'smallmessage'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'subject'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'timecreated'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'useridfrom'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'useridto'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_gradeItemRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_gradeItemRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_gradeItemRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'dategraded'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'datesubmitted'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'feedback_format'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'grade'		=>	new external_value(PARAM_NUMBER,'',VALUE_OPTIONAL),//xsd:float 
	 'str_feedback'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'str_grade'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'str_long_grade'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'userid'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'useridnumber'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'usermodified'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}


class oktech_roleRecordArray extends external_multiple_structure {
     function __construct ($desc,$required,$default) {
     	parent::__construct(new oktech_roleRecord('',VALUE_OPTIONAL,null) ,$desc,$required,$default);
     }
}

class oktech_roleRecord extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'description'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'error'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'id'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'name'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'shortname'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string 
	 'sortorder'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_loginReturn extends external_single_structure {
	function __construct ($desc) {
	    $content=array(
	       
 
	 'client'		=>	new external_value(PARAM_INT,'',VALUE_OPTIONAL),//xsd:int 
	 'sessionkey'		=>	new external_value(PARAM_CLEAN,'',VALUE_OPTIONAL),//xsd:string

	    );
		parent::__construct($content, $desc,VALUE_REQUIRED,null);
	}
}

class oktech_add_assignmentResponse extends  oktech_assignmentRecordArray{
    	
}

class oktech_add_categoryResponse extends  oktech_categoryRecordArray{
    	
}

class oktech_add_cohortResponse extends  oktech_cohortRecordArray{
    	
}

class oktech_add_courseResponse extends  oktech_courseRecordArray{
    	
}

class oktech_add_databaseResponse extends  oktech_databaseRecordArray{
    	
}

class oktech_add_forumResponse extends  oktech_forumRecordArray{
    	
}

class oktech_add_groupResponse extends  oktech_groupRecordArray{
    	
}

class oktech_add_groupingResponse extends  oktech_groupingRecordArray{
    	
}

class oktech_add_labelResponse extends  oktech_labelRecordArray{
    	
}

class oktech_add_noneditingteacherResponse extends  oktech_affectRecord{
    	
}

class oktech_add_pagewikiResponse extends  oktech_pageWikiRecordArray{
    	
}

class oktech_add_sectionResponse extends  oktech_sectionRecordArray{
    	
}

class oktech_add_studentResponse extends  oktech_affectRecord{
    	
}

class oktech_add_teacherResponse extends  oktech_affectRecord{
    	
}

class oktech_add_userResponse extends  oktech_userRecordArray{
    	
}

class oktech_add_wikiResponse extends  oktech_wikiRecordArray{
    	
}

class oktech_affect_assignment_to_sectionResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_course_to_categoryResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_database_to_sectionResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_forum_to_sectionResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_group_to_courseResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_group_to_groupingResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_grouping_to_courseResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_label_to_sectionResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_pageWiki_to_wikiResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_section_to_courseResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_user_to_cohortResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_user_to_courseResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_user_to_groupResponse extends  oktech_affectRecord{
    	
}

class oktech_affect_users_to_cohortResponse extends  oktech_enrolRecordArray{
    	
}

class oktech_affect_users_to_groupResponse extends  oktech_enrolRecordArray{
    	
}

class oktech_affect_wiki_to_sectionResponse extends  oktech_affectRecord{
    	
}

class oktech_count_activitiesResponse extends  external_value{
    	
}

class oktech_count_users_bycourseResponse extends  external_value{
    	
}

class oktech_delete_cohortResponse extends  oktech_cohortRecordArray{
    	
}

class oktech_delete_courseResponse extends  oktech_courseRecordArray{
    	
}

class oktech_delete_groupResponse extends  oktech_groupRecordArray{
    	
}

class oktech_delete_groupingResponse extends  oktech_groupingRecordArray{
    	
}

class oktech_delete_userResponse extends  oktech_userRecordArray{
    	
}

class oktech_edit_assignmentsResponse extends  oktech_assignmentRecordArray{
    	
}

class oktech_edit_categoriesResponse extends  oktech_categoryRecordArray{
    	
}

class oktech_edit_coursesResponse extends  oktech_courseRecordArray{
    	
}

class oktech_edit_databasesResponse extends  oktech_databaseRecordArray{
    	
}

class oktech_edit_forumsResponse extends  oktech_forumRecordArray{
    	
}

class oktech_edit_groupingsResponse extends  oktech_groupingRecordArray{
    	
}

class oktech_edit_groupsResponse extends  oktech_groupRecordArray{
    	
}

class oktech_edit_labelsResponse extends  oktech_labelRecordArray{
    	
}

class oktech_edit_pagesWikiResponse extends  oktech_pageWikiRecordArray{
    	
}

class oktech_edit_sectionsResponse extends  oktech_sectionRecordArray{
    	
}

class oktech_edit_usersResponse extends  oktech_userRecordArray{
    	
}

class oktech_edit_wikisResponse extends  oktech_wikiRecordArray{
    	
}

class oktech_enrol_studentsResponse extends  oktech_enrolRecordArray{
    	
}

class oktech_forum_add_discussionResponse extends  oktech_forumDiscussionRecordArray{
    	
}

class oktech_forum_add_replyResponse extends  oktech_forumPostRecordArray{
    	
}

class oktech_get_activitiesResponse extends  oktech_activityRecordArray{
    	
}

class oktech_get_all_assignmentsResponse extends  oktech_assignmentRecordArray{
    	
}

class oktech_get_all_cohortsResponse extends  oktech_cohortRecordArray{
    	
}

class oktech_get_all_databasesResponse extends  oktech_databaseRecordArray{
    	
}

class oktech_get_all_forumsResponse extends  oktech_forumRecordArray{
    	
}

class oktech_get_all_groupingsResponse extends  oktech_groupingRecordArray{
    	
}

class oktech_get_all_groupsResponse extends  oktech_groupRecordArray{
    	
}

class oktech_get_all_labelsResponse extends  oktech_labelRecordArray{
    	
}

class oktech_get_all_pagesWikiResponse extends  oktech_pageWikiRecordArray{
    	
}

class oktech_get_all_quizzesResponse extends  oktech_quizRecordArray{
    	
}

class oktech_get_all_wikisResponse extends  oktech_wikiRecordArray{
    	
}

class oktech_get_assignment_submissionsResponse extends  oktech_assignmentSubmissionRecordArray{
    	
}

class oktech_get_boolean_arrayResponse extends  oktech_booleanArray{
    	
}

class oktech_get_categoriesResponse extends  oktech_categoryRecordArray{
    	
}

class oktech_get_category_byidResponse extends  oktech_categoryRecordArray{
    	
}

class oktech_get_category_bynameResponse extends  oktech_categoryRecordArray{
    	
}

class oktech_get_cohort_byidResponse extends  oktech_cohortRecordArray{
    	
}

class oktech_get_cohort_byidnumberResponse extends  oktech_cohortRecordArray{
    	
}

class oktech_get_cohort_membersResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_cohorts_bynameResponse extends  oktech_cohortRecordArray{
    	
}

class oktech_get_courseResponse extends  oktech_courseRecordArray{
    	
}

class oktech_get_course_byidResponse extends  oktech_courseRecordArray{
    	
}

class oktech_get_course_byidnumberResponse extends  oktech_courseRecordArray{
    	
}

class oktech_get_course_gradesResponse extends  oktech_gradeRecordArray{
    	
}

class oktech_get_coursesResponse extends  oktech_courseRecordArray{
    	
}

class oktech_get_courses_bycategoryResponse extends  oktech_courseRecordArray{
    	
}

class oktech_get_courses_searchResponse extends  oktech_courseRecordArray{
    	
}

class oktech_get_eventsResponse extends  oktech_eventRecordArray{
    	
}

class oktech_get_float_arrayResponse extends  oktech_floatArray{
    	
}

class oktech_get_forum_discussionsResponse extends  oktech_forumDiscussionRecordArray{
    	
}

class oktech_get_forum_postsResponse extends  oktech_forumPostRecordArray{
    	
}

class oktech_get_gradesResponse extends  oktech_gradeRecordArray{
    	
}

class oktech_get_group_byidResponse extends  oktech_groupRecordArray{
    	
}

class oktech_get_group_membersResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_grouping_byidResponse extends  oktech_groupRecordArray{
    	
}

class oktech_get_grouping_membersResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_groupings_bycourseResponse extends  oktech_groupingRecordArray{
    	
}

class oktech_get_groupings_bynameResponse extends  oktech_groupRecordArray{
    	
}

class oktech_get_groups_bycourseResponse extends  oktech_groupRecordArray{
    	
}

class oktech_get_groups_bynameResponse extends  oktech_groupRecordArray{
    	
}

class oktech_get_instances_bytypeResponse extends  oktech_resourceRecordArray{
    	
}

class oktech_get_int_arrayResponse extends  oktech_intArray{
    	
}

class oktech_get_last_changesResponse extends  oktech_changeRecordArray{
    	
}

class oktech_get_message_contactsResponse extends  oktech_contactRecordArray{
    	
}

class oktech_get_messagesResponse extends  oktech_messageRecordArray{
    	
}

class oktech_get_messages_historyResponse extends  oktech_messageRecordArray{
    	
}

class oktech_get_module_gradesResponse extends  oktech_gradeItemRecordArray{
    	
}

class oktech_get_my_assignment_gradeResponse extends  oktech_gradeItemRecordArray{
    	
}

class oktech_get_my_cohortsResponse extends  oktech_cohortRecordArray{
    	
}

class oktech_get_my_coursesResponse extends  oktech_courseRecordArray{
    	
}

class oktech_get_my_courses_byidnumberResponse extends  oktech_courseRecordArray{
    	
}

class oktech_get_my_courses_byusernameResponse extends  oktech_courseRecordArray{
    	
}

class oktech_get_my_groupResponse extends  oktech_groupRecordArray{
    	
}

class oktech_get_my_groupsResponse extends  oktech_groupRecordArray{
    	
}

class oktech_get_my_idResponse extends  external_value{
    	
}

class oktech_get_my_module_gradeResponse extends  oktech_gradeItemRecordArray{
    	
}

class oktech_get_my_quiz_gradeResponse extends  oktech_gradeItemRecordArray{
    	
}

class oktech_get_primaryrole_incourseResponse extends  external_value{
    	
}

class oktech_get_quizResponse extends  oktech_quizRecord{
    	
}

class oktech_get_resourcefile_byidResponse extends  oktech_fileRecord{
    	
}

class oktech_get_resourcesResponse extends  oktech_resourceRecordArray{
    	
}

class oktech_get_role_byidResponse extends  oktech_roleRecordArray{
    	
}

class oktech_get_role_bynameResponse extends  oktech_roleRecordArray{
    	
}

class oktech_get_rolesResponse extends  oktech_roleRecordArray{
    	
}

class oktech_get_sectionsResponse extends  oktech_sectionRecordArray{
    	
}

class oktech_get_string_arrayResponse extends  oktech_stringArray{
    	
}

class oktech_get_studentsResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_teachersResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_userResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_user_byidResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_user_byidnumberResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_user_byusernameResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_user_gradesResponse extends  oktech_gradeRecordArray{
    	
}

class oktech_get_usersResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_users_bycourseResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_users_byprofileResponse extends  oktech_userRecordArray{
    	
}

class oktech_get_versionResponse extends  external_value{
    	
}

class oktech_has_role_incourseResponse extends  external_value{
    	
}

class oktech_loginResponse extends  oktech_loginReturn{
    	
}

class oktech_logoutResponse extends  external_value{
    	
}

class oktech_message_sendResponse extends  oktech_affectRecord{
    	
}

class oktech_remove_group_from_groupingResponse extends  oktech_affectRecord{
    	
}

class oktech_remove_noneditingteacherResponse extends  oktech_affectRecord{
    	
}

class oktech_remove_studentResponse extends  oktech_affectRecord{
    	
}

class oktech_remove_teacherResponse extends  oktech_affectRecord{
    	
}

class oktech_remove_user_from_cohortResponse extends  oktech_affectRecord{
    	
}

class oktech_remove_user_from_courseResponse extends  oktech_affectRecord{
    	
}

class oktech_remove_user_from_groupResponse extends  oktech_affectRecord{
    	
}

class oktech_remove_users_from_cohortResponse extends  oktech_enrolRecordArray{
    	
}

class oktech_remove_users_from_groupResponse extends  oktech_enrolRecordArray{
    	
}

class oktech_set_user_profile_valuesResponse extends  oktech_profileitemRecordArray{
    	
}

class oktech_unenrol_studentsResponse extends  oktech_enrolRecordArray{
    	
}

class oktech_update_cohortResponse extends  oktech_cohortRecordArray{
    	
}

class oktech_update_courseResponse extends  oktech_courseRecordArray{
    	
}

class oktech_update_groupResponse extends  oktech_groupRecordArray{
    	
}

class oktech_update_groupingResponse extends  oktech_groupingRecordArray{
    	
}

class oktech_update_sectionResponse extends  oktech_sectionRecordArray{
    	
}

class oktech_update_userResponse extends  oktech_userRecordArray{
    	
}

?>
