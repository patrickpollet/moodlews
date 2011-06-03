<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class forumPostRecord {
	/** 
	* @var string
	*/
	public $attachment;
	/** 
	* @var forumPostRecord[]
	*/
	public $children;
	/** 
	* @var int
	*/
	public $created;
	/** 
	* @var int
	*/
	public $discussion;
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
	public $mailed;
	/** 
	* @var int
	*/
	public $mailnow;
	/** 
	* @var string
	*/
	public $message;
	/** 
	* @var int
	*/
	public $messageformat;
	/** 
	* @var int
	*/
	public $messagetrust;
	/** 
	* @var int
	*/
	public $modified;
	/** 
	* @var int
	*/
	public $parent;
	/** 
	* @var string
	*/
	public $picture;
	/** 
	* @var string
	*/
	public $subject;
	/** 
	* @var int
	*/
	public $totalscore;
	/** 
	* @var int
	*/
	public $userid;

	/**
	* default constructor for class forumPostRecord
	* @param string $attachment
	* @param forumPostRecord[] $children
	* @param int $created
	* @param int $discussion
	* @param string $email
	* @param string $error
	* @param string $firstname
	* @param int $id
	* @param string $imagealt
	* @param string $lastname
	* @param int $mailed
	* @param int $mailnow
	* @param string $message
	* @param int $messageformat
	* @param int $messagetrust
	* @param int $modified
	* @param int $parent
	* @param string $picture
	* @param string $subject
	* @param int $totalscore
	* @param int $userid
	* @return forumPostRecord
	*/
	 public function forumPostRecord($attachment='',$children=array(),$created=0,$discussion=0,$email='',$error='',$firstname='',$id=0,$imagealt='',$lastname='',$mailed=0,$mailnow=0,$message='',$messageformat=0,$messagetrust=0,$modified=0,$parent=0,$picture='',$subject='',$totalscore=0,$userid=0){
		 $this->attachment=$attachment   ;
		 $this->children=$children   ;
		 $this->created=$created   ;
		 $this->discussion=$discussion   ;
		 $this->email=$email   ;
		 $this->error=$error   ;
		 $this->firstname=$firstname   ;
		 $this->id=$id   ;
		 $this->imagealt=$imagealt   ;
		 $this->lastname=$lastname   ;
		 $this->mailed=$mailed   ;
		 $this->mailnow=$mailnow   ;
		 $this->message=$message   ;
		 $this->messageformat=$messageformat   ;
		 $this->messagetrust=$messagetrust   ;
		 $this->modified=$modified   ;
		 $this->parent=$parent   ;
		 $this->picture=$picture   ;
		 $this->subject=$subject   ;
		 $this->totalscore=$totalscore   ;
		 $this->userid=$userid   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAttachment(){
		 return $this->attachment;
	}


	/**
	* @return forumPostRecord[]
	*/
	public function getChildren(){
		 return $this->children;
	}


	/**
	* @return int
	*/
	public function getCreated(){
		 return $this->created;
	}


	/**
	* @return int
	*/
	public function getDiscussion(){
		 return $this->discussion;
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
	public function getMailed(){
		 return $this->mailed;
	}


	/**
	* @return int
	*/
	public function getMailnow(){
		 return $this->mailnow;
	}


	/**
	* @return string
	*/
	public function getMessage(){
		 return $this->message;
	}


	/**
	* @return int
	*/
	public function getMessageformat(){
		 return $this->messageformat;
	}


	/**
	* @return int
	*/
	public function getMessagetrust(){
		 return $this->messagetrust;
	}


	/**
	* @return int
	*/
	public function getModified(){
		 return $this->modified;
	}


	/**
	* @return int
	*/
	public function getParent(){
		 return $this->parent;
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
	public function getSubject(){
		 return $this->subject;
	}


	/**
	* @return int
	*/
	public function getTotalscore(){
		 return $this->totalscore;
	}


	/**
	* @return int
	*/
	public function getUserid(){
		 return $this->userid;
	}

	/*set accessors */

	/**
	* @param string $attachment
	* @return void
	*/
	public function setAttachment($attachment){
		$this->attachment=$attachment;
	}


	/**
	* @param forumPostRecord[] $children
	* @return void
	*/
	public function setChildren($children){
		$this->children=$children;
	}


	/**
	* @param int $created
	* @return void
	*/
	public function setCreated($created){
		$this->created=$created;
	}


	/**
	* @param int $discussion
	* @return void
	*/
	public function setDiscussion($discussion){
		$this->discussion=$discussion;
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
	* @param int $mailed
	* @return void
	*/
	public function setMailed($mailed){
		$this->mailed=$mailed;
	}


	/**
	* @param int $mailnow
	* @return void
	*/
	public function setMailnow($mailnow){
		$this->mailnow=$mailnow;
	}


	/**
	* @param string $message
	* @return void
	*/
	public function setMessage($message){
		$this->message=$message;
	}


	/**
	* @param int $messageformat
	* @return void
	*/
	public function setMessageformat($messageformat){
		$this->messageformat=$messageformat;
	}


	/**
	* @param int $messagetrust
	* @return void
	*/
	public function setMessagetrust($messagetrust){
		$this->messagetrust=$messagetrust;
	}


	/**
	* @param int $modified
	* @return void
	*/
	public function setModified($modified){
		$this->modified=$modified;
	}


	/**
	* @param int $parent
	* @return void
	*/
	public function setParent($parent){
		$this->parent=$parent;
	}


	/**
	* @param string $picture
	* @return void
	*/
	public function setPicture($picture){
		$this->picture=$picture;
	}


	/**
	* @param string $subject
	* @return void
	*/
	public function setSubject($subject){
		$this->subject=$subject;
	}


	/**
	* @param int $totalscore
	* @return void
	*/
	public function setTotalscore($totalscore){
		$this->totalscore=$totalscore;
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
