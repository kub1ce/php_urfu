<section class="wishes">
    <?php if(!empty($ownerName)): ?>
      	<h2>Список желаний — <?=htmlspecialchars($ownerName)?></h2>
    <?php else: ?>
      	<h2>Мои желания</h2>
    <?php endif; ?>

    <?php if(empty($wishes)): ?>
      	<p class="empty">Пока пусто — добавь своё желание!</p>
    <?php endif; ?>

    <ul class="wish-list">
		<?php 
		if (array_key_exists('user_id', $_SESSION)) $currentUserId = $_SESSION['user_id'];
		else $currentUserId = 0;
		?>
		<?php foreach($wishes as $w): ?>
			<li class="wish-item">
				<div class="wish-body">
					<strong><?=htmlspecialchars($w['title'])?></strong>
					<p class="meta">Добавлено <?=date('d.m.Y H:i', strtotime($w['created_at']))?>
						<?php if(isset($w['name'])): ?> — от <?=htmlspecialchars($w['name'])?><?php endif; ?>
					</p>

					<?php if(!empty($w['description'])): ?>
						<p class="desc"><?=nl2br(htmlspecialchars($w['description']))?></p>
					<?php endif; ?>
				</div>

				<?php if($currentUserId && $currentUserId == $w['user_id']): ?>
					<div class="wish-actions">
						<a class="btn small" href="/edit.php?id=<?=$w['id']?>">Редактировать</a>
						<form method="post" action="/delete.php" onsubmit="return confirm('Удалить желание?');" style="display:inline">
							<input type="hidden" name="id" value="<?=$w['id']?>">
							<input type="hidden" name="csrf_token" value="<?=htmlspecialchars(csrf_token())?>">
							<button class="btn danger small" type="submit">Удалить</button>
						</form>
					</div>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
    </ul>
</section>
