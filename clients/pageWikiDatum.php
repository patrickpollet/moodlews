<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class pageWikiDatum {
	/** 
	* @var  string
	*/
	public $action;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  string
	*/
	public $pagename;
	/** 
	* @var  integer
	*/
	public $version;
	/** 
	* @var  integer
	*/
	public $flags;
	/** 
	* @var  string
	*/
	public $content;
	/** 
	* @var  string
	*/
	public $author;
	/** 
	* @var  integer
	*/
	public $userid;
	/** 
	* @var  integer
	*/
	public $created;
	/** 
	* @var  integer
	*/
	public $lastmodified;
	/** 
	* @var  string
	*/
	public $refs;
	/** 
	* @var  string
	*/
	public $meta;
	/** 
	* @var  integer
	*/
	public $hits;
	/** 
	* @var  integer
	*/
	public $wiki;
	/* full constructor */
	 public function pageWikiDatum($action='',$id=0,$pagename='',$version=0,$flags=0,$content='',$author='',$userid=0,$created=0,$lastmodified=0,$refs='',$meta='',$hits=0,$wiki=0){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->pagename=$pagename   ;
		 $this->version=$version   ;
		 $this->flags=$flags   ;
		 $this->content=$content   ;
		 $this->author=$author   ;
		 $this->userid=$userid   ;
		 $this->created=$created   ;
		 $this->lastmodified=$lastmodified   ;
		 $this->refs=$refs   ;
		 $this->meta=$meta   ;
		 $this->hits=$hits   ;
		 $this->wiki=$wiki   ;
	}
	/* get accessors */
	public function getAction(){
		 return $this->action;
	}

	public function getId(){
		 return $this->id;
	}

	public function getPagename(){
		 return $this->pagename;
	}

	public function getVersion(){
		 return $this->version;
	}

	public function getFlags(){
		 return $this->flags;
	}

	public function getContent(){
		 return $this->content;
	}

	public function getAuthor(){
		 return $this->author;
	}

	public function getUserid(){
		 return $this->userid;
	}

	public function getCreated(){
		 return $this->created;
	}

	public function getLastmodified(){
		 return $this->lastmodified;
	}

	public function getRefs(){
		 return $this->refs;
	}

	public function getMeta(){
		 return $this->meta;
	}

	public function getHits(){
		 return $this->hits;
	}

	public function getWiki(){
		 return $this->wiki;
	}

	/*set accessors */
	public function setAction($action){
		$this->action=$action;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setPagename($pagename){
		$this->pagename=$pagename;
	}

	public function setVersion($version){
		$this->version=$version;
	}

	public function setFlags($flags){
		$this->flags=$flags;
	}

	public function setContent($content){
		$this->content=$content;
	}

	public function setAuthor($author){
		$this->author=$author;
	}

	public function setUserid($userid){
		$this->userid=$userid;
	}

	public function setCreated($created){
		$this->created=$created;
	}

	public function setLastmodified($lastmodified){
		$this->lastmodified=$lastmodified;
	}

	public function setRefs($refs){
		$this->refs=$refs;
	}

	public function setMeta($meta){
		$this->meta=$meta;
	}

	public function setHits($hits){
		$this->hits=$hits;
	}

	public function setWiki($wiki){
		$this->wiki=$wiki;
	}

}

?>
