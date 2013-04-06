<?php
/* @var $this ResearchController */
/* @var $model Research */

$this->breadcrumbs=array(
	'Researches'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Research', 'url'=>array('index')),
	array('label'=>'Create Research', 'url'=>array('create')),
	array('label'=>'View Research', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Research', 'url'=>array('admin')),
);
?>

<h1>Update Research <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>