<?php

use yii\helpers\Url;

?>
<div style="padding: 50px 100px">
    <img src="<?= URL::base(true) ?>/images/blue_in.png" alt="">
    <h1 style="text-align: center; color:#4659B0; margin-bottom: 35px; margin-top: 0">Confirm your email on iLost</h1>
    <p style="color: #4659B0; font-size: 16px; margin-bottom: 45px"><span style="color: #4659B0; font-size: 24px">Hi!</span> Your iLost account is almost ready !
        To finish setting up your account we need to verify that you have access to the email address used to create
        the account. Click the link below, sign in and you're ready to go.
    </p>
    <a style="text-decoration: none; padding: 15px 55px; color: white; background-color: #4659B0; border-radius: 10px; font-size: 18px; font-weight: 700;box-shadow: 0 2px 2px 0 rgba(12, 131, 226, 0.14), 0 3px 1px -2px rgba(12, 131, 226, 0.2), 0 1px 5px 0 rgba(153, 153, 153, 0.12);"
       href="<?= URL::base(true) ?>/auth/get-email?token=<?php if (!empty($post)) echo $post;?>" class="verify">
        Verify
    </a>
</div>
