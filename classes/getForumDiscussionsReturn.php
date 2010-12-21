<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getForumDiscussionsReturn {
	/** 
	* @var forumDiscussionRecord[]
	*/
	public $forumDiscussions;

	/**
	* default constructor for class getForumDiscussionsReturn
	* @return getForumDiscussionsReturn
	*/	 public function getForumDiscussionsReturn() {
		 $this->forumDiscussions=array();
	}
	/* get accessors */

	/**
	* @return forumDiscussionRecord[]
	*/
	public function getForumDiscussions(){
		 return $this->forumDiscussions;
	}

	/*set accessors */

	/**
	* @param forumDiscussionRecord[] $forumDiscussions
	* @return void
	*/
	public function setForumDiscussions($forumDiscussions){
		$this->forumDiscussions=$forumDiscussions;
	}

}

?>
