<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class pageWikiRecord {
	/** 
	* @var string
	*/
	public $author;
	/** 
	* @var string
	*/
	public $content;
	/** 
	* @var int
	*/
	public $created;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $flags;
	/** 
	* @var int
	*/
	public $hits;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $lastmodified;
	/** 
	* @var string
	*/
	public $meta;
	/** 
	* @var string
	*/
	public $pagename;
	/** 
	* @var string
	*/
	public $refs;
	/** 
	* @var int
	*/
	public $userid;
	/** 
	* @var int
	*/
	public $version;
	/** 
	* @var int
	*/
	public $wiki;

	/**
	* default constructor for class pageWikiRecord
	* @param string $author
	* @param string $content
	* @param int $created
	* @param string $error
	* @param int $flags
	* @param int $hits
	* @param int $id
	* @param int $lastmodified
	* @param string $meta
	* @param string $pagename
	* @param string $refs
	* @param int $userid
	* @param int $version
	* @param int $wiki
	* @return pageWikiRecord
	*/
	 public function pageWikiRecord($author='',$content='',$created=0,$error='',$flags=0,$hits=0,$id=0,$lastmodified=0,$meta='',$pagename='',$refs='',$userid=0,$version=0,$wiki=0){
		 $this->author=$author   ;
		 $this->content=$content   ;
		 $this->created=$created   ;
		 $this->error=$error   ;
		 $this->flags=$flags   ;
		 $this->hits=$hits   ;
		 $this->id=$id   ;
		 $this->lastmodified=$lastmodified   ;
		 $this->meta=$meta   ;
		 $this->pagename=$pagename   ;
		 $this->refs=$refs   ;
		 $this->userid=$userid   ;
		 $this->version=$version   ;
		 $this->wiki=$wiki   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAuthor(){
		 return $this->author;
	}


	/**
	* @return string
	*/
	public function getContent(){
		 return $this->content;
	}


	/**
	* @return int
	*/
	public function getCreated(){
		 return $this->created;
	}


	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return int
	*/
	public function getFlags(){
		 return $this->flags;
	}


	/**
	* @return int
	*/
	public function getHits(){
		 return $this->hits;
	}


	/**
	* @return int
	*/
	public function getId(){
		 return $this->id;
	}


	/**
	* @return int
	*/
	public function getLastmodified(){
		 return $this->lastmodified;
	}


	/**
	* @return string
	*/
	public function getMeta(){
		 return $this->meta;
	}


	/**
	* @return string
	*/
	public function getPagename(){
		 return $this->pagename;
	}


	/**
	* @return string
	*/
	public function getRefs(){
		 return $this->refs;
	}


	/**
	* @return int
	*/
	public function getUserid(){
		 return $this->userid;
	}


	/**
	* @return int
	*/
	public function getVersion(){
		 return $this->version;
	}


	/**
	* @return int
	*/
	public function getWiki(){
		 return $this->wiki;
	}

	/*set accessors */

	/**
	* @param string $author
	* @return void
	*/
	public function setAuthor($author){
		$this->author=$author;
	}


	/**
	* @param string $content
	* @return void
	*/
	public function setContent($content){
		$this->content=$content;
	}


	/**
	* @param int $created
	* @return void
	*/
	public function setCreated($created){
		$this->created=$created;
	}


	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param int $flags
	* @return void
	*/
	public function setFlags($flags){
		$this->flags=$flags;
	}


	/**
	* @param int $hits
	* @return void
	*/
	public function setHits($hits){
		$this->hits=$hits;
	}


	/**
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param int $lastmodified
	* @return void
	*/
	public function setLastmodified($lastmodified){
		$this->lastmodified=$lastmodified;
	}


	/**
	* @param string $meta
	* @return void
	*/
	public function setMeta($meta){
		$this->meta=$meta;
	}


	/**
	* @param string $pagename
	* @return void
	*/
	public function setPagename($pagename){
		$this->pagename=$pagename;
	}


	/**
	* @param string $refs
	* @return void
	*/
	public function setRefs($refs){
		$this->refs=$refs;
	}


	/**
	* @param int $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}


	/**
	* @param int $version
	* @return void
	*/
	public function setVersion($version){
		$this->version=$version;
	}


	/**
	* @param int $wiki
	* @return void
	*/
	public function setWiki($wiki){
		$this->wiki=$wiki;
	}

}

?>
