<?php

$title = "Inscription";
ob_start();

?>
<main>
	<?php
	if(!$whoIsConnected)
	{
		?>

		<form method="post" action="index.php?action=signUp">
			<p><label for="username">Utilisateur : </label><input type="text" id="username" name="username"></p>
			<p><label for="password">Mot de passe : </label><input type="password" id="password" name="password"></p>
			<p><input type="submit" value="Inscription"></p>
		</form>

		<?php
	}
	else
	{
		?>

		<p>Veuillez d'abord vous <a href="index.php?action=signOut">déconnecter</a> avant d'éffectuer une inscription !</p>

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