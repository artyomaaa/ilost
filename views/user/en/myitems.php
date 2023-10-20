<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 8/22/2018
 * Time: 1:52 PM
 */

use yii\helpers\Url;

?>


    <div class="breadcumb_area bg-img"
         style="background-image: url(<?= URL::home() ?>essence/img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-wrapper section-padding-80">

        <?php if (!empty($myLostItems)) { ?>
            <h1>My Lost Items</h1>
        <?php } ?>
        <div class="container">
            <div class="row">

                <!-- Single Blog Area -->
                <?php if (!empty($myLostItems)) {
                    foreach ($myLostItems

                             as $myLostItemsValue) { ?>
                        <div class="col-12 col-lg-6">
                            <div class="single-blog-area mb-50">
                                <div class="image-size">
                                    <img src="<?= URL::home() ?>uploads/<?php if (!empty($myLostItemsValue->lostImages)) {
                                        echo $myLostItemsValue->lostImages[0]->image;
                                    } else {
                                        echo "gif_(4).gif";
                                    } ?>" alt="">
                                </div>
                                <!-- Post Title -->
                                <div class="post-title">
                                    <h6 href="#"><?= $myLostItemsValue->title ?></h6>
                                </div>
                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Post Title -->
                                    <div class="hover-post-title">
                                        <h6 href="#"><?= $myLostItemsValue->title ?></h6>
                                    </div>
                                    <div class="text-style">
                                        <p>
                                            <a href="/site/about-item?id=<?= $myLostItemsValue->id ?>&category=lost"><?= $myLostItemsValue->text ?></a>
                                        </p>
                                    </div>
                                    <a href="/post/edit?id=<?= $myLostItemsValue->id ?>&contact=lost">Edit
                                        &nbsp;Item </a>
                                    <a href="#" class="delete-item" data-id="<?= $myLostItemsValue->id ?>"
                                       id="delete-item" data-toggle="modal" data-target="#myModal">Delete
                                        &nbsp;Item </a>
                                    <span style="display: none;"
                                          id="lost_contact_<?= $myLostItemsValue->id ?>"><?= $myLostItemsValue->contact ?></span>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>

            </div>
        </div>

    </div>
    <div class="blog-wrapper section-padding-80">
        <?php if (!empty($myFindItems)) { ?>
            <h1>My Find Items</h1>
        <?php } ?>
        <div class="container" style="margin-bottom: 126px">
            <div class="row">
                <?php if (!empty($myFindItems)) {
                    foreach ($myFindItems as $myFindItemsValue) { ?>
                        <!-- Single Blog Area -->
                        <div class="col-12 col-lg-6">
                            <div class="single-blog-area mb-50">
                                <div class="image-size">
                                    <img
                                            src="<?= URL::home() ?>uploads/<?php if (!empty($myFindItemsValue->findImages)) {
                                                echo $myFindItemsValue->findImages[0]->image;
                                            } else {
                                                echo "gif_(4).gif";
                                            } ?>" alt="">
                                </div>
                                <!-- Post Title -->
                                <div class="post-title">
                                    <h6 href="#"><?= $myFindItemsValue->title ?></h6>
                                </div>
                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Post Title -->
                                    <div class="hover-post-title">
                                        <h6 href="#"><?= $myFindItemsValue->title ?></h6>
                                    </div>
                                    <div class="text-style">
                                        <p>
                                            <a href="/site/about-item?id=<?= $myFindItemsValue->id ?>&category=find"><?= $myFindItemsValue->text ?></a>
                                        </p>
                                    </div>

                                    <a href="/post/edit?id=<?= $myFindItemsValue->id ?>&contact=find">Edit
                                        &nbsp;Item </a>

                                    <a href="#" class="delete-item" id="delete-item"
                                       data-id="<?= $myFindItemsValue->id ?>" data-toggle="modal"
                                       data-target="#myModal">Delete &nbsp;Item </a>
                                    <!-- Modal -->


                                    <span style="display: none;"
                                          id="lost_contact_<?= $myFindItemsValue->id ?>"><?= $myFindItemsValue->contact ?></span>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
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
                    <!--                <span style="display: none" id="item-id"></span>-->
                    <!--                <span style="display: none" id="item-contact"></span>-->
                </div>
                <div class="modal-footer">
                    <a href="" id="item-id" style="background-color: red">Delete</a>
                    <a href="" style="background-color: #0c83e2">Cancel</a>
                </div>
            </div>

        </div>
    </div>
<?php if (empty($myFindItems) && empty($myLostItems)) { ?>
    <div class="no-item">
        <div>
            <h3>You don't have any announcements yet.</h3>
        </div>
    </div>
<?php } ?>