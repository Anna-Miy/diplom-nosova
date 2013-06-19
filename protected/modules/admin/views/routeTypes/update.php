<?php
$this->breadcrumbs=array(
	'Типы маршрутов'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список типов маршрута', 'url'=>array('index')),
	array('label'=>'Добавить новый', 'url'=>array('create')),
	array('label'=>'Просмотр', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление типами маршрутов', 'url'=>array('admin')),
);
?>


<article class="entry">

	<header class="entry-header">
		<h3 class="underlined">Редактирование "<?= $model->name ?>"</h3>
	</header>

	<div class="entry-content">

		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</article>