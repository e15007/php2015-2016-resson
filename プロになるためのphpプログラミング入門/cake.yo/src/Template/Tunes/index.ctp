<div id="navdiv">
<form class="formnav" method="post" action="/cake.yo/users/login">
<input type="submit" value="ログイン">
</form>
</div>
<h2>いまのあなたの<span class="style1">キブン</span>は？</h2>
<div class="boxbtn">
<?php
echo $this->Form->create(); 
for($idx = 1; $idx <= 6; $idx ++){
	$bname = 'btn' . $idx;
	$fname =  $bname . '.png';
	echo $this->Form->submit($fname, ['name' => $bname, 'div' => false]);
}
echo $this->Form->end();
?>
</div>
<?php
//debug($tune);
if(isset($tune['feeling_id'])){
		$feelId = $tune['feeling_id'];
		//debug($feelId);
			if($feelId < 1 && $feelId > 6){
				$feelId = 1;
			}
?>
<h2>いま聞きたい<span class="style1">
<?php
			$feels = array('', 'ルンルン', 'ノリノリ', 'ホノボノ', 'ラブラブ', 'ヘロヘロ', 'ガックリ');
			echo h($feels[$feelId]);
?>
</span>な１曲はコレ！</h2>
<div class="boxbtn">
<div id="boxface">
<?php echo $this->Html->image('face' . $feelId . '.png'); ?>
<?php //debug($tune); ?>
</div>
<div id="boxtune">
<p>
<?php echo h($tune['name']); ?>
</p>
<p id="artname"><span id="artby">&nbsp;by&nbsp;</span>
<?php echo h($tune['artist']['name']); ?>
</p>
</div>
<?php
				if(isset($tune['comcont']) && $tune['comcont'] !== ''){
							echo '<div id="fukit"></div><div id="fukim">';
							echo nl2br(h($tune->comcont));
							echo '</div><div id="fukib"></div>';
				}
?>
</div>
<?php
			}
?>
