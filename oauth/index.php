<!doctype html>
<html>
<head>
<title>note2site</title>
<meta charset="utf8" />
</head>
<body>
<?php
require('ynote_client.php');
require('ynote_parse.php');
	$oauth_consumer_key = "780b8bb560897a357c78de3e85b88cd9";
	$oauth_consumer_secret = "82c911c61bb3067058febaea94007a10";
	$oauth_access_token = 'ec4087f1c03661637bc148f1f4a665bb';
	$oauth_access_secret = '598301bc3f0e4187bcb0b26482a06eb1';

	$client = new YnoteClient($oauth_consumer_key, $oauth_consumer_secret);

/*	// getUserInfo
	$user_info_response = $client->getUserInfo($oauth_access_token, $oauth_access_secret);
	echo 'userinfo:<br />';printUserInfo(parseUserInfo($user_info_response));
*/
$list_notebooks_response = $client->listNotebooks($oauth_access_token, $oauth_access_secret);
$notebooks = parseNotebooks($list_notebooks_response);
foreach ($notebooks as $notebook){
	echo $notebook->name.' has '.$notebook->notes_num.' notes:<br />';
	$list_notes_response = $client->listNotes($oauth_access_token, $oauth_access_secret, $notebook->path);
	$notes = parseNotes($list_notes_response);
	foreach($notes as $notePath){
		$get_note_response = $client->getNote($oauth_access_token, $oauth_access_secret, $notePath);
		$note = parseNote($get_note_response);
		echo $note->title.'<br />';
	}
	echo '<br />';
}
/*
	// listNotebooks
    echo '<br /><br />';
    $list_notebook_response = $client->listNotebooks($oauth_access_token, $oauth_access_secret);
    echo 'notebooks:<br />';printNotebooks(parseNotebooks($list_notebook_response));

	// listNotes
    echo '<br /><br />';
    $list_notes_response = $client->listNotes($oauth_access_token, $oauth_access_secret, "/VCZNeXbDfG8");
    echo 'notes:<br />';printNotes(parseNotes($list_notes_response));

	// getNote
    echo '<br /><br />';
    $get_note_response = $client->getNote($oauth_access_token, $oauth_access_secret, "/VCZNeXbDfG8/C3635B99840C4D2FA0D8C466F87B3D2E");
    echo 'note:<br />';printNote(parseNote($get_note_response));
*/	
/*	// getAuthorizedDownloadLink
    echo '<br />';
    $download_attachment_response = $client->getAuthorizedDownloadLink($oauth_access_token, $oauth_access_secret, "http://note.youdao.com/yws/open/resource/download/739/7CCE9F2C0E734CC4A7F3EC96EA8BE440");
    echo '<a href="'.$download_attachment_response.'">Download</a>';
*/
?>
</body>
</html>
