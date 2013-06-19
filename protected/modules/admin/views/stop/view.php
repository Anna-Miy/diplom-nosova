<?php
$this->breadcrumbs=array(
	'Остановки'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список остановок', 'url'=>array('index')),
	array('label'=>'Добавить остановку', 'url'=>array('create')),
	array('label'=>'Редактировать остановку', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить остановку', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление остановками', 'url'=>array('admin')),
);
?>
<article class="entry">
	<header class="entry-header">
		<h3 class="underlined"><?= $model->name ?></h3>
	</header>

	<div class="entry-content">

		<?php $this->widget('zii.widgets.CDetailView', array(
					'data' => $model,
					'attributes' => array('id','name',),
		 )); ?>

	</div>

</article>