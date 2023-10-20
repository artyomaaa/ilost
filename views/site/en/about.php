<?php

/* @var $this yii\web\View */

use yii\helpers\Url;


$this->params['breadcrumbs'][] = $this->title;
//var_dump($one_statement);
$session = Yii::$app->session;
$user_id = $session->get('user_id');
//var_dump($user_id);die();
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
<section class="single_product_details_area d-flex align-items-center" style="margin-top: 47px">
    <!-- Single Product Thumb -->
    <div class="row">
        <div class="col-md-6" style="padding: 10px;">
            <div class="single_product_thumb clearfix">
                <?php if (!empty($count) && $count > 1) { ?>
                    <div class="product_thumbnail_slides owl-carousel">
                        <?php if (!empty($one_statement)) {
                            if (!empty($mass)) {
                                foreach ($one_statement->findImages as $images) { ?>
                                    <div style="width: 100%; height: 504px">
                                        <img src="<?= URL::home() ?>uploads/<?= $images->image ?>" alt=""
                                             style="width: 100%; height: 100%">
                                    </div>
                                <?php }
                            } else {
                                foreach ($one_statement->lostImages as $images) { ?>
                                    <div style="width: 100%; height: 504px">
                                        <img src="<?= URL::home() ?>uploads/<?= $images->image ?>" alt=""
                                             style="width: 100%; height: 100%">
                                    </div>
                                    <?php
                                }
                            }

                        } ?>
                    </div>
                <?php } elseif (!empty($count) && $count === 1) { ?>
                    <div style="width: 100%; height: 504px">
                        <img src="<?= URL::home() ?>uploads/<?= (empty($mass)) ? $one_statement->lostImages[0]->image : $one_statement->findImages[0]->image ?>"
                             alt=""
                             style="width: 100%; height: 100%">
                    </div>
                <?php } else { ?>
                    <div style="width: 100%; height: 504px">
                        <img src="<?= URL::home() ?>uploads/gif_(4).gif"
                             alt=""
                             style="width: 100%; height: 100%">
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- Single Product Description -->
        <div class="col-md-6">
            <div class="single_product_desc clearfix">
                <h2><?= $one_statement->title ?></h2>
                <!--        <p class="product-price"><span class="old-price">$65.00</span> $49.00</p>-->
                <p class="product-desc"><?= $one_statement->text ?></p>
                <?php if (!empty($user)) { ?>
                    <span>Name:</span>
                    <p><?= $user->first_name . ' ' . $user->last_name ?></p>
                    <span>Email:</span>
                    <p id="user_email"><?= $user->email ?></p>
                    <span>Number:</span>
                    <p><?= $user->contact_number ?></p>
                <?php } ?>
                <span>Address:</span>
                <p><?= $one_statement->country . ' ' . $one_statement->city . ' ' . $one_statement->address ?></p>
                <form class="cart-form clearfix" method="post">
                    <!-- Select Box -->

                    <!-- Cart & Favourite Box -->
                    <div class="cart-fav-box d-flex align-items-center">
                        <!-- Cart -->
                        <div class="button-float">
                            <?php if ($user_id != $one_statement->user_id) { ?>
                                <button type="button" name="addtocart" value="5" class="btn essence-btn "
                                        data-toggle="modal"
                                        data-target="#myModal">Contact
                                </button>
                            <?php } ?>
                            <div id="fb-root"></div>
                            <script>(function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-share-button"
                                 data-href="http://ilost.rocketsystems.net/site/<?= ($one_statement->contact === 'lost') ? 'about-item?id=' . $one_statement->id . '&category=lost' : 'about-item?id=' . $one_statement->id . '&category=find' ?>"
                                 data-layout="button_count">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" id="contact">
            <form action="#" method="post" class="login-modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="contact">
                    <div style="display:<?= (!empty($user_id)) ? "none" : "block" ?> ">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">email</label>
                            <input type="text" class="form-control" id="send_email" aria-describedby="emailHelp"
                                   placeholder="Write your email..."
                                   value="<?= (!empty($user_id) && !empty($contact_to_user)) ? $contact_to_user->email : "" ?>">
                            <span class="contact-error-massage" id="send_email_error"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">number</label>
                            <input type="number" name="number" class="form-control" id="send_number"
                                   placeholder="Write your number..."
                                   value="<?= (!empty($user_id) && !empty($contact_to_user)) ? $contact_to_user->contact_number : "" ?>">
                            <span class="contact-error-massage" id="send_number_error"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Type your message here.</label>
                        <textarea style="height: auto; " class="form-control" id="send_text" name="text"
                                  placeholder="Text"></textarea>
                        <span class="contact-error-massage" id="send_text_error"></span>
                    </div>
                    <?php if (empty($user_id)) { ?>
                        <div style="width: 100%; display: inline-block">
                            <p>Already have account?
                                <a href="#" id="open-login-modal" style="color: #0c83e2">Login</a>
                            </p>
                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn essence-btn" id="send_contact_data">
                        <i class="fa fa-spinner fa-spin loading"></i>Send
                    </button>
                </div>
                <form action="#">
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal contact-modal" id="contact_myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="iLost-logo">
                    <img src="<?= URL::home() ?>images/blue.png" alt="">
                </div>
            </div>

            <!-- Modal body -->
            <div class="modal-body contact-user-error">
                <p> </p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="close-contact" class="btn essence-btn" data-dismiss="modal">Ok</button>
            </div>

        </div>
    </div>
</div>

