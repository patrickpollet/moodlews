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
     *
     */
    function ws_forumposts_fix_children ($post) {
    	global $CFG;
        $post->error='';
        if (!$CFG->wspp_using_moodle20) {
           	//added in Moodle 1.9 answer to be 'compatible' with Moodle 2.0 and WSDL declaration
           	$post->messageformat=$post->format;
           	$post->messagetrust='';
        }
        if (!isset ($post->children))
            $post->children=array();
        else   foreach ($post->children as $child)
                ws_forumposts_fix_children($child);

    }


	function ws_recursive_get_posts($postid) {
		global $CFG;
        $sort="created ASC";
		$children = ws_get_records_select('forum_posts', "parent = " . $postid,null,$sort);

        $post=forum_get_post_full($postid);
        //must set these two property for correct SOAP encoding
        $post->children=array();
        $post->error='';
        if (!$CFG->wspp_using_moodle20) {
           	//added in Moodle 1.9 answer to be 'compatible' with Moodle 2.0 and WSDL declaration
           	$post->messageformat=$post->format;
           	$post->messagetrust='';
        }
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
    	global $CFG;
         if ($discussions= forum_get_discussions($cm, "d.timemodified DESC",true, -1, $limit)) {
        //return the first post of that discussion without any children
            foreach ($discussions as $id=>$discussion) {
                $discussions[$id]->post=forum_get_post_full($id);
                $discussions[$id]->post->children= array();
                $discussions[$id]->post->error='';
                if (!$CFG->wspp_using_moodle20) {
                	//added in Moodle 1.9 answer to be 'compatible' with Moodle 2.0 and WSDL declaration
                	$discussions[$id]->post->messageformat=$discussions[$id]->post->format;
                	$discussions[$id]->post->messagetrust='';
                }
            }
       }
       return array_values( $discussions);  // required for REST clients using json
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

?>
