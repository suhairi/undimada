<?php
$this->breadcrumbs=array(
	'Stations'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Stations', 'url'=>array('index')),
	array('label'=>'Create Stations', 'url'=>array('create')),
	array('label'=>'Update Stations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Stations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stations', 'url'=>array('admin')),
	array('label'=>'Generate Tokens', 'url'=>array('generate', 'id'=>$model->id)),
	array('label'=>'View Current Tokens', 'url'=>array('tokens', 'id'=>$model->id)),
);
?>

<h1>View Stations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'voters_count',
		'start_date',
		'end_date',
	),
)); ?>
