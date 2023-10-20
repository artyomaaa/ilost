<?php

use yii\helpers\Url;

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


<section class="shop_grid_area section-padding-80" style="padding-bottom:<?= (empty($lostThing) ? "86px" : "0") ?>">
    <div class="container large-container" style="margin-bottom: 93px">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-2" style="padding-left: 0">
                <div class="shop_sidebar_area">

                    <!-- ##### Single Widget ##### -->
                    <div class="widget catagory mb-50">
                        <!-- Widget Title -->
                        <h6 class="widget-title mb-30">Catagories</h6>

                        <!--  Catagories  -->
                        <div class="catagories-menu">
                            <ul id="menu-content2" class="menu-content collapse show">
                                <!-- Single Item -->
                                <li data-toggle="collapse" data-target="#clothing">
                                    <a href="/category/?category_name=cloths&category=lost" id="cloths"
                                       style="color: <?= (!empty($category_name) && $category_name === 'cloths') ? '#0c83e2' : '#4659B0' ?>">Clothes
                                        and accessories</a>

                                </li>
                                <!-- Single Item -->
                                <li data-toggle="collapse" data-target="#shoes" class="collapsed">
                                    <a href="/category/?category_name=documents&category=lost" id="documents"
                                       style="color: <?= (!empty($category_name) && $category_name === 'documents') ? '#0c83e2' : '#4659B0' ?>">Documents</a>

                                </li>
                                <!-- Single Item -->
                                <li data-toggle="collapse" data-target="#accessories" class="collapsed">
                                    <a href="/category/?category_name=electronics&category=lost" id="electronics"
                                       style="color: <?= (!empty($category_name) && $category_name === 'electronics') ? '#0c83e2' : '#4659B0' ?>">Electronics</a>

                                </li>
                                <li data-toggle="collapse" data-target="#accessories" class="collapsed">
                                    <a href="/category/?category_name=animals&category=lost" id="animals"
                                       style="color: <?= (!empty($category_name) && $category_name === 'animals') ? '#0c83e2' : '#4659B0' ?>">Animals
                                        and pets</a>

                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- ##### Single Widget ##### -->


                    <!-- ##### Single Widget ##### -->


                    <!-- ##### Single Widget ##### -->

                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-10" style="text-align: center">

                <div class="shop_grid_product_area">
                    <div class="row">
                        <div class="col-12">

                            <div class="product-topbar d-flex align-items-center justify-content-between">

                                <!-- Total Products -->
                                <div class="widget price mb-50"
                                     style="display:<?= (empty($category_name)) ? 'none' : 'block' ?>;margin: 0px auto">
                                    <!-- Widget Title -->

                                    <!-- Widget Title 2 -->
                                    <h6 class="">Search in category</h6>


                                    <div class="widget-desc">
                                        <div class="slider-range">
                                            <form action="/category/search-in-category" type="get">
                                                <div class="search-input">

                                                    <input type="text" name="search_category" id=""
                                                           placeholder="search.."/>

                                                    <input type="hidden" name="category_name"
                                                           value="<?php if (!empty($category_name)) {
                                                               echo $category_name;
                                                           } ?>"/>
                                                    <input type="hidden" name="category" value="lost">

                                                </div>
                                                <button><i class="material-icons">
                                                        search
                                                    </i></button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Sorting -->
                                <div class="product-sorting d-flex">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <?php if (!empty($lostThing)) {
                            foreach ($lostThing
                                     as $lost) { ?>
                                <!-- Single Product -->
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <a href="/site/about-item?id=<?= $lost->id ?>&category=<?php echo $lost->contact; ?>">
                                        <div class="single-product-wrapper">
                                            <!-- Product Image -->
                                            <div class="product-img">
                                                <?php if ($lost->contact === "lost") { ?>
                                                    <img src="<?= URL::home() ?>uploads/<?php if (!empty($lost->lostImages)) {
                                                        echo $lost->lostImages[0]->image;
                                                    } else {
                                                        echo "gif_(4).gif";
                                                    } ?>" alt="">
                                                <?php } else { ?>
                                                    <img src="<?= URL::home() ?>uploads/<?php if (!empty($lost->findImages)) {
                                                        echo $lost->findImages[0]->image;
                                                    } else {
                                                        echo "gif_(4).gif";
                                                    } ?>" alt="">
                                                <?php } ?>
                                                <!-- Hover Thumb -->
                                                <!--                                    <img class="hover-img" src="-->
                                                <? //= URL::home() ?><!--essence/img/product-img/product-2.jpg"-->
                                                <!--                                         alt="">-->

                                                <!-- Product Badge -->

                                                <!-- Favourite -->

                                            </div>

                                            <!-- Product Description -->
                                            <div class="product-description">
                                                <p><?= $lost->title ?></p>

                                                <p class="text-hidden"><?=  mb_strimwidth($lost->text    , 0, 80,'...') ?></p>


                                                <!-- Hover Content -->
                                                <div class="hover-content">
                                                    <!-- Add to Cart -->

                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
                <!-- Pagination -->
                <nav aria-label="navigation" class="pagination-section">
                    <?php try {
                        if (!empty($provider)) {
                            echo \yii\widgets\LinkPager::widget([
                                'pagination' => $provider->pagination,
                            ]);
                        }
                    } catch (Exception $e) {
                    } ?>
                </nav>
            </div>
        </div>
    </div>
</section>









