<?php
$this->breadcrumbs=array(
	'Остановки'=>array('index'),
	'Управление остановками',
);

$this->menu=array(
	array('label'=>'Добавить новую', 'url'=>array('create')),
	array('label'=>'Список остановок', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('stop-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<article class="entry">

  <header class="entry-header">
    <h3 class="underlined">Управление остановками</h3>
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
			'id'=>'stop-grid',
			'dataProvider'=>$model->search(),
			'htmlOptions' => array('class' => ''),
			'filter'=>$model,
			'columns'=>array(
				'id',
				'name',
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>
</article>


