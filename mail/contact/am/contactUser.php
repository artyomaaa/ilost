<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 10/24/2018
 * Time: 3:22 PM
 */
use yii\helpers\Url;
?>

<?php if (!empty($post)) { ?>
    <div class="contact-user-body" style="  padding: 10px 120px;">
        <img src="<?= URL::base(true) ?>/images/blue_in.png" alt="">
        <h2 style="color: #4659B0; text-align: center;">Դուք ունեք նամակ <?= $post['send_email'] ?> օգտատիրոջից։</h2>
        <div class="text-table"
             style="border: 1px solid #4659B0; border-radius: 5px;  padding: 15px 20px; margin: 50px 0 25px 0;">
            <p style=" font-size: 14px;"><?= $post['send_text'] ?></p>
        </div>
        <span style="   font-size: 18px;
                color: #3247a9;
                font-weight: 600;
                float: left;
                display: block;
                position: relative;">Էլ․հասցե:</span>
        <p style="  color: #3247a9;
                display: block;
                position: relative;
                float: left;
                margin: 4px;"><?= ($post['send_email']) ?></p>
        <span style="   font-size: 18px;
                color: #3247a9;
                font-weight: 600;
                float: left;
                display: block;
                position: relative;">Հեռախոսահամար:</span>
        <p style="  color: #3247a9;
                display: block;
                position: relative;
                float: left;
                margin: 4px;"><?= $post['send_number'] ?></p>
    </div>

<?php } ?>
