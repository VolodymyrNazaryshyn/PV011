<div class="wrapper">
    <?php if( isset( $view_data[ 'reg_ok' ] ) ) : ?>
        <dialog class="reg-dialog" id="reg_dialog">
            <div class="reg-ok"><?= $view_data[ 'reg_ok' ] ?></div>
        </dialog>
        <script>
            reg_dialog.showModal();
            setTimeout(() => reg_dialog.close(), 500 + 100 * (reg_dialog.innerText.length));
        </script>
    <?php endif ?>
    
    <div class="reg-form-container">
        <div class="reg-form">
            <div class="reg-form-title">Create Account</div>

            <?php if( isset( $view_data[ 'reg_error' ] ) && !( in_array( $view_data[ 'reg_error' ], $reg_error[ 'login_err' ] ) 
                || in_array( $view_data[ 'reg_error' ], $reg_error[ 'userName_err' ] ) || in_array( $view_data[ 'reg_error' ], $reg_error[ 'password_err' ] )
                || in_array( $view_data[ 'reg_error' ], $reg_error[ 'confirm_err' ] ) || in_array( $view_data[ 'reg_error' ], $reg_error[ 'email_err' ] ) ) ) : ?>
                <div class="reg-error"><?= $view_data[ 'reg_error' ] ?></div>
            <?php endif ?>
            
            <form class="registerForm" method="post">
                <div class="reg-form-control-wrapper">
                    <div class="reg-form-control">
                        <label for="login">Login</label>
                        <!-- required -->
                        <input name="login" value='<?= (isset($view_data['login'])) ? $view_data['login'] : "" ?>' /> 
                        <?php if( isset( $view_data[ 'reg_error' ] ) && in_array( $view_data[ 'reg_error' ], $reg_error[ 'login_err' ] ) ) : ?>
                            <div class="reg-error"><?= $view_data[ 'reg_error' ] ?></div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="reg-form-control-wrapper">
                    <div class="reg-form-control">
                        <label for="userName">Username</label>
                        <input name="userName" value='<?= (isset($view_data['userName'])) ? $view_data['userName'] : "" ?>' />
                        <?php if( isset( $view_data[ 'reg_error' ] ) && in_array( $view_data[ 'reg_error' ], $reg_error[ 'userName_err' ] ) ) : ?>
                            <div class="reg-error"><?= $view_data[ 'reg_error' ] ?></div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="reg-form-control-wrapper">
                    <div class="reg-form-control">
                        <label for="userPassword1">Password</label>
                        <!-- required -->
                        <input type="password" name="userPassword1" />
                        <?php if( isset( $view_data[ 'reg_error' ] ) && in_array( $view_data[ 'reg_error' ], $reg_error[ 'password_err' ] ) ) : ?>
                            <div class="reg-error"><?= $view_data[ 'reg_error' ] ?></div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="reg-form-control-wrapper">
                    <div class="reg-form-control">
                        <label for="confirm">Confirm password</label>
                        <input type="password" name="confirm" />
                        <?php if( isset( $view_data[ 'reg_error' ] ) && in_array( $view_data[ 'reg_error' ], $reg_error[ 'confirm_err' ] ) ) : ?>
                            <div class="reg-error"><?= $view_data[ 'reg_error' ] ?></div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="reg-form-control-wrapper">
                    <div class="reg-form-control">
                        <label for="email">Email</label>
                        <!-- required -->
                        <input type="email" name="email" value='<?= (isset($view_data['email'])) ? $view_data['email'] : "" ?>' />
                        <?php if( isset( $view_data[ 'reg_error' ] ) && in_array( $view_data[ 'reg_error' ], $reg_error[ 'email_err' ] ) ) : ?>
                            <div class="reg-error"><?= $view_data[ 'reg_error' ] ?></div>
                        <?php endif ?>
                    </div>
                </div>
                <button class="reg-button">Registration</button>
            </form>
        </div>
    </div>
</div>