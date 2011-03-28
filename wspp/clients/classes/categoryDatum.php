<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class categoryDatum {
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var int
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
	* @var int
	*/
	public $parent;
	/** 
	* @var int
	*/
	public $sortorder;
	/** 
	* @var int
	*/
	public $visible;
	/** 
	* @var int
	*/
	public $depth;
	/** 
	* @var string
	*/
	public $path;
	/** 
	* @var string
	*/
	public $theme;

	/**
	* default constructor for class categoryDatum
	* @param string $action
	* @param int $id
	* @param string $name
	* @param string $description
	* @param int $parent
	* @param int $sortorder
	* @param int $visible
	* @param int $depth
	* @param string $path
	* @param string $theme
	* @return categoryDatum
	*/
	 public function categoryDatum($action='',$id=0,$name='',$description='',$parent=0,$sortorder=0,$visible=0,$depth=0,$path='',$theme=''){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->description=$description   ;
		 $this->parent=$parent   ;
		 $this->sortorder=$sortorder   ;
		 $this->visible=$visible   ;
		 $this->depth=$depth   ;
		 $this->path=$path   ;
		 $this->theme=$theme   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAction(){
		 return $this->action;
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
	* @return string
	*/
	public function getDescription(){
		 return $this->description;
	}


	/**
	* @return int
	*/
	public function getParent(){
		 return $this->parent;
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
	public function getVisible(){
		 return $this->visible;
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
	public function getPath(){
		 return $this->path;
	}


	/**
	* @return string
	*/
	public function getTheme(){
		 return $this->theme;
	}

	/*set accessors */

	/**
	* @param string $action
	* @return void
	*/
	public function setAction($action){
		$this->action=$action;
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
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
	}


	/**
	* @param int $parent
	* @return void
	*/
	public function setParent($parent){
		$this->parent=$parent;
	}


	/**
	* @param int $sortorder
	* @return void
	*/
	public function setSortorder($sortorder){
		$this->sortorder=$sortorder;
	}


	/**
	* @param int $visible
	* @return void
	*/
	public function setVisible($visible){
		$this->visible=$visible;
	}


	/**
	* @param int $depth
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


	/**
	* @param string $theme
	* @return void
	*/
	public function setTheme($theme){
		$this->theme=$theme;
	}

}

?>
