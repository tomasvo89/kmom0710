<!doctype html>
<html class='no-js' lang='<?=$lang?>'>
<head>
	<meta charset='utf-8'/>
	<title><?=$title . $title_append?></title>
	<?php if(isset($favicon)): ?><link rel='icon' href='<?=$this->url->asset($favicon)?>'/><?php endif; ?>
	<?php foreach($stylesheets as $stylesheet): ?>
	<link rel='stylesheet' type='text/css' href='<?=$this->url->asset($stylesheet)?>'/>
<?php endforeach; ?>
<?php if(isset($style)): ?><style><?=$style?></style><?php endif; ?>
	<script src='<?=$this->url->asset($modernizr)?>'></script>
</head>


<body>

	<div id='above'>
		<?php if(isset($aboveheader)) echo $aboveheader?>
		<?php $this->views->render('aboveheader')?>
	</div>
<?php if ($this->views->hasContent('navbar')) : ?>
	<div id='navbar'>
		<?php $this->views->render('navbar')?>
	</div>
<?php endif; ?>

	<div id='header'>
		<?php if(isset($header)) echo $header?>
		<?php $this->views->render('header')?>
	</div>
	
<div id='wrapper'>

	<div id='main'>
		<?php if(isset($main)) echo $main?>
		<?php $this->views->render('main')?>
	</div>



</div>
<?php if(isset($jquery)):?><script src='<?=$this->url->asset($jquery)?>'></script><?php endif; ?>

	<?php if(isset($javascript_include)): foreach($javascript_include as $val): ?>
	<script src='<?=$this->url->asset($val)?>'></script>
<?php endforeach; endif; ?>

<?php if(isset($google_analytics)): ?>
	<script>
	var _gaq=[['_setAccount','<?=$google_analytics?>'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
<?php endif; ?>


</body>
<div id='footer'>
	<?php if(isset($footer)) echo $footer?>
	<?php $this->views->render('footer')?>
</div>


</html>
