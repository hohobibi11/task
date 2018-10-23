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

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) 
        ->input('title',['placeholder' => 'The Book\'s Title'])
    ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true])
        ->input('isbn',['placeholder' => 'The Book\'s ISBN code'])
     ?>

    <?= $form->field($model, 'date_pub')->textInput()
        ->input('date_pub',['placeholder' => 'YYYY/MM/DD'])
     ?>

    <?=$form->field($model, 'authorIds')->dropDownList(
            ArrayHelper::map(Author::find()->all(),'id','fullName'),
         [  
          'multiple'=>'multiple',
         ]             
        ) 
    ?>

    <div class="form-group">
        <?= 
          Html::submitButton('Save', ['class' => 'btn btn-success']) 
        ?>
        <?=  
          Html::a('Create New Author', ['author/create'], ['target'=>'_blank','class' => 'btn btn-info']) 
        ?>

    </div>
    <div class="clearfix"></div>
    

    <?php ActiveForm::end(); ?>

</div>
