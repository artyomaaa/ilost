<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Url;

$session = Yii::$app->session;
$user_id = $session->get('user_id');
$edit = $session->get('edit');
$language = $session->get('language');


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en,am">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if (!empty($this->params['customParam'])) { ?>
        <meta property="og:url"
              content="<?= URL::base(true) ?>/site/<?= ($this->params['customParam']['contact'] === 'lost') ? 'about-item?id=' . $this->params['customParam']['id'] . '&category=lost' : 'about-item?id=' . $this->params['customParam']['id'] . '&category=find' ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="<?= $this->params['customParam']['title'] ?>"/>
        <meta property="og:description" content="<?= $this->params['customParam']['text'] ?>"/>
        <meta property="og:image"
              content="<?= URL::base(true) ?>/uploads/<?php if ($this->params['customParam']['contact'] === 'lost' && count($this->params['customParam']['lostImages']) != 0) {
                  echo $this->params['customParam']['lostImages'][0]['image'];
              } elseif ($this->params['customParam']['contact'] === 'find' && count($this->params['customParam']['findImages']) != 0) {
                  echo $this->params['customParam']['findImages'][0]['image'];
              } else {
                  echo 'gif_(4).gif';
              } ?>"/>
        <meta property="og:image:width" content="500"/>
        <meta property="og:image:height" content="500"/>
        <meta property="fb:app_id" content="320278938731374"/>
    <?php } else { ?>
        <meta property="og:url" content="http://ilost.rocketsystems.net"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="Lost and Found Platform"/>
        <meta property="og:description" content="Find your lost items in our platform"/>
        <meta property="og:image" content="http://ilost.rocketsystems.net/images/iphone.png"/>
        <meta property="fb:app_id" content="320278938731374"/>
    <?php } ?>
    <title>ilost</title>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="icon" href="<?= URL::home() ?>images/icons/favicon.png">
    <link rel="stylesheet" href="<?= URL::home() ?>essence/css/core-style.css">
    <link rel="stylesheet" href="<?= URL::home() ?>essence/style.css">
    <link rel="stylesheet" href="<?= URL::home() ?>styleLayout/css/bootstrap-select.min.css">
    <link href="<?= URL::home() ?>css/site.css?v=1.2.0" rel="stylesheet"/>
    <link href="<?= URL::home() ?>css/index.css" rel="stylesheet"/>
    <link href="<?= URL::home() ?>css/find.css" rel="stylesheet"/>
    <link href="<?= URL::home() ?>css/lost.css" rel="stylesheet"/>
    <link href="<?= URL::home() ?>css/main.css" rel="stylesheet"/>
    <link href="<?= URL::home() ?>css/about.css" rel="stylesheet"/>
    <link href="<?= URL::home() ?>css/myitems.css" rel="stylesheet"/>
    <link href="<?= URL::home() ?>css/user.css" rel="stylesheet"/>
    <link href="<?= URL::home() ?>css/contact.css" rel="stylesheet"/>
<body class="" id="body">
<?php $this->beginBody() ?>
<!--sign up form-->
<div class="modal-popup-login" id="login-modal">
    <!-- Modal content -->
    <div class="form modal-content-popup ">
        <div class="modal-content-header">
            <span class="close-popup" id="close-login">×</span>
        </div>
        <div style="clear: both; margin-bottom: 10px"></div>
        <ul class="tab-group">
            <li class="tab active"><a href="#signup">Log In</a></li>
            <li class="tab"><a href="#login">Sign Up</a></li>
        </ul>
        <div class="tab-content">
            <div id="signup">
                <h2 style="text-align: center">Welcome Back!</h2>
                <form action="#" method="post">
                    <div class="field-wrap">
                        <input type="email" id="sign-in-email" placeholder="Email Address"/>
                        <span class="error-massage" id="sign-in-email-error"></span>
                    </div>
                    <div class="field-wrap">
                        <input type="password" id="sign-in-password" placeholder="Password"/>
                        <span class="error-massage" id="sign-in-password-error"></span>
                    </div>
                    <button type="submit" class="btn essence-btn" id="change-email"><i style="display: none;"
                                                                         class="fa fa-spinner fa-spin loading"></i>Login
                    </button>
                    <a href="#" class="forgot-link" id="forgot-modal-open">
                        Forgot password?
                    </a>
                </form>
            </div>
            <div id="forgot">
                <h2>Write your email</h2>
                <form action="#" id="forgot-form">
                    <div class="field-wrap">
                        <input type="email" id="forgot-email" placeholder="Email Address"/>
                        <span class="error-massage"></span>
                    </div>
                    <button type="submit" class="btn essence-btn" id="forgot-button">
                        <i style="display: none;"
                           class="fa fa-spinner fa-spin loading"></i>Next
                    </button>
                    <a href="" class="forgot-link" id="forgot-to-login">
                        Back to login.
                    </a>
                </form>
            </div>
            <div id="confirm-password">
                <h2>Write code</h2>
                <p>Please check your email.We have sent you verification code.</p>
                <form action="#" id="confirm-password-form" class="login-modal">
                    <div class="field-wrap">
                        <input type="password" id="confirm-input" placeholder="Enter code"/>
                        <span class="error-massage"></span>
                    </div>
                    <button type="submit" class="btn essence-btn">
                        <i style="display: none;"
                           class="fa fa-spinner fa-spin loading"></i>Confirm
                    </button>
                </form>
            </div>
            <div id="new-password-table">
                <h2>Write new password</h2>
                <form action="#" class="login-modal">
                    <div class="field-wrap">
                        <input type="password" id="new-password-input" placeholder="New password"/>
                        <span class="error-massage"></span>
                    </div>
                    <button type="submit" class="btn essence-btn">
                        <i style="display: none;"
                           class="fa fa-spinner fa-spin loading"></i>Confirm
                    </button>
                </form>
            </div>
            <div id="login" style="display: none">
                <h2 style="text-align: center">Sign Up for Free</h2>
                <form action="#" method="post" class="login-modal">
                    <div class="top-row">
                        <div class="field-wrap">
                            <input type="text" id="first-name" placeholder="First Name"/>
                            <span class="error-massage" id="first-name-error"></span>
                        </div>
                        <div class="field-wrap">
                            <input type="text" id="last-name" placeholder="Last Name"/>
                            <span class="error-massage" id="last-name-error"></span>
                        </div>
                    </div>
                    <div class="field-wrap">
                        <input type="email" id="email" placeholder="Email Address"/>
                        <span class="error-massage" id="error-message"></span>
                    </div>
                    <div class="field-wrap">
                        <input type="password" id="user-password" placeholder="Password"/>
                        <span class="error-massage" id="user-password-error"></span>
                    </div>
                    <div class="field-wrap">
                        <input type="number" id="contact_number" placeholder="Contact number"/>
                        <span class="error-massage" id="contact_number_error"></span>
                    </div>
                    <button type="submit" class="btn essence-btn" id="user-id"><i style="display: none;"
                                                                    class="fa fa-spinner fa-spin loading"></i>Sign up
                    </button>
                </form>
            </div>
            <?php if (!empty($language)) { ?>
                <span id="language" style="display: none"><?= $language ?></span>
            <?php } ?>
        </div><!-- tab-content -->
    </div> <!-- /form -->
</div>
<div id="myModalPopup" class="modal-popup" style="<?php if (!empty($edit) || !empty($this->params['errors'])) {
    echo 'display:block;';
} else {
    echo "";

} ?>">
    <div class="modal-content-popup">
        <div class="modal-content-header">
            <span class="close-popup">&times;</span>
        </div>
        <div style="clear: both"></div>
        <form action="#" id="statement-form" enctype="multipart/form-data">
            <div class="form-row">
                <div class="col-md-6">
                    <label for="inputCity">Country</label>
                    <input type="text" name="inputCountry" class="form-control" id="inputCountry"
                           value="<?php if (empty($edit)) {
                               echo "";
                           } else {
                               echo $edit->country;
                           }
                           ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" name="inputCity" class="form-control" id="inputCity"
                           value="<?php if (empty($edit)) {
                               echo "";
                           } else {
                               echo $edit->city;
                           }
                           ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" name="inputAddress" class="form-control" id="inputAddress"
                       value="<?php if (empty($edit)) {
                           echo "";
                       } else {
                           echo $edit->address;
                       }
                       ?>">
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="inputTitle" class="form-control" id="inputTitle"
                       value="<?php if (empty($edit)) {
                           echo "";
                       } else {
                           echo $edit->title;
                       }
                       ?>">
                <span class="error-massage" id="title_message"></span>
            </div>
            <div class="form-group">
                <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="contact"
                               value="lost" <?php if (!empty($edit)) {
                            echo('disabled');
                            if ($edit->contact === 'lost') {
                                echo 'checked';
                            }
                        } ?> />
                        Lost
                        <span class="circle">
                            <span class="check"></span>
                            </span>
                    </label>
                </div>
                <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="contact"
                               value="find"<?php if (!empty($edit)) {
                            echo('disabled');
                            if ($edit->contact === 'find') {
                                echo 'checked';
                            }
                        } ?> />
                        Found
                        <span class="circle">
                             <span class="check"></span>
                                </span>
                    </label>
                </div>
                <span class="error-massage" id="contact_message"></span>
            </div>
            <div class="form-group">
                <label>Categories</label>
                <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="category"
                               value="cloths" <?= (!empty($edit) && $edit->category === 'cloths') ? 'checked' : '' ?>/>
                        Clothes and Accessories
                        <span class="circle">
                            <span class="check"></span>
                            </span>
                    </label>
                </div>
                <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="category"
                               value="documents" <?= (!empty($edit) && $edit->category === 'documents') ? 'checked' : '' ?>/>

                        Documents
                        <span class="circle">
                            <span class="check"></span>
                            </span>
                    </label>
                </div>
                <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="category"
                               value="electronics" <?= (!empty($edit) && $edit->category === 'electronics') ? 'checked' : '' ?>/>

                        Electronics
                        <span class="circle">
                            <span class="check"></span>
                            </span>
                    </label>
                </div>
                <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="category"
                               value="animals" <?= (!empty($edit) && $edit->category === 'animals') ? 'checked' : '' ?>/>

                        Animals and Pets
                        <span class="circle">
                             <span class="check"></span>
                                </span>
                    </label>
                </div>
                <span class="error-massage" id="category_message"></span>
            </div>


            <div class="form-group">
                <label class="label-control">Datetime Picker</label>
                <input type="text" name="dataTime" id="dataTime" class="form-control datetimepicker"
                       value="<?php if (empty($edit)) {
                           echo "";
                       } else {
                           echo $edit->data;
                       }
                       ?>"/>
            </div>


            <div class="form-group">
                <label class="label-control">Text</label>
                <textarea class="form-control" id="text" name="text"
                          placeholder="Write text"><?= (empty($edit)) ? '' : $edit->text ?></textarea>
                <span class="error-massage" id="text_message"></span>
            </div>
            <div class="delete-image-table">
                <?php
                if (!empty($edit) && $edit->contact === 'lost') {

                    foreach ($edit->lostImages as $images) {
                        ?>
                        <div class="image-span">
                            <img src="<?= URL::home() ?>uploads/<?= $images->image ?>" alt="">
                            <span class="delete-image" id="image_name" data-id="<?= $images->image ?>"
                                  data-toggle="modal" data-target="#myModal">&times;</span>
                        </div>
                    <?php }
                } else {
                    if (!empty($edit)) {
                        foreach ($edit->findImages as $images) {
                            ?>
                            <div class="image-span">
                                <img src="<?= URL::home() ?>uploads/<?= $images->image ?>" alt="">
                                <span class="delete-image" id="image_name" data-id="<?= $images->image ?>"
                                      data-toggle="modal" data-target="#myModal">&times;</span>
                            </div>
                        <?php }
                    }
                } ?>
            </div>

            <div class="image-table" style="width: auto; height: auto">

                <label class="file-upload btn btn-primary">
                    Browse for file ... <input style="display: none" type="file" name="image[]" id="statement-file" multiple/>
                </label>
            </div>
            <div class="statement-image-carousel">
                <div id="demo" class="carousel slide" data-ride="carousel">

                    <!-- Indicators -->

                    <!-- The slideshow -->
                    <div class="carousel-inner" id="active"></div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>

                </div>

            </div>

            <div style="clear: both"></div>
            <div class="btn-float">
                <input type="button" value="cancel" name="cancel" class="btn essence-btn " id="cancel"
                       style="display: <?= (empty($edit)) ? 'none' : 'block' ?>">
                <button type="button" class="btn essence-btn "
                        id="submit"
                ><i class="fa fa-spinner fa-spin loading"></i> <?php if (empty($edit)) {
                        echo "Save";
                    } else {
                        echo "Save changes";
                    }
                    ?></button>
            </div>
            <span id="image_contact" style="display: none"><?= (!empty($edit) ? $edit->contact : '') ?></span>
            <input type="hidden" id="edit-id" name="edit-id" value="<?= (!empty($edit->id)) ? $edit->id : '' ?>"/>
            <div style="clear: both"></div>
            <?php if (!empty($error)) { ?>
                <span id="error-message" style="color:red;font-size: 13px">Something goes wrong, please try again</span>
            <?php } ?>
        </form>
    </div>
</div>

<div class="modal contact-modal" id="contact_myModal">
    <div class="modal-dialog">
        <div class="modal-content" id="modal_box">

            <!-- Modal Header -->
            <div class="modal-header">
                <div class="iLost-logo">
                    <img src="<?= URL::home() ?>images/blue.png" alt="">
                </div>
            </div>

            <!-- Modal body -->
            <div class="modal-body contact-user-error">
                <p></p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="close-contact" class="btn essence-btn" data-dismiss="modal">Ok</button>
            </div>

        </div>
    </div>
</div>


<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="<?= URL::home() ?>">
                <img src="<?= URL::home() ?>images/blue_in.png" alt="">
            </a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        <li>
                            <a class="header-button" href="/site/lost">Lost</a>
                        </li>
                        <li>
                            <a class="header-button" href="/site/find">Found</a>
                        </li>


                        <li class="cn-dropdown-item pr12"><a href="#" class="header-button" id="mouseenter">About us
                                <i class="fas fa-angle-down"></i>
                                <i class="fas fa-angle-up"></i>

                            </a>
                            <ul class="dropdown">
                                <li><a class="header-button-small" href="/contact/">Contact</a></li>
                                <li><a class="header-button-small" href="/site/privacy-policy">Privacy policy</a></li>
                            </ul>

                        </li>
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>
        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end" id="header-meta">

            <div class="header-button">
                <a href="#" class="btn essence-btn" id="<?= (!empty($user_id)) ? "myBtn" : "open-login-modal" ?>">Report
                    Now</a>
            </div>
            <a class="nav-brand" id="mobile-nav-brand" href="<?= URL::home() ?>">
                <img src="<?= URL::home() ?>images/blue_in.png" alt="">
            </a>
            <!-- Search Area -->
            <div class="search-area">
                <div class="search-form">
                    <input type="search" id="search-table" placeholder="Type for search">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
            <!--            language area in heder-->

            <div class="language-area">
                <div class="nice-select selectpicker" tabindex="0"><i class="fas fa-globe"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
                            class="current"> English</span>
                    <ul class="list" style="width: 103px">
                        <li data-value="english" id="english" class="option selected focus">English</li>
                        <li data-value="armenian" id="armenian" class="option">Հայերեն</li>
                    </ul>
                </div>
            </div>
            <!--            language area in phone-->
            <div class="language_table">
                <div class="nice-select selectpicker" tabindex="0"><span class="current">En</span>
                    <ul class="list">
                        <li data-value="english" id="english" class="option selected focus">En</li>
                        <li data-value="armenian" id="armenian" class="option ">Հայ</li>
                    </ul>
                </div>
            </div>
            <!-- Favourite Area -->
            <?php if (!empty($user_id)) { ?>
                <div class="favourite-area">

                    <a href="#">
                        <i class="fa fa-user-o"></i>
                    </a>
                    <div class="dropdown-content" style="width: 140px">
                        <ul>
                            <li><a href="/user/">Settings</a></li>
                            <li><a href="/user/my-items" id=""> My items</a></li>
                            <li><a href="#" id="logout">Log out</a></li>
                        </ul>
                    </div>

                </div>
            <?php } ?>
            <!-- User Login Info -->
            <div class="user-login-info"
                 style="display:<?= (!empty($user_id) ? 'none' : 'block') ?> ">
                <a href="#" id="open-login-modal">
                    <i class="fa fa-user-o"></i>
                </a>
            </div>
            <!-- Cart Area -->

        </div>

    </div>
</header>
<div class="cart-bg-overlay"></div>

<div class="right-side-cart-area">
    <!-- Cart Button -->
</div>
<div class="content">
    <?= $content ?>
</div>
<footer class="footer_area clearfix" style="padding: 0;">
    <div class="row">
        <!-- Single Widget Area -->
        <div class="col-md-2">
            <!-- Logo -->
            <div class="footer-logo">
                <a href="<?= URL::home() ?>">
                    <img src="<?= URL::home() ?>images/white_in.png" alt="">
                </a>
            </div>
        </div>
        <div class="col-md-2">
            <!-- Footer Menu -->
            <div class="footer_menu">
                <ul>
                    <li>
                        <a href="/contact/">Contact</a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <!-- Footer Menu -->
            <div class="footer_menu">
                <ul>
                    <li>
                        <a href="/site/privacy-policy">Privacy policy</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Single Widget Area -->

        <div class="col-md-2" style="padding-top: 33px">
            <div class="nice-select selectpicker" tabindex="0"><span class="current">English</span>
                <ul class="list" style="width: 103px">
                    <li data-value="english" id="english" class="option selected focus">English</li>
                    <li data-value="armenian" id="armenian" class="option">Հայերեն</li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <div class="single_widget_area">
                <div class="footer_social_area">
                    <a href="https://www.facebook.com/RocketSystemsYerevan/" data-toggle="tooltip" data-placement="top" title=""
                       data-original-title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="items-table">
                <ul>
                    <li>
                        <a href="/site/lost">Lost items</a>
                    </li>
                    <li>
                        <a href="/site/find">Found items</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Single Widget Area -->
</footer>

<div class="mobile_footer">

    <ul>
        <li>
            <a href="#" id="<?= (!empty($user_id)) ? "myBtn" : "open-login-modal" ?>">
                <i class="fa fa-plus-circle"></i>
            </a>
        </li>
        <li>
            <a href="/site/lost"><i class="fa fa-compass"> </i> </a>
        </li>
        <li>
            <a href="/site/find"><i class="fa fa-check-circle-o"></i></a>
        </li>
        <li class="cn-dropdown-item-footer pr12">
            <a href="#"><i class="fa fa-info-circle"></i>
                <i class="fas fa-angle-down" style=""></i>
                <i class="fas fa-angle-up" style="display: none;"></i>
            </a>
            <div class="dropdown-content-footer" style="display: none;">
                <ul>
                    <li><a href="/contact/">Contact</a></li>
                    <li><a href="/site/privacy-policy">Privacy policy</a></li>
                </ul>
            </div>
        </li>
        <!--                        <li><a href="#">Blog</a></li>-->
    </ul>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">delete item</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <p>Are you sure...</p>
                <span style="display: none" id="item-image"></span>

            </div>
            <div class="modal-footer">
                <a href="#" id="delete_image" style="background-color: red">Delete</a>
                <a href="#" data-dismiss="modal" style="background-color: #0c83e2">Cancel</a>
            </div>
        </div>

    </div>
</div>
<?php $this->endBody() ?>
</body>


<script src="<?= URL::home() ?>js/jquery.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>essence/js/jquery/jquery-2.2.4.min.js"></script>
<!--   Core JS Files   -->
<!-- Popper js -->
<script src="<?= URL::home() ?>essence/js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="<?= URL::home() ?>essence/js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="<?= URL::home() ?>essence/js/plugins.js"></script>
<!-- Classy Nav js -->
<script src="<?= URL::home() ?>essence/js/classy-nav.min.js"></script>
<!-- Active js -->
<script src="<?= URL::home() ?>essence/js/active.js"></script>

<script src="<?= URL::home() ?>materialkit/assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>materialkit/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>materialkit/assets/js/core/bootstrap-material-design.min.js"
        type="text/javascript"></script>

<script src="<?= URL::home() ?>materialkit/assets/js/plugins/moment.min.js"></script>
<!--&lt;!&ndash;	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker &ndash;&gt;-->
<script src="<?= URL::home() ?>materialkit/assets/js/plugins/bootstrap-datetimepicker.js"
        type="text/javascript"></script>
<!--&lt;!&ndash;  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ &ndash;&gt;-->
<script src="<?= URL::home() ?>materialkit/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--&lt;!&ndash;	Plugin for Sharrre btn &ndash;&gt;-->
<script src="<?= URL::home() ?>materialkit/assets/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
<!--&lt;!&ndash; Control Center for Material Kit: parallax effects, scripts for the example pages etc &ndash;&gt;-->
<script src="<?= URL::home() ?>materialkit/assets/js/material-kit.js?v=2.0.4" type="text/javascript"></script>
<!--selectbox-->
<script src="<?= URL::home() ?>styleLayout/js/bootstrap-select.min.js"></script>
<!-- js files -->
<script src="<?= URL::home() ?>js/error_messages.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>js/popup.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>js/site.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>js/edit.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>js/userJs/user.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>js/userJs/change_user_data.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>js/contact.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>js/googleMap.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>js/search.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>js/error_messages.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>js/statement.js" type="text/javascript"></script>
<script src="<?= URL::home() ?>js/upload.js" type="text/javascript"></script>

</html>
<?php $this->endPage() ?>
