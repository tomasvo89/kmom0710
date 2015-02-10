<hr>

<h2><?= count($comments) . " kommentar" . (count($comments)!=0&&count($comments)!=1 ? "er:" : ":") ?></h2>
<?php if (is_array($comments)) : ?>
<div class='comments'>
<?php $redirect = $this->url->create($this->request->getCurrentUrl()); ?>
<?php foreach ($comments as $id => $comment) : ?>
<b><a href="<?= $this->url->create('comment/edit').'?id=' . $id . '&pageType=' . $pageType ?> "title="Editera kommentar" class="id">#<?=$id?></a></b>
<p><img src="http://www.gravatar.com/avatar/<?=md5($comment['mail']);?>.jpg?s=40"/>
<?php if( !$comment['name'] ): ?>
<b>Anonymous </b>
<?php endif; ?>
<b><?=$comment['name']?></b>
<?php if( $comment['web'] ): ?>
<a href="<?=$comment['web']?>" class="webb"><?=$comment['web']?></a></p>
<?php endif; ?>
<?=date( 'Y-m-d H:i' , $comment['timestamp'] ) ?>

<p><?=$comment['content']?>
<a href="<?= $this->url->create('comment/removeOne').'?id=' . $id . '&pageType=' . $pageType . '&redirect=' . $redirect?> "title="Editera kommentar" class="button">Ta bort</a></p>

    
<?php endforeach; ?>
</div>
<?php endif; ?>