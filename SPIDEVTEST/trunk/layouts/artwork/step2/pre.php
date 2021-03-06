<?php
$access = array("system","campaigns");
require_once(MODULES.'mod_authorise.php');

$artworkID = (isset($_GET['id'])) ? $_GET['id'] : 0;
$artwork_row = $DB->get_artwork_info($artworkID);
if($artwork_row === false) access_denied();
$campaignID = $artwork_row['campaignID'];
$campaignName = $artwork_row['campaignName'];
$artworkName = $artwork_row['artworkName'];
if(!$DB->check_campaign_acl($campaignID,$_SESSION['companyID'],$_SESSION['userID'])) access_denied();

$task_langs = !empty($_SESSION['task_langs']) ? $_SESSION['task_langs'] : "";
$task_deadline = !empty($_SESSION['task_deadline']) ? $_SESSION['task_deadline'] : "";
$agencyID = !empty($_SESSION['agencyID']) ? $_SESSION['agencyID'] : 0;
$agentID = !empty($_SESSION['agentID']) ? $_SESSION['agentID'] : 0;

// build tasks types for form
$ttq_html = '';
$task_types_query = mysql_query("SELECT * FROM task_types") or die(mysql_error());
while($row = mysql_fetch_array($task_types_query)) {
	if($row['def'] == 1) {
		$ttq_html .= '<option value="'.$row['id'].'" selected="selected">'.$row['title'].'</option>\n';
	} else {
		$ttq_html .= '<option value="'.$row['id'].'">'.$row['title'].'</option>'."\n";
	}
}

// build list of multi-translation paragraphs
$mt_html = '';
$mt_paras_query = mysql_query("SELECT * FROM paragraphs WHERE ArtworkID = '".$artworkID."' AND mt_flag ='1'") or die(mysql_error());
while($row = mysql_fetch_array($mt_paras_query)) {
	$mt_html .= '<option value="'.$row['uID'].'">'.substr($row['ParaText'], 0, 45).'</option>'."\n";
}


if(!empty($_POST['form'])) {

	if($_POST["form"] == "save") {
		if(!empty($_POST['desiredLanguageID'])) {
			$target_lang_id = (int)$_POST['desiredLanguageID'];

			$translators = array();
			$translatorID = $_POST['translatorID'];
			$translators[$translatorID]['deadline'] = $_POST['tdeadline'][$translatorID];

			$proofreaders = array();
			if(!empty($_POST['proofreaderID']))
			foreach($_POST['proofreaderID'] as $proofreaderID) {
				$proofreaders[$proofreaderID]['deadline'] = $_POST['pdeadline'][$proofreaderID];
				$proofreaders[$proofreaderID]['order'] = $_POST['order'][$proofreaderID];
			}

			$_SESSION['tasks'][$target_lang_id] = array(
				"taskTypeID"	=> $_POST['taskType'],
				"translators" => $translators,
				"proofreaders" => $proofreaders,
				"deadline" => $_POST['deadline'],
				"notes" => $_POST['notes'],
				"storyGroup" => $_POST['storyGroup'],
			);
			
			if( isset($_POST['paraID']) ) {
				$_SESSION['tasks'][$target_lang_id]['paraID'] = $_POST['paraID'];
			}

			unset($_SESSION['translators']);
			unset($_SESSION['proofreaders']);
		}
		header("Location: index.php?layout=artwork&id=$artworkID&task=step2");
	}
	
	if($_POST["form"] == "next") {
		$task_langs = "";
		if(!empty($_POST['targetLangID'])) {
			foreach($_POST['targetLangID'] as $k=>$v) {
				$task_langs .= "$v,";
			}
			$task_langs = trim($task_langs, ",");
			$_SESSION['task_langs'] = $task_langs;
		}
		if(!empty($_POST['deadline'])) $_SESSION['task_deadline'] = $_POST['deadline'];
		if(!empty($_POST['agencyID'])) $_SESSION['agencyID'] = $_POST['agencyID'];
		if(!empty($_POST['agentID'])) $_SESSION['agentID'] = $_POST['agentID'];

		header("Location: index.php?layout=artwork&id=$artworkID&task=step3");
	}

	exit;

}