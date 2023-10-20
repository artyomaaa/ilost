<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 10/24/2018
 * Time: 3:22 PM
 */
use yii\helpers\Url;
?>
<?php if (!empty($post)){?>
    <div class="contact-us-body" style=" height: auto;padding:10px 120px;">
        <img src="<?= URL::base(true) ?>/images/blue_in.png" alt="">
        <h2 style="text-align: center; color: #3247a9">Դուք ունեք նամակ <?=$post['contact_name']?> օգտատիրոջից։</h2>
        <div class="contact-us-text" style="  padding: 15px 20px;
                border: 1px solid #3247a9;
                margin: 50px 0 25px 0;
                border-radius: 5px;">
            <p style="font-size: 14px;color: #3247a9">
                <?=$post['contact_text']?>
            </p>
        </div>
        <div class="contact-us-footer">
        <span style=" font-size: 18px;
                color: #3247a9;
                font-weight: 600;
                float: left;
                display: block;
                position: relative;">Անուն:</span>
            <p style="color: #3247a9;
                display: block;
                position: relative;
                float: left;
                margin: 4px;"><?=$post['contact_name']?></p>
            <span style=" font-size: 18px;
                color: #3247a9;
                font-weight: 600;
                float: left;
                display: block;
                position: relative;">Էլ․հասցե:</span>
            <p style="color: #3247a9;
                display: block;
                position: relative;
                float: left;
                margin: 4px;"><?=$post['contact_email']?></p>
        </div>
    </div>

<?php }?>
