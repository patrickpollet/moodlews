<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllDatabasesReturn {
	/** 
	* @var databaseRecord[]
	*/
	public $databases;

	/**
	* default constructor for class getAllDatabasesReturn
	* @param databaseRecord[] $databases
	* @return getAllDatabasesReturn
	*/
	 public function getAllDatabasesReturn($databases=array()){
		 $this->databases=$databases   ;
	}
	/* get accessors */

	/**
	* @return databaseRecord[]
	*/
	public function getDatabases(){
		 return $this->databases;
	}

	/*set accessors */

	/**
	* @param databaseRecord[] $databases
	* @return void
	*/
	public function setDatabases($databases){
		$this->databases=$databases;
	}

}

?>
