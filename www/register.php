<div class="wrapper">
    <main>
        <?php if( isset( $view_data[ 'reg_error' ] ) ) : ?>
            <div class="reg-error"><?= $view_data[ 'reg_error' ] ?></div>
        <?php endif ?>

        <?php if( isset( $view_data[ 'reg_ok' ] ) ) : ?>
            <div class="reg-error"><?= $view_data[ 'reg_ok' ] ?></div>
        <?php endif ?>

        <div class="reg-form-container">
            <div class="reg-form">
                <div class="reg-form-title">Create Account</div>
                <form class="registerForm" method="post">
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="login">Login</label>
                            <!-- required -->
                            <input name="login" value='<?= (isset($view_data['login'])) ? $view_data['login'] : "" ?>' /> 
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="userName">Username</label>
                            <input name="userName" value='<?= (isset($view_data['userName'])) ? $view_data['userName'] : "" ?>' />
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="userPassword1">Password</label>
                            <!-- required -->
                            <input type="password" name="userPassword1" />
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="confirm">Confirm password</label>
                            <input type="password" name="confirm" />
                        </div>
                    </div>
                    <div class="reg-form-control-wrapper">
                        <div class="reg-form-control">
                            <label for="email">Email</label>
                            <!-- required -->
                            <input type="email" name="email" value='<?= (isset($view_data['email'])) ? $view_data['email'] : "" ?>' />
                        </div>
                    </div>
                    <button class="reg-button">Registration</button>
                </form>
            </div>
        </div>
    </main>
</div>