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
	public $error;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $contextid;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var string
	*/
	public $idnumber;
	/** 
	* @var string
	*/
	public $component;
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
	* @param string $error
	* @param int $id
	* @param int $contextid
	* @param string $name
	* @param string $description
	* @param string $idnumber
	* @param string $component
	* @param int $timecreated
	* @param int $timemodified
	* @return cohortRecord
	*/
	 public function cohortRecord($error='',$id=0,$contextid=0,$name='',$description='',$idnumber='',$component='',$timecreated=0,$timemodified=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->contextid=$contextid   ;
		 $this->name=$name   ;
		 $this->description=$description   ;
		 $this->idnumber=$idnumber   ;
		 $this->component=$component   ;
		 $this->timecreated=$timecreated   ;
		 $this->timemodified=$timemodified   ;
	}
	/* get accessors */

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
	* @return int
	*/
	public function getContextid(){
		 return $this->contextid;
	}


	/**
	* @return string
	*/
	public function getName(){
		 return $this->name;
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
	public function getIdnumber(){
		 return $this->idnumber;
	}


	/**
	* @return string
	*/
	public function getComponent(){
		 return $this->component;
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
	* @param int $contextid
	* @return void
	*/
	public function setContextid($contextid){
		$this->contextid=$contextid;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
	}


	/**
	* @param string $idnumber
	* @return void
	*/
	public function setIdnumber($idnumber){
		$this->idnumber=$idnumber;
	}


	/**
	* @param string $component
	* @return void
	*/
	public function setComponent($component){
		$this->component=$component;
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
