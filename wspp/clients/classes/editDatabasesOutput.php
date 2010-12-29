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
	* @param databaseRecord[] $databases
	* @return editDatabasesOutput
	*/
	 public function editDatabasesOutput($databases=array()){
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
