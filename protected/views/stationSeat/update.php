<?php
$this->breadcrumbs=array(
	'Station Seats'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StationSeat', 'url'=>array('index')),
	array('label'=>'Create StationSeat', 'url'=>array('create')),
	array('label'=>'View StationSeat', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage StationSeat', 'url'=>array('admin')),
);
?>

<h1>Update StationSeat <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>