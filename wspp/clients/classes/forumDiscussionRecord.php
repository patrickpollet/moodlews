<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class forumDiscussionRecord {
	/** 
	* @var int
	*/
	public $assessed;
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $firstpost;
	/** 
	* @var int
	*/
	public $forum;
	/** 
	* @var int
	*/
	public $groupid;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var forumPostRecord
	*/
	public $post;
	/** 
	* @var int
	*/
	public $timeend;
	/** 
	* @var int
	*/
	public $timemodified;
	/** 
	* @var int
	*/
	public $timestart;
	/** 
	* @var int
	*/
	public $userid;
	/** 
	* @var int
	*/
	public $usermodified;

	/**
	* default constructor for class forumDiscussionRecord
	* @param int $assessed
	* @param int $course
	* @param string $error
	* @param int $firstpost
	* @param int $forum
	* @param int $groupid
	* @param int $id
	* @param string $name
	* @param forumPostRecord $post
	* @param int $timeend
	* @param int $timemodified
	* @param int $timestart
	* @param int $userid
	* @param int $usermodified
	* @return forumDiscussionRecord
	*/
	 public function forumDiscussionRecord($assessed=0,$course=0,$error='',$firstpost=0,$forum=0,$groupid=0,$id=0,$name='',$post=NULL,$timeend=0,$timemodified=0,$timestart=0,$userid=0,$usermodified=0){
		 $this->assessed=$assessed   ;
		 $this->course=$course   ;
		 $this->error=$error   ;
		 $this->firstpost=$firstpost   ;
		 $this->forum=$forum   ;
		 $this->groupid=$groupid   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->post=$post   ;
		 $this->timeend=$timeend   ;
		 $this->timemodified=$timemodified   ;
		 $this->timestart=$timestart   ;
		 $this->userid=$userid   ;
		 $this->usermodified=$usermodified   ;
	}
	/* get accessors */

	/**
	* @return int
	*/
	public function getAssessed(){
		 return $this->assessed;
	}


	/**
	* @return int
	*/
	public function getCourse(){
		 return $this->course;
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
	public function getFirstpost(){
		 return $this->firstpost;
	}


	/**
	* @return int
	*/
	public function getForum(){
		 return $this->forum;
	}


	/**
	* @return int
	*/
	public function getGroupid(){
		 return $this->groupid;
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
	public function getName(){
		 return $this->name;
	}


	/**
	* @return forumPostRecord
	*/
	public function getPost(){
		 return $this->post;
	}


	/**
	* @return int
	*/
	public function getTimeend(){
		 return $this->timeend;
	}


	/**
	* @return int
	*/
	public function getTimemodified(){
		 return $this->timemodified;
	}


	/**
	* @return int
	*/
	public function getTimestart(){
		 return $this->timestart;
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
	public function getUsermodified(){
		 return $this->usermodified;
	}

	/*set accessors */

	/**
	* @param int $assessed
	* @return void
	*/
	public function setAssessed($assessed){
		$this->assessed=$assessed;
	}


	/**
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param int $firstpost
	* @return void
	*/
	public function setFirstpost($firstpost){
		$this->firstpost=$firstpost;
	}


	/**
	* @param int $forum
	* @return void
	*/
	public function setForum($forum){
		$this->forum=$forum;
	}


	/**
	* @param int $groupid
	* @return void
	*/
	public function setGroupid($groupid){
		$this->groupid=$groupid;
	}


	/**
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param forumPostRecord $post
	* @return void
	*/
	public function setPost($post){
		$this->post=$post;
	}


	/**
	* @param int $timeend
	* @return void
	*/
	public function setTimeend($timeend){
		$this->timeend=$timeend;
	}


	/**
	* @param int $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}


	/**
	* @param int $timestart
	* @return void
	*/
	public function setTimestart($timestart){
		$this->timestart=$timestart;
	}


	/**
	* @param int $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}


	/**
	* @param int $usermodified
	* @return void
	*/
	public function setUsermodified($usermodified){
		$this->usermodified=$usermodified;
	}

}

?>
