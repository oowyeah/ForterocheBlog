<?php

$title = "Modifier un chapitre";

ob_start();
?>
<script src="../tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	tinymce.init({
    	selector: '#mytextarea',
    	language: 'fr_FR'
    });
</script>

<?php

$headContent = ob_get_clean();


ob_start();

?>
<main>
	<?php
	if($whoIsConnected == 'admin')
	{
		if($chapter->rowCount())
		{
			$db_data = $chapter->fetch();

			?>

			<h2>Modifier le chapitre</h2>

			<form method="post" action="index.php?action=updateChapter&chapterId=<?= $db_data['id'] ?>">
				<p>
					<label for="title">Titre de l'épisode : </label>
					<input required type="text" name="title" id="title" value="<?= $db_data['title'] ?>" />
				</p>
				<textarea id="mytextarea" name="content"><?= $db_data['content'] ?></textarea>

				<input type="submit" value="Envoyer" />
			</form>

			<?php
		}
		else
		{

			?>

			<p>Episode introuvable !</p>

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