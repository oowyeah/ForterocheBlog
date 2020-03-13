<?php

require_once("Model/UsersManager.php");
require_once("Model/ChaptersManager.php");

function whoIsConnected()
{
	session_start();
	if(isset($_SESSION['username']) && isset($_SESSION['admin']))
	{
		if($_SESSION['admin'] == 1)
		{
			return 'admin';
		}
		else
		{
			return 'user';
		}
	}
	else
	{
		return false;
	}
}
function getMessage($messageCode)
{
	switch ($messageCode) {
	    case 0:
	        return "Authentification réussie !";
	        break;
	    case 1:
	        return "Vous êtes déconnecté(e) !";
	        break;
	    case 2:
	        return "Inscription réussie !";
	        break;
	    case 3:
	        return "Chapitre ajouté !";
	        break;	   
	}
}

function homeView($messageCode)
{
	$whoIsConnected = whoIsConnected();

	if(isset($messageCode))
	{
		$message = getMessage($messageCode);
	}
	require('View/homeView.php');
}

function signInPage()
{
	$whoIsConnected = whoIsConnected();
	require('View/signInView.php');
}

function signIn($postData)
{
	$usersManager = new UsersManager();
	$login = $usersManager->getLogin($postData);
	if($login->rowCount())
	{
		$db_data = $login->fetch();
		if(password_verify($postData['password'], $db_data['password']))
		{
			session_start();
			$_SESSION['username'] = $db_data['userName'];
			$_SESSION['admin'] = $db_data['admin'];
			header('Location: index.php?message=0');
		}
		else
		{
			throw new Exception("Identifiants incorrects !");
		}
	}
	else
	{
		throw new Exception("Identifiants incorrects !");
	}
}
function signOut()
{
	session_start();

	$_SESSION = array();
	session_destroy();

	setcookie('login', '');
	setcookie('pass_hache', '');

	header('Location: index.php?message=1');

}
function signUpPage()
{
	$whoIsConnected = whoIsConnected();
	require('View/signUpView.php');
}
function signUp($postData)
{
	$usersManager = new UsersManager();
	$login = $usersManager->getLogin($postData);
	if($login->rowCount())
	{
		throw new Exception("Le nom d'utilisateur est déjà pris !");
	}
	else
	{
		$postData['username'] = strip_tags($postData['username']);
		$postData['password'] = password_hash($postData['password'], PASSWORD_DEFAULT);
		$signUp = $usersManager->addUser($postData);

		if($signUp->rowCount())
		{
			header('Location: index.php?message=2');
		}
		else
		{
			throw new Exception("Il y a eu un problème lors de l'inscription !");
		}
	}
}
function dashBoard($messageCode)
{
	if(isset($messageCode))
	{
		$message = getMessage($messageCode);
	}

	$whoIsConnected = whoIsConnected();
	require('View/dashBoardView.php');
}
function newChapter()
{
	$whoIsConnected = whoIsConnected();
	require('View/newChapterView.php');
}
function addChapter($postData)
{
	$chaptersManager = new ChaptersManager();
	$postData['title'] = strip_tags($postData['title']);
	$addedLines = $chaptersManager->addChapter($postData);
	if($addedLines->rowCount())
	{
		header('Location: index.php?action=dashBoard&message=3');
	}
	else
	{
		throw new Exception("Il y a eu un problème lors de l'ajout du chapitre !");
	}

}

function showError($error)
{
	$error = $error;
	require('View/errorView.php');
}