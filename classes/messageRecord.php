<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class messageRecord {
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
	public $useridfrom;
	/** 
	* @var int
	*/
	public $useridto;
	/** 
	* @var string
	*/
	public $subject;
	/** 
	* @var string
	*/
	public $fullmessage;
	/** 
	* @var int
	*/
	public $fullmessageformat;
	/** 
	* @var string
	*/
	public $fullmessagehtml;
	/** 
	* @var string
	*/
	public $smallmessage;
	/** 
	* @var int
	*/
	public $notification;
	/** 
	* @var string
	*/
	public $contexturl;
	/** 
	* @var string
	*/
	public $contexturlname;
	/** 
	* @var int
	*/
	public $timecreated;
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
	* @var string
	*/
	public $picture;
	/** 
	* @var string
	*/
	public $imagealt;

	/**
	* default constructor for class messageRecord
	* @return messageRecord
	*/	 public function messageRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->useridfrom=0;
		 $this->useridto=0;
		 $this->subject='';
		 $this->fullmessage='';
		 $this->fullmessageformat=0;
		 $this->fullmessagehtml='';
		 $this->smallmessage='';
		 $this->notification=0;
		 $this->contexturl='';
		 $this->contexturlname='';
		 $this->timecreated=0;
		 $this->firstname='';
		 $this->lastname='';
		 $this->email='';
		 $this->picture='';
		 $this->imagealt='';
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
	public function getUseridfrom(){
		 return $this->useridfrom;
	}


	/**
	* @return int
	*/
	public function getUseridto(){
		 return $this->useridto;
	}


	/**
	* @return string
	*/
	public function getSubject(){
		 return $this->subject;
	}


	/**
	* @return string
	*/
	public function getFullmessage(){
		 return $this->fullmessage;
	}


	/**
	* @return int
	*/
	public function getFullmessageformat(){
		 return $this->fullmessageformat;
	}


	/**
	* @return string
	*/
	public function getFullmessagehtml(){
		 return $this->fullmessagehtml;
	}


	/**
	* @return string
	*/
	public function getSmallmessage(){
		 return $this->smallmessage;
	}


	/**
	* @return int
	*/
	public function getNotification(){
		 return $this->notification;
	}


	/**
	* @return string
	*/
	public function getContexturl(){
		 return $this->contexturl;
	}


	/**
	* @return string
	*/
	public function getContexturlname(){
		 return $this->contexturlname;
	}


	/**
	* @return int
	*/
	public function getTimecreated(){
		 return $this->timecreated;
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
	* @return string
	*/
	public function getPicture(){
		 return $this->picture;
	}


	/**
	* @return string
	*/
	public function getImagealt(){
		 return $this->imagealt;
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
	* @param int $useridfrom
	* @return void
	*/
	public function setUseridfrom($useridfrom){
		$this->useridfrom=$useridfrom;
	}


	/**
	* @param int $useridto
	* @return void
	*/
	public function setUseridto($useridto){
		$this->useridto=$useridto;
	}


	/**
	* @param string $subject
	* @return void
	*/
	public function setSubject($subject){
		$this->subject=$subject;
	}


	/**
	* @param string $fullmessage
	* @return void
	*/
	public function setFullmessage($fullmessage){
		$this->fullmessage=$fullmessage;
	}


	/**
	* @param int $fullmessageformat
	* @return void
	*/
	public function setFullmessageformat($fullmessageformat){
		$this->fullmessageformat=$fullmessageformat;
	}


	/**
	* @param string $fullmessagehtml
	* @return void
	*/
	public function setFullmessagehtml($fullmessagehtml){
		$this->fullmessagehtml=$fullmessagehtml;
	}


	/**
	* @param string $smallmessage
	* @return void
	*/
	public function setSmallmessage($smallmessage){
		$this->smallmessage=$smallmessage;
	}


	/**
	* @param int $notification
	* @return void
	*/
	public function setNotification($notification){
		$this->notification=$notification;
	}


	/**
	* @param string $contexturl
	* @return void
	*/
	public function setContexturl($contexturl){
		$this->contexturl=$contexturl;
	}


	/**
	* @param string $contexturlname
	* @return void
	*/
	public function setContexturlname($contexturlname){
		$this->contexturlname=$contexturlname;
	}


	/**
	* @param int $timecreated
	* @return void
	*/
	public function setTimecreated($timecreated){
		$this->timecreated=$timecreated;
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
	* @param string $picture
	* @return void
	*/
	public function setPicture($picture){
		$this->picture=$picture;
	}


	/**
	* @param string $imagealt
	* @return void
	*/
	public function setImagealt($imagealt){
		$this->imagealt=$imagealt;
	}

}

?>
