<?php
$this->breadcrumbs=array(
	'Маршруты'=>array('index'),
	'Управление маршрутами',
);

$this->menu=array(
	array('label'=>'Добавить новый маршрут', 'url'=>array('create')),
	array('label'=>'Список маршрутов', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('route-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<article  class="entry">
	<header class="entry-header">
		<h3 class="underlined">Управление маршрутами</h3>
	</header>

	<div class="entry-content">

		<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
		<div class="search-form" style="display:none">
		<?php $this->renderPartial('_search',array('model'=>$model,'allRouteTypes'=>$allRouteTypes)); ?>
		</div><!-- search-form -->

		<span class="spacer big"></span>

		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'route-grid',
			'dataProvider'=>$model->search(),
			'htmlOptions' => array('class' => ''),
			'filter'=>$model,
			'columns'=>array(
                'name',
				array(
                    'name' => 'route_type_id',
                    'value' => '$data->routeType->name',
                    'filter' => CHtml::listData($allRouteTypes, 'id', 'name')
                ),
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>
</article>


