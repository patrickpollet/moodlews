<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class gradeRecord {
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  integer
	*/
	public $maxgrade;
	/** 
	* @var  string
	*/
	public $grade;
	/** 
	* @var  string
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
	/** 
	* @var  integer
	*/
	public $sortOrder;
	/* constructor */
	 public function gradeRecord() {
		 $this->name='';
		 $this->maxgrade=0;
		 $this->grade='';
		 $this->percent='';
		 $this->weight=0.0;
		 $this->weighted=0.0;
		 $this->sortOrder=0;
	}
}

?>
