<br>
  <div class="myButton">
<a href="<?=$this->url->create('question/add') ?>">Ask a question</a></li>

  </div>

<article class="article1">

<?=$content?>

<?php if(isset($byline)) : ?>
<footer class="byline">
<?=$byline?>

</footer>
<?php endif; ?>

</article>
