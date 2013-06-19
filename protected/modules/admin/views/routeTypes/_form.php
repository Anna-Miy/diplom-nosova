<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array('id'=>'route-types-form','enableAjaxValidation'=>false,)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?><br>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons"><br>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cоздать' : 'Сохранить'); ?>
	</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->


