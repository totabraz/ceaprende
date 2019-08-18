<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
        $this->load->model('user_model', 'user');
        $this->load->model('compartilhamento_model', 'compartilhamento');
    }

    public function index()
    {
        redirect('admin/home', 'refresh');
    }

    public function home()
    {
    verificaLogin();
    
        
        $dados['num_minhas_aulas'] = $this->compartilhamento->countMine($this->user->getMyID());
        $dados['num_aulas'] = $this->compartilhamento->countAll();
        $dados['title']    =  'Listagem de Documentos';
        $dados['subtitle'] =  'Listagem do notícias';
        $dados['tela']     =  'listar';
        $dados['sidenav']  = 'list-doc';

        // carrega view
        $this->load->view('includes/head');
        $this->load->view('includes/header', $dados);
        $this->load->view('admin/home', $dados);
        $this->load->view('includes/footer');
    }

    public function home_old()
    {
        // Verificar login da sessão
        verificaLogin();
        $dados['title']    =  'Listagem de Documentos';
        $dados['subtitle'] =  'Listagem do notícias';
        $dados['tela']     =  'listar';
        $dados['sidenav']  = 'list-doc';

        // carrega view
        $this->load->view('includes/head');
        $this->load->view('includes/header', $dados);
        $this->load->view('admin/home_old', $dados);
        $this->load->view('includes/footer');
    }

    public function logout()
    {
        globalLogout();
    }

    public function login()
    {
        if ($this->option->get_option('setup_executado') != 1) {
            redirect('setup/instalar', 'refresh');
        } else {
            $this->form_validation->set_rules('login', 'Usuário', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[8]');
            // verifica validação
            if ($this->form_validation->run() == false) {
                if (validation_errors()) {
                    set_msg(getMsgError(validation_errors()));
                }
            } else {
                $dados_form = $this->input->post();
                $user = NULL;
                //if find by login or email
                if ($user = $this->user->getUserByLoginOrEmail($dados_form['login'], $dados_form['login'])) {
                    if ($user->login === $dados_form['login'] || $user->email === $dados_form['login']) {

                        if (password_verify($dados_form['password'], $user->password)) {
                            $this->session->set_userdata('logged', true);
                            $this->session->set_userdata('login', $user->login);
                            $this->session->set_userdata('permission_name', $user->permission_name);
                            $this->session->set_userdata('permission_value', $user->permission_value);
                            $this->session->set_userdata('email', $user->email);
                            $this->session->set_userdata('name', $user->full_name);
                            //TODO: fazer difect para
                            redirect('admin/home', 'refresh');
                        } else {
                            set_msg(getMsgError('Login, E-mail e/ou Senha estão errados! :('));
                        }
                    }
                } else {
                    set_msg(getMsgError('Usurário não existe! :('));
                }
            }
            $dados['title'] = 'Acesso ao sistema';
            $dados['subtitle'] = 'Acessar o painel';

            $this->load->view('includes/head');
            $this->load->view('admin/login', $dados);
            $this->load->view('includes/scripts');
        }
    }
}
