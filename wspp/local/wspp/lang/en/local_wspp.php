<?PHP // $Id$
      // wspp.php -
      // translation file for Ok Tech WebServices (wspp) version 1.7
      // thanks to   "Stephen C. Scherer" <sscherer4@cox.net>

$string['webservices'] = 'OK Tech Webservices ( aka wspp)';

$string['ws_disable']='Disable Web Service';
$string['config_ws_disable']='Reject all connection requests';
$string['ws_logoperations']='Log operations in Moodle\'s log ';
$string['config_ws_logoperations']='Configure logging operations';
$string['ws_logdetailedoperations']='Log detailed operations';
$string['config_ws_logdetailedoperations']='Configure logging of detailed operations ; for example' .
        ' in case of a large number of registrations, each entry will be logged';
$string['ws_logerrors']='Log errors';
$string['config_ws_logerrors']='Insert an entry in the log for each error';

$string['ws_sessiontimeout']='Duration of each session';
$string['config_ws_sessiontimeout']='Time interval in seconds after which a connection request (transaction log) will expire';

$string['ws_debug']='Enable debug mode';
$string['config_ws_debug']='Dump many intermediate values in moodledata/debug.out file';

$string['ws_enforceipcheck']='Enable monitoring of IP addresses';
$string['ws_config_enforceipcheck']='With this option, only registered customers in the table mdl_webservices_clients_allow will be allowed to connect' .
        '. For now you must edit it with phpmyadmin';


$string['ws_accessdisabled']='web service access disabled on this site.';
$string['ws_accessrestricted']='web service access not allowed for your ip address {$a}.';
$string['ws_nomoodle16']='Moodle versions prior to 1.7 are not supported.';

$string['ws_invaliduser']='Invalid username and / or password.';

$string['ws_ipadressmismatch']='ip address has changed for this open session ! {$a}';
$string['ws_errorregistersession']='unable to register the session';

$string['ws_invalidclient']='Invalid Client connection.';

$string['ws_sqlstrftimedatetime']='%%d/%%m/%%Y %%H:%%i:%%s';

$string['ws_nomatch']='no match found for {$a->critere} = {$a->valeur}';
$string['ws_nothingfound']='no results.';
$string['ws_emptyparameter']='the parameter {$a} cannot be empty.';


$string['ws_userunknown']='user {$a} unknown.';
$string['ws_courseunknown']='course {$a} unknown.';
$string['ws_categoryunknown']='category  {$a} unknown.';
$string['ws_groupunknown']='group  {$a} unknown.';
$string['ws_groupingunknown']='grouping {$a} unknown.';
$string['ws_roleunknown']='role {$a} unknown.';
$string['ws_sectionunknown']='section {$a} unknown.';
$string['ws_forumunknown']='forum {$a} unknown.';
$string['ws_databaseunknown']='database {$a} unknown.';
$string['ws_assignmentunknown']='assignment {$a} unknown.';
$string['ws_wikiunknown']='wiki {$a} unknown.';
$string['ws_wikipageunknown']='wikipage {$a} unknown.';
$string['ws_labelunknown']='label {$a} unknown.';
$string['ws_profileunknown']='profile {$a} unknown.';

$string['ws_activityunknown']='activity {$a->type} with id {$a->id} unknown.';

$string['ws_assignmenttypeunknown']='assignment type {$a} unknown.';
$string['ws_quizunknown']='quiz {$a} unknown.';

$string['ws_noseegrades']='not authorized to see grades of {$a}';
$string['ws_nogradesfound']='no grades for user {$a->user} in {$a->course}';
$string['ws_operationnotallowed']='you don\'t have the permissions to do this.';
$string['ws_nocourseforuser']='no courses found for {$a}';
$string['ws_coursewithoutidnumber']='the course {$a} does not have idnumber (report to your administrator)';
$string['ws_nocoursewithidnumberforuser']='no course with non empty idnumber exists for user {$a} (report to your administrator)';
$string['ws_roleidnotfound']='role id {$a} not found.';
$string['ws_nothingtodo']='nothing to do.';
$string['ws_notsupportedgradebook']='the notebook prior to Moodle 1.8 is not supported.';


$string['ws_missingvalue']='required value {$a} missing';
$string['ws_useridnumberexists']='a user already exists with this idnumber {$a}';
$string['ws_courseidnumberexists']='a course already exists with this idnumber {$a}';
$string['ws_invalidaction']='invalid action {$a}';
$string['ws_user_notenroled']='The user {$a->user} is not enrolled in the course {$a->course}.';

$string['nothingtodo']='nothing to do';
$string['ws_notimplemented']='feature {$a} not yet implemented';

$string['nocourses']='no courses';
$string['nousers']='no users';
$string['nocategories']='no categories';
$string['noroles']='no roles';
$string['noresources']='no resources';

$string['nosections']='no sections';
$string['nogradesfor']='no grades for {$a}';
$string['nogradesin']='no grades in {$a}';
$string['nogroupsin']='no groups in {$a}';
$string['nogroups']='no groups';
$string['nogrouping']='no groupings';
$string['nogroupingsin']='no groupings in {$a}';
$string['nocohorts']='no cohorts';

$string['noteachers']='no teachers';
$string['noevents']='no events';
$string['nochanges']='no changes';
$string['noactivities']='no activities';
$string['nodatabases']='no databases';
$string['noforums']='no forums';
$string['nowikis']='no wikies';
$string['noassignments']='no assignments';
$string['nosubmissions']='no submissions to this assignment';
$string['nowikipages']='no wiki pages';
$string['nolabels']='no labels';
$string['noquizzes']='no quizzes';
$string['nomessages']='no messages';
$string['nocontacts']='no contacts';

$string['ws_groupalreadyaffected']='the group {$a->group} already is a member of course {$a->course}.';
$string['ws_groupingalreadyaffected']='the grouping {$a->group} already is a member of course {$a->course}.';

$string['ws_errorcreatingcourse']='error creating course {$a}.';
$string['ws_errordeletingcourse']='error deleting course {$a}.';
$string['ws_errorupdatingcourse']='error updating course {$a}.';

$string['ws_errorcreatinguser']='error creating user {$a}.';
$string['ws_errordeletinguser']='error deleting user {$a}.';
$string['ws_errorupdatinguser']='error updating user {$a}.';

$string['ws_errorcreatinggroup']='error creating group {$a}.';
$string['ws_errordeletinggroup']='error deleting group {$a}.';
$string['ws_errorupdatinggroup']='error updating group {$a}.';

$string['ws_errorcreatinggrouping']='error creating grouping {$a}.';
$string['ws_errordeletinggrouping']='error deleting grouping {$a}.';
$string['ws_errorupdatinggrouping']='error updating grouping {$a}.';

$string['ws_duplicategroupname']='duplicate group name {$a}.';
$string['ws_duplicategroupingname']='duplicate grouping name {$a}.';

$string['ws_errorcreatingcategory']='error creating category {$a}.';
$string['ws_errorcreatingsection']='error creating section {$a}.';
$string['ws_errorcreatinglabel']='error creating label {$a}.';
$string['ws_errorcreatingforum']='error creating forum {$a}.';
$string['ws_errorcreatingassignment']='error creating assignment {$a}.';
$string['ws_errorcreatingdatabase']='error creating database {$a}.';
$string['ws_errorcreatingwiki']='error creating wiki {$a}.';
$string['ws_errorcreatingwikientry']='error creating first wiki\'s entry {$a}';
$string['ws_errorcreatingpagewiki']='error creating page wiki {$a}.';


$string['ws_errorcreatingassignment']='error creating assignment {$a}.';
$string['ws_errorupdatingassignment']='error updating assignment {$a}.';
$string['ws_errordeletingassignment']='error deleting assignment {$a}.';

$string['ws_errorcreatingdatabase']='error creating database {$a}.';
$string['ws_errorupdatingdatabase']='error updating database {$a}.';

$string['ws_errorcreatingsection']='error creating section {$a}.';
$string['ws_errorupdatingsection']='error updating section {$a}.';

$string['ws_unvalidgroupmode']='invalid group mode {$a}';

$string['ws_wikiincorrecttype']='invalid wiki type {$a}';

$string['ws_moduletypeunknown']='Module type {$a} not found!';
$string['ws_modalreadyassigned']='The {$a->type}  {$a->id} is already assigned to the section {$a->section} of course {$a->course}.';
$string['ws_erroraddingmoduletocourse']='It is not possible to add {$a->type}  {$a->id} to course {$a->course}.';
$string['ws_erroraddingmoduletosection']='It is not possible to add the {$a->type} {$a->id} in Section {$a->section} of the course {$a->course}.';

$string['ws_errorupdatingmodule']='error affecting the module {$a->id} in {$a->course}';

$string['ws_profileinvalidvaluemenu']='value {$a} is not permitted in the options';
$string['ws_profileinvalidvaluecheckbox']='value has been 0 or 1';

$string['ws_uselocalwsdl']='Use an auto generated wsdl';
$string['config_ws_uselocalwsdl']='Fixes a problem reading the WSDL with some versions of PHP 5 (http://bugs.php.net/bug.php?id=48216) ';


$string['ws_quizexportunknownformat']='Export format of {$a} is unknown';

$string['ws_erroralreadydeleteduser']='User id= {$a} has already been deleted';

$string['ws_useralreadymember']='User  {$a->user} is already enroled to  {$a->course}';
$string['ws_usernotmember']='User {$a->user} is not enroled to {$a->course}';

$string['ws_resourceunknown']= 'Resource {$a} unknown';
$string['ws_resourceinvalid']= 'Resource {$a} invalid';

?>
