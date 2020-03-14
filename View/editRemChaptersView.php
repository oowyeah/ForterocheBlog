<?php

$title = "Supprimer un chapitre";

ob_start();

?>

<main>

	<?php

	if($whoIsConnected == 'admin')
	{
		?>

		<h2>Editer ou supprimer un chapitre</h2>

		<?php

		if($chapters->rowCount())
		{
			?>

			<div id="editRemChapters">

			<?php

			$chapterNumber = 1;
			while($db_data = $chapters->fetch())
			{
				?>

				<div class="chapter">
					<h3>Chapitre <?= $chapterNumber ?> - <?= $db_data['title'] ?></h3>
					<div class="buttons">
						<div class="editButton">
							<a href="index.php?action=editChapter&chapterId=<?= $db_data['id'] ?>">Editer</a>
						</div>
						<div class="removeButton">
							Supprimer
						</div>
					</div>
				</div>

				<?php
				$chapterNumber ++;
			}

			?>

			</div>

			<?php
		}
		else
		{

			?>

			<p>Il n'y pas d'épisodes pour le moment</p>

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