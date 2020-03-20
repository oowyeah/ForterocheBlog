<?php
require_once("Manager.php");

class UsersManager extends Manager
{

	public function getLogin($postData)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM users WHERE userName = ?');
		$req->execute(array($postData['username']));

		return $req;	
	}
	public function addUser($postData)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('	INSERT INTO users(userName, password)
								VALUES (?, ?)');
		$req->execute(array($postData['username'], $postData['password']));
		return $req;	
	}




}