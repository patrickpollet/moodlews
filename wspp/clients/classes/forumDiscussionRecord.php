<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class forumDiscussionRecord {
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
	public $course;
	/** 
	* @var int
	*/
	public $forum;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var int
	*/
	public $firstpost;
	/** 
	* @var int
	*/
	public $userid;
	/** 
	* @var int
	*/
	public $groupid;
	/** 
	* @var int
	*/
	public $assessed;
	/** 
	* @var int
	*/
	public $timemodified;
	/** 
	* @var int
	*/
	public $usermodified;
	/** 
	* @var int
	*/
	public $timestart;
	/** 
	* @var int
	*/
	public $timeend;
	/** 
	* @var forumPostRecord
	*/
	public $post;

	/**
	* default constructor for class forumDiscussionRecord
	* @param string $error
	* @param int $id
	* @param int $course
	* @param int $forum
	* @param string $name
	* @param int $firstpost
	* @param int $userid
	* @param int $groupid
	* @param int $assessed
	* @param int $timemodified
	* @param int $usermodified
	* @param int $timestart
	* @param int $timeend
	* @param forumPostRecord $post
	* @return forumDiscussionRecord
	*/
	 public function forumDiscussionRecord($error='',$id=0,$course=0,$forum=0,$name='',$firstpost=0,$userid=0,$groupid=0,$assessed=0,$timemodified=0,$usermodified=0,$timestart=0,$timeend=0,$post=NULL){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->course=$course   ;
		 $this->forum=$forum   ;
		 $this->name=$name   ;
		 $this->firstpost=$firstpost   ;
		 $this->userid=$userid   ;
		 $this->groupid=$groupid   ;
		 $this->assessed=$assessed   ;
		 $this->timemodified=$timemodified   ;
		 $this->usermodified=$usermodified   ;
		 $this->timestart=$timestart   ;
		 $this->timeend=$timeend   ;
		 $this->post=$post   ;
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
	public function getCourse(){
		 return $this->course;
	}


	/**
	* @return int
	*/
	public function getForum(){
		 return $this->forum;
	}


	/**
	* @return string
	*/
	public function getName(){
		 return $this->name;
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
	public function getUserid(){
		 return $this->userid;
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
	public function getAssessed(){
		 return $this->assessed;
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
	public function getUsermodified(){
		 return $this->usermodified;
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
	public function getTimeend(){
		 return $this->timeend;
	}


	/**
	* @return forumPostRecord
	*/
	public function getPost(){
		 return $this->post;
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
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param int $forum
	* @return void
	*/
	public function setForum($forum){
		$this->forum=$forum;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param int $firstpost
	* @return void
	*/
	public function setFirstpost($firstpost){
		$this->firstpost=$firstpost;
	}


	/**
	* @param int $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}


	/**
	* @param int $groupid
	* @return void
	*/
	public function setGroupid($groupid){
		$this->groupid=$groupid;
	}


	/**
	* @param int $assessed
	* @return void
	*/
	public function setAssessed($assessed){
		$this->assessed=$assessed;
	}


	/**
	* @param int $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}


	/**
	* @param int $usermodified
	* @return void
	*/
	public function setUsermodified($usermodified){
		$this->usermodified=$usermodified;
	}


	/**
	* @param int $timestart
	* @return void
	*/
	public function setTimestart($timestart){
		$this->timestart=$timestart;
	}


	/**
	* @param int $timeend
	* @return void
	*/
	public function setTimeend($timeend){
		$this->timeend=$timeend;
	}


	/**
	* @param forumPostRecord $post
	* @return void
	*/
	public function setPost($post){
		$this->post=$post;
	}

}

?>
