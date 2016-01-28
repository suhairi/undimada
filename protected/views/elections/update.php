<?php
$this->breadcrumbs=array(
	'Elections'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Elections <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
