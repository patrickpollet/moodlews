<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class gradeStatsRecord {
	/** 
	* @var  integer
	*/
	public $gradeItems;
	/** 
	* @var  string
	*/
	public $allgrades;
	/** 
	* @var  integer
	*/
	public $points;
	/** 
	* @var  integer
	*/
	public $totalpoints;
	/** 
	* @var  float
	*/
	public $percent;
	/** 
	* @var  float
	*/
	public $weight;
	/** 
	* @var  float
	*/
	public $weighted;
	/* constructor */
	 public function gradeStatsRecord() {
		 $this->gradeItems=0;
		 $this->allgrades='';
		 $this->points=0;
		 $this->totalpoints=0;
		 $this->percent=0.0;
		 $this->weight=0.0;
		 $this->weighted=0.0;
	}
}

?>
