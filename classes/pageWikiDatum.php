<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class pageWikiDatum {
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var integer
	*/
	public $id;
	/** 
	* @var string
	*/
	public $pagename;
	/** 
	* @var integer
	*/
	public $version;
	/** 
	* @var integer
	*/
	public $flags;
	/** 
	* @var string
	*/
	public $content;
	/** 
	* @var string
	*/
	public $author;
	/** 
	* @var integer
	*/
	public $userid;
	/** 
	* @var integer
	*/
	public $created;
	/** 
	* @var integer
	*/
	public $lastmodified;
	/** 
	* @var string
	*/
	public $refs;
	/** 
	* @var string
	*/
	public $meta;
	/** 
	* @var integer
	*/
	public $hits;
	/** 
	* @var integer
	*/
	public $wiki;

	/**
	* default constructor for class pageWikiDatum
	* @return pageWikiDatum
	*/	 public function pageWikiDatum() {
		 $this->action='';
		 $this->id=0;
		 $this->pagename='';
		 $this->version=0;
		 $this->flags=0;
		 $this->content='';
		 $this->author='';
		 $this->userid=0;
		 $this->created=0;
		 $this->lastmodified=0;
		 $this->refs='';
		 $this->meta='';
		 $this->hits=0;
		 $this->wiki=0;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAction(){
		 return $this->action;
	}


	/**
	* @return integer
	*/
	public function getId(){
		 return $this->id;
	}


	/**
	* @return string
	*/
	public function getPagename(){
		 return $this->pagename;
	}


	/**
	* @return integer
	*/
	public function getVersion(){
		 return $this->version;
	}


	/**
	* @return integer
	*/
	public function getFlags(){
		 return $this->flags;
	}


	/**
	* @return string
	*/
	public function getContent(){
		 return $this->content;
	}


	/**
	* @return string
	*/
	public function getAuthor(){
		 return $this->author;
	}


	/**
	* @return integer
	*/
	public function getUserid(){
		 return $this->userid;
	}


	/**
	* @return integer
	*/
	public function getCreated(){
		 return $this->created;
	}


	/**
	* @return integer
	*/
	public function getLastmodified(){
		 return $this->lastmodified;
	}


	/**
	* @return string
	*/
	public function getRefs(){
		 return $this->refs;
	}


	/**
	* @return string
	*/
	public function getMeta(){
		 return $this->meta;
	}


	/**
	* @return integer
	*/
	public function getHits(){
		 return $this->hits;
	}


	/**
	* @return integer
	*/
	public function getWiki(){
		 return $this->wiki;
	}

	/*set accessors */

	/**
	* @param string $action
	* @return void
	*/
	public function setAction($action){
		$this->action=$action;
	}


	/**
	* @param integer $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param string $pagename
	* @return void
	*/
	public function setPagename($pagename){
		$this->pagename=$pagename;
	}


	/**
	* @param integer $version
	* @return void
	*/
	public function setVersion($version){
		$this->version=$version;
	}


	/**
	* @param integer $flags
	* @return void
	*/
	public function setFlags($flags){
		$this->flags=$flags;
	}


	/**
	* @param string $content
	* @return void
	*/
	public function setContent($content){
		$this->content=$content;
	}


	/**
	* @param string $author
	* @return void
	*/
	public function setAuthor($author){
		$this->author=$author;
	}


	/**
	* @param integer $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}


	/**
	* @param integer $created
	* @return void
	*/
	public function setCreated($created){
		$this->created=$created;
	}


	/**
	* @param integer $lastmodified
	* @return void
	*/
	public function setLastmodified($lastmodified){
		$this->lastmodified=$lastmodified;
	}


	/**
	* @param string $refs
	* @return void
	*/
	public function setRefs($refs){
		$this->refs=$refs;
	}


	/**
	* @param string $meta
	* @return void
	*/
	public function setMeta($meta){
		$this->meta=$meta;
	}


	/**
	* @param integer $hits
	* @return void
	*/
	public function setHits($hits){
		$this->hits=$hits;
	}


	/**
	* @param integer $wiki
	* @return void
	*/
	public function setWiki($wiki){
		$this->wiki=$wiki;
	}

}

?>
