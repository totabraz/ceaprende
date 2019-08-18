<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Usuários</strong> - <em>Cadastrar Novo</em>
                    </h1>
                </section>
                <hr class="col-xs-12" />
                <div class="box-body">
                    <?php
                    $setup = array('class' => 'form-control', 'trim|required');
                    if ($msg = get_msg()) {
                        echo $msg;
                    }
                    echo form_open();

                    $form_input_full_name = isset($form_input['full_name']) ? $form_input['full_name'] : "";
                    $form_input_email = isset($form_input['email']) ? $form_input['email'] : "";
                    $form_input_phone = isset($form_input['phone']) ? $form_input['phone'] : "";
                    $form_input_login = isset($form_input['login']) ? $form_input['login'] : "";

                    echo ' <div class="form-group">';
                    $form_full_name = (isset($user['full_name'])) ? $user['full_name'] : '';
                    $opts = array('name' => 'full_name', 'value' => $form_input_full_name, 'title' => 'Infome seu Nome');
                    echo form_label('Nome:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $form_email = (isset($user['email'])) ? $user['email'] : '';
                    $opts = array('name' => 'email', 'value' => $form_input_email, 'title' => 'Infome seu E-mail');
                    echo form_label('email:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';


                    echo ' <div class="form-group">';
                    $form_phone = (isset($user['phone'])) ? $user['phone'] : '';
                    $opts = array('name' => 'phone', 'value' => $form_input_phone, 'title' => 'Infome seu Telefone');
                    echo form_label('Telefone:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';


                    // DADOS LOGIN 

                    echo ' <div class="form-group">';
                    $form_login = (isset($user['login'])) ? $user['login'] : '';
                    $opts = array('name' => 'login', 'value' => $form_input_login, 'title' => 'Infome seu Login');
                    echo form_label('Login:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    /*
            echo '<div class="form-group">';
            echo '<div class="row">';
            echo '<div class="col-xs-12">';
            echo form_label('Tipo Usuário:');
            echo '</div>';
            echo '<div class="col-xs-12 col-sm-6">';
            $idioma = array(
                LABEL_ADMIN => LABEL_ADMIN,
                LABEL_EDITOR => LABEL_EDITOR,
                LABEL_VIEWER => LABEL_VIEWER
            );
            $selected = ($this->input->post('idioma')) ? $this->input->post('idioma') : 'investments';
            $opts = array('name' => 'permission_name', 'value' => textToHtml(set_value('idioma')), 'title' => 'Idioma', 'class' => 'form-control editorhtml col');
            echo form_dropdown($opts, $idioma, $selected);
            echo '</div>';
            echo '</div> </div> </div> ';
            
            */


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

                    $selected = ($this->input->post('permission_name')) ? $this->input->post('permission_name') : LABEL_VIEWER;
                    $opts = array('autocomplete' => 'off', 'name' => 'permission_name', 'value' => $selected, 'title' => 'Tipo de Usuário', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $permission_name, $selected);
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
                    $selected = ($this->input->post('blocked')) ? $this->input->post('blocked') : 0;
                    $opts = array('autocomplete' => 'off', 'name' => 'blocked', 'value' => $selected, 'title' => 'Estado do Usário', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $arrayOpts);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
















                    echo '<div class="form-group">';
                    $opts = array('name' => 'password', 'title' => 'Infome sua Senha', 'placeholder' => 'Senha', 'value' => 'poipoipoi');
                    echo form_label('Senha');
                    echo form_password($opts, '', $setup);
                    echo '</div>';

                    echo '<div class="form-group ">';
                    echo form_label('Repetir Senha');
                    $opts = array('name' => 'password2', 'title' => 'Repita sua Senha', 'placeholder' => 'Repitir Senha', 'value' => 'poipoipoi');
                    echo form_password($opts, '', $setup);
                    echo '</div>';



                    echo '<div class="form-group text-right">';
                    echo form_label('Adicionar Outro &nbsp;');
                    echo form_checkbox('addmore', 'Adicionar Outro',  TRUE);
                    echo '</div>';

                    echo form_submit('enviar', 'Salvar', array('class' => 'btn btn-success pull-right'));
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