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
	* @return getAllDatabasesReturn
	*/	 public function getAllDatabasesReturn() {
		 $this->databases=array();
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
