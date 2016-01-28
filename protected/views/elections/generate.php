<div class="tokenlist">
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/jquery-barcode-2.0.2.js");
?>
<h1 class="noprint">Tokens for Election <?php echo $election->name ?></h1>
<table id="tokens">
<?php 
$i=0;
foreach($tokens as $token){
?>
<tr>
<td>
<?php echo ($i+1).'/'.count($tokens)?>
</td>
<td>
<?php echo $token->token?>
</td>
</tr>
<?php 
	$i++;
} ?>
</table>
</div>
