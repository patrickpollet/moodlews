<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class cohortRecord {
	/** 
	* @var string
	*/
	public $component;
	/** 
	* @var int
	*/
	public $contextid;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var string
	*/
	public $error;
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
	public $name;
	/** 
	* @var int
	*/
	public $timecreated;
	/** 
	* @var int
	*/
	public $timemodified;

	/**
	* default constructor for class cohortRecord
	* @param string $component
	* @param int $contextid
	* @param string $description
	* @param string $error
	* @param int $id
	* @param string $idnumber
	* @param string $name
	* @param int $timecreated
	* @param int $timemodified
	* @return cohortRecord
	*/
	 public function cohortRecord($component='',$contextid=0,$description='',$error='',$id=0,$idnumber='',$name='',$timecreated=0,$timemodified=0){
		 $this->component=$component   ;
		 $this->contextid=$contextid   ;
		 $this->description=$description   ;
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->idnumber=$idnumber   ;
		 $this->name=$name   ;
		 $this->timecreated=$timecreated   ;
		 $this->timemodified=$timemodified   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getComponent(){
		 return $this->component;
	}


	/**
	* @return int
	*/
	public function getContextid(){
		 return $this->contextid;
	}


	/**
	* @return string
	*/
	public function getDescription(){
		 return $this->description;
	}


	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
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
	public function getName(){
		 return $this->name;
	}


	/**
	* @return int
	*/
	public function getTimecreated(){
		 return $this->timecreated;
	}


	/**
	* @return int
	*/
	public function getTimemodified(){
		 return $this->timemodified;
	}

	/*set accessors */

	/**
	* @param string $component
	* @return void
	*/
	public function setComponent($component){
		$this->component=$component;
	}


	/**
	* @param int $contextid
	* @return void
	*/
	public function setContextid($contextid){
		$this->contextid=$contextid;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
	}


	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
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
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param int $timecreated
	* @return void
	*/
	public function setTimecreated($timecreated){
		$this->timecreated=$timecreated;
	}


	/**
	* @param int $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

}

?>
