<?php

$title = "Gérer les commentaires";

ob_start();

?>

<main>

	<?php

	if($whoIsConnected == 'admin')
	{
		?>

		<h2>Autoriser ou supprimer un commentaire signalé</h2>

		<?php

		if($reportedComments->rowCount())
		{
			?>

			<div id="reportedComments">

			<?php

			while($db_data = $reportedComments->fetch())
			{
				?>

				<div class="comment">
					<fieldset>
						<legend>Le : <?= $db_data['date'] ?> - De : <?= htmlspecialchars($db_data['userName']) ?></legend>

						<p>"<?= htmlspecialchars($db_data['content']) ?>"</p>
						<div class="buttons">
							<div class="button">
								<a href="index.php?action=allowComment&commentId=<?= $db_data['comment_Id'] ?>">Autoriser</a>
							</div>
							<div class="button">
								<a href="index.php?action=removeComment&commentId=<?= $db_data['comment_Id'] ?>">Supprimer</a>
							</div>
						</div>
					</fieldset>
				</div>

				<?php

			}

			?>

			</div>

			<?php
		}
		else
		{

			?>

			<p class="noComments">Il n'y pas de commentaires signalés !</p>

			<?php

		}
	}
	else
	{
		?>

		<p class="noComments">Vous n'avez pas les droits nécessaires pour accéder à cette page !</p>

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