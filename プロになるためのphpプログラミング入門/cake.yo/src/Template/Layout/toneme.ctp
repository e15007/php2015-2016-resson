<?php

$cakeDescription = 'ToneMe トンミー ';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<section class="container clearfix">
		<?= $this->fetch('content') ?>
</section>

<footer>
</footer>
</div>
</div>
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
