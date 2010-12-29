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
	public $visible;
	/** 
	* @var integer
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
	* @param integer $id
	* @param string $name
	* @param string $description
	* @param integer $parent
	* @param integer $sortorder
	* @param integer $visible
	* @param integer $depth
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
	public function getVisible(){
		 return $this->visible;
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
	* @param integer $visible
	* @return void
	*/
	public function setVisible($visible){
		$this->visible=$visible;
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


	/**
	* @param string $theme
	* @return void
	*/
	public function setTheme($theme){
		$this->theme=$theme;
	}

}

?>
