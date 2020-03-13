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