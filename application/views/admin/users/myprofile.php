<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Meu Usuário</strong> - <em>Editar</em>
                    </h1>
                </section>
                <hr class="col-xs-12" />
                <!-- /.box-header -->
                <div class="box-body">
                    <?php

                    $setup = array('class' => 'form-control', 'trim|required');
                    if ($msg = get_msg()) {
                        echo '<div class="row">';
                        echo '<div class="col-xs-12">';
                        echo $msg;
                        echo '</div>';
                        echo '</div>';
                    }

                    echo form_open();

                    $form_input_first_name = isset($user['first_name']) ? $user['first_name'] : "";
                    $form_input_last_name = isset($user['last_name']) ? $user['last_name'] : "";
                    $form_input_email = isset($user['email']) ? $user['email'] : "";
                    $form_input_phone = isset($user['phone']) ? $user['phone'] : "";
                    $form_input_login = isset($user['login']) ? $user['login'] : "";
                    $form_input_blocked = isset($user['blocked']) ? $user['blocked'] : "";
                    $form_input_permission_name = isset($user['permission_name']) ? $user['permission_name'] : "";
                    $form_input_permission_value = isset($user['permission_value']) ? $user['permission_value'] : "";

                    echo ' <div class="form-group">';
                    $form_first_name = (isset($user['first_name'])) ? $user['first_name'] : '';
                    $opts = array('autocomplete' => 'off', 'name' => 'first_name', 'value' => $form_input_first_name, 'title' => 'Infome seu Nome');
                    echo form_label('Nome:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $form_last_name = (isset($user['last_name'])) ? $user['last_name'] : '';
                    $opts = array('autocomplete' => 'off', 'name' => 'last_name', 'value' => $form_input_last_name, 'title' => 'Infome seu Sobrenome');
                    echo form_label('Sobrenome:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $form_email = (isset($user['email'])) ? $user['email'] : '';
                    $opts = array('autocomplete' => 'off', 'name' => 'email', 'value' => $form_input_email, 'title' => 'Infome seu E-mail');
                    echo form_label('email:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';


                    echo ' <div class="form-group">';
                    $form_phone = (isset($user['phone'])) ? $user['phone'] : '';
                    $opts = array('autocomplete' => 'off', 'name' => 'phone', 'value' => $form_input_phone, 'title' => 'Infome seu Telefone');
                    echo form_label('Telefone:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';


                    // DADOS LOGIN 

                    echo ' <div class="form-group">';
                    $form_login = (isset($user['login'])) ? $user['login'] : '';
                    $opts = array('autocomplete' => 'off', 'name' => 'login', 'value' => $form_input_login, 'title' => 'Infome seu Login');
                    echo form_label('Login:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';


                    echo '<div class="row">';
                    echo '<div class="col-xs-12 col-md-6">';

                    echo '<div class="form-group">';
                    echo '<div class="row">';
                    echo '<div class="col-xs-12 ">';
                    echo form_label('Tipo do Usuário:');
                    echo '</div>';
                    echo '<div class="col-xs-12 ">';

                    $permission_name = array(
                        LABEL_ADMIN => LABEL_ADMIN,
                        LABEL_EDITOR => LABEL_EDITOR,
                        LABEL_VIEWER => LABEL_VIEWER
                    );
                    if (AmIRoot()) {
                        $permission_name = array(
                            LABEL_ADMIN => LABEL_ADMIN,
                            LABEL_EDITOR => LABEL_EDITOR,
                            LABEL_VIEWER => LABEL_VIEWER,
                            LABEL_ROOT => LABEL_ROOT
                        );
                    }

                    $opts = array('autocomplete' => 'off', 'name' => 'permission_name', 'value' => $form_input_permission_name, 'title' => 'Tipo de Usuário', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $permission_name, $form_input_permission_name);
                    echo '</div>';

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';


                    echo '<div class="col-xs-12 col-md-6">';
                    echo '<div class="form-group">';
                    echo '<div class="row">';
                    echo '<div class="col-xs-12">';
                    echo form_label('Usuário está:');
                    echo '</div>';
                    echo '<div class="col-xs-12">';
                    $arrayOpts = array(
                        "0" => "ATIVO",
                        "1" => "BLOQUEADO"
                    );

                    $opts = array('autocomplete' => 'off', 'name' => 'blocked', 'value' => $form_input_blocked, 'title' => 'Estado do Usário', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $arrayOpts);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="form-group">';
                    $opts = array('autocomplete' => 'off', 'name' => 'password', 'title' => 'Infome sua Senha', 'placeholder' => 'Senha', 'value' => '');
                    echo form_label('Senha');
                    echo form_password($opts, '', $setup);
                    echo '</div>';

                    echo '<div class="form-group ">';
                    $opts = array('autocomplete' => 'off', 'name' => 'password2', 'title' => 'Repita sua Senha', 'placeholder' => 'Repitir Senha', 'value' => '');
                    echo form_password($opts, '', $setup);
                    echo '</div>';

                    echo '<div class="form-group ">';
                    echo form_submit('enviar', 'Salvar', array('class' => 'btn btn-success pull-right'));
                    echo '<a href="' . base_url("admin/users/listar") . '" class="btn btn-default pull-right">Voltar</a>';
                    echo '</div>';

                    // Form Closed
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.wrapper-content -->
<!-- fica no header -->
</div>