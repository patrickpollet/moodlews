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
	/* constructor */
	 public function courseRecord() {
		 $this->error='';
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
		 $this->numsections=0;
		 $this->marker=0;
		 $this->maxbytes=0;
		 $this->visible=0;
		 $this->hiddensections=0;
		 $this->groupmode=0;
		 $this->groupmodeforce=0;
		 $this->lang='';
		 $this->theme='';
		 $this->cost='';
		 $this->timecreated=0;
		 $this->timemodified=0;
		 $this->metacourse=0;
	}
}

?>
