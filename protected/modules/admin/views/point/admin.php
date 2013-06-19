<?php
$this->breadcrumbs=array(
	'Точки'=>array('index'),
	'Управление точками',
);

$this->menu=array(
	array('label'=>'Список точек', 'url'=>array('index')),
	array('label'=>'Добавить точку', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('point-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<article class="entry">

	<header class="entry-header">
		<h3 class="underlined">Управление точками</h3>
	</header>

	<div class="entry-content">

		<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
		<div class="search-form" style="display:none">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->

		<span class="spacer big"></span>
		
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'point-grid',
			'dataProvider'=>$model->search(),
			'htmlOptions' => array('class' => ''),
			'filter'=>$model,
			'columns'=>array(
                array(
                    'name' => 'id',
                    'type' => 'html',
                    'value' => 'CHtml::image(Yii::app()->baseUrl ."/images/icons/marker.png", $data->id)',
                ),
				'lat', 'lng',
                array(
                    'name' => 'pos',
                    'header' => '№'
                ),
                array(
                    'name' => 'route_id',
                    'value' => '$data->route->name',
                    'filter' => CHtml::listData(Route::model()->findAll(), 'id', 'name')
                ),
                array(
                    'name' => 'stop_id',
                    'value' => 'isset($data->stop->name) ? $data->stop->name: "" ',
                    'filter' => CHtml::listData(Stop::model()->findAll(array('order' => 'name')), 'id', 'name')
                ),
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>
</article>


