<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class activityRecord {
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $time;
	/** 
	* @var int
	*/
	public $userid;
	/** 
	* @var string
	*/
	public $ip;
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var int
	*/
	public $module;
	/** 
	* @var int
	*/
	public $cmid;
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var string
	*/
	public $url;
	/** 
	* @var string
	*/
	public $info;
	/** 
	* @var string
	*/
	public $DATE;
	/** 
	* @var string
	*/
	public $auth;
	/** 
	* @var string
	*/
	public $firstname;
	/** 
	* @var string
	*/
	public $lastname;
	/** 
	* @var string
	*/
	public $email;
	/** 
	* @var int
	*/
	public $firstaccess;
	/** 
	* @var int
	*/
	public $lastaccess;
	/** 
	* @var int
	*/
	public $lastlogin;
	/** 
	* @var int
	*/
	public $currentlogin;
	/** 
	* @var string
	*/
	public $DLA;
	/** 
	* @var string
	*/
	public $DFA;
	/** 
	* @var string
	*/
	public $DLL;
	/** 
	* @var string
	*/
	public $DCL;

	/**
	* default constructor for class activityRecord
	* @param string $error
	* @param int $id
	* @param int $time
	* @param int $userid
	* @param string $ip
	* @param int $course
	* @param int $module
	* @param int $cmid
	* @param string $action
	* @param string $url
	* @param string $info
	* @param string $DATE
	* @param string $auth
	* @param string $firstname
	* @param string $lastname
	* @param string $email
	* @param int $firstaccess
	* @param int $lastaccess
	* @param int $lastlogin
	* @param int $currentlogin
	* @param string $DLA
	* @param string $DFA
	* @param string $DLL
	* @param string $DCL
	* @return activityRecord
	*/
	 public function activityRecord($error='',$id=0,$time=0,$userid=0,$ip='',$course=0,$module=0,$cmid=0,$action='',$url='',$info='',$DATE='',$auth='',$firstname='',$lastname='',$email='',$firstaccess=0,$lastaccess=0,$lastlogin=0,$currentlogin=0,$DLA='',$DFA='',$DLL='',$DCL=''){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->time=$time   ;
		 $this->userid=$userid   ;
		 $this->ip=$ip   ;
		 $this->course=$course   ;
		 $this->module=$module   ;
		 $this->cmid=$cmid   ;
		 $this->action=$action   ;
		 $this->url=$url   ;
		 $this->info=$info   ;
		 $this->DATE=$DATE   ;
		 $this->auth=$auth   ;
		 $this->firstname=$firstname   ;
		 $this->lastname=$lastname   ;
		 $this->email=$email   ;
		 $this->firstaccess=$firstaccess   ;
		 $this->lastaccess=$lastaccess   ;
		 $this->lastlogin=$lastlogin   ;
		 $this->currentlogin=$currentlogin   ;
		 $this->DLA=$DLA   ;
		 $this->DFA=$DFA   ;
		 $this->DLL=$DLL   ;
		 $this->DCL=$DCL   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return int
	*/
	public function getId(){
		 return $this->id;
	}


	/**
	* @return int
	*/
	public function getTime(){
		 return $this->time;
	}


	/**
	* @return int
	*/
	public function getUserid(){
		 return $this->userid;
	}


	/**
	* @return string
	*/
	public function getIp(){
		 return $this->ip;
	}


	/**
	* @return int
	*/
	public function getCourse(){
		 return $this->course;
	}


	/**
	* @return int
	*/
	public function getModule(){
		 return $this->module;
	}


	/**
	* @return int
	*/
	public function getCmid(){
		 return $this->cmid;
	}


	/**
	* @return string
	*/
	public function getAction(){
		 return $this->action;
	}


	/**
	* @return string
	*/
	public function getUrl(){
		 return $this->url;
	}


	/**
	* @return string
	*/
	public function getInfo(){
		 return $this->info;
	}


	/**
	* @return string
	*/
	public function getDATE(){
		 return $this->DATE;
	}


	/**
	* @return string
	*/
	public function getAuth(){
		 return $this->auth;
	}


	/**
	* @return string
	*/
	public function getFirstname(){
		 return $this->firstname;
	}


	/**
	* @return string
	*/
	public function getLastname(){
		 return $this->lastname;
	}


	/**
	* @return string
	*/
	public function getEmail(){
		 return $this->email;
	}


	/**
	* @return int
	*/
	public function getFirstaccess(){
		 return $this->firstaccess;
	}


	/**
	* @return int
	*/
	public function getLastaccess(){
		 return $this->lastaccess;
	}


	/**
	* @return int
	*/
	public function getLastlogin(){
		 return $this->lastlogin;
	}


	/**
	* @return int
	*/
	public function getCurrentlogin(){
		 return $this->currentlogin;
	}


	/**
	* @return string
	*/
	public function getDLA(){
		 return $this->DLA;
	}


	/**
	* @return string
	*/
	public function getDFA(){
		 return $this->DFA;
	}


	/**
	* @return string
	*/
	public function getDLL(){
		 return $this->DLL;
	}


	/**
	* @return string
	*/
	public function getDCL(){
		 return $this->DCL;
	}

	/*set accessors */

	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param int $time
	* @return void
	*/
	public function setTime($time){
		$this->time=$time;
	}


	/**
	* @param int $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}


	/**
	* @param string $ip
	* @return void
	*/
	public function setIp($ip){
		$this->ip=$ip;
	}


	/**
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param int $module
	* @return void
	*/
	public function setModule($module){
		$this->module=$module;
	}


	/**
	* @param int $cmid
	* @return void
	*/
	public function setCmid($cmid){
		$this->cmid=$cmid;
	}


	/**
	* @param string $action
	* @return void
	*/
	public function setAction($action){
		$this->action=$action;
	}


	/**
	* @param string $url
	* @return void
	*/
	public function setUrl($url){
		$this->url=$url;
	}


	/**
	* @param string $info
	* @return void
	*/
	public function setInfo($info){
		$this->info=$info;
	}


	/**
	* @param string $DATE
	* @return void
	*/
	public function setDATE($DATE){
		$this->DATE=$DATE;
	}


	/**
	* @param string $auth
	* @return void
	*/
	public function setAuth($auth){
		$this->auth=$auth;
	}


	/**
	* @param string $firstname
	* @return void
	*/
	public function setFirstname($firstname){
		$this->firstname=$firstname;
	}


	/**
	* @param string $lastname
	* @return void
	*/
	public function setLastname($lastname){
		$this->lastname=$lastname;
	}


	/**
	* @param string $email
	* @return void
	*/
	public function setEmail($email){
		$this->email=$email;
	}


	/**
	* @param int $firstaccess
	* @return void
	*/
	public function setFirstaccess($firstaccess){
		$this->firstaccess=$firstaccess;
	}


	/**
	* @param int $lastaccess
	* @return void
	*/
	public function setLastaccess($lastaccess){
		$this->lastaccess=$lastaccess;
	}


	/**
	* @param int $lastlogin
	* @return void
	*/
	public function setLastlogin($lastlogin){
		$this->lastlogin=$lastlogin;
	}


	/**
	* @param int $currentlogin
	* @return void
	*/
	public function setCurrentlogin($currentlogin){
		$this->currentlogin=$currentlogin;
	}


	/**
	* @param string $DLA
	* @return void
	*/
	public function setDLA($DLA){
		$this->DLA=$DLA;
	}


	/**
	* @param string $DFA
	* @return void
	*/
	public function setDFA($DFA){
		$this->DFA=$DFA;
	}


	/**
	* @param string $DLL
	* @return void
	*/
	public function setDLL($DLL){
		$this->DLL=$DLL;
	}


	/**
	* @param string $DCL
	* @return void
	*/
	public function setDCL($DCL){
		$this->DCL=$DCL;
	}

}

?>
