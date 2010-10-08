<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class groupingDatum {
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
	public $courseid;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $description;
	/* full constructor */
	 public function groupingDatum($action='',$id=0,$courseid=0,$name='',$description=''){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->courseid=$courseid   ;
		 $this->name=$name   ;
		 $this->description=$description   ;
	}
	/* get accessors */
	public function getAction(){
		 return $this->action;
	}

	public function getId(){
		 return $this->id;
	}

	public function getCourseid(){
		 return $this->courseid;
	}

	public function getName(){
		 return $this->name;
	}

	public function getDescription(){
		 return $this->description;
	}

	/*set accessors */
	public function setAction($action){
		$this->action=$action;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setDescription($description){
		$this->description=$description;
	}

}

?>
