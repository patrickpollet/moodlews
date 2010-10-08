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
	/* full constructor */
	 public function editDatabasesInput($databases=array()){
		 $this->databases=$databases   ;
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
