<?php

if($chapter->rowCount())
{
	$db_data = $chapter->fetch();
	$title = 'Chapitre ' . $chapterNumber . ' - ' . htmlspecialchars($db_data['title']);
	$id = $db_data['id'];

	ob_start();

	?>

	<main>
		<h2>Chapitre <?= $chapterNumber ?> - <?= htmlspecialchars($db_data['title']) ?></h2>

		<fieldset class="divider">
			<legend><h3>Commentaires</h3></legend>
		</fieldset>

		<?php
		if($whoIsConnected)
		{
			?>
			<form id="commentForm" action="index.php?action=postComment&chapterId=<?= $db_data['id'] ?>&from=commentsView" method="post">
				<fieldset>
					<legend>Ajouter un commentaire</legend>
					<div id="fieldsetDiv">
						<textarea rows="5" cols="30" name="content" placeholder="Saisissez votre commentaire"></textarea>
						<input type="submit" value="Envoyer">
					</div>
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
							<legend><h4><?= htmlspecialchars($db_data['userName']) ?> le <?= $db_data['date'] ?></h4></legend>
							<p><?= htmlspecialchars($db_data['content']) ?></p>
							<?php
							if($whoIsConnected)
							{
								?>
								<div class="button"><a href="index.php?action=reportComment&commentId=<?= $db_data['commentId'] ?>&from=commentsView&chapterId=<?= $id ?>">Signaler <i class="fas fa-exclamation-circle"></i></a></div>
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