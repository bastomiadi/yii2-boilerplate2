<?php

use common\components\CaptchaRefreshable;
use yii\helpers\Html;
$this->title = 'Login';
// $this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <?php 
        // $form->field($model, 'verifyCode')->widget(Captcha::class, [
        //         'captchaAction' => 'site/captcha',
        //         'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
        //         'imageOptions' => [
        //             'id' => 'captcha-login'
        //         ]
        // ])->label(false) 
        ?>

        <?= $form->field($model, 'verifyCode')->widget(CaptchaRefreshable::class)->label(false) ?>
        
        <div class="row">
            <div class="col-8">
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => '<div class="icheck-primary">{input}{label}</div>',
                    'labelOptions' => [
                        'class' => ''
                    ],
                    'uncheck' => null
                ]) ?>
            </div>
            <div class="col-4">
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>

        <?= yii\authclient\widgets\AuthChoice::widget([
            'baseAuthUrl' => ['site/auth'],
            'popupMode' => false,
        ]) ?>

        <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>
<?php $this->registerJs("
    $('#captcha-login').on('click', function(e){
        e.preventDefault();
        //console.log(e);
        $('#captcha-login img').yiiCaptcha('refresh');

    })
"); ?>