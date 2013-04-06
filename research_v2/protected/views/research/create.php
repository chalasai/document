<?php
/* @var $this ResearchController */
/* @var $model Research */

$this->breadcrumbs=array(
	'Researches'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Research', 'url'=>array('index')),
	array('label'=>'Manage Research', 'url'=>array('admin')),
);
?>

<h1>Create Research</h1>

<?php echo $this->renderPartial('_form', array(
		'model'=>$model,
		'research_group'=>$research_group,
		'model_file'=>$model_file,
		)); ?>
