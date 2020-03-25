<?php

$title = "Supprimer un chapitre";

ob_start();
?>



<?php

$headContent = ob_get_clean();

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
					<h3>Chapitre <?= $chapterNumber ?> <?= htmlspecialchars($db_data['title']) ?></h3>
					<div class="buttons">
						<div class="editButton">
							<a href="index.php?action=editChapter&chapterId=<?= $db_data['id'] ?>">Editer</a>
						</div>
						<div class="removeButton">
							<a href="index.php?action=removeChapter&chapterId=<?= $db_data['id'] ?>">Supprimer</a>
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

			<p class="noComments">Il n'y pas de chapitres pour le moment</p>

			<?php

		}
		?>
		<script>
			let classes = document.getElementsByClassName('removeButton');

			for(let i=0; i < classes.length; i++)
			{
				console.log(classes[i]);
				classes[i].addEventListener("click", function(e) {

					e.preventDefault();

					let yes = confirm('Etes-vous sûr de vouloir supprimer ce chapitre ?');
					
					if(yes)
					{
						location.href = e.target.href;
					}
				});
			}
		</script>
		<?php
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