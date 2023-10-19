<?php
/**
 * @var $apples \common\models\Apple[]
 * @var $model \common\models\AppleForm
 */


use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use common\models\Apple;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <?= Html::a('Generate', ['/apple/gen-apples'], ['class' => 'btn btn-mini btn-success']) ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-md-10">
        <div class="box box-body box-success">
            <div class="box-header">
                <h3 class="box-title">Aplles list</h3>
            </div>
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-hover"  >
                        <thead>
                        <tr>
                            <th>Apple</th>
                            <th>Status</th>
                            <th>Percent eat</th>
                            <th class="text-left"><i class="fa fa-gear fa-lg"></i></th>
                            <th class="text-left"><i class="fa fa-gear fa-lg"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($apples)): ?>
                            <tr>
                                <td colspan="7" class="text-center">No apples was found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($apples as $apple): ?>
                                <tr data-id="<?= $apple['id'] ?>">
                                    <?php if ($apple['color'] > 0) : ?>
                                        <td>
                                            <img src="<?= Apple::BASE_URL_BACKEND_IMAGE . Apple::getAppleColor($apple['color']) ?>"
                                                 width="20%"
                                        </td>
                                    <?php endif; ?>
                                    <td><?= Apple::getStatuses($apple['status']) ?></td>
                                    <td><?= $apple['percent_eat'] ?></td>
                                    <td class="text-left"><?php
                                        Modal::begin([
                                            'toggleButton' => [
                                                'label' => 'Eat',
                                                'tag' => 'button',
                                                'class' => 'btn btn-primary',
                                                 'disabled' =>$apple['status']==Apple::HANGING_ON_TREE,
                                            ],

                                        ]);
                                        ?> <?php $form = ActiveForm::begin(['id' => 'percent-form', 'action' => ['apple/eat-apple']]); ?>
                                        <?= $form->field($model, 'percent')->textInput(['autofocus' => true]) ?>
                                        <?= $form->field($model, 'id')->hiddenInput(['value' => $apple['id']])->label(false) ?>
                                        <?= $form->field($model, 'dateFall')->hiddenInput(['value' => $apple['date_fall']])->label(false) ?>
                                        <div class="form-group">
                                            <?= Html::submitButton('Eat Apple',
                                                ['class' => 'btn btn-primary',
                                                    'name' => 'eat-button',]
                                                   ) ?>
                                            <?php ActiveForm::end(); ?>
                                        </div>
                                        <?php Modal::end(); ?>
                                    </td>
                                    <?php if (!$apple['status']): ?>
                                        <td class="text-left"><?= Html::a('Down', ['/apple/down-apple', 'id' => $apple['id']], ['class' => 'btn btn-mini btn-danger']) ?>

                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <?= Html::a('Generate', ['/apple/gen-apples'], ['class' => 'btn btn-mini btn-success']) ?>
</div>

