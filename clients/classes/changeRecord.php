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
	* @var integer
	*/
	public $id;
	/** 
	* @var integer
	*/
	public $courseid;
	/** 
	* @var integer
	*/
	public $instance;
	/** 
	* @var integer
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
	* @var integer
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
	* @var integer
	*/
	public $visible;

	/**
	* default constructor for class changeRecord
	* @param string $error
	* @param integer $id
	* @param integer $courseid
	* @param integer $instance
	* @param integer $resid
	* @param string $name
	* @param string $date
	* @param integer $timestamp
	* @param string $type
	* @param string $author
	* @param string $link
	* @param string $url
	* @param integer $visible
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
	* @return integer
	*/
	public function getId(){
		 return $this->id;
	}


	/**
	* @return integer
	*/
	public function getCourseid(){
		 return $this->courseid;
	}


	/**
	* @return integer
	*/
	public function getInstance(){
		 return $this->instance;
	}


	/**
	* @return integer
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
	* @return integer
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
	* @return integer
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
	* @param integer $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param integer $courseid
	* @return void
	*/
	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}


	/**
	* @param integer $instance
	* @return void
	*/
	public function setInstance($instance){
		$this->instance=$instance;
	}


	/**
	* @param integer $resid
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
	* @param integer $timestamp
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
	* @param integer $visible
	* @return void
	*/
	public function setVisible($visible){
		$this->visible=$visible;
	}

}

?>
