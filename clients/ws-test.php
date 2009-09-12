<?php // $Id: ws-test.php,v 1.6 2007/04/24 04:05:36 PP Exp $
/*
sample PHP4 WS client
Inspired by OKTech sample client   
Do not used generated class MoodleWS_NS, so can be used with PHP4 
See ws_course_xsl_nusoap.php for a php5 example using nusoap 
*/
 
    require_once('../../config.php');
    // use Moodle distributed nusoap lib
    require_once($CFG->dirroot . '/lib/soap/nusoap.php');

    require ('auth.php');
    ini_set('soap.wsdl_cache_enabled', '0');  // Set to '0' for debugging.


/**
 * For the examples below I have assigned the following idnumber fields:
 * - For the guest user: 'USER-guest'
 * - For the admin user: 'USER-admin'
 * - Two manually created users: 'USER-one' and 'USER-two'
 * - The user created by this script is now assigned an idnumber of: 'USER-wstest'
 * 
 * - For the SITEID course: 'COURSE-1'
 * - Two simple courses I created: 'COURSE-2' and 'COURSE-3'
 */
    define('WS_PRINT_DEBUG',       true);
    define('WS_WSDL_URL',          $CFG->wwwroot . '/wspp/wsdl_pp.php');
    define('WS_USER_IDFIELD',      'username');
    define('WS_COURSE_IDFIELD',    'idnumber');
    define('WS_USER_GET_IDS',      'ppollet,alexis,astrid,pguy');
    define('WS_COURSE_GET_IDS',    '1PC_PASSINFO,C2I_101');
    define('WS_GRADES_USER_ID',    'USER-one'); 
    define('WS_GRADES_COURSE_IDS', 'COURSE-2,COURSE-4,COURSE-3');
    define('WS_ENROL_COURSE_ID',   'COURSE-wstest');
    define('WS_ENROL_USER_IDS',    'astorck,toto,ppollet,alexis,astrid,pguy,uribeiro');


    $mykey = '';
    $mycid = 0;

    $tests = array(
        'login',

    /// User-spefic tests.
//        'add_user',
//        'update_user',
//        'get_users',
//          'get_users_bycourse',
//        'delete_user',

    /// User-specific tests.
//        'add_course',
//        'update_course',
//        'get_courses',
//        'delete_course',

    /// Other tests.
//        'get_grades',
        'enrol_students',

        'logout',
    );


    function proc_result($result, $client, $debug = WS_PRINT_DEBUG) {
        echo '<p><b>Sent server call...</b></p>';

        if ($debug) {
            echo 'Request: <xmp>' . $client->request . '</xmp>';
            echo 'Response: <xmp>' . $client->response . '</xmp>';
            echo 'Debug log: <pre>' . $client->debug_str . '</pre>';
        }

    /// Check for a fault.
        if ($client->fault) {
            echo '<p><b>Fault: ' . $result['faultstring'] . '</b></p>';
        } else {
        /// Check for errors.
            $err = $client->getError();
            if ($err) {
            /// Display error.
                echo '<p><b>Error: ' . $err . '</b></p>';
                print_object($result);
            } else {
            /// Check for server sent errors.
                if (!empty($result->error)) {
                /// Display the error.
                    echo '<p><b>Received error...</b></p>';
                    
                    if (WS_PRINT_DEBUG) {
                        print_object($result->error);
                        print_object($result->stat);
                        print_object($result->client);
                        print_object($result->sessionkey);
                    }
                    die;
                }

            /// Display the result.
                echo '<p><b>Received result...</b></p>';
                if (WS_PRINT_DEBUG) {
                    print_object($result);
                }
                return $result;
            }
        }
    }


/// === Start tests code. ===


    echo '<p><b>Attempting to create a server connection...</b></p>';

/// Create the client instance
    $client = new soap_client(WS_WSDL_URL, true);

/// Check for an error
    $err = $client->getError();
    if ($err) {
    /// Display the error.
        echo '<p><b>Constructor error: ' . $err . '</b></p>';
        die;
    } else {
        echo '<p><b>Client connected...</b></p>';
    }

    $proxy  = $client->getProxy();


/// LOGIN
    if (in_array('login', $tests)) {
        print_heading('Login:');

        $result = proc_result($proxy->login(LOGIN, PASSWORD), $proxy);

        $mycid = $result['client'];
        $mykey = $result['sessionkey'];
    }


/// EDIT_USER (ADD)
    if (in_array('add_user', $tests)) {
        print_object('<h2>Edit User (ADD):</h2>');
        $users = array();
/*
        $users[] = array(
            'action'    => 'Add',
            'idnumber'  => 'USER-wstest',
            'username'  => 'wstest',
            'firstname' => 'WS',
            'lastname'  => 'Test',
            'password'  => md5('wstest'),
            'email'     => 'jfilip+ws@gmail.com',
            'city'      => 'Toronto',
            'country'   => 'ca',
        );
*/
/*
       $users[]=array(
          'action' => 'Delete',
          'idnumber'=> 'Lyon3_014'
       );
*/
 $users[] = array(
            'action'    => 'Update',
            'idnumber'  => 'USER-wstest',
            'username'  => 'wstest',
            'firstname' => 'W S',
            'lastname'  => 'last Test PP',
            'password'  => md5('wstest256'),
            'email'     => 'jfilip+ws@gmail.com',
            'city'      => 'Toronto',
            'country'   => 'ca',
        );

        proc_result($proxy->edit_users($mycid, $mykey, array('users' => $users)), $proxy);
    }


/// EDIT_USER (UPDATE)
    if (in_array('update_user', $tests)) {
        print_heading('Edit User (UPDATE):');
        $users = array();

        $users[] = array(
            'action'   => 'Update',
            'idnumber' => '123456789'
        );

        $users[] = array(
            'action'    => 'Update',
            'idnumber'  => 'USER-wstest',
            'firstname' => 'Web Services',
            'lastname'  => 'Test'
        );

        proc_result($proxy->edit_users($mycid, $mykey, array('users' => $users)), $proxy);
    }


/// GET_USER
    if (in_array('get_users', $tests)) {
        print_heading('Get Users:');

        $userids = array();

        if ($uids = explode(',', WS_USER_GET_IDS)) {
            foreach ($uids as $uid) {
                $userids[] = $uid;
            }
        }

        proc_result($proxy->get_users($mycid, $mykey, $userids, WS_USER_IDFIELD), $proxy);
    }

/// GET_USERS_BYCOURSE
    if (in_array('get_users_bycourse', $tests)) {
        print_heading('Get Users by course : course id=2 role =5');

        proc_result($proxy->get_users_bycourse($mycid, $mykey, 2,'id',5), $proxy);
    }



/// EDIT_USER (DELETE)
    if (in_array('delete_user', $tests)) {
        print_heading('Edit User (DELETE):');
        $users = array();

        $users[] = array(
            'action'    => 'Delete',
            'idnumber'  => '123456789'
        );

        $users[] = array(
            'action'   => 'Delete',
            'idnumber' => 'USER-wstest'
        );

        proc_result($proxy->edit_user($mycid, $mykey, array('users' => $users)), $proxy);
    }


/// EDIT_COURSE (ADD)
    if (in_array('add_course', $tests)) {
        print_heading('Edit Course (ADD):');

        $courses   = array();
        $courses[] = array(
            'action'      => 'Add',
            'idnumber'    => 'COURSE-wstest',
            'shortname'   => 'WS_01',
            'fullname'    => 'Web Services Test Course #1',
            'summary'     => 'Web Services Test Course #1<br /><br /><b>Created with the Moodle Web Services layer</b>',
            'category'    => 1,
            'format'      => 'weeks',
            'numsections' => 10,
            'enrolperiod' => 60
        );

        proc_result($proxy->edit_courses($mycid, $mykey, array('courses' => $courses)), $proxy);
    }


/// EDIT_COURSE (UPDATE)
    if (in_array('update_course', $tests)) {
        print_heading('Edit Course (UPDATE):');

        $courses   = array();
        $courses[] = array(
            'action'   => 'Update',
            'idnumber' => 'NULL'
        );

        $courses[] = array(
            'action'      => 'Update',
            'idnumber'    => 'COURSE-wstest',
            'summary'    => 'Web Services Test Course #1<br /><br /><b><u>Modified</u> with the Moodle Web Services layer</b>.',
            'enrolperiod' => 90            
        );

        proc_result($proxy->edit_courses($mycid, $mykey, array('courses' => $courses)), $proxy);
    }


/// GET_COURSE
    if (in_array('get_courses', $tests)) {
        print_heading('Get Courses:');

        $courseids = array();

        if ($cids = explode(',', WS_COURSE_GET_IDS)) {
            foreach ($cids as $cid) {
                $courseids[] = $cid;
            }
        }

        proc_result($proxy->get_courses($mycid, $mykey, $courseids, WS_COURSE_IDFIELD), $proxy);
    }


/// EDIT_COUSE (DELETE)
    if (in_array('delete_course', $tests)) {
        print_heading('Edit Course (DELETE):');

        $courses   = array();
        $courses[] = array(
            'action'   => 'Delete',
            'idnumber' => 'COURSE-wstest'
        );

        proc_result($proxy->edit_courses($mycid, $mykey, array('courses' => $courses)), $proxy);
    }


/// GET_GRADES
    if (in_array('get_grades', $tests)) {
        print_heading('Get Grades:');

        $courseids = array();

        if ($cids = explode(',', WS_GRADES_COURSE_IDS)) {
            foreach ($cids as $cid) {
                $courseids['courseid'][] = $cid;
            }
        }

        proc_result($proxy->get_grades($mycid, $mykey, WS_GRADES_USER_ID, $courseids, WS_COURSE_IDFIELD), $proxy);
    }


/// ENROL_STUDENTS
    if (in_array('enrol_students', $tests)) {
        print_heading('Enrol Students:');

        $userids = array();

        if ($uids = explode(',', WS_ENROL_USER_IDS)) {
            foreach ($uids as $uid) {
                $userids[] = $uid;
            }
        }
        print_r($userids);
        proc_result($proxy->enrol_students($mycid, $mykey, WS_ENROL_COURSE_ID, $userids, WS_USER_IDFIELD), $proxy);
    }


/// LOGOUT
    if (in_array('logout', $tests)) {
        print_heading('Logout:');

        proc_result($proxy->logout($mycid, $mykey), $proxy);
    }


?>
