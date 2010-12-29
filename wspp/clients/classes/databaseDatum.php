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
	* @var integer
	*/
	public $id;
	/** 
	* @var integer
	*/
	public $course;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $intro;
	/** 
	* @var integer
	*/
	public $comments;
	/** 
	* @var integer
	*/
	public $timeavailablefrom;
	/** 
	* @var integer
	*/
	public $timeavailableto;
	/** 
	* @var integer
	*/
	public $timeviewfrom;
	/** 
	* @var integer
	*/
	public $timeviewto;
	/** 
	* @var integer
	*/
	public $requiredentries;
	/** 
	* @var integer
	*/
	public $requiredentriestoview;
	/** 
	* @var integer
	*/
	public $maxentries;
	/** 
	* @var integer
	*/
	public $ressarticles;
	/** 
	* @var string
	*/
	public $singletemplate;
	/** 
	* @var string
	*/
	public $listtemplate;
	/** 
	* @var string
	*/
	public $listtemplateheader;
	/** 
	* @var string
	*/
	public $listtemplatefooter;
	/** 
	* @var string
	*/
	public $addtemplatee;
	/** 
	* @var string
	*/
	public $rsstemplate;
	/** 
	* @var string
	*/
	public $rsstitletemplate;
	/** 
	* @var string
	*/
	public $csstemplate;
	/** 
	* @var string
	*/
	public $jstemplate;
	/** 
	* @var string
	*/
	public $asearchtemplate;
	/** 
	* @var integer
	*/
	public $approval;
	/** 
	* @var integer
	*/
	public $scale;
	/** 
	* @var integer
	*/
	public $assessed;
	/** 
	* @var integer
	*/
	public $defaultsort;
	/** 
	* @var integer
	*/
	public $defaultsortdir;
	/** 
	* @var integer
	*/
	public $editany;
	/** 
	* @var integer
	*/
	public $notification;

	/**
	* default constructor for class databaseDatum
	* @param string $action
	* @param integer $id
	* @param integer $course
	* @param string $name
	* @param string $intro
	* @param integer $comments
	* @param integer $timeavailablefrom
	* @param integer $timeavailableto
	* @param integer $timeviewfrom
	* @param integer $timeviewto
	* @param integer $requiredentries
	* @param integer $requiredentriestoview
	* @param integer $maxentries
	* @param integer $ressarticles
	* @param string $singletemplate
	* @param string $listtemplate
	* @param string $listtemplateheader
	* @param string $listtemplatefooter
	* @param string $addtemplatee
	* @param string $rsstemplate
	* @param string $rsstitletemplate
	* @param string $csstemplate
	* @param string $jstemplate
	* @param string $asearchtemplate
	* @param integer $approval
	* @param integer $scale
	* @param integer $assessed
	* @param integer $defaultsort
	* @param integer $defaultsortdir
	* @param integer $editany
	* @param integer $notification
	* @return databaseDatum
	*/
	 public function databaseDatum($action='',$id=0,$course=0,$name='',$intro='',$comments=0,$timeavailablefrom=0,$timeavailableto=0,$timeviewfrom=0,$timeviewto=0,$requiredentries=0,$requiredentriestoview=0,$maxentries=0,$ressarticles=0,$singletemplate='',$listtemplate='',$listtemplateheader='',$listtemplatefooter='',$addtemplatee='',$rsstemplate='',$rsstitletemplate='',$csstemplate='',$jstemplate='',$asearchtemplate='',$approval=0,$scale=0,$assessed=0,$defaultsort=0,$defaultsortdir=0,$editany=0,$notification=0){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->course=$course   ;
		 $this->name=$name   ;
		 $this->intro=$intro   ;
		 $this->comments=$comments   ;
		 $this->timeavailablefrom=$timeavailablefrom   ;
		 $this->timeavailableto=$timeavailableto   ;
		 $this->timeviewfrom=$timeviewfrom   ;
		 $this->timeviewto=$timeviewto   ;
		 $this->requiredentries=$requiredentries   ;
		 $this->requiredentriestoview=$requiredentriestoview   ;
		 $this->maxentries=$maxentries   ;
		 $this->ressarticles=$ressarticles   ;
		 $this->singletemplate=$singletemplate   ;
		 $this->listtemplate=$listtemplate   ;
		 $this->listtemplateheader=$listtemplateheader   ;
		 $this->listtemplatefooter=$listtemplatefooter   ;
		 $this->addtemplatee=$addtemplatee   ;
		 $this->rsstemplate=$rsstemplate   ;
		 $this->rsstitletemplate=$rsstitletemplate   ;
		 $this->csstemplate=$csstemplate   ;
		 $this->jstemplate=$jstemplate   ;
		 $this->asearchtemplate=$asearchtemplate   ;
		 $this->approval=$approval   ;
		 $this->scale=$scale   ;
		 $this->assessed=$assessed   ;
		 $this->defaultsort=$defaultsort   ;
		 $this->defaultsortdir=$defaultsortdir   ;
		 $this->editany=$editany   ;
		 $this->notification=$notification   ;
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
	* @return integer
	*/
	public function getCourse(){
		 return $this->course;
	}


	/**
	* @return string
	*/
	public function getName(){
		 return $this->name;
	}


	/**
	* @return string
	*/
	public function getIntro(){
		 return $this->intro;
	}


	/**
	* @return integer
	*/
	public function getComments(){
		 return $this->comments;
	}


	/**
	* @return integer
	*/
	public function getTimeavailablefrom(){
		 return $this->timeavailablefrom;
	}


	/**
	* @return integer
	*/
	public function getTimeavailableto(){
		 return $this->timeavailableto;
	}


	/**
	* @return integer
	*/
	public function getTimeviewfrom(){
		 return $this->timeviewfrom;
	}


	/**
	* @return integer
	*/
	public function getTimeviewto(){
		 return $this->timeviewto;
	}


	/**
	* @return integer
	*/
	public function getRequiredentries(){
		 return $this->requiredentries;
	}


	/**
	* @return integer
	*/
	public function getRequiredentriestoview(){
		 return $this->requiredentriestoview;
	}


	/**
	* @return integer
	*/
	public function getMaxentries(){
		 return $this->maxentries;
	}


	/**
	* @return integer
	*/
	public function getRessarticles(){
		 return $this->ressarticles;
	}


	/**
	* @return string
	*/
	public function getSingletemplate(){
		 return $this->singletemplate;
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
	public function getListtemplateheader(){
		 return $this->listtemplateheader;
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
	public function getAddtemplatee(){
		 return $this->addtemplatee;
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
	* @return string
	*/
	public function getCsstemplate(){
		 return $this->csstemplate;
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
	public function getAsearchtemplate(){
		 return $this->asearchtemplate;
	}


	/**
	* @return integer
	*/
	public function getApproval(){
		 return $this->approval;
	}


	/**
	* @return integer
	*/
	public function getScale(){
		 return $this->scale;
	}


	/**
	* @return integer
	*/
	public function getAssessed(){
		 return $this->assessed;
	}


	/**
	* @return integer
	*/
	public function getDefaultsort(){
		 return $this->defaultsort;
	}


	/**
	* @return integer
	*/
	public function getDefaultsortdir(){
		 return $this->defaultsortdir;
	}


	/**
	* @return integer
	*/
	public function getEditany(){
		 return $this->editany;
	}


	/**
	* @return integer
	*/
	public function getNotification(){
		 return $this->notification;
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
	* @param integer $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $intro
	* @return void
	*/
	public function setIntro($intro){
		$this->intro=$intro;
	}


	/**
	* @param integer $comments
	* @return void
	*/
	public function setComments($comments){
		$this->comments=$comments;
	}


	/**
	* @param integer $timeavailablefrom
	* @return void
	*/
	public function setTimeavailablefrom($timeavailablefrom){
		$this->timeavailablefrom=$timeavailablefrom;
	}


	/**
	* @param integer $timeavailableto
	* @return void
	*/
	public function setTimeavailableto($timeavailableto){
		$this->timeavailableto=$timeavailableto;
	}


	/**
	* @param integer $timeviewfrom
	* @return void
	*/
	public function setTimeviewfrom($timeviewfrom){
		$this->timeviewfrom=$timeviewfrom;
	}


	/**
	* @param integer $timeviewto
	* @return void
	*/
	public function setTimeviewto($timeviewto){
		$this->timeviewto=$timeviewto;
	}


	/**
	* @param integer $requiredentries
	* @return void
	*/
	public function setRequiredentries($requiredentries){
		$this->requiredentries=$requiredentries;
	}


	/**
	* @param integer $requiredentriestoview
	* @return void
	*/
	public function setRequiredentriestoview($requiredentriestoview){
		$this->requiredentriestoview=$requiredentriestoview;
	}


	/**
	* @param integer $maxentries
	* @return void
	*/
	public function setMaxentries($maxentries){
		$this->maxentries=$maxentries;
	}


	/**
	* @param integer $ressarticles
	* @return void
	*/
	public function setRessarticles($ressarticles){
		$this->ressarticles=$ressarticles;
	}


	/**
	* @param string $singletemplate
	* @return void
	*/
	public function setSingletemplate($singletemplate){
		$this->singletemplate=$singletemplate;
	}


	/**
	* @param string $listtemplate
	* @return void
	*/
	public function setListtemplate($listtemplate){
		$this->listtemplate=$listtemplate;
	}


	/**
	* @param string $listtemplateheader
	* @return void
	*/
	public function setListtemplateheader($listtemplateheader){
		$this->listtemplateheader=$listtemplateheader;
	}


	/**
	* @param string $listtemplatefooter
	* @return void
	*/
	public function setListtemplatefooter($listtemplatefooter){
		$this->listtemplatefooter=$listtemplatefooter;
	}


	/**
	* @param string $addtemplatee
	* @return void
	*/
	public function setAddtemplatee($addtemplatee){
		$this->addtemplatee=$addtemplatee;
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
	* @param string $csstemplate
	* @return void
	*/
	public function setCsstemplate($csstemplate){
		$this->csstemplate=$csstemplate;
	}


	/**
	* @param string $jstemplate
	* @return void
	*/
	public function setJstemplate($jstemplate){
		$this->jstemplate=$jstemplate;
	}


	/**
	* @param string $asearchtemplate
	* @return void
	*/
	public function setAsearchtemplate($asearchtemplate){
		$this->asearchtemplate=$asearchtemplate;
	}


	/**
	* @param integer $approval
	* @return void
	*/
	public function setApproval($approval){
		$this->approval=$approval;
	}


	/**
	* @param integer $scale
	* @return void
	*/
	public function setScale($scale){
		$this->scale=$scale;
	}


	/**
	* @param integer $assessed
	* @return void
	*/
	public function setAssessed($assessed){
		$this->assessed=$assessed;
	}


	/**
	* @param integer $defaultsort
	* @return void
	*/
	public function setDefaultsort($defaultsort){
		$this->defaultsort=$defaultsort;
	}


	/**
	* @param integer $defaultsortdir
	* @return void
	*/
	public function setDefaultsortdir($defaultsortdir){
		$this->defaultsortdir=$defaultsortdir;
	}


	/**
	* @param integer $editany
	* @return void
	*/
	public function setEditany($editany){
		$this->editany=$editany;
	}


	/**
	* @param integer $notification
	* @return void
	*/
	public function setNotification($notification){
		$this->notification=$notification;
	}

}

?>
