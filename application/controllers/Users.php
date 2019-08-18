<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
        $this->load->model('user_model', 'user');
    }

    public function index()
    {
        redirect('admin/users/list', 'refresh');
    }

    public function edit()
    {
        // Verificar login da sessão
        verificaLoginAdmin();
        $dados = [];

        //Verifica se o ID foi passado
        $idUser = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // $dados['idUser'] = $idUser;
        if ($idUser > 0) {
            // ID informado, continuar a edição
            if ($user = $this->user->getUserByID($idUser)) {
                $dados['user'] = (array)$user;
            } else {
                set_msg(getMsgError('Erro! Usuário inexistente!<br/> Escolha um usuário para editar !'));
                redirect('admin/users/listar', 'refresh');
            }
        } else {
            set_msg(getMsgError('Erro! ID_Documento não encontrado!'));
            redirect('admin/users/listar', 'refresh');
        }

        $isMyUser = $this->user->getMyUserInfo();
        $myUserPermission = $isMyUser->permission_value;
        $isMyUser = ($isMyUser->ID == $user->ID);
        $dados['isMyUser'] = $isMyUser;
        // if ((!isRoot($user->permission_value)) || $isMyUser) {
        if ((!isRoot($user->permission_value)) || isRoot($myUserPermission)) {


            // Regras de validação
            $this->form_validation->set_rules('login', 'Login', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|min_length[8]');
            $this->form_validation->set_rules('phone', 'Telefone', 'trim|required|min_length[10]');
            $this->form_validation->set_rules('full_name', 'Nome', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('permission_name', 'Tipo Usuário', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('blocked', 'Estado do Usuário', 'required');
            $dados_form = $this->input->post();

            //verificar a validação 
            if ($this->form_validation->run() == FALSE) {
                if (validation_errors()) {
                    set_msg(getMsgError(validation_errors()));
                }
                if (sizeof($dados_form) > 0) {
                    if (isset($dados_form['login'])) $dados['user']['login'] = $dados_form['login'];
                    if (isset($dados_form['email'])) $dados['user']['email'] = $dados_form['email'];
                    if (isset($dados_form['phone'])) $dados['user']['phone'] = $dados_form['phone'];
                    if (isset($dados_form['full_name'])) $dados['user']['full_name'] = $dados_form['full_name'];
                    if (isset($dados_form['blocked'])) $dados['user']['blocked'] = $dados_form['blocked'];
                    if (isset($dados_form['permission_name'])) {
                        $dados['user']['permission_name'] = $dados_form['permission_name'];
                        $dados['user']['permission_value'] = getPermissionValue($dados_form['permission_name']);;
                    }
                }
            } else {
                $dados_insert['ID'] = $user->ID;
                $dados_insert["login"] = $dados_form['login'];
                $dados_insert["email"] = $dados_form['email'];
                $dados_insert["phone"] = $dados_form['phone'];
                $dados_insert["full_name"] = $dados_form['full_name'];
                $dados_insert["blocked"] = $dados_form['blocked'];
                $dados_insert['permission_name'] = $dados_form['permission_name'];
                $dados_insert['permission_value'] = getPermissionValue($dados_form['permission_name']);
                $dados['user'] = $dados_insert;

                $samePassWord = TRUE;
                $changePS = TRUE;
                if (isset($dados_form['password']) && isset($dados_form['password2']) && !($dados_form['password'] == '' || $dados_form['password2'] == '')) {
                    if ($dados_form['password'] === $dados_form['password2']) {
                        $changePS = FALSE;
                        $dados_insert["password"] = password_hash($dados_form['password'], PASSWORD_DEFAULT);
                    } else {
                        $samePassWord = FALSE;
                        $msg = getMsgError('Senhas não conferem.');
                    }
                }

                if ($this->user->salvar($dados_insert)) {
                    if ($changePS) $msg = getMsgOk('Dados atualizados. [Mesma senha]');
                    else $msg = getMsgOk('Dados atualizados.[Senhas atualizadas]');
                } else {
                    if ($samePassWord) {
                        $msg = getMsgError('Ops! Algo aconteceu, tente novamente.');
                    } else {
                        $msg = getMsgError('Senhas não conferem.');
                    }
                }
                set_msg($msg);
            }
            $this->input->post(NULL);

            // carrega view
            $this->load->view('includes/head');
            $this->load->view('includes/header');
            $this->load->view('users/edit', $dados);
            $this->load->view('includes/footer');
        } else {
            set_msg(getMsgError('Você não ter permissão pra editar um usuário: ' . LABEL_ROOT));
            redirect('admin/users/listar', 'refresh');
        }
    }


    public function blocker()
    {
        // Verificar login da sessão
        verificaLoginAdmin();
        $idUser = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $user = $this->user->getUserById($idUser);
        if (isset($user) && !isRoot($user->permission_value)) {
            if ($user->blocked) {
                $user->blocked = 0;
            } else {
                $user->blocked = 1;
            }
            if ($this->user->salvar($user)) {
                set_msg(getMsgOk('Usuário bloqueaeo com sucesso'));
            } else {
                set_msg(getMsgError('Erro ao bloquear usuário'));
            }
        } else {
            set_msg(getMsgError('Usuário ROOT não poder ser bloqueado'));
        }
        redirect('admin/users/listar', 'refresh');
    }

    public function list()
    {
        // Verificar login da sessão
        verificaLogin();

        $dados['users'] = $this->user->getAll();
        $user = $this->user->getMyUserInfo();
        printInfoDump($user);
        $dados['userID'] = $user->ID;
        // printInfoDump($user);
        $dados['menuActive'] = 'users/list';
        // carrega view
        $this->load->view('includes/head');
        $this->load->view('includes/header', $dados);
        $this->load->view('users/list', $dados);
        $this->load->view('includes/footer');
    }

    public function create()
    {
        // Verificar login da sessão
        verificaLoginAdmin();

        // Regras de validação
        $this->form_validation->set_rules('login', 'Login', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|min_length[8]');
        $this->form_validation->set_rules('full_name', 'Nome', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('phone', 'Telefone', 'trim|required|min_length[10]');
        $this->form_validation->set_rules('permission_name', 'Tipo Usuário', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Senha', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Repitir Senha', 'trim|required|min_length[8]|matches[password]');
        $dados_form = $this->input->post();
        //verificar a validação 
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
        } else {
            $user = $this->user->getUserByLoginOrEmail($dados_form['login'], $dados_form['email']);
            if (($user === NULL) && (isset($dados_form['password']) && (isset($dados_form['password2']) && ($dados_form['password'] === $dados_form['password2'])))) {
                $dados_insert["login"] = $dados_form['login'];
                $dados_insert["email"] = $dados_form['email'];
                $dados_insert["phone"] = $dados_form['phone'];
                $dados_insert["full_name"] = $dados_form['full_name'];
                $dados_insert['permission_name'] = $dados_form['permission_name'];
                $dados_insert['permission_value'] = getPermissionValue($dados_form['permission_name']);
                $dados_insert["password"] = password_hash($dados_form['password'], PASSWORD_DEFAULT);

                // salvar no banco
                if ($id = $this->user->salvar($dados_insert)) {
                    set_msg(getMsgOk('Usuário cadastrado!'));
                    if ($dados_form['addmore']) {
                        redirect('admin/users/cadastrar', 'refresh');
                    } else {
                        redirect('admin/users/listar', 'refresh');
                    }
                } else {
                    set_msg(getMsgError('Problemas ao cadastrada usuário!'));
                }
            } else {
                set_msg(getMsgError('Login ou E-mail já cadastrado!'));
            }
        }

        unset($dados_form['password']);
        unset($dados_form['password2']);
        $dados['form_input'] = $dados_form;
        $dados['title']     = 'Novo Cadastro';
        $dados['user'] = (isset($dados_insert)) ?  $dados_insert : '';
        $dados['menuActive'] = 'users/create';

        // carrega view
        $this->load->view('includes/head');
        $this->load->view('includes/header', $dados);
        $this->load->view('users/create', $dados);
        $this->load->view('includes/footer');
    }



    /*

	public function excluir(){
		// Verificar login da sessão
		verificaLogin();
		$idDocumento = $this->uri->segment(4);
		if ($idDocumento > 0){
			if($user = $this->user->getDocumento($idDocumento)){
				$dados['user'] = $user;
			} else {
				set_msg(getMsgError('Erro! Documento inexistente! Escolha um user para excluir !'));
				redirect('dashboard/users/listar','refresh');
			}
		} else {
			set_msg(getMsgError('Erro! ID_Documento não encontrado!'));
			redirect('dashboard/users/listar','refresh');
		}
		$this->form_validation->set_rules('excluir', 'Excluir', 'trim|required'); 
		//verificar a validação 
		if($this->form_validation->run() == FALSE) {
			if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
			}
		} else {
			$arquivoPath = 'uploads/' . $user->arquivo;
			if ($this->user->excluirDocumento($idDocumento)){
				unlink($arquivoPath);
				set_msg(getMsgOk('Documento excluida com sucesso!'));
				redirect('dashboard/users/listar','refresh');
			} else {
				set_msg(getMsgError('Nenhum user foi excluida!'));
				redirect('dashboard/users/listar','refresh');
			}
		}

		// carrega view
		$dados['title']		=  'Listagem de Documentos';
		$dados['subtitle']  =  'Excluir do notícias';
		$dados['tela'] 		=  'excluir';
		$dados['sidenav'] = 'edit-doc';
		$this->load->view('includes/head', $dados);
		$this->load->view('dashboard/includes/side-nav.php', $dados);
		$this->load->view('dashboard/users', $dados);
		$this->load->view('includes/footer', $dados);
	}
     */



    public function myprofile()
    {
        // Verificar login da sessão
        verificaLoginAdmin();

        $dados = [];
        $dados['user'] = (array)$this->user->getMyUserInfo();

        // Regras de validação
        $this->form_validation->set_rules('login', 'Login', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|min_length[8]');
        $this->form_validation->set_rules('phone', 'Telefone', 'trim|required|min_length[10]');
        $this->form_validation->set_rules('full_name', 'Nome', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('permission_name', 'Tipo Usuário', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('blocked', 'Estado do Usuário', 'required');
        $dados_form = $this->input->post();

        //verificar a validação 
        if ($this->form_validation->run() == FALSE) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
        } else {

            if (sizeof($dados_form) > 0) {
                if (isset($dados_form['login'])) $dados['user']['login'] = $dados_form['login'];
                if (isset($dados_form['email'])) $dados['user']['email'] = $dados_form['email'];
                if (isset($dados_form['phone'])) $dados['user']['phone'] = $dados_form['phone'];
                if (isset($dados_form['full_name'])) $dados['user']['full_name'] = $dados_form['full_name'];
                if (isset($dados_form['blocked'])) $dados['user']['blocked'] = $dados_form['blocked'];
                if (isset($dados_form['permission_name'])) {
                    $dados['user']['permission_name'] = $dados_form['permission_name'];
                    $dados['user']['permission_value'] = getPermissionValue($dados_form['permission_name']);;
                }

                $dados_insert['ID'] = $dados['user']['ID'];
                $dados_insert["login"] = $dados_form['login'];
                $dados_insert["email"] = $dados_form['email'];
                $dados_insert["phone"] = $dados_form['phone'];
                $dados_insert["full_name"] = $dados_form['full_name'];
                $dados_insert["blocked"] = $dados_form['blocked'];
                $dados_insert['permission_name'] = $dados_form['permission_name'];
                $dados_insert['permission_value'] = getPermissionValue($dados_form['permission_name']);
                $dados['user'] = $dados_insert;

                $samePassWord = TRUE;
                $changePS = TRUE;

                if (isset($dados_form['password']) && isset($dados_form['password2']) && !($dados_form['password'] == '' || $dados_form['password2'] == '')) {
                    if ($dados_form['password'] === $dados_form['password2']) {
                        $changePS = FALSE;
                        echo "-1";
                        $dados_insert["password"] = password_hash($dados_form['password'], PASSWORD_DEFAULT);
                        echo "-2";
                    } else {
                        $samePassWord = FALSE;
                        echo "-3";
                        $msg = getMsgError('Senhas não conferem.');
                        echo "-4";
                    }
                }
                if ($this->user->salvar($dados_insert)) {
                    if ($changePS) $msg = getMsgOk('Dados atualizados. [Mesma senha]');
                    else $msg = getMsgOk('Dados atualizados.[Senhas atualizadas]');
                } else if (!$samePassWord) {
                    $msg = getMsgError('Senhas não conferem.');
                } else {
                    $msg = getMsgError('Dados não alterados');
                }
                set_msg($msg);
            }
        }
        $this->input->post(NULL);

        $dados['menuActive'] = 'users/myprofile';
        // carrega view
        $this->load->view('includes/head');
        $this->load->view('includes/header', $dados);
        $this->load->view('users/myprofile', $dados);
        $this->load->view('includes/footer');
    }
}
