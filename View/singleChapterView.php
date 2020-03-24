<?php

if($chapter->rowCount())
{
	$db_data = $chapter->fetch();
	$title = 'Chapitre ' . $chapterNumber . ' - ' . htmlspecialchars($db_data['title']);
	$id = $db_data['id'];

	ob_start();

	?>

	<main>
		<h2>Chapitre <?= $chapterNumber ?> <?= htmlspecialchars($db_data['title']) ?></h2>
		<div class="chapterContent"><?= $db_data['content'] ?></div>
		<p class="chapterEnd">Jean Forteroche - Publié le <?= $db_data['date'] ?></p>

		<fieldset class="divider">
			<legend><h3>Commentaires</h3></legend>
		</fieldset>
		<?php
		if($whoIsConnected)
		{
			?>
			<form id="commentForm" action="index.php?action=postComment&chapterId=<?= $id ?>&from=chapterView" method="post">
				<fieldset>
					<legend>Ajouter un commentaire</legend>
					<div id=fieldsetDiv>
						<textarea rows="5" cols="30" name="content" placeholder="Saisissez votre commentaire"></textarea>
						<input type="submit" value="ENVOYER">
					</div>
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
							<legend><h4><?= htmlspecialchars($db_data['userName']) ?> le <?= $db_data['date'] ?></h4></legend>
							<p><?= htmlspecialchars($db_data['content']) ?></p>
							<?php
							if($whoIsConnected) {
								?>
								<div class="button"><a href="index.php?action=reportComment&commentId=<?= $db_data['commentId'] ?>&from=chapterView&chapterId=<?= $id ?>">Signaler <i class="fas fa-exclamation-circle"></i></a></div>
								<?php
							}
							?>
						</fieldset>
					</div>
					

					<?php
				}

				?>

			</div>
			<div class="button"><a href="index.php?action=listComments&chapterId=<?= $id ?>">Voir tous les commentaires</a></div>
			<?php

		}
		else
		{
			?>

			<p class="noComments">Il n'y a pas encore de commentaires.</p>

			<?php
		}
}

else
{
	$title = "Episode Introuvable"
	?>

	<p class="noComments">L'épisode est introuvable</p>
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