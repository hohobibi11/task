<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Author;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_pub')->textInput() ?>

    <?= isset($model->id) ?
        $form->field($model, 'authors')->dropDownList(
            ArrayHelper::map(Author::find()->all(),'id','fullName'),
         [  
          'multiple'=>'multiple',
         ]             
        )->label("Add Authors (hold CTRL key for multiple choices)") 
        :
        $form->field($model, 'authors')->dropDownList(
            ArrayHelper::map(Author::find()->all(),'id','fullName'),
         [ 
          'options'=> ArrayHelper::map($model->authors,'id','fullName'), 
          'multiple'=>'multiple',
         ]             
        )->label("Add Authors (hold CTRL key for multiple choices)")  
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
