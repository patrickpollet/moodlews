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
	 public function editDatabasesOutput() {
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
