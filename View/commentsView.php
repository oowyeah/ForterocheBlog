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

		<h3>Commentaires</h3>

		<?php
		if($whoIsConnected)
		{
			?>
			<form action="index.php?action=postComment&chapterId=<?= $db_data['id'] ?>&from=commentsView" method="post">
				<fieldset>
					<legend>Ajouter un commentaire</legend>
					<textarea rows="5" cols="30" name="content" placeholder="Saisissez votre commentaire"></textarea>
					<input type="submit" value="Envoyer">
				</fieldset>
			</form>
			<?php
		}
		if($comments->rowCount())
		{
			?>
			<div id="comments">
				<?php
				while($db_data = $comments->fetch())
				{
					?>

					<div class="comment">
						<fieldset>
							<legend><h4><?= $db_data['userName'] ?> le <?= $db_data['date'] ?></h4></legend>
							<p><?= $db_data['content'] ?></p>
							<?php
							if($whoIsConnected)
							{
								?>
								<p><a href="index.php?action=reportComment&commentId=<?= $db_data['commentId'] ?>&from=commentsView&chapterId=<?= $id ?>">Signaler</a></p>
								<?php
							}
							?>
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