<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class cohortDatum {
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $categoryid;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var string
	*/
	public $component;
	/** 
	* @var string
	*/
	public $idnumber;

	/**
	* default constructor for class cohortDatum
	* @param string $action
	* @param int $id
	* @param int $categoryid
	* @param string $name
	* @param string $description
	* @param string $component
	* @param string $idnumber
	* @return cohortDatum
	*/
	 public function cohortDatum($action='',$id=0,$categoryid=0,$name='',$description='',$component='',$idnumber=''){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->categoryid=$categoryid   ;
		 $this->name=$name   ;
		 $this->description=$description   ;
		 $this->component=$component   ;
		 $this->idnumber=$idnumber   ;
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
	* @return int
	*/
	public function getCategoryid(){
		 return $this->categoryid;
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
	* @return string
	*/
	public function getComponent(){
		 return $this->component;
	}


	/**
	* @return string
	*/
	public function getIdnumber(){
		 return $this->idnumber;
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
	* @param int $categoryid
	* @return void
	*/
	public function setCategoryid($categoryid){
		$this->categoryid=$categoryid;
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
	* @param string $component
	* @return void
	*/
	public function setComponent($component){
		$this->component=$component;
	}


	/**
	* @param string $idnumber
	* @return void
	*/
	public function setIdnumber($idnumber){
		$this->idnumber=$idnumber;
	}

}

?>
