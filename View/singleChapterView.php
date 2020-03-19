<?php

if($chapter->rowCount())
{
	$db_data = $chapter->fetch();
	$title = 'Chapitre ' . $chapterNumber . ' - ' . $db_data['title'];
	$id = $db_data['id'];

	ob_start();

	?>

	<main>
		<h2>Chapitre <?= $chapterNumber ?> - <?= $db_data['title'] ?></h2>
		<div class="chapterContent"><?= $db_data['content'] ?></div>
		<p class="chapterEnd">Jean Forteroche - Publié le <?= $db_data['date'] ?></p>

		<h3>Commentaires</h3>

		<?php
		if($whoIsConnected)
		{
			?>
			<form action="index.php?action=postComment&chapterId=<?= $id ?>&from=chapterView" method="post">
				<fieldset>
					<legend>Ajouter un commentaire</legend>
					<textarea rows="5" cols="30" name="content" placeholder="Saisissez votre commentaire"></textarea>
					<input type="submit" value="Envoyer">
				</fieldset>
			</form>
			<?php
		}
		if($lastComments->rowCount())
		{
			?>
			<div id="comments">
				<?php
				while($db_data = $lastComments->fetch())
				{
					?>

					<div class="comment">
						<fieldset>
							<legend><h4><?= $db_data['userName'] ?> le <?= $db_data['date'] ?></h4></legend>
							<p><?= $db_data['content'] ?></p>
							<?php
							if($whoIsConnected) {
								?>
								<p><a href="index.php?action=reportComment&commentId=<?= $db_data['commentId'] ?>&from=chapterView&chapterId=<?= $id ?>">Signaler</a></p>
								<?php
							}
							?>
						</fieldset>
					</div>
					

					<?php
				}

				?>

			</div>
			<p><a href="index.php?action=listComments&chapterId=<?= $id ?>">Voir tous les commentaires</a></p>
			<?php

		}
		else
		{
			?>

			<p>Il n'y a pas encore de commentaires.</p>

			<?php
		}
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