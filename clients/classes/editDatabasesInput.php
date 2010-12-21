<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editDatabasesInput {
	/** 
	* @var databaseDatum[]
	*/
	public $databases;

	/**
	* default constructor for class editDatabasesInput
	* @param databaseDatum[] $databases
	* @return editDatabasesInput
	*/
	 public function editDatabasesInput($databases=array()){
		 $this->databases=$databases   ;
	}
	/* get accessors */

	/**
	* @return databaseDatum[]
	*/
	public function getDatabases(){
		 return $this->databases;
	}

	/*set accessors */

	/**
	* @param databaseDatum[] $databases
	* @return void
	*/
	public function setDatabases($databases){
		$this->databases=$databases;
	}

}

?>
