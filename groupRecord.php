<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class groupRecord {
	/** 
	* @var  string
	*/
	public $error;
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
	/** 
	* @var  integer
	*/
	public $timecreated;
	/** 
	* @var  integer
	*/
	public $timemodified;
	 public function groupRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->courseid=0;
		 $this->name='';
		 $this->description='';
		 $this->enrolmentkey='';
		 $this->picture=0;
		 $this->hidepicture=0;
		 $this->timecreated=0;
		 $this->timemodified=0;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
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

	public function getTimecreated(){
		 return $this->timecreated;
	}

	public function getTimemodified(){
		 return $this->timemodified;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
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

	public function setTimecreated($timecreated){
		$this->timecreated=$timecreated;
	}

	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

}

?>
