<?php
$this->breadcrumbs=array(
	'Elections'=>array('Elections/index'),
	$election->name=>array('Elections/view','id'=>$election->id),
	'Tokens',
);

$this->menu=array(
	array('label'=>'Generate Tokens', 'url'=>array('Elections/generate', 'id'=>$election->id)),
	array('label'=>'Download Tokens Cutout', 'url'=>array('Elections/tokens', 'id'=>$election->id)),
	array('label'=>'Download Tokens Audit', 'url'=>array('Tokens/print', 'election_id'=>$election->id)),
);
?>

<h1>Tokens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'viewData'=>array('seats'=>$seats),
)); ?>
