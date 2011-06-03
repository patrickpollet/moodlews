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
	public $contexturl;
	/** 
	* @var string
	*/
	public $contexturlname;
	/** 
	* @var string
	*/
	public $email;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var string
	*/
	public $firstname;
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
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $imagealt;
	/** 
	* @var string
	*/
	public $lastname;
	/** 
	* @var int
	*/
	public $notification;
	/** 
	* @var string
	*/
	public $picture;
	/** 
	* @var string
	*/
	public $smallmessage;
	/** 
	* @var string
	*/
	public $subject;
	/** 
	* @var int
	*/
	public $timecreated;
	/** 
	* @var int
	*/
	public $useridfrom;
	/** 
	* @var int
	*/
	public $useridto;

	/**
	* default constructor for class messageRecord
	* @param string $contexturl
	* @param string $contexturlname
	* @param string $email
	* @param string $error
	* @param string $firstname
	* @param string $fullmessage
	* @param int $fullmessageformat
	* @param string $fullmessagehtml
	* @param int $id
	* @param string $imagealt
	* @param string $lastname
	* @param int $notification
	* @param string $picture
	* @param string $smallmessage
	* @param string $subject
	* @param int $timecreated
	* @param int $useridfrom
	* @param int $useridto
	* @return messageRecord
	*/
	 public function messageRecord($contexturl='',$contexturlname='',$email='',$error='',$firstname='',$fullmessage='',$fullmessageformat=0,$fullmessagehtml='',$id=0,$imagealt='',$lastname='',$notification=0,$picture='',$smallmessage='',$subject='',$timecreated=0,$useridfrom=0,$useridto=0){
		 $this->contexturl=$contexturl   ;
		 $this->contexturlname=$contexturlname   ;
		 $this->email=$email   ;
		 $this->error=$error   ;
		 $this->firstname=$firstname   ;
		 $this->fullmessage=$fullmessage   ;
		 $this->fullmessageformat=$fullmessageformat   ;
		 $this->fullmessagehtml=$fullmessagehtml   ;
		 $this->id=$id   ;
		 $this->imagealt=$imagealt   ;
		 $this->lastname=$lastname   ;
		 $this->notification=$notification   ;
		 $this->picture=$picture   ;
		 $this->smallmessage=$smallmessage   ;
		 $this->subject=$subject   ;
		 $this->timecreated=$timecreated   ;
		 $this->useridfrom=$useridfrom   ;
		 $this->useridto=$useridto   ;
	}
	/* get accessors */

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
	* @return string
	*/
	public function getFirstname(){
		 return $this->firstname;
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
	* @return int
	*/
	public function getId(){
		 return $this->id;
	}


	/**
	* @return string
	*/
	public function getImagealt(){
		 return $this->imagealt;
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
	public function getNotification(){
		 return $this->notification;
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
	public function getSmallmessage(){
		 return $this->smallmessage;
	}


	/**
	* @return string
	*/
	public function getSubject(){
		 return $this->subject;
	}


	/**
	* @return int
	*/
	public function getTimecreated(){
		 return $this->timecreated;
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

	/*set accessors */

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
	* @param string $firstname
	* @return void
	*/
	public function setFirstname($firstname){
		$this->firstname=$firstname;
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
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param string $imagealt
	* @return void
	*/
	public function setImagealt($imagealt){
		$this->imagealt=$imagealt;
	}


	/**
	* @param string $lastname
	* @return void
	*/
	public function setLastname($lastname){
		$this->lastname=$lastname;
	}


	/**
	* @param int $notification
	* @return void
	*/
	public function setNotification($notification){
		$this->notification=$notification;
	}


	/**
	* @param string $picture
	* @return void
	*/
	public function setPicture($picture){
		$this->picture=$picture;
	}


	/**
	* @param string $smallmessage
	* @return void
	*/
	public function setSmallmessage($smallmessage){
		$this->smallmessage=$smallmessage;
	}


	/**
	* @param string $subject
	* @return void
	*/
	public function setSubject($subject){
		$this->subject=$subject;
	}


	/**
	* @param int $timecreated
	* @return void
	*/
	public function setTimecreated($timecreated){
		$this->timecreated=$timecreated;
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

}

?>
