<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getForumPostsReturn {
	/** 
	* @var forumPostRecord[]
	*/
	public $forumPosts;

	/**
	* default constructor for class getForumPostsReturn
	* @return getForumPostsReturn
	*/	 public function getForumPostsReturn() {
		 $this->forumPosts=array();
	}
	/* get accessors */

	/**
	* @return forumPostRecord[]
	*/
	public function getForumPosts(){
		 return $this->forumPosts;
	}

	/*set accessors */

	/**
	* @param forumPostRecord[] $forumPosts
	* @return void
	*/
	public function setForumPosts($forumPosts){
		$this->forumPosts=$forumPosts;
	}

}

?>
