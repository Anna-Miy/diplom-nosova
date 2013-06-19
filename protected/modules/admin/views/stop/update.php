<?php
$this->breadcrumbs=array(
	'Остановки'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактировать остановку',
);

$this->menu=array(
	array('label'=>'Список остановок', 'url'=>array('index')),
	array('label'=>'Добавить остановку', 'url'=>array('create')),
	array('label'=>'Просмотр остановки', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление остановками', 'url'=>array('admin')),
);
?>
<article class="entry">
	<header class="entry-header">
		<h3 class="underlined">Редактирование остановки "<?php echo $model->name; ?>"</h3>
	</header>

	<div class="entry-content">
		<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
	</div>

</article>