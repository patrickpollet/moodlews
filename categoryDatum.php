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
	 public function categoryDatum() {
		 $this->action='';
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
		 $this->theme='';
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
