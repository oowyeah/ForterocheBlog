<?php

if($chapter->rowCount())
{
	$db_data = $chapter->fetch();
	$title = 'Chapitre ' . $chapterNumber . ' - ' . $db_data['title'];

	ob_start();

	?>

	<main>
		<h2><?= $db_data['title'] ?></h2>
		<p class="chapterContent"><?= $db_data['content'] ?></p>
		<p class="chapterEnd">Jean Forteroche - Publié le <?= $db_data['date'] ?></p>

	<?php
}

else
{
	$title = "Episode Introuvable"
	?>

	<p>L'épisode est introuvable</p>
	</main>

	<?php
}

?>


<footer>
</footer>

<?php

$content = ob_get_clean();

require('template.php');
?>