<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class databaseDatum {
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var string
	*/
	public $addtemplatee;
	/** 
	* @var int
	*/
	public $approval;
	/** 
	* @var string
	*/
	public $asearchtemplate;
	/** 
	* @var int
	*/
	public $assessed;
	/** 
	* @var int
	*/
	public $comments;
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var string
	*/
	public $csstemplate;
	/** 
	* @var int
	*/
	public $defaultsort;
	/** 
	* @var int
	*/
	public $defaultsortdir;
	/** 
	* @var int
	*/
	public $editany;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $intro;
	/** 
	* @var string
	*/
	public $jstemplate;
	/** 
	* @var string
	*/
	public $listtemplate;
	/** 
	* @var string
	*/
	public $listtemplatefooter;
	/** 
	* @var string
	*/
	public $listtemplateheader;
	/** 
	* @var int
	*/
	public $maxentries;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var int
	*/
	public $notification;
	/** 
	* @var int
	*/
	public $requiredentries;
	/** 
	* @var int
	*/
	public $requiredentriestoview;
	/** 
	* @var int
	*/
	public $ressarticles;
	/** 
	* @var string
	*/
	public $rsstemplate;
	/** 
	* @var string
	*/
	public $rsstitletemplate;
	/** 
	* @var int
	*/
	public $scale;
	/** 
	* @var string
	*/
	public $singletemplate;
	/** 
	* @var int
	*/
	public $timeavailablefrom;
	/** 
	* @var int
	*/
	public $timeavailableto;
	/** 
	* @var int
	*/
	public $timeviewfrom;
	/** 
	* @var int
	*/
	public $timeviewto;

	/**
	* default constructor for class databaseDatum
	* @param string $action
	* @param string $addtemplatee
	* @param int $approval
	* @param string $asearchtemplate
	* @param int $assessed
	* @param int $comments
	* @param int $course
	* @param string $csstemplate
	* @param int $defaultsort
	* @param int $defaultsortdir
	* @param int $editany
	* @param int $id
	* @param string $intro
	* @param string $jstemplate
	* @param string $listtemplate
	* @param string $listtemplatefooter
	* @param string $listtemplateheader
	* @param int $maxentries
	* @param string $name
	* @param int $notification
	* @param int $requiredentries
	* @param int $requiredentriestoview
	* @param int $ressarticles
	* @param string $rsstemplate
	* @param string $rsstitletemplate
	* @param int $scale
	* @param string $singletemplate
	* @param int $timeavailablefrom
	* @param int $timeavailableto
	* @param int $timeviewfrom
	* @param int $timeviewto
	* @return databaseDatum
	*/
	 public function databaseDatum($action='',$addtemplatee='',$approval=0,$asearchtemplate='',$assessed=0,$comments=0,$course=0,$csstemplate='',$defaultsort=0,$defaultsortdir=0,$editany=0,$id=0,$intro='',$jstemplate='',$listtemplate='',$listtemplatefooter='',$listtemplateheader='',$maxentries=0,$name='',$notification=0,$requiredentries=0,$requiredentriestoview=0,$ressarticles=0,$rsstemplate='',$rsstitletemplate='',$scale=0,$singletemplate='',$timeavailablefrom=0,$timeavailableto=0,$timeviewfrom=0,$timeviewto=0){
		 $this->action=$action   ;
		 $this->addtemplatee=$addtemplatee   ;
		 $this->approval=$approval   ;
		 $this->asearchtemplate=$asearchtemplate   ;
		 $this->assessed=$assessed   ;
		 $this->comments=$comments   ;
		 $this->course=$course   ;
		 $this->csstemplate=$csstemplate   ;
		 $this->defaultsort=$defaultsort   ;
		 $this->defaultsortdir=$defaultsortdir   ;
		 $this->editany=$editany   ;
		 $this->id=$id   ;
		 $this->intro=$intro   ;
		 $this->jstemplate=$jstemplate   ;
		 $this->listtemplate=$listtemplate   ;
		 $this->listtemplatefooter=$listtemplatefooter   ;
		 $this->listtemplateheader=$listtemplateheader   ;
		 $this->maxentries=$maxentries   ;
		 $this->name=$name   ;
		 $this->notification=$notification   ;
		 $this->requiredentries=$requiredentries   ;
		 $this->requiredentriestoview=$requiredentriestoview   ;
		 $this->ressarticles=$ressarticles   ;
		 $this->rsstemplate=$rsstemplate   ;
		 $this->rsstitletemplate=$rsstitletemplate   ;
		 $this->scale=$scale   ;
		 $this->singletemplate=$singletemplate   ;
		 $this->timeavailablefrom=$timeavailablefrom   ;
		 $this->timeavailableto=$timeavailableto   ;
		 $this->timeviewfrom=$timeviewfrom   ;
		 $this->timeviewto=$timeviewto   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAction(){
		 return $this->action;
	}


	/**
	* @return string
	*/
	public function getAddtemplatee(){
		 return $this->addtemplatee;
	}


	/**
	* @return int
	*/
	public function getApproval(){
		 return $this->approval;
	}


	/**
	* @return string
	*/
	public function getAsearchtemplate(){
		 return $this->asearchtemplate;
	}


	/**
	* @return int
	*/
	public function getAssessed(){
		 return $this->assessed;
	}


	/**
	* @return int
	*/
	public function getComments(){
		 return $this->comments;
	}


	/**
	* @return int
	*/
	public function getCourse(){
		 return $this->course;
	}


	/**
	* @return string
	*/
	public function getCsstemplate(){
		 return $this->csstemplate;
	}


	/**
	* @return int
	*/
	public function getDefaultsort(){
		 return $this->defaultsort;
	}


	/**
	* @return int
	*/
	public function getDefaultsortdir(){
		 return $this->defaultsortdir;
	}


	/**
	* @return int
	*/
	public function getEditany(){
		 return $this->editany;
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
	public function getIntro(){
		 return $this->intro;
	}


	/**
	* @return string
	*/
	public function getJstemplate(){
		 return $this->jstemplate;
	}


	/**
	* @return string
	*/
	public function getListtemplate(){
		 return $this->listtemplate;
	}


	/**
	* @return string
	*/
	public function getListtemplatefooter(){
		 return $this->listtemplatefooter;
	}


	/**
	* @return string
	*/
	public function getListtemplateheader(){
		 return $this->listtemplateheader;
	}


	/**
	* @return int
	*/
	public function getMaxentries(){
		 return $this->maxentries;
	}


	/**
	* @return string
	*/
	public function getName(){
		 return $this->name;
	}


	/**
	* @return int
	*/
	public function getNotification(){
		 return $this->notification;
	}


	/**
	* @return int
	*/
	public function getRequiredentries(){
		 return $this->requiredentries;
	}


	/**
	* @return int
	*/
	public function getRequiredentriestoview(){
		 return $this->requiredentriestoview;
	}


	/**
	* @return int
	*/
	public function getRessarticles(){
		 return $this->ressarticles;
	}


	/**
	* @return string
	*/
	public function getRsstemplate(){
		 return $this->rsstemplate;
	}


	/**
	* @return string
	*/
	public function getRsstitletemplate(){
		 return $this->rsstitletemplate;
	}


	/**
	* @return int
	*/
	public function getScale(){
		 return $this->scale;
	}


	/**
	* @return string
	*/
	public function getSingletemplate(){
		 return $this->singletemplate;
	}


	/**
	* @return int
	*/
	public function getTimeavailablefrom(){
		 return $this->timeavailablefrom;
	}


	/**
	* @return int
	*/
	public function getTimeavailableto(){
		 return $this->timeavailableto;
	}


	/**
	* @return int
	*/
	public function getTimeviewfrom(){
		 return $this->timeviewfrom;
	}


	/**
	* @return int
	*/
	public function getTimeviewto(){
		 return $this->timeviewto;
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
	* @param string $addtemplatee
	* @return void
	*/
	public function setAddtemplatee($addtemplatee){
		$this->addtemplatee=$addtemplatee;
	}


	/**
	* @param int $approval
	* @return void
	*/
	public function setApproval($approval){
		$this->approval=$approval;
	}


	/**
	* @param string $asearchtemplate
	* @return void
	*/
	public function setAsearchtemplate($asearchtemplate){
		$this->asearchtemplate=$asearchtemplate;
	}


	/**
	* @param int $assessed
	* @return void
	*/
	public function setAssessed($assessed){
		$this->assessed=$assessed;
	}


	/**
	* @param int $comments
	* @return void
	*/
	public function setComments($comments){
		$this->comments=$comments;
	}


	/**
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param string $csstemplate
	* @return void
	*/
	public function setCsstemplate($csstemplate){
		$this->csstemplate=$csstemplate;
	}


	/**
	* @param int $defaultsort
	* @return void
	*/
	public function setDefaultsort($defaultsort){
		$this->defaultsort=$defaultsort;
	}


	/**
	* @param int $defaultsortdir
	* @return void
	*/
	public function setDefaultsortdir($defaultsortdir){
		$this->defaultsortdir=$defaultsortdir;
	}


	/**
	* @param int $editany
	* @return void
	*/
	public function setEditany($editany){
		$this->editany=$editany;
	}


	/**
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param string $intro
	* @return void
	*/
	public function setIntro($intro){
		$this->intro=$intro;
	}


	/**
	* @param string $jstemplate
	* @return void
	*/
	public function setJstemplate($jstemplate){
		$this->jstemplate=$jstemplate;
	}


	/**
	* @param string $listtemplate
	* @return void
	*/
	public function setListtemplate($listtemplate){
		$this->listtemplate=$listtemplate;
	}


	/**
	* @param string $listtemplatefooter
	* @return void
	*/
	public function setListtemplatefooter($listtemplatefooter){
		$this->listtemplatefooter=$listtemplatefooter;
	}


	/**
	* @param string $listtemplateheader
	* @return void
	*/
	public function setListtemplateheader($listtemplateheader){
		$this->listtemplateheader=$listtemplateheader;
	}


	/**
	* @param int $maxentries
	* @return void
	*/
	public function setMaxentries($maxentries){
		$this->maxentries=$maxentries;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param int $notification
	* @return void
	*/
	public function setNotification($notification){
		$this->notification=$notification;
	}


	/**
	* @param int $requiredentries
	* @return void
	*/
	public function setRequiredentries($requiredentries){
		$this->requiredentries=$requiredentries;
	}


	/**
	* @param int $requiredentriestoview
	* @return void
	*/
	public function setRequiredentriestoview($requiredentriestoview){
		$this->requiredentriestoview=$requiredentriestoview;
	}


	/**
	* @param int $ressarticles
	* @return void
	*/
	public function setRessarticles($ressarticles){
		$this->ressarticles=$ressarticles;
	}


	/**
	* @param string $rsstemplate
	* @return void
	*/
	public function setRsstemplate($rsstemplate){
		$this->rsstemplate=$rsstemplate;
	}


	/**
	* @param string $rsstitletemplate
	* @return void
	*/
	public function setRsstitletemplate($rsstitletemplate){
		$this->rsstitletemplate=$rsstitletemplate;
	}


	/**
	* @param int $scale
	* @return void
	*/
	public function setScale($scale){
		$this->scale=$scale;
	}


	/**
	* @param string $singletemplate
	* @return void
	*/
	public function setSingletemplate($singletemplate){
		$this->singletemplate=$singletemplate;
	}


	/**
	* @param int $timeavailablefrom
	* @return void
	*/
	public function setTimeavailablefrom($timeavailablefrom){
		$this->timeavailablefrom=$timeavailablefrom;
	}


	/**
	* @param int $timeavailableto
	* @return void
	*/
	public function setTimeavailableto($timeavailableto){
		$this->timeavailableto=$timeavailableto;
	}


	/**
	* @param int $timeviewfrom
	* @return void
	*/
	public function setTimeviewfrom($timeviewfrom){
		$this->timeviewfrom=$timeviewfrom;
	}


	/**
	* @param int $timeviewto
	* @return void
	*/
	public function setTimeviewto($timeviewto){
		$this->timeviewto=$timeviewto;
	}

}

?>
