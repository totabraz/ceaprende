<div id="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 header-area">
				<h1 class="col-12 main-title">
                    <br/>
                    Setup Inicial
				</h1>
            </div>
            
				<div class="col col-sm-8 col-md-6">
					<div class="card">
						<div class="card-body">
                            <?php 
							$setup = array('class' => 'form-control','trim|required');
                            
							if ($msg = get_msg()) { echo $msg;   }
                            
                            echo form_open();
                            
                            echo '<div class="form-group">';
                            // echo "<hr/>";
                            echo form_label('Tipo do usuário: Administrador');
                            echo '</div>';
                            
                            echo ' <div class="form-group">';
                            $form_full_name = (isset($user['full_name']))? $user['full_name']: '';
                            $opts = array('name' => 'full_name', 'value' => $form_full_name, 'title' => 'Infome seu Nome');
                            echo form_label('Nome:');
                            echo form_input($opts, '', $setup);
                            echo '</div>';
  
                            echo ' <div class="form-group">';
                            $form_email = (isset($user['email']))? $user['email']: '';
                            $opts = array('name' => 'email', 'value' => $form_email, 'title' => 'Infome seu E-mail');
                            echo form_label('email:');
                            echo form_input($opts, '', $setup);
                            echo '</div>';
    
    
                            echo ' <div class="form-group">';
                            $form_phone = (isset($user['phone']))? $user['phone']: '';
                            $opts = array('name' => 'phone', 'value' => $form_phone, 'title' => 'Infome seu Telefone');
                            echo form_label('Telefone:');
                            echo form_input($opts, '', $setup);
                            echo '</div>';


                            // DADOS LOGIN 
                            
                            echo ' <div class="form-group">';
                            $form_login = (isset($user['login']))? $user['login']: '';
                            $opts = array('name' => 'login', 'value' => $form_login, 'title' => 'Infome seu Login');
                            echo form_label('Login:');
                            echo form_input($opts, '', $setup);
                            echo '</div>';
                            
                            echo '<div class="form-group">';
							$opts = array('name'=>'password', 'title' => 'Infome sua Senha','placeholder' => 'Senha' , 'value'=>'poipoipoi');
							echo form_label('Senha');
							echo form_password($opts,'',$setup);
                            echo '</div>';
                            
							echo '<div class="form-group">';
							$opts = array('name'=>'password2', 'title' => 'Repita sua Senha','placeholder' => 'Repitir Senha', 'value'=>'poipoipoi');
							echo form_password($opts,'',$setup);
							echo '</div>';
                                                        
							
							echo form_submit('enviar', 'Registrar'  , array('class' => 'btn btn-outline-info'));
							// Form Closed
							echo form_close();
							?>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>