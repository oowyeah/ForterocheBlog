<?php

$title = "Liste des chapitres";

ob_start();

?>

<main>

	<h2>Les chapitres</h2>

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
				<h3>Chapitre <?= $chapterNumber ?> - <?= $db_data['title'] ?></h3>
				<div class="content">
					<?php

					while(str_word_count($db_data['content']) >= 30)
					{
						$db_data['content'] = substr($db_data['content'], 0, -1);
					}

					?>

					<?= $db_data['content'] . "(...)" ?>

				</div>
				<div class="ReadButton">
					<a>Lire la suite</a>
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

		<p>Il n'y pas de chapitres pour le moment</p>

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