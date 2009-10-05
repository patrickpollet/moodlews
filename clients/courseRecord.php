<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class courseRecord {
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
	public $category;
	/** 
	* @var  integer
	*/
	public $sortorder;
	/** 
	* @var  string
	*/
	public $password;
	/** 
	* @var  string
	*/
	public $fullname;
	/** 
	* @var  string
	*/
	public $shortname;
	/** 
	* @var  string
	*/
	public $idnumber;
	/** 
	* @var  string
	*/
	public $summary;
	/** 
	* @var  string
	*/
	public $format;
	/** 
	* @var  integer
	*/
	public $showgrades;
	/** 
	* @var  integer
	*/
	public $newsitems;
	/** 
	* @var  string
	*/
	public $teacher;
	/** 
	* @var  string
	*/
	public $teachers;
	/** 
	* @var  string
	*/
	public $student;
	/** 
	* @var  string
	*/
	public $students;
	/** 
	* @var  integer
	*/
	public $guest;
	/** 
	* @var  integer
	*/
	public $startdate;
	/** 
	* @var  integer
	*/
	public $enrolperiod;
	/** 
	* @var  integer
	*/
	public $numsections;
	/** 
	* @var  integer
	*/
	public $marker;
	/** 
	* @var  integer
	*/
	public $maxbytes;
	/** 
	* @var  integer
	*/
	public $visible;
	/** 
	* @var  integer
	*/
	public $hiddensections;
	/** 
	* @var  integer
	*/
	public $groupmode;
	/** 
	* @var  integer
	*/
	public $groupmodeforce;
	/** 
	* @var  string
	*/
	public $lang;
	/** 
	* @var  string
	*/
	public $theme;
	/** 
	* @var  string
	*/
	public $cost;
	/** 
	* @var  integer
	*/
	public $timecreated;
	/** 
	* @var  integer
	*/
	public $timemodified;
	/** 
	* @var  integer
	*/
	public $metacourse;
	/** 
	* @var  integer
	*/
	public $myrole;
	/* full constructor */
	 public function courseRecord($error='',$id=0,$category=0,$sortorder=0,$password='',$fullname='',$shortname='',$idnumber='',$summary='',$format='',$showgrades=0,$newsitems=0,$teacher='',$teachers='',$student='',$students='',$guest=0,$startdate=0,$enrolperiod=0,$numsections=0,$marker=0,$maxbytes=0,$visible=0,$hiddensections=0,$groupmode=0,$groupmodeforce=0,$lang='',$theme='',$cost='',$timecreated=0,$timemodified=0,$metacourse=0,$myrole=0){
		 $this->error=$error   ;
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
		 $this->numsections=$numsections   ;
		 $this->marker=$marker   ;
		 $this->maxbytes=$maxbytes   ;
		 $this->visible=$visible   ;
		 $this->hiddensections=$hiddensections   ;
		 $this->groupmode=$groupmode   ;
		 $this->groupmodeforce=$groupmodeforce   ;
		 $this->lang=$lang   ;
		 $this->theme=$theme   ;
		 $this->cost=$cost   ;
		 $this->timecreated=$timecreated   ;
		 $this->timemodified=$timemodified   ;
		 $this->metacourse=$metacourse   ;
		 $this->myrole=$myrole   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getCategory(){
		 return $this->category;
	}

	public function getSortorder(){
		 return $this->sortorder;
	}

	public function getPassword(){
		 return $this->password;
	}

	public function getFullname(){
		 return $this->fullname;
	}

	public function getShortname(){
		 return $this->shortname;
	}

	public function getIdnumber(){
		 return $this->idnumber;
	}

	public function getSummary(){
		 return $this->summary;
	}

	public function getFormat(){
		 return $this->format;
	}

	public function getShowgrades(){
		 return $this->showgrades;
	}

	public function getNewsitems(){
		 return $this->newsitems;
	}

	public function getTeacher(){
		 return $this->teacher;
	}

	public function getTeachers(){
		 return $this->teachers;
	}

	public function getStudent(){
		 return $this->student;
	}

	public function getStudents(){
		 return $this->students;
	}

	public function getGuest(){
		 return $this->guest;
	}

	public function getStartdate(){
		 return $this->startdate;
	}

	public function getEnrolperiod(){
		 return $this->enrolperiod;
	}

	public function getNumsections(){
		 return $this->numsections;
	}

	public function getMarker(){
		 return $this->marker;
	}

	public function getMaxbytes(){
		 return $this->maxbytes;
	}

	public function getVisible(){
		 return $this->visible;
	}

	public function getHiddensections(){
		 return $this->hiddensections;
	}

	public function getGroupmode(){
		 return $this->groupmode;
	}

	public function getGroupmodeforce(){
		 return $this->groupmodeforce;
	}

	public function getLang(){
		 return $this->lang;
	}

	public function getTheme(){
		 return $this->theme;
	}

	public function getCost(){
		 return $this->cost;
	}

	public function getTimecreated(){
		 return $this->timecreated;
	}

	public function getTimemodified(){
		 return $this->timemodified;
	}

	public function getMetacourse(){
		 return $this->metacourse;
	}

	public function getMyrole(){
		 return $this->myrole;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setCategory($category){
		$this->category=$category;
	}

	public function setSortorder($sortorder){
		$this->sortorder=$sortorder;
	}

	public function setPassword($password){
		$this->password=$password;
	}

	public function setFullname($fullname){
		$this->fullname=$fullname;
	}

	public function setShortname($shortname){
		$this->shortname=$shortname;
	}

	public function setIdnumber($idnumber){
		$this->idnumber=$idnumber;
	}

	public function setSummary($summary){
		$this->summary=$summary;
	}

	public function setFormat($format){
		$this->format=$format;
	}

	public function setShowgrades($showgrades){
		$this->showgrades=$showgrades;
	}

	public function setNewsitems($newsitems){
		$this->newsitems=$newsitems;
	}

	public function setTeacher($teacher){
		$this->teacher=$teacher;
	}

	public function setTeachers($teachers){
		$this->teachers=$teachers;
	}

	public function setStudent($student){
		$this->student=$student;
	}

	public function setStudents($students){
		$this->students=$students;
	}

	public function setGuest($guest){
		$this->guest=$guest;
	}

	public function setStartdate($startdate){
		$this->startdate=$startdate;
	}

	public function setEnrolperiod($enrolperiod){
		$this->enrolperiod=$enrolperiod;
	}

	public function setNumsections($numsections){
		$this->numsections=$numsections;
	}

	public function setMarker($marker){
		$this->marker=$marker;
	}

	public function setMaxbytes($maxbytes){
		$this->maxbytes=$maxbytes;
	}

	public function setVisible($visible){
		$this->visible=$visible;
	}

	public function setHiddensections($hiddensections){
		$this->hiddensections=$hiddensections;
	}

	public function setGroupmode($groupmode){
		$this->groupmode=$groupmode;
	}

	public function setGroupmodeforce($groupmodeforce){
		$this->groupmodeforce=$groupmodeforce;
	}

	public function setLang($lang){
		$this->lang=$lang;
	}

	public function setTheme($theme){
		$this->theme=$theme;
	}

	public function setCost($cost){
		$this->cost=$cost;
	}

	public function setTimecreated($timecreated){
		$this->timecreated=$timecreated;
	}

	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

	public function setMetacourse($metacourse){
		$this->metacourse=$metacourse;
	}

	public function setMyrole($myrole){
		$this->myrole=$myrole;
	}

}

?>
