<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class fileRecord {
	/** 
	* @var string
	*/
	public $filecontent;
	/** 
	* @var string
	*/
	public $filename;
	/** 
	* @var string
	*/
	public $filepath;
	/** 
	* @var int
	*/
	public $filesize;
	/** 
	* @var string
	*/
	public $fileurl;

	/**
	* default constructor for class fileRecord
	* @param string $filecontent
	* @param string $filename
	* @param string $filepath
	* @param int $filesize
	* @param string $fileurl
	* @return fileRecord
	*/
	 public function fileRecord($filecontent='',$filename='',$filepath='',$filesize=0,$fileurl=''){
		 $this->filecontent=$filecontent   ;
		 $this->filename=$filename   ;
		 $this->filepath=$filepath   ;
		 $this->filesize=$filesize   ;
		 $this->fileurl=$fileurl   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getFilecontent(){
		 return $this->filecontent;
	}


	/**
	* @return string
	*/
	public function getFilename(){
		 return $this->filename;
	}


	/**
	* @return string
	*/
	public function getFilepath(){
		 return $this->filepath;
	}


	/**
	* @return int
	*/
	public function getFilesize(){
		 return $this->filesize;
	}


	/**
	* @return string
	*/
	public function getFileurl(){
		 return $this->fileurl;
	}

	/*set accessors */

	/**
	* @param string $filecontent
	* @return void
	*/
	public function setFilecontent($filecontent){
		$this->filecontent=$filecontent;
	}


	/**
	* @param string $filename
	* @return void
	*/
	public function setFilename($filename){
		$this->filename=$filename;
	}


	/**
	* @param string $filepath
	* @return void
	*/
	public function setFilepath($filepath){
		$this->filepath=$filepath;
	}


	/**
	* @param int $filesize
	* @return void
	*/
	public function setFilesize($filesize){
		$this->filesize=$filesize;
	}


	/**
	* @param string $fileurl
	* @return void
	*/
	public function setFileurl($fileurl){
		$this->fileurl=$fileurl;
	}

}

?>
