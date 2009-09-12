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
	* @var  gradeRecords
	*/
	public $grades;
	/* constructor */
	 public function studentGradeRecord() {
		 $this->error='';
		 $this->courseid='';
		 $this->stats=new gradeStatsRecord();
		 $this->grades=new gradeRecords();
	}
}

?>
