<?php
use Yii\helpers\Url;
?>
<div style="padding: 50px 100px">
    <img src="<?= URL::base(true) ?>/images/blue_in.png" alt="">
    <h1 style="text-align: center; color:#4659B0;margin-top: 0; margin-bottom: 65px">We received a request to reset your iLost password.</h1>
    <p style="color: #4659B0; font-size: 16px; margin-bottom: 40px">
        You can enter this code to reset your password:
    </p>
    <h2 style="width: 313px;color: #4659B0; border: 1px solid #4659B0; border-radius: 5px; padding: 10px"><?=(!empty($post)? $post:"")?></h2>

</div>
