<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class categoryRecord {
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var integer
	*/
	public $id;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var integer
	*/
	public $parent;
	/** 
	* @var integer
	*/
	public $sortorder;
	/** 
	* @var integer
	*/
	public $coursecount;
	/** 
	* @var integer
	*/
	public $visible;
	/** 
	* @var integer
	*/
	public $timemodified;
	/** 
	* @var integer
	*/
	public $depth;
	/** 
	* @var string
	*/
	public $path;

	/**
	* default constructor for class categoryRecord
	* @return categoryRecord
	*/	 public function categoryRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->name='';
		 $this->description='';
		 $this->parent=0;
		 $this->sortorder=0;
		 $this->coursecount=0;
		 $this->visible=0;
		 $this->timemodified=0;
		 $this->depth=0;
		 $this->path='';
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
	* @return string
	*/
	public function getName(){
		 return $this->name;
	}


	/**
	* @return string
	*/
	public function getDescription(){
		 return $this->description;
	}


	/**
	* @return integer
	*/
	public function getParent(){
		 return $this->parent;
	}


	/**
	* @return integer
	*/
	public function getSortorder(){
		 return $this->sortorder;
	}


	/**
	* @return integer
	*/
	public function getCoursecount(){
		 return $this->coursecount;
	}


	/**
	* @return integer
	*/
	public function getVisible(){
		 return $this->visible;
	}


	/**
	* @return integer
	*/
	public function getTimemodified(){
		 return $this->timemodified;
	}


	/**
	* @return integer
	*/
	public function getDepth(){
		 return $this->depth;
	}


	/**
	* @return string
	*/
	public function getPath(){
		 return $this->path;
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
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
	}


	/**
	* @param integer $parent
	* @return void
	*/
	public function setParent($parent){
		$this->parent=$parent;
	}


	/**
	* @param integer $sortorder
	* @return void
	*/
	public function setSortorder($sortorder){
		$this->sortorder=$sortorder;
	}


	/**
	* @param integer $coursecount
	* @return void
	*/
	public function setCoursecount($coursecount){
		$this->coursecount=$coursecount;
	}


	/**
	* @param integer $visible
	* @return void
	*/
	public function setVisible($visible){
		$this->visible=$visible;
	}


	/**
	* @param integer $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}


	/**
	* @param integer $depth
	* @return void
	*/
	public function setDepth($depth){
		$this->depth=$depth;
	}


	/**
	* @param string $path
	* @return void
	*/
	public function setPath($path){
		$this->path=$path;
	}

}

?>
