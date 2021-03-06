<?php
require_once('Manager.php');

class CommentsManager extends Manager
{
	public function getReportedComments()
	{
		$db = $this->dbConnect();
		$req = $db->query('	SELECT c.id comment_Id, c.userId, DATE_FORMAT(c.date,
							\'%d/%m/%Y\') AS date, c.content, c.reported, u.id, u.userName
							FROM comments c
							INNER JOIN users u
							ON c.userId = u.id
							WHERE c.reported = 1 ORDER BY c.date DESC');
		return $req;
	}
	public function updateStatus($commentId, $reported)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('	UPDATE comments SET reported = ?
								WHERE id = ?');
		$req->execute(array($reported, $commentId));
		return $req;
	}
	public function removeComment($commentId)
	{

		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM comments WHERE id = ?');
		$req->execute(array($commentId));
		return $req;
	
	}
	public function getLastComments($chapterId, $commentsNbr)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('	SELECT c.id commentId, c.userId, u.userName, c.chapterId, DATE_FORMAT(c.date,
								\'%d/%m/%Y\') AS date, c.content
								FROM comments c
								INNER JOIN users u
								ON c.userId = u.id
								WHERE c.chapterId = ?
								ORDER BY commentId DESC LIMIT ' .$commentsNbr);
		$req->execute(array($chapterId));
		return $req;
	}
	public function getComments($chapterId)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('	SELECT c.id commentId, c.userId, u.userName, c.chapterId, DATE_FORMAT(c.date,
								\'%d/%m/%Y\') AS date, c.content
								FROM comments c
								INNER JOIN users u
								ON c.userId = u.id
								WHERE c.chapterId = ?
								ORDER BY commentId DESC');
		$req->execute(array($chapterId));
		return $req;
	}
	public function addComment($postData)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('	INSERT INTO comments (userId, chapterId, content, date)
								VALUES(?, ?, ?, NOW())');
		$req->execute(array($postData['userId'], $postData['chapterId'], $postData['content'])) or die('problem');
		return $req;
	}
}

