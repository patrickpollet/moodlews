<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class courseDatum {
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
	public $category;
	/** 
	* @var integer
	*/
	public $sortorder;
	/** 
	* @var string
	*/
	public $password;
	/** 
	* @var string
	*/
	public $fullname;
	/** 
	* @var string
	*/
	public $shortname;
	/** 
	* @var string
	*/
	public $idnumber;
	/** 
	* @var string
	*/
	public $summary;
	/** 
	* @var string
	*/
	public $format;
	/** 
	* @var integer
	*/
	public $showgrades;
	/** 
	* @var integer
	*/
	public $newsitems;
	/** 
	* @var string
	*/
	public $teacher;
	/** 
	* @var string
	*/
	public $teachers;
	/** 
	* @var string
	*/
	public $student;
	/** 
	* @var string
	*/
	public $students;
	/** 
	* @var integer
	*/
	public $guest;
	/** 
	* @var integer
	*/
	public $startdate;
	/** 
	* @var integer
	*/
	public $enrolperiod;
	/** 
	* @var integer
	*/
	public $marker;
	/** 
	* @var integer
	*/
	public $maxbytes;
	/** 
	* @var integer
	*/
	public $visible;
	/** 
	* @var integer
	*/
	public $hiddensections;
	/** 
	* @var integer
	*/
	public $groupmode;
	/** 
	* @var integer
	*/
	public $groupmodeforce;
	/** 
	* @var string
	*/
	public $lang;
	/** 
	* @var string
	*/
	public $theme;
	/** 
	* @var string
	*/
	public $cost;
	/** 
	* @var integer
	*/
	public $metacourse;

	/**
	* default constructor for class courseDatum
	* @return courseDatum
	*/	 public function courseDatum() {
		 $this->action='';
		 $this->id=0;
		 $this->category=0;
		 $this->sortorder=0;
		 $this->password='';
		 $this->fullname='';
		 $this->shortname='';
		 $this->idnumber='';
		 $this->summary='';
		 $this->format='';
		 $this->showgrades=0;
		 $this->newsitems=0;
		 $this->teacher='';
		 $this->teachers='';
		 $this->student='';
		 $this->students='';
		 $this->guest=0;
		 $this->startdate=0;
		 $this->enrolperiod=0;
		 $this->marker=0;
		 $this->maxbytes=0;
		 $this->visible=0;
		 $this->hiddensections=0;
		 $this->groupmode=0;
		 $this->groupmodeforce=0;
		 $this->lang='';
		 $this->theme='';
		 $this->cost='';
		 $this->metacourse=0;
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
	* @return integer
	*/
	public function getCategory(){
		 return $this->category;
	}


	/**
	* @return integer
	*/
	public function getSortorder(){
		 return $this->sortorder;
	}


	/**
	* @return string
	*/
	public function getPassword(){
		 return $this->password;
	}


	/**
	* @return string
	*/
	public function getFullname(){
		 return $this->fullname;
	}


	/**
	* @return string
	*/
	public function getShortname(){
		 return $this->shortname;
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
	public function getSummary(){
		 return $this->summary;
	}


	/**
	* @return string
	*/
	public function getFormat(){
		 return $this->format;
	}


	/**
	* @return integer
	*/
	public function getShowgrades(){
		 return $this->showgrades;
	}


	/**
	* @return integer
	*/
	public function getNewsitems(){
		 return $this->newsitems;
	}


	/**
	* @return string
	*/
	public function getTeacher(){
		 return $this->teacher;
	}


	/**
	* @return string
	*/
	public function getTeachers(){
		 return $this->teachers;
	}


	/**
	* @return string
	*/
	public function getStudent(){
		 return $this->student;
	}


	/**
	* @return string
	*/
	public function getStudents(){
		 return $this->students;
	}


	/**
	* @return integer
	*/
	public function getGuest(){
		 return $this->guest;
	}


	/**
	* @return integer
	*/
	public function getStartdate(){
		 return $this->startdate;
	}


	/**
	* @return integer
	*/
	public function getEnrolperiod(){
		 return $this->enrolperiod;
	}


	/**
	* @return integer
	*/
	public function getMarker(){
		 return $this->marker;
	}


	/**
	* @return integer
	*/
	public function getMaxbytes(){
		 return $this->maxbytes;
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
	public function getHiddensections(){
		 return $this->hiddensections;
	}


	/**
	* @return integer
	*/
	public function getGroupmode(){
		 return $this->groupmode;
	}


	/**
	* @return integer
	*/
	public function getGroupmodeforce(){
		 return $this->groupmodeforce;
	}


	/**
	* @return string
	*/
	public function getLang(){
		 return $this->lang;
	}


	/**
	* @return string
	*/
	public function getTheme(){
		 return $this->theme;
	}


	/**
	* @return string
	*/
	public function getCost(){
		 return $this->cost;
	}


	/**
	* @return integer
	*/
	public function getMetacourse(){
		 return $this->metacourse;
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
	* @param integer $category
	* @return void
	*/
	public function setCategory($category){
		$this->category=$category;
	}


	/**
	* @param integer $sortorder
	* @return void
	*/
	public function setSortorder($sortorder){
		$this->sortorder=$sortorder;
	}


	/**
	* @param string $password
	* @return void
	*/
	public function setPassword($password){
		$this->password=$password;
	}


	/**
	* @param string $fullname
	* @return void
	*/
	public function setFullname($fullname){
		$this->fullname=$fullname;
	}


	/**
	* @param string $shortname
	* @return void
	*/
	public function setShortname($shortname){
		$this->shortname=$shortname;
	}


	/**
	* @param string $idnumber
	* @return void
	*/
	public function setIdnumber($idnumber){
		$this->idnumber=$idnumber;
	}


	/**
	* @param string $summary
	* @return void
	*/
	public function setSummary($summary){
		$this->summary=$summary;
	}


	/**
	* @param string $format
	* @return void
	*/
	public function setFormat($format){
		$this->format=$format;
	}


	/**
	* @param integer $showgrades
	* @return void
	*/
	public function setShowgrades($showgrades){
		$this->showgrades=$showgrades;
	}


	/**
	* @param integer $newsitems
	* @return void
	*/
	public function setNewsitems($newsitems){
		$this->newsitems=$newsitems;
	}


	/**
	* @param string $teacher
	* @return void
	*/
	public function setTeacher($teacher){
		$this->teacher=$teacher;
	}


	/**
	* @param string $teachers
	* @return void
	*/
	public function setTeachers($teachers){
		$this->teachers=$teachers;
	}


	/**
	* @param string $student
	* @return void
	*/
	public function setStudent($student){
		$this->student=$student;
	}


	/**
	* @param string $students
	* @return void
	*/
	public function setStudents($students){
		$this->students=$students;
	}


	/**
	* @param integer $guest
	* @return void
	*/
	public function setGuest($guest){
		$this->guest=$guest;
	}


	/**
	* @param integer $startdate
	* @return void
	*/
	public function setStartdate($startdate){
		$this->startdate=$startdate;
	}


	/**
	* @param integer $enrolperiod
	* @return void
	*/
	public function setEnrolperiod($enrolperiod){
		$this->enrolperiod=$enrolperiod;
	}


	/**
	* @param integer $marker
	* @return void
	*/
	public function setMarker($marker){
		$this->marker=$marker;
	}


	/**
	* @param integer $maxbytes
	* @return void
	*/
	public function setMaxbytes($maxbytes){
		$this->maxbytes=$maxbytes;
	}


	/**
	* @param integer $visible
	* @return void
	*/
	public function setVisible($visible){
		$this->visible=$visible;
	}


	/**
	* @param integer $hiddensections
	* @return void
	*/
	public function setHiddensections($hiddensections){
		$this->hiddensections=$hiddensections;
	}


	/**
	* @param integer $groupmode
	* @return void
	*/
	public function setGroupmode($groupmode){
		$this->groupmode=$groupmode;
	}


	/**
	* @param integer $groupmodeforce
	* @return void
	*/
	public function setGroupmodeforce($groupmodeforce){
		$this->groupmodeforce=$groupmodeforce;
	}


	/**
	* @param string $lang
	* @return void
	*/
	public function setLang($lang){
		$this->lang=$lang;
	}


	/**
	* @param string $theme
	* @return void
	*/
	public function setTheme($theme){
		$this->theme=$theme;
	}


	/**
	* @param string $cost
	* @return void
	*/
	public function setCost($cost){
		$this->cost=$cost;
	}


	/**
	* @param integer $metacourse
	* @return void
	*/
	public function setMetacourse($metacourse){
		$this->metacourse=$metacourse;
	}

}

?>
