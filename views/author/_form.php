<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Author */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="author-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])
    	->input('name',['placeholder' => 'The Author\'s Name'])
     ?>

    <?= $form->field($model, 'f_name')->textInput(['maxlength' => true])
    	->input('f_name',['placeholder' => 'The Author\'s Familly Name'])
     ?>

    <?= $form->field($model, 'birth')->textInput()
    	->input('birth',['placeholder' => 'YYYY/MM/DD']) 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
