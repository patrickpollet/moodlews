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
	public $error;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $discussion;
	/** 
	* @var int
	*/
	public $parent;
	/** 
	* @var int
	*/
	public $userid;
	/** 
	* @var int
	*/
	public $created;
	/** 
	* @var int
	*/
	public $modified;
	/** 
	* @var int
	*/
	public $mailed;
	/** 
	* @var string
	*/
	public $subject;
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
	* @var string
	*/
	public $attachment;
	/** 
	* @var int
	*/
	public $totalscore;
	/** 
	* @var int
	*/
	public $mailnow;
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
	* @var forumPostRecord[]
	*/
	public $children;

	/**
	* default constructor for class forumPostRecord
	* @param string $error
	* @param int $id
	* @param int $discussion
	* @param int $parent
	* @param int $userid
	* @param int $created
	* @param int $modified
	* @param int $mailed
	* @param string $subject
	* @param string $message
	* @param int $messageformat
	* @param int $messagetrust
	* @param string $attachment
	* @param int $totalscore
	* @param int $mailnow
	* @param string $firstname
	* @param string $lastname
	* @param string $email
	* @param string $picture
	* @param string $imagealt
	* @param forumPostRecord[] $children
	* @return forumPostRecord
	*/
	 public function forumPostRecord($error='',$id=0,$discussion=0,$parent=0,$userid=0,$created=0,$modified=0,$mailed=0,$subject='',$message='',$messageformat=0,$messagetrust=0,$attachment='',$totalscore=0,$mailnow=0,$firstname='',$lastname='',$email='',$picture='',$imagealt='',$children=array()){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->discussion=$discussion   ;
		 $this->parent=$parent   ;
		 $this->userid=$userid   ;
		 $this->created=$created   ;
		 $this->modified=$modified   ;
		 $this->mailed=$mailed   ;
		 $this->subject=$subject   ;
		 $this->message=$message   ;
		 $this->messageformat=$messageformat   ;
		 $this->messagetrust=$messagetrust   ;
		 $this->attachment=$attachment   ;
		 $this->totalscore=$totalscore   ;
		 $this->mailnow=$mailnow   ;
		 $this->firstname=$firstname   ;
		 $this->lastname=$lastname   ;
		 $this->email=$email   ;
		 $this->picture=$picture   ;
		 $this->imagealt=$imagealt   ;
		 $this->children=$children   ;
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
	public function getDiscussion(){
		 return $this->discussion;
	}


	/**
	* @return int
	*/
	public function getParent(){
		 return $this->parent;
	}


	/**
	* @return int
	*/
	public function getUserid(){
		 return $this->userid;
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
	public function getModified(){
		 return $this->modified;
	}


	/**
	* @return int
	*/
	public function getMailed(){
		 return $this->mailed;
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
	* @return string
	*/
	public function getAttachment(){
		 return $this->attachment;
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
	public function getMailnow(){
		 return $this->mailnow;
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


	/**
	* @return forumPostRecord[]
	*/
	public function getChildren(){
		 return $this->children;
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
	* @param int $discussion
	* @return void
	*/
	public function setDiscussion($discussion){
		$this->discussion=$discussion;
	}


	/**
	* @param int $parent
	* @return void
	*/
	public function setParent($parent){
		$this->parent=$parent;
	}


	/**
	* @param int $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}


	/**
	* @param int $created
	* @return void
	*/
	public function setCreated($created){
		$this->created=$created;
	}


	/**
	* @param int $modified
	* @return void
	*/
	public function setModified($modified){
		$this->modified=$modified;
	}


	/**
	* @param int $mailed
	* @return void
	*/
	public function setMailed($mailed){
		$this->mailed=$mailed;
	}


	/**
	* @param string $subject
	* @return void
	*/
	public function setSubject($subject){
		$this->subject=$subject;
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
	* @param string $attachment
	* @return void
	*/
	public function setAttachment($attachment){
		$this->attachment=$attachment;
	}


	/**
	* @param int $totalscore
	* @return void
	*/
	public function setTotalscore($totalscore){
		$this->totalscore=$totalscore;
	}


	/**
	* @param int $mailnow
	* @return void
	*/
	public function setMailnow($mailnow){
		$this->mailnow=$mailnow;
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


	/**
	* @param forumPostRecord[] $children
	* @return void
	*/
	public function setChildren($children){
		$this->children=$children;
	}

}

?>
