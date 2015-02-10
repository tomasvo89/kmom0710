<article class="article1">

<h1>Latest questions</h1>

<?php foreach($questions as $question): ?>
  <?php
  $date1 = $question->timestamp;
  $date2 = date('Y-m-d H:i:s');
  $ts1 = strtotime($date1);
  $ts2 = strtotime($date2);
  $seconds_diff = $ts2 - $ts1;
  if ($seconds_diff < 86400) {
    $date = ' today';
  } else {
    $date = $seconds_diff / 86400;
    $date = round($date, 1);
    $date .= " days ago";
  }
  ?>


  <div class="firstPageQuestions">
      <p>
      <i class="fa fa-question"></i>   <a href="<?=$this->url->create('question/id/' . $question->id) ?>"><?=$question->title?></a>
       <span class="timestamp">- <?=$date ?></span></p>
  </div>
<?php endforeach; ?>
<!-- </div> -->
<br>
<br>
<h1>Mosts used tags</h1>
<div class="mostUsedTags">
<?php foreach($mostUsedTags as $tag): ?>
  <div class="tag">
        <i class="fa fa-tags"></i><a href="<?=$this->url->create('question/tagId/' . $tag->tag) ?>"> <?=$tag->tag ?></a>
  </div>
<?php endforeach; ?>
</div>
</article1>