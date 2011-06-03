<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class changeRecord {
	/** 
	* @var string
	*/
	public $author;
	/** 
	* @var int
	*/
	public $courseid;
	/** 
	* @var string
	*/
	public $date;
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
	public $instance;
	/** 
	* @var string
	*/
	public $link;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var int
	*/
	public $resid;
	/** 
	* @var int
	*/
	public $timestamp;
	/** 
	* @var string
	*/
	public $type;
	/** 
	* @var string
	*/
	public $url;
	/** 
	* @var int
	*/
	public $visible;

	/**
	* default constructor for class changeRecord
	* @param string $author
	* @param int $courseid
	* @param string $date
	* @param string $error
	* @param int $id
	* @param int $instance
	* @param string $link
	* @param string $name
	* @param int $resid
	* @param int $timestamp
	* @param string $type
	* @param string $url
	* @param int $visible
	* @return changeRecord
	*/
	 public function changeRecord($author='',$courseid=0,$date='',$error='',$id=0,$instance=0,$link='',$name='',$resid=0,$timestamp=0,$type='',$url='',$visible=0){
		 $this->author=$author   ;
		 $this->courseid=$courseid   ;
		 $this->date=$date   ;
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->instance=$instance   ;
		 $this->link=$link   ;
		 $this->name=$name   ;
		 $this->resid=$resid   ;
		 $this->timestamp=$timestamp   ;
		 $this->type=$type   ;
		 $this->url=$url   ;
		 $this->visible=$visible   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAuthor(){
		 return $this->author;
	}


	/**
	* @return int
	*/
	public function getCourseid(){
		 return $this->courseid;
	}


	/**
	* @return string
	*/
	public function getDate(){
		 return $this->date;
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
	public function getId(){
		 return $this->id;
	}


	/**
	* @return int
	*/
	public function getInstance(){
		 return $this->instance;
	}


	/**
	* @return string
	*/
	public function getLink(){
		 return $this->link;
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
	public function getResid(){
		 return $this->resid;
	}


	/**
	* @return int
	*/
	public function getTimestamp(){
		 return $this->timestamp;
	}


	/**
	* @return string
	*/
	public function getType(){
		 return $this->type;
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
	public function getVisible(){
		 return $this->visible;
	}

	/*set accessors */

	/**
	* @param string $author
	* @return void
	*/
	public function setAuthor($author){
		$this->author=$author;
	}


	/**
	* @param int $courseid
	* @return void
	*/
	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}


	/**
	* @param string $date
	* @return void
	*/
	public function setDate($date){
		$this->date=$date;
	}


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
	* @param int $instance
	* @return void
	*/
	public function setInstance($instance){
		$this->instance=$instance;
	}


	/**
	* @param string $link
	* @return void
	*/
	public function setLink($link){
		$this->link=$link;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param int $resid
	* @return void
	*/
	public function setResid($resid){
		$this->resid=$resid;
	}


	/**
	* @param int $timestamp
	* @return void
	*/
	public function setTimestamp($timestamp){
		$this->timestamp=$timestamp;
	}


	/**
	* @param string $type
	* @return void
	*/
	public function setType($type){
		$this->type=$type;
	}


	/**
	* @param string $url
	* @return void
	*/
	public function setUrl($url){
		$this->url=$url;
	}


	/**
	* @param int $visible
	* @return void
	*/
	public function setVisible($visible){
		$this->visible=$visible;
	}

}

?>
