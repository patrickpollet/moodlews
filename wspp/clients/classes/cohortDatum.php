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
	public $categoryid;
	/** 
	* @var string
	*/
	public $component;
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
	public $idnumber;
	/** 
	* @var string
	*/
	public $name;

	/**
	* default constructor for class cohortDatum
	* @param string $action
	* @param int $categoryid
	* @param string $component
	* @param string $description
	* @param int $id
	* @param string $idnumber
	* @param string $name
	* @return cohortDatum
	*/
	 public function cohortDatum($action='',$categoryid=0,$component='',$description='',$id=0,$idnumber='',$name=''){
		 $this->action=$action   ;
		 $this->categoryid=$categoryid   ;
		 $this->component=$component   ;
		 $this->description=$description   ;
		 $this->id=$id   ;
		 $this->idnumber=$idnumber   ;
		 $this->name=$name   ;
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
	public function getCategoryid(){
		 return $this->categoryid;
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
	public function getIdnumber(){
		 return $this->idnumber;
	}


	/**
	* @return string
	*/
	public function getName(){
		 return $this->name;
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
	* @param int $categoryid
	* @return void
	*/
	public function setCategoryid($categoryid){
		$this->categoryid=$categoryid;
	}


	/**
	* @param string $component
	* @return void
	*/
	public function setComponent($component){
		$this->component=$component;
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
	* @param string $idnumber
	* @return void
	*/
	public function setIdnumber($idnumber){
		$this->idnumber=$idnumber;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}

}

?>
