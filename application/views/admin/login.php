<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b><?php echo SITE_SIGLA ?></b>Sys</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Login</p>
            <?php
            if ($msg = get_msg()) {
                echo $msg;
            }
            ?>
            <div class="">
                <div class="card card-login mx-auto mt-5">
                    <div class="card-body">

                        <?php

                        $setup = array('class' => 'form-control', 'trim|required');                        

                        echo form_open('', ['autocomplete'=>"off"]);
                        echo '<div class="form-group">';
                        // $opts = array('name'=>'login', 'value' => set_value('login'), 'title' => 'Infome seu Usuário','placeholder' => 'Usuário', 'autofocus'=>'autofocus');
                        $opts = array('name' => 'login', 'title' => 'Infome seu Usuário', 'autocomplete'=>"off", 'placeholder' => 'Usuário', 'autofocus' => 'autofocus', 'value' => '');
                        echo form_input($opts, '', $setup);
                        echo '</div>';

                        echo '<div class="form-group">';
                        $opts = array('name' => 'password', 'title' => 'Infome sua Senha', 'placeholder' => 'Senha', 'value' => 'poipoipoi');
                        echo form_password($opts, '', $setup);
                        echo '</div>';

                        echo form_submit('enviar', 'Entrar', array('class' => 'btn btn-primary btn-block btn-flat'));
                        // Form Closed
                        echo form_close();
                        ?>
                    </div>  
                </div>
            </div>

                    <?php /*
            <div class="social-auth-links text-center">
                <p>- OU -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
            </div>
            <!-- /.social-auth-links -->
            
            <a href="#">I forgot my password</a><br>
            <a href="register.html" class="text-center">Register a new membership</a>
             */ ?>

        </div>
        <!-- /.login-box-body -->
    </div>