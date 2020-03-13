<?php

class Manager
{
	protected function dbConnect()
	{
			$db = new PDO('mysql:host=localhost;dbname=db_project4;charset=utf8', 'root', '');
			return $db;
	}
}