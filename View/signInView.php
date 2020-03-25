<?php

$title = "Connexion";
ob_start();

?>
<main>
	<?php
	if(isset($whoIsConnected))
	{
		if(!$whoIsConnected)
		{
			?>

			<form id="signInForm" method="post" action="index.php?action=signIn">
				<p><label for="username">Utilisateur : </label><input autofocus type="text" id="username" name="username"></p>
				<p><label for="password">Mot de passe : </label><input type="password" id="password" name="password"></p>
				<p><input type="submit" value="Connexion"></p>
				<p>Pas encore inscrit ? <a href="index.php?action=signUpPage">Inscrivez-vous !</a></p>
			</form>

			<?php
		}
		else
		{
			?>

			<p class="noComments">Vous êtes déja connecté(e) !</p>
			
			<?php
		}
	}
	?>
</main>

<footer>
</footer>

<?php

$content = ob_get_clean();

require('template.php');
?>