<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class studentGradeRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  string
	*/
	public $courseid;
	/** 
	* @var  gradeStatsRecord
	*/
	public $stats;
	/** 
	* @var  (gradeRecords) array of gradeRecord
	*/
	public $grades;
	 public function studentGradeRecord() {
		 $this->error='';
		 $this->courseid='';
		 $this->stats=NULL;
		 $this->grades=array();
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getCourseid(){
		 return $this->courseid;
	}

	public function getStats(){
		 return $this->stats;
	}

	public function getGrades(){
		 return $this->grades;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}

	public function setStats($stats){
		$this->stats=$stats;
	}

	public function setGrades($grades){
		$this->grades=$grades;
	}

}

?>
