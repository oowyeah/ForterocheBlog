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
						$noTags = strip_tags($db_data['content']);
						
						$str = explode(" ", $noTags, 30);
						$str = array_slice($str, 0, 29);
						echo implode(" ", $str) . " (...)";
						
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