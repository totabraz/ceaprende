<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
        $this->load->model('news_model', 'news');
    }

    public function index()
    {
        redirect('admin/news/list', 'refresh');
    }
    /**
     * 
     * 
     */

    public function edit()
    {
        // Verificar login da sessão
        verificaLoginAdmin();
        $dados = [];

        //Verifica se o ID foi passado
        $idNews = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // $dados['idNews'] = $idNews;
        if ($idNews > 0) {
            // ID informado, continuar a edição
            if ($news = $this->news->getNewsById($idNews)) {
                $dados['news'] = (array)$news;

                // Regras de validação
                $this->form_validation->set_rules('news_title', 'Titulo', 'trim|required');
                $this->form_validation->set_rules('news_body', 'Corpo da notícia', 'trim|required');
                $this->form_validation->set_rules('news_highlight', 'highlight', 'trim|required');
                $this->form_validation->set_rules('news_date_to_publish', 'Data para publicar', 'trim|required');
                $dados_form = $this->input->post();

                if ($this->form_validation->run() == false) {
                    if (validation_errors()) {
                        set_msg(getMsgError(validation_errors()));
                    }
                } else {

                    $dados['news']["news_title"] = $dados_form['news_title'];
                    $dados['news']["news_date_to_publish"] = changeDateToDB($dados_form['news_date_to_publish']);
                    $dados['news']["news_date_published"] = changeDateToDB($dados_form['news_date_published']);
                    $dados['news']["news_body"] = $dados_form['news_body'];
                    $dados['news']["news_highlight"] = $dados_form['news_highlight'];


                    $this->load->library('upload', config_upload_img());
                    if ($this->upload->do_upload('news_img')) {
                        $dados_upload = $this->upload->data();
                        $dados['news']["news_img"] = $dados_upload['file_name'];
                    }

                    // salvar no banco
                    if ($this->news->save($dados['news'])) {
                        set_msg(getMsgOk('Notícia cadastrada!'));
                    } else {
                        set_msg(getMsgError('Problemas atualizar notícia!'));
                    }


                    //  em cima
                    // 
                    // 
                    // 
                }
            } else {
                set_msg(getMsgError('Erro! ID da notícia inexistente!'));
                redirect('admin/news/listar', 'refresh');
            }
        } else {
            set_msg(getMsgError('Erro! Notícia não encontrado!'));
            redirect('admin/news/listar', 'refresh');
        }


        $dados['form_input'] = $dados_form;
        $dados['title']     = 'Cadastrar Nova';
        
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('admin/news/edit', $dados);
        $this->load->view('admin/includes/footer');
    }



    //         //verificar a validação 
    //         if ($this->form_validation->run() == FALSE) {
    //             if (validation_errors()) {
    //                 set_msg(getMsgError(validation_errors()));
    //             }
    //             if (sizeof($dados_form) > 0) {
    //                 if (isset($dados_form['login'])) $dados['user']['login'] = $dados_form['login'];
    //                 if (isset($dados_form['email'])) $dados['user']['email'] = $dados_form['email'];
    //                 if (isset($dados_form['phone'])) $dados['user']['phone'] = $dados_form['phone'];
    //                 if (isset($dados_form['first_name'])) $dados['user']['first_name'] = $dados_form['first_name'];
    //                 if (isset($dados_form['last_name'])) $dados['user']['last_name'] = $dados_form['last_name'];
    //                 if (isset($dados_form['blocked'])) $dados['user']['blocked'] = $dados_form['blocked'];
    //                 if (isset($dados_form['permission_name'])) {
    //                     $dados['user']['permission_name'] = $dados_form['permission_name'];
    //                     $dados['user']['permission_value'] = getPermissionValue($dados_form['permission_name']);;
    //                 }
    //             }
    //         } else {
    //             $dados_insert['ID'] = $user->ID;
    //             $dados_insert["login"] = $dados_form['login'];
    //             $dados_insert["email"] = $dados_form['email'];
    //             $dados_insert["phone"] = $dados_form['phone'];
    //             $dados_insert["first_name"] = $dados_form['first_name'];
    //             $dados_insert["last_name"] = $dados_form['last_name'];
    //             $dados_insert["blocked"] = $dados_form['blocked'];
    //             $dados_insert['permission_name'] = $dados_form['permission_name'];
    //             $dados_insert['permission_value'] = getPermissionValue($dados_form['permission_name']);
    //             $dados['user'] = $dados_insert;

    //             $samePassWord = TRUE;
    //             $changePS = TRUE;
    //             if (isset($dados_form['password']) && isset($dados_form['password2']) && !($dados_form['password'] == '' || $dados_form['password2'] == '')) {
    //                 if ($dados_form['password'] === $dados_form['password2']) {
    //                     $changePS = FALSE;
    //                     $dados_insert["password"] = password_hash($dados_form['password'], PASSWORD_DEFAULT);
    //                 } else {
    //                     $samePassWord = FALSE;
    //                     $msg = getMsgError('Senhas não conferem.');
    //                 }
    //             }

    //             if ($this->user->salvar($dados_insert)) {
    //                 if ($changePS) $msg = getMsgOk('Dados atualizados. [Mesma senha]');
    //                 else $msg = getMsgOk('Dados atualizados.[Senhas atualizadas]');
    //             } else {
    //                 if ($samePassWord) {
    //                     $msg = getMsgError('Ops! Algo aconteceu, tente novamente.');
    //                 } else {
    //                     $msg = getMsgError('Senhas não conferem.');
    //                 }
    //             }
    //             set_msg($msg);
    //         }
    //         $this->input->post(NULL);

    //         // carrega view
    //         $this->load->view('admin/includes/head');
    //         $this->load->view('admin/includes/header');
    //         $this->load->view('admin/news/edit', $dados);
    //         $this->load->view('admin/includes/footer');
    //     } else {
    //         set_msg(getMsgError('Você não ter permissão pra editar um usuário: ' . LABEL_ROOT));
    //         redirect('admin/users/listar', 'refresh');
    //     }
    // }


    public function list()
    {
        // Verificar login da sessão
        verificaLogin();

        $dados['news'] = $this->news->getAll();

        $dados['menuActive'] = 'news/list';
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('admin/news/list', $dados);
        $this->load->view('admin/includes/footer');
    }

    public function create()
    {
        // Verificar login da sessão
        verificaLoginAdmin();

        // Regras de validação
        $this->form_validation->set_rules('news_title', 'Titulo', 'trim|required');
        $this->form_validation->set_rules('news_body', 'Corpo da notícia', 'trim|required');
        $this->form_validation->set_rules('news_highlight', 'highlight', 'trim|required');
        $this->form_validation->set_rules('news_date_to_publish', 'Data para publicar', 'trim|required');
        $dados_form = $this->input->post();

        //verificar a validação 
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
        } else {
            $dados_insert["news_title"] = $dados_form['news_title'];
            $dados_insert["news_date_to_publish"] = changeDateToDB($dados_form['news_date_to_publish']);
            $dados_insert["news_date_published"] = changeDateToDB($dados_form['news_date_published']);
            $dados_insert["news_body"] = $dados_form['news_body'];
            $dados_insert["news_highlight"] = $dados_form['news_highlight'];
            $this->load->library('upload', config_upload_img());

            if ($this->upload->do_upload('news_img')) {
                $dados_upload = $this->upload->data();
                $dados_insert["news_img"] = $dados_upload['file_name'];
            }

            // salvar no banco
            if ($id = $this->news->save($dados_insert)) {
                set_msg(getMsgOk('Notícia cadastrada!'));
                if (isset($dados_form['addmore']) && $dados_form['addmore']) redirect('admin/news/cadastrar', 'refresh');
                else  redirect('admin/news/listar', 'refresh');
            } else {
                set_msg(getMsgError('Problemas ao cadastrada usuário!'));
            }
        }
        $dados['form_input'] = $dados_form;
        $dados['title']     = 'Cadastrar Nova';
        $dados['news'] = (isset($dados_insert)) ?  $dados_insert : '';
        $dados['menuActive'] = 'news/create';
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('admin/news/create', $dados);
        $this->load->view('admin/includes/footer');
    }

    public function highlighter()
    {
        $id = ($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $news = $this->news->getNewsById($id);
        $news->news_highlight = ($news->news_highlight) ? 0 : 1;
        print_r($news->news_highlight);
        if ($id = $this->news->save($news)) {
            set_msg(getMsgOk('Notícia atualizada!'));
        } else {
            set_msg(getMsgError('Problemas ao atualizar!'));
        }
        redirect('admin/news/listar', 'refresh');
    }


    public function changestatus()
    {
        $id = ($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $news = $this->news->getNewsById($id);
        $news->news_published = ($news->news_published) ? 0 : 1;
        if ($id = $this->news->save($news)) {
            set_msg(getMsgOk('Notícia atualizada!'));
        } else {
            set_msg(getMsgError('Problemas ao atualizar!'));
        }
        redirect('admin/news/listar', 'refresh');
    }
}
