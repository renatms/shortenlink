<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model */
/* @var $link */

$this->title = 'Shorten link';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>
    <table>
        <tr>
            <td style="width: 500px">
                <?= $form->field($model, 'url') ?>
            </td>

            <td>
                <?= Html::submitButton('shorten', ['class' => 'btn btn-success']) ?>
            </td>
        </tr>
        <tr>
            <td>
                <label class="control-label" for="shorturl">Shorten url:</label>
                <input id="shorturl" class="form-control" type="url" value=<?= $link ?>>
            </td>
        </tr>
    </table>
<?php ActiveForm::end(); ?>