<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class categoryDatum {
	/** 
	* @var  string
	*/
	public $action;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $description;
	/** 
	* @var  integer
	*/
	public $parent;
	/** 
	* @var  integer
	*/
	public $sortorder;
	/** 
	* @var  integer
	*/
	public $coursecount;
	/** 
	* @var  integer
	*/
	public $visible;
	/** 
	* @var  integer
	*/
	public $timemodified;
	/** 
	* @var  integer
	*/
	public $depth;
	/** 
	* @var  string
	*/
	public $path;
	/** 
	* @var  string
	*/
	public $theme;
	/* full constructor */
	 public function categoryDatum($action='',$id=0,$name='',$description='',$parent=0,$sortorder=0,$coursecount=0,$visible=0,$timemodified=0,$depth=0,$path='',$theme=''){
		 $this->action=$action   ;
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
		 $this->theme=$theme   ;
	}
	/* get accessors */
	public function getAction(){
		 return $this->action;
	}

	public function getId(){
		 return $this->id;
	}

	public function getName(){
		 return $this->name;
	}

	public function getDescription(){
		 return $this->description;
	}

	public function getParent(){
		 return $this->parent;
	}

	public function getSortorder(){
		 return $this->sortorder;
	}

	public function getCoursecount(){
		 return $this->coursecount;
	}

	public function getVisible(){
		 return $this->visible;
	}

	public function getTimemodified(){
		 return $this->timemodified;
	}

	public function getDepth(){
		 return $this->depth;
	}

	public function getPath(){
		 return $this->path;
	}

	public function getTheme(){
		 return $this->theme;
	}

	/*set accessors */
	public function setAction($action){
		$this->action=$action;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setDescription($description){
		$this->description=$description;
	}

	public function setParent($parent){
		$this->parent=$parent;
	}

	public function setSortorder($sortorder){
		$this->sortorder=$sortorder;
	}

	public function setCoursecount($coursecount){
		$this->coursecount=$coursecount;
	}

	public function setVisible($visible){
		$this->visible=$visible;
	}

	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

	public function setDepth($depth){
		$this->depth=$depth;
	}

	public function setPath($path){
		$this->path=$path;
	}

	public function setTheme($theme){
		$this->theme=$theme;
	}

}

?>
