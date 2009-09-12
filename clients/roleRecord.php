<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class roleRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $shortname;
	/** 
	* @var  string
	*/
	public $description;
	/** 
	* @var  integer
	*/
	public $sortorder;
	/* full constructor */
	 public function roleRecord($error='',$id=0,$name='',$shortname='',$description='',$sortorder=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->shortname=$shortname   ;
		 $this->description=$description   ;
		 $this->sortorder=$sortorder   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getName(){
		 return $this->name;
	}

	public function getShortname(){
		 return $this->shortname;
	}

	public function getDescription(){
		 return $this->description;
	}

	public function getSortorder(){
		 return $this->sortorder;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setShortname($shortname){
		$this->shortname=$shortname;
	}

	public function setDescription($description){
		$this->description=$description;
	}

	public function setSortorder($sortorder){
		$this->sortorder=$sortorder;
	}

}

?>
