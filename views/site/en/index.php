<?php

/* @var $this yii\web\View */
header('Content-Type: text/plain; charset=utf-8');
use yii\helpers\Url;

//use yii\widgets\ActiveForm;


$this->title = 'My Yii Application';

$session = Yii::$app->session;
$user_id = $session->get('user_id');
$edit = $session->get('edit');
?>
<img class="animated-image" src="<?= URL::home() ?>images/iphone.png">

<section class="a" style="height: 120vh;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="hero-content">
                    <img src="<?= URL::home() ?>images/white.png" alt="">
                    <h4 style="color: white" class="title-text"> Find your lost items here or help others to find theirs</h4>
                    <h6 style="color: white"> Lost or found something ? </h6>
                    <a href="#" class="btn essence-btn" id="<?= (!empty($user_id)) ? "myBtn" : "open-login-modal" ?>">
                        Report Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="new_arrivals_area section-padding-80 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <?php if (!empty($statements)) { ?>
                        <h2>Last lost items </h2>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <!-- Single Product -->
                    <div class="new-statements">
                        <div class="statements">
                            <div class="row">
                                <?php if (!empty($statements)) {
                                    foreach ($statements as $new_value) { ?>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <a href="/site/about-item?id=<?= $new_value->id ?>&category=lost">
                                                <div class="single-product-wrapper">
                                                    <!--                                    --><?php //echo '<pre>'; var_dump($new_value->images[0]->image);?>
                                                    <!-- Product Image -->

                                                    <div class="product-img">
                                                        <img src="<?= URL::home() ?>uploads/<?php if (!empty($new_value->lostImages)) {
                                                            echo $new_value->lostImages[0]->image;
                                                        } else {
                                                            echo "gif_(4).gif";
                                                        } ?>" alt=""/>

                                                    </div>
                                                    <!-- Product Description -->
                                                    <div class="product-description">
                                                        <p><?= $new_value->title ?></p>

                                                        <p class="text-hidden"><?= mb_strimwidth($new_value->text   , 0, 100,'...') ?></p>
                                                        <!-- Hover Content -->

                                                    </div>

                                                </div>
                                            </a>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="owl-controls">
                        <div class="owl-nav">
                            <div class="owl-prev" style="display: none;">prev</div>
                            <div class="owl-next" style="display: none;">next</div>
                        </div>
                        <div class="owl-dots" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="new_arrivals_area section-padding-80 clearfix" style="padding-top: 26px;margin-bottom: 120px">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <?php if (!empty($findThing)) { ?>
                        <h2>Last found items</h2>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="">
                    <!-- Single Product -->
                    <div class="new-statements">
                        <div class="statements">
                            <div class="row">
                                <?php if (!empty($findThing)) {
                                    foreach ($findThing

                                             as $find) { ?>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <a href="/site/about-item?id=<?= $find->id ?>&category=find">
                                                <div class="single-product-wrapper">
                                                    <!-- Product Image -->
                                                    <div class="product-img">
                                                        <img src="<?= URL::home() ?>uploads/<?php if (!empty($find->findImages)) {
                                                            echo $find->findImages[0]->image;
                                                        } else {
                                                            echo "gif_(4).gif";
                                                        } ?>" alt="">
                                                        <!-- Hover Thumb -->
                                                    </div>
                                                    <!-- Product Description -->
                                                    <div class="product-description">
                                                        <p><?= $find->title ?></p>

                                                        <p class="text-hidden"><?=  mb_strimwidth($find->text   , 0, 100,'...') ?></p>
                                                        <!-- Hover Content -->

                                                    </div>

                                                </div>
                                            </a>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                        <div class="owl-controls">
                            <div class="owl-nav">
                                <div class="owl-prev" style="display: none;">prev</div>
                                <div class="owl-next" style="display: none;">next</div>
                            </div>
                            <div class="owl-dots" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>













