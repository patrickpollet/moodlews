<?php


/**
 * @author Patrick Pollet
 * @version $Id: entete.php 288 2008-06-18 23:21:13Z ppollet $
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package c2ipf
 */

/**
 * export questions of the quiz into the given format
 */
function ws_libquiz_export($quiz, $format) {
	global $CFG;
	require_once ($CFG->dirroot . '/mod/quiz/locallib.php');

	// load parent class for import/export
	require_once ($CFG->dirroot . "/question/format.php");
	// and then the class for the selected format
	require_once ($CFG->dirroot . "/question/format/$format/format.php");

	$classname = "qformat_$format";
	if (!$qformat = new $classname ())
		return '';
	;
	$qformat->set_can_access_backupdata(0);

	$questionlist = quiz_questions_in_quiz($quiz->questions);

	$sql = "SELECT q.*, i.grade AS maxgrade, i.id AS instance" .
	"  FROM {$CFG->prefix}question q," .
	"       {$CFG->prefix}quiz_question_instances i" .
	" WHERE i.quiz = '$quiz->id' AND q.id = i.question" .
	"   AND q.id IN ($questionlist)";

	// Load the questions
	if (!$questions = get_records_sql($sql)) {
		return "";
	}
	//$qformat->setQuestions($questions);

	$ret = "";
	foreach ($questions as $question) {
		//$ret .= $question->name . ',';
		// do not export hidden questions
		if (!empty ($question->hidden)) {
			continue;
		}

		// do not export random questions
		if ($question->qtype == RANDOM) {
			continue;
		}
		$questiontype = $QTYPES[$question->qtype];
		//fetch answers and spcific options
		$questiontype->get_question_options($question);
		$ret .= $qformat->writequestion($question);
	}

	return $qformat->presave_process($ret);

	//return "hello pp";

}

/**
 * check that the requested export format is available
 */
function ws_libquiz_is_supported_format($format) {

	global $CFG;

	return is_readable($CFG->dirroot . "/question/format/$format/format.php");
}
?>
