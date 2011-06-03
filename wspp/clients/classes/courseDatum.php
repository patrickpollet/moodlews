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
	* @var int
	*/
	public $category;
	/** 
	* @var string
	*/
	public $cost;
	/** 
	* @var int
	*/
	public $enrolperiod;
	/** 
	* @var string
	*/
	public $format;
	/** 
	* @var string
	*/
	public $fullname;
	/** 
	* @var int
	*/
	public $groupmode;
	/** 
	* @var int
	*/
	public $groupmodeforce;
	/** 
	* @var int
	*/
	public $guest;
	/** 
	* @var int
	*/
	public $hiddensections;
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
	public $lang;
	/** 
	* @var int
	*/
	public $marker;
	/** 
	* @var int
	*/
	public $maxbytes;
	/** 
	* @var int
	*/
	public $metacourse;
	/** 
	* @var int
	*/
	public $newsitems;
	/** 
	* @var string
	*/
	public $password;
	/** 
	* @var string
	*/
	public $shortname;
	/** 
	* @var int
	*/
	public $showgrades;
	/** 
	* @var int
	*/
	public $sortorder;
	/** 
	* @var int
	*/
	public $startdate;
	/** 
	* @var string
	*/
	public $student;
	/** 
	* @var string
	*/
	public $students;
	/** 
	* @var string
	*/
	public $summary;
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
	public $theme;
	/** 
	* @var int
	*/
	public $visible;

	/**
	* default constructor for class courseDatum
	* @param string $action
	* @param int $category
	* @param string $cost
	* @param int $enrolperiod
	* @param string $format
	* @param string $fullname
	* @param int $groupmode
	* @param int $groupmodeforce
	* @param int $guest
	* @param int $hiddensections
	* @param int $id
	* @param string $idnumber
	* @param string $lang
	* @param int $marker
	* @param int $maxbytes
	* @param int $metacourse
	* @param int $newsitems
	* @param string $password
	* @param string $shortname
	* @param int $showgrades
	* @param int $sortorder
	* @param int $startdate
	* @param string $student
	* @param string $students
	* @param string $summary
	* @param string $teacher
	* @param string $teachers
	* @param string $theme
	* @param int $visible
	* @return courseDatum
	*/
	 public function courseDatum($action='',$category=0,$cost='',$enrolperiod=0,$format='',$fullname='',$groupmode=0,$groupmodeforce=0,$guest=0,$hiddensections=0,$id=0,$idnumber='',$lang='',$marker=0,$maxbytes=0,$metacourse=0,$newsitems=0,$password='',$shortname='',$showgrades=0,$sortorder=0,$startdate=0,$student='',$students='',$summary='',$teacher='',$teachers='',$theme='',$visible=0){
		 $this->action=$action   ;
		 $this->category=$category   ;
		 $this->cost=$cost   ;
		 $this->enrolperiod=$enrolperiod   ;
		 $this->format=$format   ;
		 $this->fullname=$fullname   ;
		 $this->groupmode=$groupmode   ;
		 $this->groupmodeforce=$groupmodeforce   ;
		 $this->guest=$guest   ;
		 $this->hiddensections=$hiddensections   ;
		 $this->id=$id   ;
		 $this->idnumber=$idnumber   ;
		 $this->lang=$lang   ;
		 $this->marker=$marker   ;
		 $this->maxbytes=$maxbytes   ;
		 $this->metacourse=$metacourse   ;
		 $this->newsitems=$newsitems   ;
		 $this->password=$password   ;
		 $this->shortname=$shortname   ;
		 $this->showgrades=$showgrades   ;
		 $this->sortorder=$sortorder   ;
		 $this->startdate=$startdate   ;
		 $this->student=$student   ;
		 $this->students=$students   ;
		 $this->summary=$summary   ;
		 $this->teacher=$teacher   ;
		 $this->teachers=$teachers   ;
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
	public function getCategory(){
		 return $this->category;
	}


	/**
	* @return string
	*/
	public function getCost(){
		 return $this->cost;
	}


	/**
	* @return int
	*/
	public function getEnrolperiod(){
		 return $this->enrolperiod;
	}


	/**
	* @return string
	*/
	public function getFormat(){
		 return $this->format;
	}


	/**
	* @return string
	*/
	public function getFullname(){
		 return $this->fullname;
	}


	/**
	* @return int
	*/
	public function getGroupmode(){
		 return $this->groupmode;
	}


	/**
	* @return int
	*/
	public function getGroupmodeforce(){
		 return $this->groupmodeforce;
	}


	/**
	* @return int
	*/
	public function getGuest(){
		 return $this->guest;
	}


	/**
	* @return int
	*/
	public function getHiddensections(){
		 return $this->hiddensections;
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
	public function getLang(){
		 return $this->lang;
	}


	/**
	* @return int
	*/
	public function getMarker(){
		 return $this->marker;
	}


	/**
	* @return int
	*/
	public function getMaxbytes(){
		 return $this->maxbytes;
	}


	/**
	* @return int
	*/
	public function getMetacourse(){
		 return $this->metacourse;
	}


	/**
	* @return int
	*/
	public function getNewsitems(){
		 return $this->newsitems;
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
	public function getShortname(){
		 return $this->shortname;
	}


	/**
	* @return int
	*/
	public function getShowgrades(){
		 return $this->showgrades;
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
	public function getStartdate(){
		 return $this->startdate;
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
	* @return string
	*/
	public function getSummary(){
		 return $this->summary;
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
	* @param int $category
	* @return void
	*/
	public function setCategory($category){
		$this->category=$category;
	}


	/**
	* @param string $cost
	* @return void
	*/
	public function setCost($cost){
		$this->cost=$cost;
	}


	/**
	* @param int $enrolperiod
	* @return void
	*/
	public function setEnrolperiod($enrolperiod){
		$this->enrolperiod=$enrolperiod;
	}


	/**
	* @param string $format
	* @return void
	*/
	public function setFormat($format){
		$this->format=$format;
	}


	/**
	* @param string $fullname
	* @return void
	*/
	public function setFullname($fullname){
		$this->fullname=$fullname;
	}


	/**
	* @param int $groupmode
	* @return void
	*/
	public function setGroupmode($groupmode){
		$this->groupmode=$groupmode;
	}


	/**
	* @param int $groupmodeforce
	* @return void
	*/
	public function setGroupmodeforce($groupmodeforce){
		$this->groupmodeforce=$groupmodeforce;
	}


	/**
	* @param int $guest
	* @return void
	*/
	public function setGuest($guest){
		$this->guest=$guest;
	}


	/**
	* @param int $hiddensections
	* @return void
	*/
	public function setHiddensections($hiddensections){
		$this->hiddensections=$hiddensections;
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
	* @param string $lang
	* @return void
	*/
	public function setLang($lang){
		$this->lang=$lang;
	}


	/**
	* @param int $marker
	* @return void
	*/
	public function setMarker($marker){
		$this->marker=$marker;
	}


	/**
	* @param int $maxbytes
	* @return void
	*/
	public function setMaxbytes($maxbytes){
		$this->maxbytes=$maxbytes;
	}


	/**
	* @param int $metacourse
	* @return void
	*/
	public function setMetacourse($metacourse){
		$this->metacourse=$metacourse;
	}


	/**
	* @param int $newsitems
	* @return void
	*/
	public function setNewsitems($newsitems){
		$this->newsitems=$newsitems;
	}


	/**
	* @param string $password
	* @return void
	*/
	public function setPassword($password){
		$this->password=$password;
	}


	/**
	* @param string $shortname
	* @return void
	*/
	public function setShortname($shortname){
		$this->shortname=$shortname;
	}


	/**
	* @param int $showgrades
	* @return void
	*/
	public function setShowgrades($showgrades){
		$this->showgrades=$showgrades;
	}


	/**
	* @param int $sortorder
	* @return void
	*/
	public function setSortorder($sortorder){
		$this->sortorder=$sortorder;
	}


	/**
	* @param int $startdate
	* @return void
	*/
	public function setStartdate($startdate){
		$this->startdate=$startdate;
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
	* @param string $summary
	* @return void
	*/
	public function setSummary($summary){
		$this->summary=$summary;
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
