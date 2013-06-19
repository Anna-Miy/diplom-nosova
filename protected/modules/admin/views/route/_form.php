<div class="form">

<?php
    /** @var $form CActiveForm */
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'route-form',
	'enableAjaxValidation'=>false,
)); ?>

<!--	<p class="note left">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?><br>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?><br>
		<?php echo $form->textArea($model,'description', array('cols' => 50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_from'); ?><br>
        <?php $this->widget('CMaskedTextField',array(
            'mask'=>'99:99',
            'model'=>$model,
            'attribute'=>'time_from'
        )); ?>
		<?php echo $form->error($model,'time_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_to'); ?><br>
        <?php $this->widget('CMaskedTextField',array(
            'mask'=>'99:99',
            'model'=>$model,
            'attribute'=>'time_to'
        )); ?>
		<?php echo $form->error($model,'time_to'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'interval'); ?><br>
        <?php $this->widget('CMaskedTextField',array(
            'mask'=>'99:99',
            'model'=>$model,
            'attribute'=>'interval'
        )); ?>
		<?php echo $form->error($model,'interval'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'route_type_id'); ?><br>
		<?php echo $form->dropDownList($model,'route_type_id',
		                               CHtml::listData(RouteTypes::model()->findAll(), 'id', 'name')) ?>
		<?php echo $form->error($model,'route_type_id'); ?>
	</div>



	<div id="routes_editor" data-route-id="<?php echo $model->id; ?>">
		<div class="right">
			<label><input type="checkbox" id="alongTheRoad" checked="checked"> Прокладывать по дороге</label>
            <?= CHtml::hiddenField('routePoints', isset($encodedRoutePoints) ? $encodedRoutePoints : ''); ?>
			<?= CHtml::dropDownList('stopsList', 0, array('0' => '') + CHtml::listData(Stop::model()->findAll(), 'id', 'name'), array('data-placeholder' => 'без остановки'))?>
			<a href="#" class="undoBtn button secondary">Отмена</a>
            <span class="reoutePolyEditControls" style="display: none">
                <a href="#" class="button secondary" id="cancelPolyEdit">Отмена редактирования</a>
                <a href="#" class="button secondary" id="applyPolyEdit">Применить редактирование</a>
            </span>
        </div>

		<span class="spacer"></span>
		<div id="routes_map"></div>
	</div>


	
<span class="spacer"></span>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать маршрут' : 'Сохранить', array('id' => 'saveBtn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script type="text/javascript">
	$(function () {
	  $("#stopsList").chosen({allow_single_deselect: true});
	})
</script>


<script data-main="/js/route_editor/main" src="/js/libs/require/require.js"></script>