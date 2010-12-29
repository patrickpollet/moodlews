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
	* @param string $error
	* @param integer $id
	* @param string $name
	* @param string $description
	* @param integer $parent
	* @param integer $sortorder
	* @param integer $coursecount
	* @param integer $visible
	* @param integer $timemodified
	* @param integer $depth
	* @param string $path
	* @return categoryRecord
	*/
	 public function categoryRecord($error='',$id=0,$name='',$description='',$parent=0,$sortorder=0,$coursecount=0,$visible=0,$timemodified=0,$depth=0,$path=''){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->description=$description   ;
		 $this->parent=$parent   ;
		 $this->sortorder=$sortorder   ;
		 $this->coursecount=$coursecount   ;
		 $this->visible=$visible   ;
		 $this->timemodified=$timemodified   ;
		 $this->depth=$depth   ;
		 $this->path=$path   ;
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
