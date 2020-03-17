<?php
require("Controller/controller.php");

try {

	if(isset($_GET['action']))
	{
		if($_GET['action'] == "signInPage")
		{
			signInPage();
		}
		elseif($_GET['action'] == "signIn")
		{
			if(isset($_POST['username']) && isset($_POST['password']))
			{
				if(!empty($_POST['username']) && !empty($_POST['password']))
				{
					$postData = array(
						'username' => $_POST['username'],
						'password' => $_POST['password']
					);

					signIn($postData);
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
		elseif($_GET['action'] == "signOut")
		{
			signOut();
		}
		if($_GET['action'] == "signUpPage")
		{
			signUpPage();
		}
		elseif($_GET['action'] == "signUp")
		{
			if(isset($_POST['username']) && isset($_POST['password']))
			{
				if(!empty($_POST['username']) && !empty($_POST['password']))
				{
					$postData = array(
						'username' => $_POST['username'],
						'password' => $_POST['password']
					);

					signUp($postData);
				}
				else
				{
					throw new Exception("Veuillez remplir tous les champs !");
				}
			}
			else
			{
				throw new Exception("Veuillez remplir tous les champs !");
			}
		}
		elseif($_GET['action'] == "dashBoard")
		{
			if(isset($_GET['message']))
			{
				$messageCode = $_GET['message'];
				dashBoard($messageCode);
			}
			else
			{
				dashBoard(null);
			}
		}
		elseif($_GET['action'] == "newChapter")
		{
			newChapter();
		}
		elseif($_GET['action'] == "addChapter")
		{
			if(isset($_POST['title']) && isset($_POST['content']))
			{
				if(!empty($_POST['title']) && !empty($_POST['content']))
				{
					$postData = array(
						'title' => $_POST['title'],
						'content' => $_POST['content']
					);

					addChapter($postData);
				}
				else
				{
					throw new Exception("Veuillez remplir tous les champs !");
				}
			}
			else
			{
				throw new Exception("Veuillez remplir tous les champs !");
			}
		}
		elseif($_GET['action'] == "editRemChapters")
		{
			if(isset($_GET['message']))
			{
				$messageCode = $_GET['message'];
				editRemChapters($messageCode);
			}

			else
			{
				editRemChapters(null);
			}
		}
		elseif($_GET['action'] == "editChapter" && isset($_GET['chapterId']))
		{
			editChapter($_GET['chapterId']);
		}
		elseif($_GET['action'] == "updateChapter" && isset($_GET['chapterId']))
		{
			if(isset($_POST['title']) && isset($_POST['content']))
			{
				if(!empty($_POST['title']) && !empty($_POST['content']))
				{
					$postData = array(
						'title' => $_POST['title'],
						'content' => $_POST['content'],
						'id' => $_GET['chapterId']
					);

					updateChapter($postData);
				}
				else
				{
					throw new Exception("Veuillez remplir tous les champs !");
				}
			}
			else
			{
				throw new Exception("Veuillez remplir tous les champs !");
			}
		}
		elseif($_GET['action'] == "removeChapter" && isset($_GET['chapterId']))
		{
			removeChapter($_GET['chapterId']);
		}
		elseif($_GET['action'] == "reportedComments")
		{	
			if(isset($_GET['message']))
			{
				$messageCode = $_GET['message'];
				reportedComments($messageCode);
			}

			else
			{
				reportedComments(null);
			}
		}
		elseif($_GET['action'] == "allowComment" && isset($_GET['commentId']))
		{
			allowComment($_GET['commentId']);
		}
		elseif($_GET['action'] == "removeComment" && isset($_GET['commentId']))
		{
			removeComment($_GET['commentId']);
		}
		elseif($_GET['action'] == "chaptersList")
		{
			chaptersList();
		}
		elseif($_GET['action'] == "singleChapter" && isset($_GET['chapterId']))
		{
			if(isset($_GET['message']))
			{
				$messageCode = $_GET['message'];
				singleChapter($_GET['chapterId'], $messageCode);
			}
			else
			{
				singleChapter($_GET['chapterId'], null);
			}
		}
		elseif($_GET['action'] == "postComment")
		{

			if(isset($_POST['content']) && isset($_GET['chapterId']) && isset($_GET['from']))
			{
				if(!empty($_POST['content']) && !empty($_GET['chapterId']))
				{
					$postData = array(
						'content' => $_POST['content'],
						'chapterId' => $_GET['chapterId'],
						'userId' => null
					);

					postComment($postData, $_GET['from']);
				}
				else
				{
					throw new Exception("Veuillez saisir un commentaire !");
				}
			}
			else
			{
				throw new Exception("Veuillez saisir un commentaire !");
			}
		}
		elseif($_GET['action'] == "listComments" && isset($_GET['chapterId']))
		{
			if(isset($_GET['message']))
			{
				$messageCode = $_GET['message'];
				listComments($_GET['chapterId'], $messageCode);
			}
			else
			{
				listComments($_GET['chapterId'], null);
			}
		}
		elseif($_GET['action'] == "reportComment" && isset($_GET['commentId']) && isset($_GET['from']) && isset($_GET['chapterId']))
		{
			reportComment($_GET['commentId'], $_GET['from']);
		}
	}
	else
	{	if(isset($_GET['message']))
		{
			$messageCode = $_GET['message'];
			homeView($messageCode);
		}
		else
		{
			homeView(null);
		}	

	}

}

catch(Exception $e) {
    $error = $e->getMessage();
    showError($error);
}