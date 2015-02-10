<hr>
<h2><?= count($comments) . " kommentar" . (count($comments)!=0&&count($comments)!=1 ? "er:" : ":") ?></h2>


<div class='comments'>
    
<?php foreach ($comments as $comment) : ?>
<h5>Publicerat: <?=$comment->timestamp?></h5>
<h4><a href="<?= $this->url->create('comment/update/'.$comment->id) ?> "title="Editera kommentar" class="id">Inlägg#<?=$comment->id?></a></h4>
<p><img src="http://www.gravatar.com/avatar/<?=md5($comment->email);?>.jpg?s=40"/>    
<b><?= $comment->name; ?></b>
<?php if( $comment->homepage ): ?>
<a href="<?=$comment->homepage ?>" target="_blank" class="webb"><?=$comment->homepage?></a></p>
<?php endif; ?>

<p><?=$comment->content?></p>
<br/>

<a href='comment/delete/<?=$comment->id?>' style="padding-left: 10px;" class="pull-right"><button>Radera</button></a>    
<a href='comment/update/<?=$comment->id?>' class="pull-right"><button >Ändra</button></a>    

<?php endforeach; ?>
    
</div>
