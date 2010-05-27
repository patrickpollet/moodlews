<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class groupDatum {
	/** 
	* @var  string
	*/
	public $action;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  integer
	*/
	public $courseid;
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $description;
	/** 
	* @var  string
	*/
	public $enrolmentkey;
	/** 
	* @var  integer
	*/
	public $picture;
	/** 
	* @var  integer
	*/
	public $hidepicture;
	/* full constructor */
	 public function groupDatum($action='',$id=0,$courseid=0,$name='',$description='',$enrolmentkey='',$picture=0,$hidepicture=0){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->courseid=$courseid   ;
		 $this->name=$name   ;
		 $this->description=$description   ;
		 $this->enrolmentkey=$enrolmentkey   ;
		 $this->picture=$picture   ;
		 $this->hidepicture=$hidepicture   ;
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

	public function getEnrolmentkey(){
		 return $this->enrolmentkey;
	}

	public function getPicture(){
		 return $this->picture;
	}

	public function getHidepicture(){
		 return $this->hidepicture;
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

	public function setEnrolmentkey($enrolmentkey){
		$this->enrolmentkey=$enrolmentkey;
	}

	public function setPicture($picture){
		$this->picture=$picture;
	}

	public function setHidepicture($hidepicture){
		$this->hidepicture=$hidepicture;
	}

}

?>
