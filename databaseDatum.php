<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class databaseDatum {
	/** 
	* @var  string
	*/
	public $action;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  integer
	*/
	public $course;
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $intro;
	/** 
	* @var  integer
	*/
	public $comments;
	/** 
	* @var  integer
	*/
	public $timeavailablefrom;
	/** 
	* @var  integer
	*/
	public $timeavailableto;
	/** 
	* @var  integer
	*/
	public $timeviewfrom;
	/** 
	* @var  integer
	*/
	public $timeviewto;
	/** 
	* @var  integer
	*/
	public $requiredentries;
	/** 
	* @var  integer
	*/
	public $requiredentriestoview;
	/** 
	* @var  integer
	*/
	public $maxentries;
	/** 
	* @var  integer
	*/
	public $ressarticles;
	/** 
	* @var  string
	*/
	public $singletemplate;
	/** 
	* @var  string
	*/
	public $listtemplate;
	/** 
	* @var  string
	*/
	public $listtemplateheader;
	/** 
	* @var  string
	*/
	public $listtemplatefooter;
	/** 
	* @var  string
	*/
	public $addtemplatee;
	/** 
	* @var  string
	*/
	public $rsstemplate;
	/** 
	* @var  string
	*/
	public $rsstitletemplate;
	/** 
	* @var  string
	*/
	public $csstemplate;
	/** 
	* @var  string
	*/
	public $jstemplate;
	/** 
	* @var  string
	*/
	public $asearchtemplate;
	/** 
	* @var  integer
	*/
	public $approval;
	/** 
	* @var  integer
	*/
	public $scale;
	/** 
	* @var  integer
	*/
	public $assessed;
	/** 
	* @var  integer
	*/
	public $defaultsort;
	/** 
	* @var  integer
	*/
	public $defaultsortdir;
	/** 
	* @var  integer
	*/
	public $editany;
	/** 
	* @var  integer
	*/
	public $notification;
	 public function databaseDatum() {
		 $this->action='';
		 $this->id=0;
		 $this->course=0;
		 $this->name='';
		 $this->intro='';
		 $this->comments=0;
		 $this->timeavailablefrom=0;
		 $this->timeavailableto=0;
		 $this->timeviewfrom=0;
		 $this->timeviewto=0;
		 $this->requiredentries=0;
		 $this->requiredentriestoview=0;
		 $this->maxentries=0;
		 $this->ressarticles=0;
		 $this->singletemplate='';
		 $this->listtemplate='';
		 $this->listtemplateheader='';
		 $this->listtemplatefooter='';
		 $this->addtemplatee='';
		 $this->rsstemplate='';
		 $this->rsstitletemplate='';
		 $this->csstemplate='';
		 $this->jstemplate='';
		 $this->asearchtemplate='';
		 $this->approval=0;
		 $this->scale=0;
		 $this->assessed=0;
		 $this->defaultsort=0;
		 $this->defaultsortdir=0;
		 $this->editany=0;
		 $this->notification=0;
	}
	/* get accessors */
	public function getAction(){
		 return $this->action;
	}

	public function getId(){
		 return $this->id;
	}

	public function getCourse(){
		 return $this->course;
	}

	public function getName(){
		 return $this->name;
	}

	public function getIntro(){
		 return $this->intro;
	}

	public function getComments(){
		 return $this->comments;
	}

	public function getTimeavailablefrom(){
		 return $this->timeavailablefrom;
	}

	public function getTimeavailableto(){
		 return $this->timeavailableto;
	}

	public function getTimeviewfrom(){
		 return $this->timeviewfrom;
	}

	public function getTimeviewto(){
		 return $this->timeviewto;
	}

	public function getRequiredentries(){
		 return $this->requiredentries;
	}

	public function getRequiredentriestoview(){
		 return $this->requiredentriestoview;
	}

	public function getMaxentries(){
		 return $this->maxentries;
	}

	public function getRessarticles(){
		 return $this->ressarticles;
	}

	public function getSingletemplate(){
		 return $this->singletemplate;
	}

	public function getListtemplate(){
		 return $this->listtemplate;
	}

	public function getListtemplateheader(){
		 return $this->listtemplateheader;
	}

	public function getListtemplatefooter(){
		 return $this->listtemplatefooter;
	}

	public function getAddtemplatee(){
		 return $this->addtemplatee;
	}

	public function getRsstemplate(){
		 return $this->rsstemplate;
	}

	public function getRsstitletemplate(){
		 return $this->rsstitletemplate;
	}

	public function getCsstemplate(){
		 return $this->csstemplate;
	}

	public function getJstemplate(){
		 return $this->jstemplate;
	}

	public function getAsearchtemplate(){
		 return $this->asearchtemplate;
	}

	public function getApproval(){
		 return $this->approval;
	}

	public function getScale(){
		 return $this->scale;
	}

	public function getAssessed(){
		 return $this->assessed;
	}

	public function getDefaultsort(){
		 return $this->defaultsort;
	}

	public function getDefaultsortdir(){
		 return $this->defaultsortdir;
	}

	public function getEditany(){
		 return $this->editany;
	}

	public function getNotification(){
		 return $this->notification;
	}

	/*set accessors */
	public function setAction($action){
		$this->action=$action;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setCourse($course){
		$this->course=$course;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setIntro($intro){
		$this->intro=$intro;
	}

	public function setComments($comments){
		$this->comments=$comments;
	}

	public function setTimeavailablefrom($timeavailablefrom){
		$this->timeavailablefrom=$timeavailablefrom;
	}

	public function setTimeavailableto($timeavailableto){
		$this->timeavailableto=$timeavailableto;
	}

	public function setTimeviewfrom($timeviewfrom){
		$this->timeviewfrom=$timeviewfrom;
	}

	public function setTimeviewto($timeviewto){
		$this->timeviewto=$timeviewto;
	}

	public function setRequiredentries($requiredentries){
		$this->requiredentries=$requiredentries;
	}

	public function setRequiredentriestoview($requiredentriestoview){
		$this->requiredentriestoview=$requiredentriestoview;
	}

	public function setMaxentries($maxentries){
		$this->maxentries=$maxentries;
	}

	public function setRessarticles($ressarticles){
		$this->ressarticles=$ressarticles;
	}

	public function setSingletemplate($singletemplate){
		$this->singletemplate=$singletemplate;
	}

	public function setListtemplate($listtemplate){
		$this->listtemplate=$listtemplate;
	}

	public function setListtemplateheader($listtemplateheader){
		$this->listtemplateheader=$listtemplateheader;
	}

	public function setListtemplatefooter($listtemplatefooter){
		$this->listtemplatefooter=$listtemplatefooter;
	}

	public function setAddtemplatee($addtemplatee){
		$this->addtemplatee=$addtemplatee;
	}

	public function setRsstemplate($rsstemplate){
		$this->rsstemplate=$rsstemplate;
	}

	public function setRsstitletemplate($rsstitletemplate){
		$this->rsstitletemplate=$rsstitletemplate;
	}

	public function setCsstemplate($csstemplate){
		$this->csstemplate=$csstemplate;
	}

	public function setJstemplate($jstemplate){
		$this->jstemplate=$jstemplate;
	}

	public function setAsearchtemplate($asearchtemplate){
		$this->asearchtemplate=$asearchtemplate;
	}

	public function setApproval($approval){
		$this->approval=$approval;
	}

	public function setScale($scale){
		$this->scale=$scale;
	}

	public function setAssessed($assessed){
		$this->assessed=$assessed;
	}

	public function setDefaultsort($defaultsort){
		$this->defaultsort=$defaultsort;
	}

	public function setDefaultsortdir($defaultsortdir){
		$this->defaultsortdir=$defaultsortdir;
	}

	public function setEditany($editany){
		$this->editany=$editany;
	}

	public function setNotification($notification){
		$this->notification=$notification;
	}

}

?>
