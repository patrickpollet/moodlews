<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class fileRecord {
	/** 
	* @var  string
	*/
	public $fileurl;
	/** 
	* @var  string
	*/
	public $filename;
	/** 
	* @var  string
	*/
	public $filepath;
	/** 
	* @var  integer
	*/
	public $filesize;
	/** 
	* @var  string
	*/
	public $filecontent;
	 public function fileRecord() {
		 $this->fileurl='';
		 $this->filename='';
		 $this->filepath='';
		 $this->filesize=0;
		 $this->filecontent='';
	}
	/* get accessors */
	public function getFileurl(){
		 return $this->fileurl;
	}

	public function getFilename(){
		 return $this->filename;
	}

	public function getFilepath(){
		 return $this->filepath;
	}

	public function getFilesize(){
		 return $this->filesize;
	}

	public function getFilecontent(){
		 return $this->filecontent;
	}

	/*set accessors */
	public function setFileurl($fileurl){
		$this->fileurl=$fileurl;
	}

	public function setFilename($filename){
		$this->filename=$filename;
	}

	public function setFilepath($filepath){
		$this->filepath=$filepath;
	}

	public function setFilesize($filesize){
		$this->filesize=$filesize;
	}

	public function setFilecontent($filecontent){
		$this->filecontent=$filecontent;
	}

}

?>
