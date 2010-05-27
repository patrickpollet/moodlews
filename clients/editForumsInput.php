<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editForumsInput {
	/** 
	* @var  (forumData) array of forumDatum
	*/
	public $forums;
	/* full constructor */
	 public function editForumsInput($forums=array()){
		 $this->forums=$forums   ;
	}
	/* get accessors */
	public function getForums(){
		 return $this->forums;
	}

	/*set accessors */
	public function setForums($forums){
		$this->forums=$forums;
	}

}

?>
