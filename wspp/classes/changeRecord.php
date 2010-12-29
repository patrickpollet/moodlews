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
	* @return changeRecord
	*/	 public function changeRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->courseid=0;
		 $this->instance=0;
		 $this->resid=0;
		 $this->name='';
		 $this->date='';
		 $this->timestamp=0;
		 $this->type='';
		 $this->author='';
		 $this->link='';
		 $this->url='';
		 $this->visible=0;
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
