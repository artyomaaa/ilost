<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\ContactForm */

use yii\helpers\Url;


$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcumb_area bg-img" style="background-image: url(<?= URL::home() ?>essence/img/bg-img/breadcumb.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="contact-body">
    <div class="row">
        <div class="col-md-6">
            <div id="map">
                <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A2b050db7689d4f6f1af8a9accc6c1a08f4551f1a20d1f5ab848e50b71d816220&amp;source=constructor"
                        width="730" height="400" frameborder="0">

                </iframe>
            </div>
        </div>
        <div class="col-md-6">
            <form action="#">
                <div class="contact-table" id="contact-table">
                    <div class="form-group">
                        <label for="inputName">Անուն</label>
                        <input type="text" class="form-control" id="contact_name">
                        <span class="contact-error-massage" id="contact_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Էլ․հասցե</label>
                        <input type="email" class="form-control" id="contact_email">
                        <span class="contact-error-massage" id="contact_email_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="inputText">Տեքստ</label>
                        <textarea style="height: auto; " class="form-control" name="text" id="contact_text"
                                  placeholder="Գրել տեքստ․․․"></textarea>
                        <span class="contact-error-massage" id="contact_text_error"></span>
                    </div>
                    <div class="button-float">
                        <button type="submit" class="btn essence-btn" id="send_massage_us">
                            <i class="fa fa-spinner fa-spin loading"></i>Ուղարկել
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

