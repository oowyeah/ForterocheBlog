<?php

require_once("Model/UsersManager.php");
require_once("Model/ChaptersManager.php");
require_once("Model/CommentsManager.php");

function whoIsConnected()
{
	if(session_status() == PHP_SESSION_NONE)
	{
		session_start();
	}

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
	    case 4:
	        return "Chapitre modifié !";
	        break;
	    case 5:
	        return "Chapitre supprimé !";
	        break;
	    case 6:
	        return "Commentaire autorisé !";
	        break;
	    case 7:
	        return "Commentaire supprimé !";
	        break;	
	    case 8:
	        return "Commentaire ajouté !";
	        break;
	    case 9:
	        return "Commentaire signalé !";
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
		$postData['username'] = $postData['username'];
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
	$whoIsConnected = whoIsConnected();
	$chaptersManager = new ChaptersManager();
	$postData['title'] = $postData['title'];
	if($whoIsConnected == "admin")
	{
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
	else
	{
		throw new Exception("Vous devez être administrateur pour effectuer cette opération !");
	}
}
function editRemChapters($messageCode)
{
	if(isset($messageCode))
	{
		$message = getMessage($messageCode);
	}

	$whoIsConnected = whoIsConnected();
	$chaptersManager = new ChaptersManager();
	$chapters = $chaptersManager->getChaptersList();
	require('View/editRemChaptersView.php');
}
function editChapter($chapterId)
{
	$whoIsConnected = whoIsConnected();
	$chaptersManager = new ChaptersManager();
	$chapter = $chaptersManager->getChapter($chapterId);
	require('View/editChapterView.php');
}
function updateChapter($postData)
{
	$whoIsConnected = whoIsConnected();
	$chaptersManager = new ChaptersManager();
	$postData['title'] = $postData['title'];
	if($whoIsConnected == "admin")
	{
		$addedLines = $chaptersManager->UpdateChapter($postData);
		if($addedLines)
		{
			header('Location: index.php?action=editRemChapters&message=4');
		}
		else
		{
			throw new Exception("Il y a eu un problème lors de la modification du chapitre !");
		}
	}
	else
	{
		throw new Exception("Vous devez être administrateur pour effectuer cette opération !");
	}

}
function removeChapter($chapterId)
{
	$whoIsConnected = whoIsConnected();
	$chaptersManager = new ChaptersManager();
	if($whoIsConnected == "admin")
	{
		$removedLine = $chaptersManager->removeChapter($chapterId);
		if($removedLine->rowCount())
		{
			header('Location: index.php?action=editRemChapters&message=5');
		}
		else
		{
			throw new Exception("Il y a eu un problème lors de la suppression du chapitre !");
		}
	}
	else
	{
		throw new Exception("Vous devez être administrateur pour effectuer cette opération !");
	}
}
function reportedComments($messageCode)
{
	if(isset($messageCode))
	{
		$message = getMessage($messageCode);
	}

	$whoIsConnected = whoIsConnected();
	$commentsManager = new CommentsManager();
	$reportedComments = $commentsManager->getReportedComments();
	require('View/reportedCommentsView.php');
}
function allowComment($commentId)
{
	$whoIsConnected = whoIsConnected();
	$commentsManager = new CommentsManager();
	if($whoIsConnected == "admin")
	{
		$allowedComment = $commentsManager->updateStatus($commentId, 0);
		if($allowedComment->rowCount())
		{
			header('Location: index.php?action=reportedComments&message=6');
		}
		else
		{
			throw new Exception("Il y a eu un problème lors de l'autorisation du commentaire !");
		}
	}
	else
	{
		throw new Exception("Vous devez être administrateur pour effectuer cette opération !");
	}
}
function removeComment($commentId)
{
	$whoIsConnected = whoIsConnected();
	$commentsManager = new CommentsManager();
	if($whoIsConnected == "admin")
	{
		$removedLine = $commentsManager->removeComment($commentId);
		if($removedLine->rowCount())
		{
			header('Location: index.php?action=reportedComments&message=7');
		}
		else
		{
			throw new Exception("Il y a eu un problème lors de la suppression du commentaire !");
		}
	}
	else
	{
		throw new Exception("Vous devez être administrateur pour effectuer cette opération !");
	}
}
function chaptersList()
{

	$whoIsConnected = whoIsConnected();
	$chaptersManager = new ChaptersManager();
	$chapters = $chaptersManager->getChaptersList();
	require('View/chaptersView.php');
}
function singleChapter($chapterId, $messageCode)
{
	if(isset($messageCode))
	{
		$message = getMessage($messageCode);
	}

	$whoIsConnected = whoIsConnected();
	$commentsManager = new CommentsManager();
	$lastComments = $commentsManager->getLastComments($chapterId, 5);
	$chaptersManager = new ChaptersManager();
	$chapter = $chaptersManager->getChapter($chapterId);
	$chapters = $chaptersManager->getChaptersList();
	$chapterNumber = 1;
	while($data = $chapters->fetch())
	{
		if($data['id'] == $chapterId)
		{
			break;
		}
		else
		{
			$chapterNumber++;
		}
	}

	require('View/singleChapterView.php');
}
function postComment($postData, $from)
{

	$whoIsConnected = whoIsConnected();
	$usersManager = new UsersManager();
	$commentsManager = new CommentsManager();

	if($whoIsConnected != false)
	{
		$user = $usersManager->getLogin(array('username' => $_SESSION['username']));
		$data = $user->fetch();
		$userId = $data['id'];
		$postData['userId'] = $userId;
	}

	$postData['content'] = $postData['content'];

	if($whoIsConnected == "admin" || $whoIsConnected == "user")
	{
		$addedLines = $commentsManager->addComment($postData);
		if($addedLines->rowCount())
		{
			if($from == "chapterView")
			{
				header("Location: index.php?action=singleChapter&chapterId=" .$postData['chapterId'] . "&message=8");
			}
			elseif($from == "commentsView")
			{
				header("Location: index.php?action=listComments&chapterId=" .$postData['chapterId'] . "&message=8");
			}
		}
		else
		{
			throw new Exception("Il y a eu un problème lors de l'ajout du commentaire !");
		}
	}
	else
	{
		throw new Exception("Vous n'avez pas l'autorisation d'effectuer cette opération !");
	}
}
function listComments($chapterId, $messageCode)
{
	if(isset($messageCode))
	{
		$message = getMessage($messageCode);
	}

	$whoIsConnected = whoIsConnected();
	$commentsManager = new CommentsManager();
	$comments = $commentsManager->getComments($chapterId);
	$chaptersManager = new ChaptersManager();
	$chapter = $chaptersManager->getChapter($chapterId);
	$chapters = $chaptersManager->getChaptersList();
	$chapterNumber = 1;
	while($data = $chapters->fetch())
	{
		if($data['id'] == $chapterId)
		{
			break;
		}
		else
		{
			$chapterNumber++;
		}
	}

	require('View/commentsView.php');
}
function reportComment($commentId, $from)
{
	$whoIsConnected = whoIsConnected();
	$commentsManager = new CommentsManager();
	if($whoIsConnected == "admin" || $whoIsConnected == "user")
	{
		$reportedComment = $commentsManager->updateStatus($commentId, 1);
		if($reportedComment)
		{
			if($from == "chapterView")
			{
				header("Location: index.php?action=singleChapter&chapterId=" .$_GET['chapterId'] . "&message=9");
			}
			elseif($from == "commentsView")
			{
				header("Location: index.php?action=listComments&chapterId=" .$_GET['chapterId'] . "&message=9");
			}
		}
		else
		{
			throw new Exception("Il y a eu un problème lors du signalement !");
		}
	}
	else
	{
		throw new Exception("Vous devez être connecté pour effectuer cette opération !");
	}
}
function showError($error)
{

	$whoIsConnected = whoIsConnected();

	$error = $error;
	require('View/errorView.php');
}