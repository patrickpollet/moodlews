<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class activityRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  integer
	*/
	public $time;
	/** 
	* @var  integer
	*/
	public $userid;
	/** 
	* @var  string
	*/
	public $ip;
	/** 
	* @var  integer
	*/
	public $course;
	/** 
	* @var  integer
	*/
	public $module;
	/** 
	* @var  integer
	*/
	public $cmid;
	/** 
	* @var  string
	*/
	public $action;
	/** 
	* @var  string
	*/
	public $url;
	/** 
	* @var  string
	*/
	public $info;
	/** 
	* @var  string
	*/
	public $DATE;
	/** 
	* @var  string
	*/
	public $auth;
	/** 
	* @var  string
	*/
	public $firstname;
	/** 
	* @var  string
	*/
	public $lastname;
	/** 
	* @var  string
	*/
	public $email;
	/** 
	* @var  integer
	*/
	public $firstaccess;
	/** 
	* @var  integer
	*/
	public $lastaccess;
	/** 
	* @var  integer
	*/
	public $lastlogin;
	/** 
	* @var  integer
	*/
	public $currentlogin;
	/** 
	* @var  string
	*/
	public $DLA;
	/** 
	* @var  string
	*/
	public $DFA;
	/** 
	* @var  string
	*/
	public $DLL;
	/** 
	* @var  string
	*/
	public $DCL;
	 public function activityRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->time=0;
		 $this->userid=0;
		 $this->ip='';
		 $this->course=0;
		 $this->module=0;
		 $this->cmid=0;
		 $this->action='';
		 $this->url='';
		 $this->info='';
		 $this->DATE='';
		 $this->auth='';
		 $this->firstname='';
		 $this->lastname='';
		 $this->email='';
		 $this->firstaccess=0;
		 $this->lastaccess=0;
		 $this->lastlogin=0;
		 $this->currentlogin=0;
		 $this->DLA='';
		 $this->DFA='';
		 $this->DLL='';
		 $this->DCL='';
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getTime(){
		 return $this->time;
	}

	public function getUserid(){
		 return $this->userid;
	}

	public function getIp(){
		 return $this->ip;
	}

	public function getCourse(){
		 return $this->course;
	}

	public function getModule(){
		 return $this->module;
	}

	public function getCmid(){
		 return $this->cmid;
	}

	public function getAction(){
		 return $this->action;
	}

	public function getUrl(){
		 return $this->url;
	}

	public function getInfo(){
		 return $this->info;
	}

	public function getDATE(){
		 return $this->DATE;
	}

	public function getAuth(){
		 return $this->auth;
	}

	public function getFirstname(){
		 return $this->firstname;
	}

	public function getLastname(){
		 return $this->lastname;
	}

	public function getEmail(){
		 return $this->email;
	}

	public function getFirstaccess(){
		 return $this->firstaccess;
	}

	public function getLastaccess(){
		 return $this->lastaccess;
	}

	public function getLastlogin(){
		 return $this->lastlogin;
	}

	public function getCurrentlogin(){
		 return $this->currentlogin;
	}

	public function getDLA(){
		 return $this->DLA;
	}

	public function getDFA(){
		 return $this->DFA;
	}

	public function getDLL(){
		 return $this->DLL;
	}

	public function getDCL(){
		 return $this->DCL;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setTime($time){
		$this->time=$time;
	}

	public function setUserid($userid){
		$this->userid=$userid;
	}

	public function setIp($ip){
		$this->ip=$ip;
	}

	public function setCourse($course){
		$this->course=$course;
	}

	public function setModule($module){
		$this->module=$module;
	}

	public function setCmid($cmid){
		$this->cmid=$cmid;
	}

	public function setAction($action){
		$this->action=$action;
	}

	public function setUrl($url){
		$this->url=$url;
	}

	public function setInfo($info){
		$this->info=$info;
	}

	public function setDATE($DATE){
		$this->DATE=$DATE;
	}

	public function setAuth($auth){
		$this->auth=$auth;
	}

	public function setFirstname($firstname){
		$this->firstname=$firstname;
	}

	public function setLastname($lastname){
		$this->lastname=$lastname;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function setFirstaccess($firstaccess){
		$this->firstaccess=$firstaccess;
	}

	public function setLastaccess($lastaccess){
		$this->lastaccess=$lastaccess;
	}

	public function setLastlogin($lastlogin){
		$this->lastlogin=$lastlogin;
	}

	public function setCurrentlogin($currentlogin){
		$this->currentlogin=$currentlogin;
	}

	public function setDLA($DLA){
		$this->DLA=$DLA;
	}

	public function setDFA($DFA){
		$this->DFA=$DFA;
	}

	public function setDLL($DLL){
		$this->DLL=$DLL;
	}

	public function setDCL($DCL){
		$this->DCL=$DCL;
	}

}

?>
