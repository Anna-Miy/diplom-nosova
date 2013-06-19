<?php
$this->breadcrumbs=array(
	'Типы маршрутов'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список типов маршрута', 'url'=>array('index')),
	array('label'=>'Добавить новый', 'url'=>array('create')),
	array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Управление типами маршрутов', 'url'=>array('admin')),
);
?>



<article class="entry">
	<header class="entry-header">
		<h3 class="underlined"><?= $model->name ?></h3>
	</header>

	<div class="entry-content">

		<?php $this->widget('zii.widgets.CDetailView', array(
					'data' => $model,
			                                             
					'attributes' => array('id','name'),
		 )); ?>

	</div>

</article>