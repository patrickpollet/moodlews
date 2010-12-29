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
	public $fileurl;
	/** 
	* @var string
	*/
	public $filename;
	/** 
	* @var string
	*/
	public $filepath;
	/** 
	* @var integer
	*/
	public $filesize;
	/** 
	* @var string
	*/
	public $filecontent;

	/**
	* default constructor for class fileRecord
	* @return fileRecord
	*/	 public function fileRecord() {
		 $this->fileurl='';
		 $this->filename='';
		 $this->filepath='';
		 $this->filesize=0;
		 $this->filecontent='';
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getFileurl(){
		 return $this->fileurl;
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
	* @return integer
	*/
	public function getFilesize(){
		 return $this->filesize;
	}


	/**
	* @return string
	*/
	public function getFilecontent(){
		 return $this->filecontent;
	}

	/*set accessors */

	/**
	* @param string $fileurl
	* @return void
	*/
	public function setFileurl($fileurl){
		$this->fileurl=$fileurl;
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
	* @param integer $filesize
	* @return void
	*/
	public function setFilesize($filesize){
		$this->filesize=$filesize;
	}


	/**
	* @param string $filecontent
	* @return void
	*/
	public function setFilecontent($filecontent){
		$this->filecontent=$filecontent;
	}

}

?>
