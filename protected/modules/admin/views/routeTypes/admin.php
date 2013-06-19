<?php
$this->breadcrumbs=array(
	'Типы маршрутов'=>array('index'),
	'Управление типами маршрутов',
);

$this->menu=array(
	array('label'=>'Добавить новый', 'url'=>array('create')),
	array('label'=>'Список маршрутов', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('route-types-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<article class="entry">

  <header class="entry-header">
    <h3 class="underlined">Управление типами маршрутов</h3>
  </header>

  <div class="entry-content">

    <?php echo CHtml::link('Расширеный поиск','#',array('class'=>'search-button')); ?>

    <div class="search-form" style="display:none">
      <?php $this->renderPartial('_search',array(
          'model'=>$model,
      )); ?>
    </div><!-- search-form -->

    <span class="big spacer"></span>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
       'id' => 'route-types-grid',
       'htmlOptions' => array('class' => ''),

       'dataProvider' => $model->search(),
       'filter' => $model,
       'columns' => array(
         /*'id',*/
         'name',
         array(
           'class' => 'CButtonColumn',
         ),
       ),
    )); ?>



  </div>
  <!-- END .entry-content -->
</article>