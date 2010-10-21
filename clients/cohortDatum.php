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
	* @var integer
	*/
	public $id;
	/** 
	* @var integer
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
	/* full constructor */
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
	public function getAction(){
		 return $this->action;
	}

	public function getId(){
		 return $this->id;
	}

	public function getCategoryid(){
		 return $this->categoryid;
	}

	public function getName(){
		 return $this->name;
	}

	public function getDescription(){
		 return $this->description;
	}

	public function getComponent(){
		 return $this->component;
	}

	public function getIdnumber(){
		 return $this->idnumber;
	}

	/*set accessors */
	public function setAction($action){
		$this->action=$action;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setCategoryid($categoryid){
		$this->categoryid=$categoryid;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setDescription($description){
		$this->description=$description;
	}

	public function setComponent($component){
		$this->component=$component;
	}

	public function setIdnumber($idnumber){
		$this->idnumber=$idnumber;
	}

}

?>
