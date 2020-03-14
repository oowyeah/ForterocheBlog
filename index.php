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