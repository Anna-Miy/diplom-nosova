<?php
$this->breadcrumbs=array(
	'Точки'=>array('index'),
	'#'.$model->id=>array('view','id'=>$model->id),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список точек', 'url'=>array('index')),
	array('label'=>'Добавить точку', 'url'=>array('create')),
	array('label'=>'Просмотр точки', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление точками', 'url'=>array('admin')),
);
?>
<article class="entry">
	<header class="entry-header">
		<h3 class="underlined">Редактирование точки #<?= $model->id ?></h3>
	</header>

	<div class="entry-content">
		<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
	</div>

</article>