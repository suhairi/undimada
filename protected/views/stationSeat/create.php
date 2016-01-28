<?php
$this->breadcrumbs=array(
	'Station Seats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StationSeat', 'url'=>array('index')),
	array('label'=>'Manage StationSeat', 'url'=>array('admin')),
);
?>

<h1>Create StationSeat</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>