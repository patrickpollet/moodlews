<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllDatabasesReturn {
	/** 
	* @var  (databaseRecords) array of databaseRecord
	*/
	public $databases;
	 public function getAllDatabasesReturn() {
		 $this->databases=array();
	}
	/* get accessors */
	public function getDatabases(){
		 return $this->databases;
	}

	/*set accessors */
	public function setDatabases($databases){
		$this->databases=$databases;
	}

}

?>
