<article class="article1">
<br>
<div class="myButton">
<a href="<?=$this->url->create('question/add') ?>">Ask a question</a>
</div>

<h1>All questions</h1>
<?php if (is_array($question)) : ?>
  <div class="sort">
    Sort by:
      <a href="<?=$this->url->create('question/sort/votes') ?>">Votes</a>
      <a href="<?=$this->url->create('question/sort/nbrOfAnswers') ?>">Answer</a>
      <a href="<?=$this->url->create('question/sort/date') ?>">Date</a>
  </div>

<?php $question = array_reverse($question); ?>
      <?php foreach ($question as $tmp) : ?>
        <?php $gravatar = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($tmp->mail))) . '.jpg?s=30'; ?>
        <div class='question'>

          <div class="author-bar ">
            <p class="right"><a href="<?=$this->url->create('users/id/' . $tmp->userID) ?>"><?=$tmp->name?></a>
              <a href=<?= $tmp->mail ?>><i class="fa fa-envelope-o"></i></a></p>
              <img class="gravatar" src=<?=$gravatar ?>>
            </div>

          <h3><a href="<?=$this->url->create('question/id/' . $tmp->id) ?>"><?=$tmp->title?></a></h3>

            <?php $res = explode("\n", str_replace(' ', '', $tmp->tags)); ?>
            <div class="tags">
              <?php foreach ($res as $tag) : ?>
                <div class="tag">
                  <a href="<?=$this->url->create('question/tagId/' . $tag) ?>"><?=$tag ?></a>
                </div>
            <?php endforeach; ?>
          </div>
        </div>
    <?php endforeach; ?>

<?php endif; ?>
</article>