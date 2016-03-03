<?php
Yii::app()->clientScript->registerScript('clickscript',"
setTimeout(function() { 
	window.location.href = '".$this->createUrl('Votes/welcome')."';
	}, 3000);
",CClientScript::POS_READY);
?>
<br /><br /><br /><br /><br /><br />
<div class='undi'>
<h1>Terima Kasih Kerana Mengundi</h1>
<form action="welcome" method="get">
<input class="button" type="submit" value="Sekian"/>
</form>
</div>
