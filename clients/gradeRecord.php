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
	/* full constructor */
	 public function gradeRecord($name='',$maxgrade=0,$grade='',$percent='',$weight=0.0,$weighted=0.0,$sortOrder=0){
		 $this->name=$name   ;
		 $this->maxgrade=$maxgrade   ;
		 $this->grade=$grade   ;
		 $this->percent=$percent   ;
		 $this->weight=$weight   ;
		 $this->weighted=$weighted   ;
		 $this->sortOrder=$sortOrder   ;
	}
	/* get accessors */
	public function getName(){
		 return $this->name;
	}

	public function getMaxgrade(){
		 return $this->maxgrade;
	}

	public function getGrade(){
		 return $this->grade;
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

	public function getSortOrder(){
		 return $this->sortOrder;
	}

	/*set accessors */
	public function setName($name){
		$this->name=$name;
	}

	public function setMaxgrade($maxgrade){
		$this->maxgrade=$maxgrade;
	}

	public function setGrade($grade){
		$this->grade=$grade;
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

	public function setSortOrder($sortOrder){
		$this->sortOrder=$sortOrder;
	}

}

?>
