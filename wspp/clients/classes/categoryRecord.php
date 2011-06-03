<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class categoryRecord {
	/** 
	* @var int
	*/
	public $coursecount;
	/** 
	* @var int
	*/
	public $depth;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var int
	*/
	public $parent;
	/** 
	* @var string
	*/
	public $path;
	/** 
	* @var int
	*/
	public $sortorder;
	/** 
	* @var int
	*/
	public $timemodified;
	/** 
	* @var int
	*/
	public $visible;

	/**
	* default constructor for class categoryRecord
	* @param int $coursecount
	* @param int $depth
	* @param string $description
	* @param string $error
	* @param int $id
	* @param string $name
	* @param int $parent
	* @param string $path
	* @param int $sortorder
	* @param int $timemodified
	* @param int $visible
	* @return categoryRecord
	*/
	 public function categoryRecord($coursecount=0,$depth=0,$description='',$error='',$id=0,$name='',$parent=0,$path='',$sortorder=0,$timemodified=0,$visible=0){
		 $this->coursecount=$coursecount   ;
		 $this->depth=$depth   ;
		 $this->description=$description   ;
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->parent=$parent   ;
		 $this->path=$path   ;
		 $this->sortorder=$sortorder   ;
		 $this->timemodified=$timemodified   ;
		 $this->visible=$visible   ;
	}
	/* get accessors */

	/**
	* @return int
	*/
	public function getCoursecount(){
		 return $this->coursecount;
	}


	/**
	* @return int
	*/
	public function getDepth(){
		 return $this->depth;
	}


	/**
	* @return string
	*/
	public function getDescription(){
		 return $this->description;
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
	* @return string
	*/
	public function getName(){
		 return $this->name;
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
	public function getPath(){
		 return $this->path;
	}


	/**
	* @return int
	*/
	public function getSortorder(){
		 return $this->sortorder;
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
	public function getVisible(){
		 return $this->visible;
	}

	/*set accessors */

	/**
	* @param int $coursecount
	* @return void
	*/
	public function setCoursecount($coursecount){
		$this->coursecount=$coursecount;
	}


	/**
	* @param int $depth
	* @return void
	*/
	public function setDepth($depth){
		$this->depth=$depth;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
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
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param int $parent
	* @return void
	*/
	public function setParent($parent){
		$this->parent=$parent;
	}


	/**
	* @param string $path
	* @return void
	*/
	public function setPath($path){
		$this->path=$path;
	}


	/**
	* @param int $sortorder
	* @return void
	*/
	public function setSortorder($sortorder){
		$this->sortorder=$sortorder;
	}


	/**
	* @param int $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
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
