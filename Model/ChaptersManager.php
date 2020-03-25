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
	public function getChaptersList()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM chapters ORDER BY id ASC');
		return $req;
	}
	public function getChapter($chapterId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('	SELECT id, title, content, DATE_FORMAT(date,
								\'%d/%m/%Y\') AS date FROM chapters
								WHERE id = ?');
		$req->execute(array($chapterId));
		return $req;

	}
	public function updateChapter($postData)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('	UPDATE chapters SET title = ?, content = ?
								WHERE id = ?');
		$req->execute(array($postData['title'], $postData['content'], $postData['id']));
		return $req;
	}
	public function removeChapter($chapterId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('	DELETE chapters, comments FROM chapters 
								LEFT JOIN comments
								ON comments.chapterId = chapters.id 
								WHERE chapters.id = ?');
		$req->execute(array($chapterId));
		return $req;
	}
}