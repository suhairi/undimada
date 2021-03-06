<?php
$this->breadcrumbs=array(
	'Elections'=>array('Elections/index'),
	$election->name=>array('Elections/view','id'=>$election->id),
	'Results',
);

$this->menu=array(
	array('label'=>'Result Form', 'url'=>array('resultform','id'=>$election->id)),
);

$cs=Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/tablesorter/jquery.tablesorter.min.js',CClientScript::POS_HEAD);
$cs->registerCssFile(Yii::app()->baseUrl.'/js/tablesorter/themes/blue/style.css');
Yii::app()->clientScript->registerScript('clickscript',"
	$('.votetable').tablesorter({sortList: [[1,1]],cssAsc: 'headerSortUp',cssDesc: 'headerSortDown',cssHeader: 'header'});
",CClientScript::POS_READY);
?>
<h1>Voting Results</h1>
<?php
foreach($seats as $seat){
?>
	<h2><?php echo $seat->name;?></h2>
<table class='votetable tablesorter'>
<thead>
<tr><th class='header'>Candidate</th><th class='header'>Votes</th></tr>
</thead>
<tbody>
<?php foreach($seat->candidates() as $candidate){ ?>
<tr>
<td><?php echo $candidate->name; ?></td>
<td><?php echo $candidate->votescount; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php
}
?>
	<h3>Votes thrown : <?php echo count($usedtokens)."/".count($election->tokens);?></h3>
