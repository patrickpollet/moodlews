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
	public $error;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $courseid;
	/** 
	* @var int
	*/
	public $instance;
	/** 
	* @var int
	*/
	public $resid;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $date;
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
	public $author;
	/** 
	* @var string
	*/
	public $link;
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
	* @param string $error
	* @param int $id
	* @param int $courseid
	* @param int $instance
	* @param int $resid
	* @param string $name
	* @param string $date
	* @param int $timestamp
	* @param string $type
	* @param string $author
	* @param string $link
	* @param string $url
	* @param int $visible
	* @return changeRecord
	*/
	 public function changeRecord($error='',$id=0,$courseid=0,$instance=0,$resid=0,$name='',$date='',$timestamp=0,$type='',$author='',$link='',$url='',$visible=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->courseid=$courseid   ;
		 $this->instance=$instance   ;
		 $this->resid=$resid   ;
		 $this->name=$name   ;
		 $this->date=$date   ;
		 $this->timestamp=$timestamp   ;
		 $this->type=$type   ;
		 $this->author=$author   ;
		 $this->link=$link   ;
		 $this->url=$url   ;
		 $this->visible=$visible   ;
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
	public function getCourseid(){
		 return $this->courseid;
	}


	/**
	* @return int
	*/
	public function getInstance(){
		 return $this->instance;
	}


	/**
	* @return int
	*/
	public function getResid(){
		 return $this->resid;
	}


	/**
	* @return string
	*/
	public function getName(){
		 return $this->name;
	}


	/**
	* @return string
	*/
	public function getDate(){
		 return $this->date;
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
	public function getAuthor(){
		 return $this->author;
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
	* @param int $courseid
	* @return void
	*/
	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}


	/**
	* @param int $instance
	* @return void
	*/
	public function setInstance($instance){
		$this->instance=$instance;
	}


	/**
	* @param int $resid
	* @return void
	*/
	public function setResid($resid){
		$this->resid=$resid;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $date
	* @return void
	*/
	public function setDate($date){
		$this->date=$date;
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
	* @param string $author
	* @return void
	*/
	public function setAuthor($author){
		$this->author=$author;
	}


	/**
	* @param string $link
	* @return void
	*/
	public function setLink($link){
		$this->link=$link;
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
