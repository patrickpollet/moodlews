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
	public $depth;
	/** 
	* @var string
	*/
	public $description;
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
	* @var string
	*/
	public $theme;
	/** 
	* @var int
	*/
	public $visible;

	/**
	* default constructor for class categoryDatum
	* @param string $action
	* @param int $depth
	* @param string $description
	* @param int $id
	* @param string $name
	* @param int $parent
	* @param string $path
	* @param int $sortorder
	* @param string $theme
	* @param int $visible
	* @return categoryDatum
	*/
	 public function categoryDatum($action='',$depth=0,$description='',$id=0,$name='',$parent=0,$path='',$sortorder=0,$theme='',$visible=0){
		 $this->action=$action   ;
		 $this->depth=$depth   ;
		 $this->description=$description   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->parent=$parent   ;
		 $this->path=$path   ;
		 $this->sortorder=$sortorder   ;
		 $this->theme=$theme   ;
		 $this->visible=$visible   ;
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
	* @return string
	*/
	public function getTheme(){
		 return $this->theme;
	}


	/**
	* @return int
	*/
	public function getVisible(){
		 return $this->visible;
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
	* @param string $theme
	* @return void
	*/
	public function setTheme($theme){
		$this->theme=$theme;
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
