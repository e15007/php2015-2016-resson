<?php
$cakeDescription = 'ToneMe トンミー ';
?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
	<title>
		<?= $cakeDescription ?>:
		<?= $this->fetch('title') ?>
	</title>
	<?= $this->Html->meta('icon') ?>
	<?= $this->Html->css('toneme.css') ?>
	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>
</head>
<body>
<div id="container">
<div id="header">
<h1><?php echo $this->Html->image('head.png');?></h1>
</div>
<div id="content">
	<?= $this->Flash->render() ?>
	<?= $this->fetch('content') ?>
</div>
<div id="footer">
</div>
</div>
</body>
</html>
