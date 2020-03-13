<?php

$title = "Connexion";
ob_start();

?>
<main>
	<?php
	if(!$isConnected)
	{
		?>

		<form method="post" action="index.php?action=signIn">
			<p><label for="username">Utilisateur : </label><input type="text" id="username" name="username"></p>
			<p><label for="password">Mot de passe : </label><input type="password" id="password" name="password"></p>
			<p><input type="submit" value="Connexion"></p>
			<p>Pas encore inscrit ? - <a href="index.php?action=signUpPage">Inscrivez-vous !</p></a>
		</form>

		<?php
	}
	?>
</main>

<footer>
</footer>

<?php

$content = ob_get_clean();

require('template.php');
?>