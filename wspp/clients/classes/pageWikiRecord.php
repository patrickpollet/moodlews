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
	public $error;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $pagename;
	/** 
	* @var int
	*/
	public $version;
	/** 
	* @var int
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
	* @var int
	*/
	public $userid;
	/** 
	* @var int
	*/
	public $created;
	/** 
	* @var int
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
	* @var int
	*/
	public $hits;
	/** 
	* @var int
	*/
	public $wiki;

	/**
	* default constructor for class pageWikiRecord
	* @param string $error
	* @param int $id
	* @param string $pagename
	* @param int $version
	* @param int $flags
	* @param string $content
	* @param string $author
	* @param int $userid
	* @param int $created
	* @param int $lastmodified
	* @param string $refs
	* @param string $meta
	* @param int $hits
	* @param int $wiki
	* @return pageWikiRecord
	*/
	 public function pageWikiRecord($error='',$id=0,$pagename='',$version=0,$flags=0,$content='',$author='',$userid=0,$created=0,$lastmodified=0,$refs='',$meta='',$hits=0,$wiki=0){
		 $this->error=$error   ;
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

	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return int
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
	* @return int
	*/
	public function getVersion(){
		 return $this->version;
	}


	/**
	* @return int
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
	* @return int
	*/
	public function getUserid(){
		 return $this->userid;
	}


	/**
	* @return int
	*/
	public function getCreated(){
		 return $this->created;
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
	* @return int
	*/
	public function getHits(){
		 return $this->hits;
	}


	/**
	* @return int
	*/
	public function getWiki(){
		 return $this->wiki;
	}

	/*set accessors */

	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param int $id
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
	* @param int $version
	* @return void
	*/
	public function setVersion($version){
		$this->version=$version;
	}


	/**
	* @param int $flags
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
	* @param int $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}


	/**
	* @param int $created
	* @return void
	*/
	public function setCreated($created){
		$this->created=$created;
	}


	/**
	* @param int $lastmodified
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
	* @param int $hits
	* @return void
	*/
	public function setHits($hits){
		$this->hits=$hits;
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
