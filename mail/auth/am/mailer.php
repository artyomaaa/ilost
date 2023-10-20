<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 10/24/2018
 * Time: 3:21 PM
 */
use yii\helpers\Url;
?>
<div style="padding: 50px 100px">
    <img src="<?= URL::base(true) ?>/images/blue_in.png" alt="">
    <h1 style="text-align: center; color:#4659B0;margin-top: 0; margin-bottom: 65px">Հաստատեք ձեր էլ.հասցեն</h1>
    <p style="color: #4659B0; font-size: 16px; margin-bottom: 40px"> Ձեր գրանցումը iLost-ում գրեթե ավարտված է։
        Ձեր անձնական էջի կարգավորումները ավարտին հասցնելու համար մենք պետք է համոզվենք, որ Դուք կարող եք մուտք գործել
        գրանցման ժամանակ օգտագործված էլեկտրոնային հասցե։ Անցնելով ստորև ներկայացված հղումով՝ կարող եք մուտք գործել  և Ձեր
        անձնկան էջը պատրաստ է։
    </p>
    <a style="text-decoration: none; padding: 15px 55px; color: white; background-color: #4659B0; border-radius: 10px; font-size: 18px; font-weight: 700;box-shadow: 0 2px 2px 0 rgba(12, 131, 226, 0.14), 0 3px 1px -2px rgba(12, 131, 226, 0.2), 0 1px 5px 0 rgba(153, 153, 153, 0.12);"
       href="<?= URL::base(true) ?>/auth/get-email?token=<?php if (!empty($post)) echo $post;?>" class="verify">
        Հաստատել
    </a>
</div>