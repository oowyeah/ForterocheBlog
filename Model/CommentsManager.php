<?php
require_once('Manager.php');

class CommentsManager extends Manager
{
	public function getReportedComments()
	{
		$db = $this->dbConnect();
		$req = $db->query('	SELECT c.id comment_Id, c.userId, c.date, c.content, c.reported, u.id, u.userName
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
}

