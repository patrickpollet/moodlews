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
	/* full constructor */
	 public function gradeStatsRecord($gradeItems=0,$allgrades='',$points=0,$totalpoints=0,$percent=0.0,$weight=0.0,$weighted=0.0){
		 $this->gradeItems=$gradeItems   ;
		 $this->allgrades=$allgrades   ;
		 $this->points=$points   ;
		 $this->totalpoints=$totalpoints   ;
		 $this->percent=$percent   ;
		 $this->weight=$weight   ;
		 $this->weighted=$weighted   ;
	}
	/* get accessors */
	public function getGradeItems(){
		 return $this->gradeItems;
	}

	public function getAllgrades(){
		 return $this->allgrades;
	}

	public function getPoints(){
		 return $this->points;
	}

	public function getTotalpoints(){
		 return $this->totalpoints;
	}

	public function getPercent(){
		 return $this->percent;
	}

	public function getWeight(){
		 return $this->weight;
	}

	public function getWeighted(){
		 return $this->weighted;
	}

	/*set accessors */
	public function setGradeItems($gradeItems){
		$this->gradeItems=$gradeItems;
	}

	public function setAllgrades($allgrades){
		$this->allgrades=$allgrades;
	}

	public function setPoints($points){
		$this->points=$points;
	}

	public function setTotalpoints($totalpoints){
		$this->totalpoints=$totalpoints;
	}

	public function setPercent($percent){
		$this->percent=$percent;
	}

	public function setWeight($weight){
		$this->weight=$weight;
	}

	public function setWeighted($weighted){
		$this->weighted=$weighted;
	}

}

?>
