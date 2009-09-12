<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class changeRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  integer
	*/
	public $courseid;
	/** 
	* @var  integer
	*/
	public $instance;
	/** 
	* @var  integer
	*/
	public $resid;
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $date;
	/** 
	* @var  integer
	*/
	public $timestamp;
	/** 
	* @var  string
	*/
	public $type;
	/** 
	* @var  string
	*/
	public $author;
	/** 
	* @var  string
	*/
	public $link;
	/** 
	* @var  string
	*/
	public $url;
	/** 
	* @var  integer
	*/
	public $visible;
	/* full constructor */
	 public function changeRecord($error='',$id=0,$courseid=0,$instance=0,$resid=0,$name='',$date='',$timestamp=0,$type='',$author='',$link='',$url='',$visible=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->courseid=$courseid   ;
		 $this->instance=$instance   ;
		 $this->resid=$resid   ;
		 $this->name=$name   ;
		 $this->date=$date   ;
		 $this->timestamp=$timestamp   ;
		 $this->type=$type   ;
		 $this->author=$author   ;
		 $this->link=$link   ;
		 $this->url=$url   ;
		 $this->visible=$visible   ;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getCourseid(){
		 return $this->courseid;
	}

	public function getInstance(){
		 return $this->instance;
	}

	public function getResid(){
		 return $this->resid;
	}

	public function getName(){
		 return $this->name;
	}

	public function getDate(){
		 return $this->date;
	}

	public function getTimestamp(){
		 return $this->timestamp;
	}

	public function getType(){
		 return $this->type;
	}

	public function getAuthor(){
		 return $this->author;
	}

	public function getLink(){
		 return $this->link;
	}

	public function getUrl(){
		 return $this->url;
	}

	public function getVisible(){
		 return $this->visible;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}

	public function setInstance($instance){
		$this->instance=$instance;
	}

	public function setResid($resid){
		$this->resid=$resid;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setDate($date){
		$this->date=$date;
	}

	public function setTimestamp($timestamp){
		$this->timestamp=$timestamp;
	}

	public function setType($type){
		$this->type=$type;
	}

	public function setAuthor($author){
		$this->author=$author;
	}

	public function setLink($link){
		$this->link=$link;
	}

	public function setUrl($url){
		$this->url=$url;
	}

	public function setVisible($visible){
		$this->visible=$visible;
	}

}

?>
