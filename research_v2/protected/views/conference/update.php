<?php
/* @var $this ConferenceController */
/* @var $model Conference */

$this->breadcrumbs=array(
	'Conferences'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Conference', 'url'=>array('index')),
	array('label'=>'Create Conference', 'url'=>array('create')),
	array('label'=>'View Conference', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Conference', 'url'=>array('admin')),
);
?>

<h1>Update Conference <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>