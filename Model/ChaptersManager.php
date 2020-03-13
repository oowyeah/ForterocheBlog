<?php
require_once('Manager.php');

class ChaptersManager extends Manager
{
	public function addChapter($postData)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('	INSERT INTO chapters (title, date, content)
								VALUES (?, NOW(), ?)');
		$req->execute(array($postData['title'], $postData['content']));

		return $req;
	}
}
