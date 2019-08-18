<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
        $this->load->model('blog_model', 'blog');
    }

    public function index()
    {
        redirect('admin/blog/list', 'refresh');
    }

    public function edit()
    {
        // Verificar login da sessão
        verificaLoginAdmin();
        $dados = [];

        //Verifica se o ID foi passado
        $idBlog = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // $dados['idBlog'] = $idBlog;
        if ($idBlog > 0) {
            // ID informado, continuar a edição
            if ($blog = $this->blog->getBlogById($idBlog)) {
                $dados['blog'] = (array)$blog;

                // Regras de validação
                $this->form_validation->set_rules('blog_title', 'Titulo', 'trim|required');
                $this->form_validation->set_rules('blog_body', 'Corpo da notícia', 'trim|required');
                $this->form_validation->set_rules('blog_date_to_publish', 'Data para publicar', 'trim|required');
                $dados_form = $this->input->post();

                if ($this->form_validation->run() == false) {
                    if (validation_errors()) {
                        set_msg(getMsgError(validation_errors()));
                    }
                } else {

                    $dados['blog']["blog_title"] = $dados_form['blog_title'];
                    $dados['blog']["blog_date_to_publish"] = changeDateToDB($dados_form['blog_date_to_publish']);
                    $dados['blog']["blog_author_login"] = $dados_form['blog_author_login'];
                    $dados['blog']["blog_published"] = $dados_form['blog_published'];
                    $dados['blog']["blog_author_name"] = $dados_form['blog_author_name'];
                    $dados['blog']["blog_body"] = $dados_form['blog_body'];


                    $this->load->library('upload', config_upload_img());
                    if ($this->upload->do_upload('blog_img')) {
                        $dados_upload = $this->upload->data();
                        $dados['blog']["blog_img"] = $dados_upload['file_name'];
                    }

                    // salvar no banco
                    if ($this->blog->save($dados['blog'])) {
                        set_msg(getMsgOk('Notícia cadastrada!'));
                    } else {
                        set_msg(getMsgError('Problemas atualizar notícia!'));
                    }
                }
            } else {
                set_msg(getMsgError('Erro! ID da notícia inexistente!'));
                redirect('admin/blog/listar', 'refresh');
            }
        } else {
            set_msg(getMsgError('Erro! Notícia não encontrado!'));
            redirect('admin/blog/listar', 'refresh');
        }

        $dados['form_input'] = $dados_form;
        $dados['title']     = 'Cadastrar Nova';
        $dados['menuActive'] = 'blog/edit';

        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('admin/blog/edit', $dados);
        $this->load->view('admin/includes/footer');
    }

    public function list()
    {
        // Verificar login da sessão
        verificaLogin();

        $dados['blog'] = $this->blog->getAll();

        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('admin/blog/list', $dados);
        $this->load->view('admin/includes/footer');
    }

    public function create()
    {
        // Verificar login da sessão
        verificaLoginAdmin();

        // Regras de validação
        $this->form_validation->set_rules('blog_title', 'Titulo', 'trim|required');
        $this->form_validation->set_rules('blog_body', 'Corpo da notícia', 'trim|required');
        $this->form_validation->set_rules('blog_date_to_publish', 'Data para publicar', 'trim|required');
        $dados_form = $this->input->post();

        //verificar a validação 
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
        } else {
            $dados_insert["blog_title"] = $dados_form['blog_title'];
            $dados_insert["blog_date_to_publish"] = changeDateToDB($dados_form['blog_date_to_publish']);
            $dados_insert["blog_author_login"] = $dados_form['blog_author_login'];
            $dados_insert["blog_author_name"] = $dados_form['blog_author_name'];
            $dados_insert["blog_body"] = $dados_form['blog_body'];
            $this->load->library('upload', config_upload_img());

            if ($this->upload->do_upload('blog_img')) {
                $dados_upload = $this->upload->data();
                $dados_insert["blog_img"] = $dados_upload['file_name'];
            }

            // salvar no banco
            if ($id = $this->blog->save($dados_insert)) {
                set_msg(getMsgOk('Notícia cadastrada!'));
                if (isset($dados_form['addmore']) && $dados_form['addmore']) redirect('admin/blog/cadastrar', 'refresh');
                else  redirect('admin/blog/listar', 'refresh');
            } else {
                set_msg(getMsgError('Problemas ao cadastrada usuário!'));
            }
        }
        $dados['form_input'] = $dados_form;
        $dados['title']     = 'Nova Postagem';
        $dados['blog'] = (isset($dados_insert)) ?  $dados_insert : '';
        $dados['menuActive'] = 'blog/create';
        // carrega view
        $this->load->view('admin/includes/head');
        $this->load->view('admin/includes/header', $dados);
        $this->load->view('admin/blog/create', $dados);
        $this->load->view('admin/includes/footer');
    }

    public function highlighter()
    {
        $id = ($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $blog = $this->blog->getBlogById($id);
        if ($id = $this->blog->save($blog)) {
            set_msg(getMsgOk('Notícia atualizada!'));
        } else {
            set_msg(getMsgError('Problemas ao atualizar!'));
        }
        redirect('admin/blog/listar', 'refresh');
    }


    public function changestatus()
    {
        $id = ($this->uri->segment(4)) ? $this->uri->segment(4) : NULL;
        $blog = $this->blog->getBlogById($id);
        $blog->blog_published = ($blog->blog_published) ? 0 : 1;
        if ($id = $this->blog->save($blog)) {
            set_msg(getMsgOk('Notícia atualizada!'));
        } else {
            set_msg(getMsgError('Problemas ao atualizar!'));
        }
        redirect('admin/blog/listar', 'refresh');
    }
}
