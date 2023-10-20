<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 11/26/2018
 * Time: 3:59 PM
 */
use yii\helpers\Url;

?>
<div style="padding: 50px 100px">
    <img src="<?= URL::base(true) ?>/images/blue_in.png" alt="">
    <h1 style="text-align: center; color:#4659B0;margin-top: 0; margin-bottom: 65px">Հաստատեք ձեր էլ.հասցեի փոփոխությունը</h1>
    <p style="color: #4659B0; font-size: 16px; margin-bottom: 40px">
        Դուք փորձում եք փոխել ձեր էլ․հասցեն iLost-ում։Խնդրում ենք հաստատել։
    </p>
    <a style="text-decoration: none; padding: 15px 55px; color: white; background-color: #4659B0; border-radius: 10px; font-size: 18px; font-weight: 700;box-shadow: 0 2px 2px 0 rgba(12, 131, 226, 0.14), 0 3px 1px -2px rgba(12, 131, 226, 0.2), 0 1px 5px 0 rgba(153, 153, 153, 0.12);"
       href="<?= URL::base(true) ?>/auth/get-email?token=<?php if (!empty($post)){ echo $post[0]['token'];?>&email=<?php echo $post[0]['email'];}?>" class="verify">
        Հաստատել
    </a>
</div>
