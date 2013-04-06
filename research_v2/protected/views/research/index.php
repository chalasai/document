<?php
/* @var $this ResearchController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Researches',
);

$this->menu=array(
	array('label'=>'Create Research', 'url'=>array('create')),
	array('label'=>'Manage Research', 'url'=>array('admin')),
);
?>

<h1>Researches</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
