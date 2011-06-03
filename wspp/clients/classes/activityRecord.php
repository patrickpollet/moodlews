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
	public $DATE;
	/** 
	* @var string
	*/
	public $DCL;
	/** 
	* @var string
	*/
	public $DFA;
	/** 
	* @var string
	*/
	public $DLA;
	/** 
	* @var string
	*/
	public $DLL;
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var string
	*/
	public $auth;
	/** 
	* @var int
	*/
	public $cmid;
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var int
	*/
	public $currentlogin;
	/** 
	* @var string
	*/
	public $email;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $firstaccess;
	/** 
	* @var string
	*/
	public $firstname;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $info;
	/** 
	* @var string
	*/
	public $ip;
	/** 
	* @var int
	*/
	public $lastaccess;
	/** 
	* @var int
	*/
	public $lastlogin;
	/** 
	* @var string
	*/
	public $lastname;
	/** 
	* @var int
	*/
	public $module;
	/** 
	* @var int
	*/
	public $time;
	/** 
	* @var string
	*/
	public $url;
	/** 
	* @var int
	*/
	public $userid;

	/**
	* default constructor for class activityRecord
	* @param string $DATE
	* @param string $DCL
	* @param string $DFA
	* @param string $DLA
	* @param string $DLL
	* @param string $action
	* @param string $auth
	* @param int $cmid
	* @param int $course
	* @param int $currentlogin
	* @param string $email
	* @param string $error
	* @param int $firstaccess
	* @param string $firstname
	* @param int $id
	* @param string $info
	* @param string $ip
	* @param int $lastaccess
	* @param int $lastlogin
	* @param string $lastname
	* @param int $module
	* @param int $time
	* @param string $url
	* @param int $userid
	* @return activityRecord
	*/
	 public function activityRecord($DATE='',$DCL='',$DFA='',$DLA='',$DLL='',$action='',$auth='',$cmid=0,$course=0,$currentlogin=0,$email='',$error='',$firstaccess=0,$firstname='',$id=0,$info='',$ip='',$lastaccess=0,$lastlogin=0,$lastname='',$module=0,$time=0,$url='',$userid=0){
		 $this->DATE=$DATE   ;
		 $this->DCL=$DCL   ;
		 $this->DFA=$DFA   ;
		 $this->DLA=$DLA   ;
		 $this->DLL=$DLL   ;
		 $this->action=$action   ;
		 $this->auth=$auth   ;
		 $this->cmid=$cmid   ;
		 $this->course=$course   ;
		 $this->currentlogin=$currentlogin   ;
		 $this->email=$email   ;
		 $this->error=$error   ;
		 $this->firstaccess=$firstaccess   ;
		 $this->firstname=$firstname   ;
		 $this->id=$id   ;
		 $this->info=$info   ;
		 $this->ip=$ip   ;
		 $this->lastaccess=$lastaccess   ;
		 $this->lastlogin=$lastlogin   ;
		 $this->lastname=$lastname   ;
		 $this->module=$module   ;
		 $this->time=$time   ;
		 $this->url=$url   ;
		 $this->userid=$userid   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getDATE(){
		 return $this->DATE;
	}


	/**
	* @return string
	*/
	public function getDCL(){
		 return $this->DCL;
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
	public function getDLA(){
		 return $this->DLA;
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
	public function getAction(){
		 return $this->action;
	}


	/**
	* @return string
	*/
	public function getAuth(){
		 return $this->auth;
	}


	/**
	* @return int
	*/
	public function getCmid(){
		 return $this->cmid;
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
	public function getCurrentlogin(){
		 return $this->currentlogin;
	}


	/**
	* @return string
	*/
	public function getEmail(){
		 return $this->email;
	}


	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return int
	*/
	public function getFirstaccess(){
		 return $this->firstaccess;
	}


	/**
	* @return string
	*/
	public function getFirstname(){
		 return $this->firstname;
	}


	/**
	* @return int
	*/
	public function getId(){
		 return $this->id;
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
	public function getIp(){
		 return $this->ip;
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
	* @return string
	*/
	public function getLastname(){
		 return $this->lastname;
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
	public function getTime(){
		 return $this->time;
	}


	/**
	* @return string
	*/
	public function getUrl(){
		 return $this->url;
	}


	/**
	* @return int
	*/
	public function getUserid(){
		 return $this->userid;
	}

	/*set accessors */

	/**
	* @param string $DATE
	* @return void
	*/
	public function setDATE($DATE){
		$this->DATE=$DATE;
	}


	/**
	* @param string $DCL
	* @return void
	*/
	public function setDCL($DCL){
		$this->DCL=$DCL;
	}


	/**
	* @param string $DFA
	* @return void
	*/
	public function setDFA($DFA){
		$this->DFA=$DFA;
	}


	/**
	* @param string $DLA
	* @return void
	*/
	public function setDLA($DLA){
		$this->DLA=$DLA;
	}


	/**
	* @param string $DLL
	* @return void
	*/
	public function setDLL($DLL){
		$this->DLL=$DLL;
	}


	/**
	* @param string $action
	* @return void
	*/
	public function setAction($action){
		$this->action=$action;
	}


	/**
	* @param string $auth
	* @return void
	*/
	public function setAuth($auth){
		$this->auth=$auth;
	}


	/**
	* @param int $cmid
	* @return void
	*/
	public function setCmid($cmid){
		$this->cmid=$cmid;
	}


	/**
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param int $currentlogin
	* @return void
	*/
	public function setCurrentlogin($currentlogin){
		$this->currentlogin=$currentlogin;
	}


	/**
	* @param string $email
	* @return void
	*/
	public function setEmail($email){
		$this->email=$email;
	}


	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param int $firstaccess
	* @return void
	*/
	public function setFirstaccess($firstaccess){
		$this->firstaccess=$firstaccess;
	}


	/**
	* @param string $firstname
	* @return void
	*/
	public function setFirstname($firstname){
		$this->firstname=$firstname;
	}


	/**
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param string $info
	* @return void
	*/
	public function setInfo($info){
		$this->info=$info;
	}


	/**
	* @param string $ip
	* @return void
	*/
	public function setIp($ip){
		$this->ip=$ip;
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
	* @param string $lastname
	* @return void
	*/
	public function setLastname($lastname){
		$this->lastname=$lastname;
	}


	/**
	* @param int $module
	* @return void
	*/
	public function setModule($module){
		$this->module=$module;
	}


	/**
	* @param int $time
	* @return void
	*/
	public function setTime($time){
		$this->time=$time;
	}


	/**
	* @param string $url
	* @return void
	*/
	public function setUrl($url){
		$this->url=$url;
	}


	/**
	* @param int $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}

}

?>
