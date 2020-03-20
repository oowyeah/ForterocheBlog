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

				<div class="reportedComment">
					<p>Le : <?= $db_data['date'] ?> - De : <?= htmlspecialchars($db_data['userName']) ?></p>
					<p>"<?= htmlspecialchars($db_data['content']) ?>"</p>
					<div class="buttons">
						<div class="allowButton">
							<a href="index.php?action=allowComment&commentId=<?= $db_data['comment_Id'] ?>">Autoriser</a>
						</div>
						<div class="removeButton">
							<a href="index.php?action=removeComment&commentId=<?= $db_data['comment_Id'] ?>">Supprimer</a>
						</div>
					</div>
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

			<p>Il n'y pas de commentaires signalés !</p>

			<?php

		}
	}
	else
	{
		?>

		<p>Vous n'avez pas les droits nécessaires pour accéder à cette page !</p>

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