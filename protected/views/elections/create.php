<?php
$this->breadcrumbs=array(
	'Elections'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Elections', 'url'=>array('index')),
	array('label'=>'Manage Elections', 'url'=>array('admin')),
);
?>

<h1>Create Elections</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>