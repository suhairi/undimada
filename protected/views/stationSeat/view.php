<?php
$this->breadcrumbs=array(
	'Station Seats'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StationSeat', 'url'=>array('index')),
	array('label'=>'Create StationSeat', 'url'=>array('create')),
	array('label'=>'Update StationSeat', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StationSeat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StationSeat', 'url'=>array('admin')),
);
?>

<h1>View StationSeat #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'seat_id',
		'station_id',
	),
)); ?>
