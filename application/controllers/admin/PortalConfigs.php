<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PortalConfigs extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        # Carregando o model
        // $this->load->model('Database_model');
        // # Carregando o model, configurando como um apelodo 
    // # Para poder chamar apenas como: 'Database'
        // $this->load->model('Database_model', 'Database');
        $this->load->helper('form');
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('option_model', 'option');
        $this->load->model('user_model', 'user');
    }

    public function index()
    {
        redirect('admin/site/config/analytics', 'refresh');
    }

    public function analytics()
    {
        // Regras de validação
        $this->form_validation->set_rules('analytics', 'Google Analytics', 'trim|required|min_length[20]');
        $dados_form = $this->input->post();
        $dados_insert = $dados_form;

        //verificar a validação 
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                $msg = getMsgError(validation_errors());
            }
        } else {
            $user = NULL;
            if ($user = $this->user->getUser([$dados_form['login']]));
            else ($user = $this->user->getUser($dados_form['email']));

            if (($user !== NULL) && (isset($dados_form['password']) && (isset($dados_form['password2']) && ($dados_form['password'] === $dados_form['password2'])))) {
                $dados_insert["login"] = $dados_form['login'];
                $dados_insert["email"] = $dados_form['email'];
                $dados_insert["first_name"] = $dados_form['first_name'];
                $dados_insert["last_name"] = $dados_form['last_name'];
                $dados_insert['permission_value'] = PERMISSION_ROOT;;
                $dados_insert['permission_name'] = LABEL_ROOT;;
                $dados_insert["password"] = password_hash($dados_form['password'], PASSWORD_DEFAULT);

                // salvar no banco
                if ($id = $this->user->salvar($dados_insert) && $this->option->update_option('setup_executado', 1)) {
                    $msg = getMsgOk('Login cadstrado com sucesso!');
                    $this->session->set_userdata('logged', true);
                    $this->session->set_userdata('login', $dados_form['login']);
                    $this->session->set_userdata('name', $dados_form['first_name']);
                    $this->session->set_userdata('email', $dados_form['login']);
                    redirect('admin/admin', 'refresh');
                } else {
                    $msg = getMsgError('Problemas ao cadastrar usuário!');
                }
            } else if ($user !== NULL) {
                $msg = getMsgError('Login ou e-mail já cadastrado.. :(');
            } else {
                $msg = getMsgError('Login já cadastrado!');
            }
        }
        $dados['title']     = 'Novo Cadastro';
        $dados['user'] = (isset($dados_insert)) ?  $dados_insert : '';
        $dados['msg_system'] = (isset($msg)) ? $msg : '';

        $dados['title'] = 'Acesso ao sistema';
        $dados['subtitle'] = 'Acessar o painel';

        $this->load->view('admin/includes/head');
        // $this->load->view('admin/portal_configs/analytics', $dados);

        $this->load->view('admin/users/create', $dados);
        $this->load->view('admin/includes/footer');
    }
}
