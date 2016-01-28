<?php
$this->breadcrumbs=array(
	'Stations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Stations', 'url'=>array('index')),
	array('label'=>'Manage Stations', 'url'=>array('admin')),
);
?>

<h1>Create Stations</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>