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
	public $id;
	/** 
	* @var int
	*/
	public $category;
	/** 
	* @var int
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
	* @var int
	*/
	public $showgrades;
	/** 
	* @var int
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
	* @var int
	*/
	public $guest;
	/** 
	* @var int
	*/
	public $startdate;
	/** 
	* @var int
	*/
	public $enrolperiod;
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
	public $visible;
	/** 
	* @var int
	*/
	public $hiddensections;
	/** 
	* @var int
	*/
	public $groupmode;
	/** 
	* @var int
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
	* @var int
	*/
	public $metacourse;

	/**
	* default constructor for class courseDatum
	* @param string $action
	* @param int $id
	* @param int $category
	* @param int $sortorder
	* @param string $password
	* @param string $fullname
	* @param string $shortname
	* @param string $idnumber
	* @param string $summary
	* @param string $format
	* @param int $showgrades
	* @param int $newsitems
	* @param string $teacher
	* @param string $teachers
	* @param string $student
	* @param string $students
	* @param int $guest
	* @param int $startdate
	* @param int $enrolperiod
	* @param int $marker
	* @param int $maxbytes
	* @param int $visible
	* @param int $hiddensections
	* @param int $groupmode
	* @param int $groupmodeforce
	* @param string $lang
	* @param string $theme
	* @param string $cost
	* @param int $metacourse
	* @return courseDatum
	*/
	 public function courseDatum($action='',$id=0,$category=0,$sortorder=0,$password='',$fullname='',$shortname='',$idnumber='',$summary='',$format='',$showgrades=0,$newsitems=0,$teacher='',$teachers='',$student='',$students='',$guest=0,$startdate=0,$enrolperiod=0,$marker=0,$maxbytes=0,$visible=0,$hiddensections=0,$groupmode=0,$groupmodeforce=0,$lang='',$theme='',$cost='',$metacourse=0){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->category=$category   ;
		 $this->sortorder=$sortorder   ;
		 $this->password=$password   ;
		 $this->fullname=$fullname   ;
		 $this->shortname=$shortname   ;
		 $this->idnumber=$idnumber   ;
		 $this->summary=$summary   ;
		 $this->format=$format   ;
		 $this->showgrades=$showgrades   ;
		 $this->newsitems=$newsitems   ;
		 $this->teacher=$teacher   ;
		 $this->teachers=$teachers   ;
		 $this->student=$student   ;
		 $this->students=$students   ;
		 $this->guest=$guest   ;
		 $this->startdate=$startdate   ;
		 $this->enrolperiod=$enrolperiod   ;
		 $this->marker=$marker   ;
		 $this->maxbytes=$maxbytes   ;
		 $this->visible=$visible   ;
		 $this->hiddensections=$hiddensections   ;
		 $this->groupmode=$groupmode   ;
		 $this->groupmodeforce=$groupmodeforce   ;
		 $this->lang=$lang   ;
		 $this->theme=$theme   ;
		 $this->cost=$cost   ;
		 $this->metacourse=$metacourse   ;
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
	public function getCategory(){
		 return $this->category;
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
	* @return int
	*/
	public function getShowgrades(){
		 return $this->showgrades;
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
	* @return int
	*/
	public function getGuest(){
		 return $this->guest;
	}


	/**
	* @return int
	*/
	public function getStartdate(){
		 return $this->startdate;
	}


	/**
	* @return int
	*/
	public function getEnrolperiod(){
		 return $this->enrolperiod;
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
	public function getVisible(){
		 return $this->visible;
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
	* @return int
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
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param int $category
	* @return void
	*/
	public function setCategory($category){
		$this->category=$category;
	}


	/**
	* @param int $sortorder
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
	* @param int $showgrades
	* @return void
	*/
	public function setShowgrades($showgrades){
		$this->showgrades=$showgrades;
	}


	/**
	* @param int $newsitems
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
	* @param int $guest
	* @return void
	*/
	public function setGuest($guest){
		$this->guest=$guest;
	}


	/**
	* @param int $startdate
	* @return void
	*/
	public function setStartdate($startdate){
		$this->startdate=$startdate;
	}


	/**
	* @param int $enrolperiod
	* @return void
	*/
	public function setEnrolperiod($enrolperiod){
		$this->enrolperiod=$enrolperiod;
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
	* @param int $visible
	* @return void
	*/
	public function setVisible($visible){
		$this->visible=$visible;
	}


	/**
	* @param int $hiddensections
	* @return void
	*/
	public function setHiddensections($hiddensections){
		$this->hiddensections=$hiddensections;
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
	* @param int $metacourse
	* @return void
	*/
	public function setMetacourse($metacourse){
		$this->metacourse=$metacourse;
	}

}

?>
