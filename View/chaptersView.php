<?php

$title = "Liste des chapitres";

ob_start();

?>

<main>

	<h2>LES CHAPITRES</h2>

	<?php

	if($chapters->rowCount())
	{
		?>

		<div id="chaptersList">

		<?php

		$chapterNumber = 1;
		while($db_data = $chapters->fetch())
		{
			?>

			<div class="chapter">
				<h3>Chapitre <?= $chapterNumber ?> <?= htmlspecialchars($db_data['title']) ?></h3>
				<div class="content">
					<?php
					if(str_word_count($db_data['content']) >= 30)
					{

						while(str_word_count($db_data['content']) >= 30)
						{
							$db_data['content'] = substr($db_data['content'], 0, -1);
						}

						echo $db_data['content'] . "(...)</p>";
					}
					else
					{
						?>
						<?= $db_data['content'] ?>
						<?php
					}
					?>

				</div>
				<div class="readButton">
					<a href="index.php?action=singleChapter&chapterId=<?= $db_data['id'] ?>">Lire la suite</a>
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

</main>

<footer>
</footer>

<?php

$content = ob_get_clean();

require('template.php');
?>