<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editDatabasesOutput {
	/** 
	* @var databaseRecord[]
	*/
	public $databases;

	/**
	* default constructor for class editDatabasesOutput
	* @return editDatabasesOutput
	*/	 public function editDatabasesOutput() {
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
