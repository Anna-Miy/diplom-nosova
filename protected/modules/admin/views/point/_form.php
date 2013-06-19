<div class="form">

<?php
    /** @var $form CActiveForm */
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'point-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="one-fourth">
		<?php echo $form->labelEx($model,'route_id'); ?><br>
		<?php echo $form->dropDownList($model,'route_id', CHtml::listData(Route::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'route_id'); ?>
	</div>

	<div class="three-fourth last">
		<?php echo $form->labelEx($model,'stop_id'); ?><br>
		<?php echo $form->dropDownList($model,'stop_id',array('' => 'нет остановки') + CHtml::listData(Stop::model()->findAll(array('order' => 'name')), 'id', 'name')); ?>
		<?php echo $form->error($model,'stop_id'); ?>
	</div>

	<div>
		<?php echo $form->labelEx($model,'pos'); ?><br>
		<?php echo $form->textField($model,'pos',array('size'=>15,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'pos'); ?>
	</div>

	<div class="one-fourth">
		<?php echo $form->labelEx($model,'lat'); ?><br>
		<?php echo $form->textField($model,'lat',array('size'=>15,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'lat'); ?>
	</div>

	<div class="three-fourth last">
		<?php echo $form->labelEx($model,'lng'); ?><br>
		<?php echo $form->textField($model,'lng',array('size'=>15,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'lng'); ?>
	</div>

	<span class="spacer"></span>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->