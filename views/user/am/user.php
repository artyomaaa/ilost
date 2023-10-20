<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 8/27/2018
 * Time: 2:32 PM
 */

use yii\helpers\Url;

?>
<div class="breadcumb_area bg-img" style="background-image: url('/essence/img/bg-img/breadcumb.jpg');">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">

                </div>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($user)) { ?>
    <div class="user-table">
        <form action="#" method="post" class="login-modal" id="user-data-form">
            <h2 style="text-align: center; margin-bottom: 60px">Փոփոխել օգտատիրոջ տվյալները</h2>

            <div class="top-row">
                <div class="field-wrap">
                    <input type="text" name="first-name" placeholder="Անուն" value="<?= $user->first_name ?>" disabled>
                    <i class="far fa-edit change"></i>
                    <i class="fas fa-times close-input"></i>
                    <i class="fas fa-check done"></i>
                    <span class="error-massage" id="first-name-error"></span>
                </div>

                <div class="field-wrap">
                    <input type="text" name="last-name" placeholder="Ազգանուն" value="<?= $user->last_name ?>" disabled>
                    <i class="far fa-edit change"></i>
                    <i class="fas fa-times close-input"></i>
                    <i class="fas fa-check done"></i>
                    <span class="error-massage" id="last-name-error"></span>
                </div>
            </div>

            <div class="field-wrap">
                <input type="email" name="email" placeholder="Էլ․հասցե" value="<?= $user->email ?>" disabled=>
                <i class="far fa-edit change"></i>
                <i class="fas fa-times close-input"></i>
                <i class="fas fa-check done"></i>
                <span class="error-massage" ></span>
            </div>

            <div class="field-wrap">
                <input type="password" name="password" id="password-input" placeholder="Գաղտնաբառ" disabled>
                <i class="far fa-edit change" id="password-icon"></i>
                <span class="error-massage" id="user-password-error"></span>
                <div class="change-password-table">
                    <i class="fas fa-times close-input" id="password-close-input"></i>
                    <i class="fas fa-check done" id="password-done"></i>
                    <div class="top-row">
                        <div class="field-wrap">
                            <input type="password" id="old_password" name="old_password" placeholder="Ընթացիկ գաղտնաբառը">
                            <span class="error-massage" id="old_password_message"></span>
                        </div>
                        <div class="field-wrap">
                            <input type="password" id="new_password" name="new_password" placeholder="Նոր գաղտնաբառը">
                        </div>
                        <div class="field-wrap">
                            <input type="password" id="new_password_again" name="new_password_again"
                                   placeholder="Կրկնել գաղտնաբառը">
                            <span class="error-massage" id="equal_password"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field-wrap">
                <input type="number" name="number" placeholder="Հեռախոսահամար"
                       value="<?= $user->contact_number ?>" disabled>
                <i class="far fa-edit change"></i>
                <i class="fas fa-times close-input"></i>
                <i class="fas fa-check done"></i>
                <span class="error-massage" id="contact_number_error"></span>
            </div>
            <input type="hidden" id="user_id" value="<?= $user->id ?>">

            <button type="button" class="btn essence-btn" id="save-user-changes"><i style="display: none;"
                                                                      class="fa fa-spinner fa-spin loading"></i>Պահպանել
            </button>
            <button type="button" class="btn essence-btn" id="cancel-changes"><i style="display: none;"
                                                                   class="fa fa-spinner fa-spin loading"></i>Չեղարկել
            </button>
        </form>
    </div>

<?php } ?>

