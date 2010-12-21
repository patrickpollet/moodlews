<?php
/**
 * @author Patrick Pollet
 * @version $Id: libforum.php 37 2010-12-15 17:35:38Z ppollet $
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package MoodleWS
 */

require_once ("{$CFG->dirroot}/mod/forum/lib.php");

    /**
     * recusrive fix for missing properties required by SOAP encoding of forumPostRecord
     */
    function ws_forumposts_fix_children ($post) {
        $post->error='';
        if (!isset ($post->children))
            $post->children=array();
        else   foreach ($post->children as $child)
                ws_forumposts_fix_children($child);

    }


	function ws_recursive_get_posts($postid) {
        $sort="created ASC";
		$children = ws_get_records_select('forum_posts', "parent = " . $postid,null,$sort);

        $post=forum_get_post_full($postid);
        //must set these two property for correct SOAP encoding
        $post->children=array();
        $post->error='';

		if(is_array($children)) {
			foreach($children as $child) {
				$post->children [] = ws_recursive_get_posts($child->id);
			}
		}
		elseif($children) {
			$post->children[] = ws_recursive_get_posts($children->id);
		}

		return $post;
	}


    /**
     * takes care of different paramters bewteen Moodle 1.9 and 2.0
     * @return $discussionid
     */
    function ws_forum_add_discussion ($discussion,&$message) {
        global $CFG;
        $message='';
        if ($CFG->wspp_using_moodle20)
           return  forum_add_discussion($discussion, null,$message);
        else
           return  forum_add_discussion($discussion, $message);
    }


      /**
     * takes care of different paramters bewteen Moodle 1.9 and 2.0
     * @return $postid
     */
    function ws_forum_add_reply ($addpost,&$message) {
        global $CFG;
        $message='';
        if ($CFG->wspp_using_moodle20)
           return   forum_add_new_post($addpost, null, $message);
        else
           return  forum_add_new_post($addpost, $message);
    }


    function ws_forum_get_discussions ($cm,$limit) {
         if ($discussions= forum_get_discussions($cm, "d.timemodified DESC",true, -1, $limit)) {
        //return the fisrt post of that discussion without any children
            foreach ($discussions as $id=>$discussion) {
                $discussions[$id]->post=forum_get_post_full($id);
                $discussions[$id]->post->children= array();
                $discussions[$id]->post->error='';
            }
       }
       //$this->debug_output(print_r($discussions,true));
       return $discussions;
    }


    function ws_get_forum_posts($discussion) {
        global $CFG;
        $discussionid=$discussion->id;
         $CFG->get_forum_posts=3;  //finally I use My way ;-)
       switch ($CFG->get_forum_posts) {
           case 3:
               // caution not $discussion->id !!! but the id of the first post ...
               $ret=ws_recursive_get_posts($discussion->firstpost);
               // WS always return an array for consistency
               return array($ret);
           case 1:
               // attempt 1 : give too much output
               // every post is present nested if needed
               // actually we need only the first array item that has the original discussion
               // and the replies in its children, evnentually with children
               $sort="p.created ASC";
               $posts = forum_get_all_discussion_posts($discussionid, $sort, false);
               // we must add an empty attribute children if missing for posts which have none yet
               // otherwise SOAP encoding error ... object hasn't 'children' property
               ws_forumposts_fix_children($posts[$discussionid]);
               return array($posts[$discussionid]);

           case 2:
               // attemt 2 : does not return the parent discussion itself and answers are not nested (all children are empty ?)
               $sort= "ORDER BY p.created ASC"; //strange order by is required it this call
               $posts=forum_get_discussion_posts($discussionid, $sort, $discussion->forum);
               return $posts;
       }
    }




/**

	if(isset($_GET['forum'])) {
		$forums = get_records_select('forum', "id = " . optional_param('id'), 'id, type, intro');
		$forum = $forums[$_POST['id']];

		$discussions = get_records_select('forum_discussions', "forum = " . $forum->id);

		$discussions_array = array();
		foreach ($discussions as $discussion) {
			$original_post = get_record_select('forum_posts', "parent = 0 AND discussion = " . $discussion->id);
			$discussions_array[] = recursive_get_posts($original_post);
		}

		$return_array = array();
		$return_array["id"] = $_POST['id'];
		$return_array["discussions"] = $discussions_array;
		$return_array["type"] = $forum->type;
		$return_array["intro"] = $forum->intro;

		$json_output["forum"] = $return_array;
	}




	if(isset($_GET['newPost']))
	{

		if (!empty($USER->id)) {

			if($_GET['discussion_id'] > 0){
				$diss = $_GET['discussion_id'];
			}else{
				$full_diss = get_record_select('forum_discussions', "forum = ".optional_param('forum_id')." AND firstpost = " . optional_param('first_post_id'));
				$diss = $full_diss->id;
			}

			$obj = (object) array(
								  'subject' => optional_param('subject'),
								  'name' => optional_param('subject'),
								  'intro' => optional_param('message'),
								  'message' => optional_param('message'),
								  'course' => optional_param('course_id') ? optional_param('course_id') : 1,
								  'forum' => optional_param('forum_id'),
								  'discussion' => $diss,
								  'reply' => optional_param('post_id'),
								  'parent' => optional_param('post_id'),
								  'user_id' => $USER->id,
								  'MAX_FILE_SIZE' => 134217728,
								  'subscribe' => 1,
								  'format' => 0,
								  'mailnow' => 0
								  );

			$message = ''; //chaine contenant des erreurs eventuelles (upload)
			if($diss > 0)

			attention changé n Moodle 2.0
			function forum_add_discussion($discussion, $mform=null, &$message=null, $userid=null)
			function forum_add_new_post($post, $mform, &$message)
			{
				$id = forum_add_new_post($obj, $message);
			}else{
				$id = forum_add_discussion($obj, $message);
			}

		}

	}

	if(isset($_GET['searchForums']))
	{
		$search_results = array();
		$ref = '';
		if($posts = forum_search_posts(array(optional_param('key')), optional_param('course_id'), 0, 50, $ref))
		{
			foreach($posts as $post)
			{
				$search_results[] = get_object_vars($post);
			}
		}

		$json_output['search_forums'] = $search_results;
	}
**/
?>
