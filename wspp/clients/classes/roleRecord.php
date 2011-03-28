<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class roleRecord {
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
	public $name;
	/** 
	* @var string
	*/
	public $shortname;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var int
	*/
	public $sortorder;

	/**
	* default constructor for class roleRecord
	* @param string $error
	* @param int $id
	* @param string $name
	* @param string $shortname
	* @param string $description
	* @param int $sortorder
	* @return roleRecord
	*/
	 public function roleRecord($error='',$id=0,$name='',$shortname='',$description='',$sortorder=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->shortname=$shortname   ;
		 $this->description=$description   ;
		 $this->sortorder=$sortorder   ;
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
	* @return string
	*/
	public function getName(){
		 return $this->name;
	}


	/**
	* @return string
	*/
	public function getShortname(){
		 return $this->shortname;
	}


	/**
	* @return string
	*/
	public function getDescription(){
		 return $this->description;
	}


	/**
	* @return int
	*/
	public function getSortorder(){
		 return $this->sortorder;
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
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $shortname
	* @return void
	*/
	public function setShortname($shortname){
		$this->shortname=$shortname;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
	}


	/**
	* @param int $sortorder
	* @return void
	*/
	public function setSortorder($sortorder){
		$this->sortorder=$sortorder;
	}

}

?>
