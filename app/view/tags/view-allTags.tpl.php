<br>
  <div class="myButton">
<a href="<?=$this->url->create('question/add') ?>">Ask a question</a>

  </div>
  <h1>All tags</h1>
<?php if (is_array($tags)) : ?>
  <div class="allTags">
  <?php foreach ($tags as $tag) : ?>
    <div class="tag">
      <i class="fa fa-tags"></i><a href="<?=$this->url->create('question/tagId/' . $tag) ?>"> <?=$tag ?></a>

    </div>

  <?php endforeach; ?>
</div>
<?php endif; ?>
