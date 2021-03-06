<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Compartilhar extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        # Carregando o model
        // $this->load->model('Database_model');
        // # Carregando o model, configurando como um apelodo 
        // # Para poder chamar apenas como: 'Database'
        // $this->load->model('Database_model', 'Database');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
        $this->load->model('user_model', 'user');
        $this->load->model('categoria_model', 'categoria');
        $this->load->model('compartilhamento_model', 'compartilhamento');
    }

    public function index()
    {
        verificaLogin();
        redirect('compartilhar/listar', 'refresh');
    }


    public function home()
    {
        verificaLogin();
        redirect('compartilhar/listar', 'refresh');
    }

    public function listar()
    {
        verificaLogin();
        $dados['compartilhamentos'] = $this->compartilhamento->getAll();
        if (isset($dados['compartilhamentos']) && sizeof($dados['compartilhamentos']) > 0) {
            for ($i = 0; $i < sizeof($dados['compartilhamentos']); $i++) {
                $dados['compartilhamentos'][$i]->categoria = $this->categoria->getItById($dados['compartilhamentos'][$i]->id_categoria)->titulo;
            }
        }

        $dados['breadcrumb'][0]['titulo'] = 'Compartilhando';
        $dados['breadcrumb'][0]['rota'] = 'compartilhar';
        $dados['breadcrumb'][1]['titulo'] = 'Meus Artigos';
        $dados['breadcrumb'][1]['rota'] = 'listar';
        // carrega view
        $this->load->view('includes/head');
        $this->load->view('includes/header', $dados);
        $this->load->view('includes/breadcrumb', $dados);
        $this->load->view('compartilhar/listar', $dados);
        $this->load->view('includes/footer');
    }

    public function categorias()
    {
        verificaLogin();
        $this->form_validation->set_rules('titulo', 'Titulo', 'trim|required|min_length[4]');
        $dados_form = $this->input->post();

        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
        } else {
            unset($dados_form['enviar']);
            $categoria = $this->categoria->getItByTitulo($dados_form['titulo']);
            if (($categoria === NULL) && (isset($dados_form['titulo']))) {

                // salvar no banco
                if ($id = $this->categoria->salvar($dados_form)) {
                    set_msg(getMsgOk('Categoria cadastrada!'));
                    redirect('compartilhar/categorias/cadastrar', 'refresh');
                } else {
                    set_msg(getMsgError('Problemas ao cadastrada !'));
                }
            } else {
                set_msg(getMsgError('Categorai já cadastrada!'));
            }
        }
        $dados['categorias'] = $this->categoria->getAll();
        // carrega view
        $dados['breadcrumb'][0]['titulo'] = 'Compartilhando';
        $dados['breadcrumb'][0]['rota'] = 'compartilhar';
        $dados['breadcrumb'][1]['titulo'] = 'Add Categoria';
        $dados['breadcrumb'][1]['rota'] = 'categoria';
        // carrega view
        $this->load->view('includes/head');
        $this->load->view('includes/header', $dados);
        $this->load->view('includes/breadcrumb', $dados);
        $this->load->view('compartilhar/categorias', $dados);
        $this->load->view('includes/footer');
    }

    public function cadastrar()
    {
        verificaLogin();
        $this->form_validation->set_rules('id_categoria', 'id_categoria', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('titulo', 'titulo', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('conteudo', 'conteudo', 'trim|required', 'min_length[4');
        // $this->form_validation->set_rules('referencia', 'referencia', 'trim|required','min_length[4');
        $this->form_validation->set_rules('pergunta1', 'pergunta1', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta11', 'resposta11', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta12', 'resposta12', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta13', 'resposta13', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta14', 'resposta14', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('pergunta2', 'pergunta2', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta21', 'resposta21', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta22', 'resposta22', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta23', 'resposta23', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta24', 'resposta24', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('pergunta3', 'pergunta3', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta31', 'resposta31', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta32', 'resposta32', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta33', 'resposta33', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta34', 'resposta34', 'trim|required', 'min_length[4');
        $dados_form = $this->input->post();
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
        } else {
            unset($dados_form['enviar']);
            $dados_form['id_usuario'] = $this->user->getMyID();
            if (isset($dados_form['id_categoria']) && (isset($dados_form['id_categoria']) && ($dados_form['id_usuario'] !== NULL))) {
                if ($id = $this->compartilhamento->salvar($dados_form)) {
                    set_msg(getMsgOk('Assunto cadastrado!'));
                    redirect('compartilhar', 'refresh');
                } else {
                    set_msg(getMsgError('Problemas ao cadastrada !'));
                }
            } else {
                set_msg(getMsgError('Categorai já cadastrada!'));
            }
        }

        $dados['categorias'] = $this->categoria->getAll();
        // carrega view
        $dados['breadcrumb'][0]['titulo'] = 'Compartilhando';
        $dados['breadcrumb'][0]['rota'] = 'compartilhar';
        $dados['breadcrumb'][1]['titulo'] = 'Cadastrar';
        $dados['breadcrumb'][1]['rota'] = 'cadastrar';
        // carrega view
        $this->load->view('includes/head');
        $this->load->view('includes/header', $dados);
        $this->load->view('includes/breadcrumb', $dados);
        $this->load->view('compartilhar/cadastrar', $dados);
        $this->load->view('includes/footer');
    }




    public function excluir()
    {
        $dados = '';
        // carrega view


        if ($this->compartilhamento->remove($this->uri->segment(3))) {
            set_msg(getMsgOk('Excluido!'));
            redirect('compartilhar', 'refresh');
        } else {
            set_msg(getMsgError('Problemas ao excluir !'));
        }
        $this->load->view('includes/head');
        $this->load->view('includes/header', $dados);
        $this->load->view('compartilhar/excluir', $dados);
        $this->load->view('includes/footer');
    }


    public function editar()
    {
        verificaLogin();

        $dados = [];

        //Verifica se o ID foi passado
        $idConteudo = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // $dados['idUser'] = $idUser;
        if ($idConteudo > 0) {
            // ID informado, continuar a edição
            if ($compartilhamentos = $this->compartilhamento->getByID($idConteudo)) {
                $dados['compartilhamento'] = $compartilhamentos;
            } else {
                set_msg(getMsgError('Erro! Usuário inexistente!<br/> Escolha um usuário para editar !'));
                redirect('admin/users/listar', 'refresh');
            }
        } else {
            set_msg(getMsgError('Erro! ID_Documento não encontrado!'));
            redirect('admin/users/listar', 'refresh');
        }
        $dados['compartilhamento'] = $compartilhamentos;

        $this->form_validation->set_rules('id_categoria', 'id_categoria', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('titulo', 'titulo', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('conteudo', 'conteudo', 'trim|required', 'min_length[4');
        // $this->form_validation->set_rules('referencia', 'referencia', 'trim|required','min_length[4');
        $this->form_validation->set_rules('pergunta1', 'pergunta1', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta11', 'resposta11', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta12', 'resposta12', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta13', 'resposta13', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta14', 'resposta14', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('pergunta2', 'pergunta2', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta21', 'resposta21', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta22', 'resposta22', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta23', 'resposta23', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta24', 'resposta24', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('pergunta3', 'pergunta3', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta31', 'resposta31', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta32', 'resposta32', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta33', 'resposta33', 'trim|required', 'min_length[4');
        $this->form_validation->set_rules('resposta34', 'resposta34', 'trim|required', 'min_length[4');
        $dados_form['ID'] = $idConteudo;
        $dados_form = $this->input->post();

        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(getMsgError(validation_errors()));
            }
        } else {
            unset($dados_form['enviar']);
            $dados_form['id_usuario'] = $this->user->getMyID();
            if (isset($dados_form['id_categoria']) && (isset($dados_form['id_categoria']) && ($dados_form['id_usuario'] !== NULL))) {
                if ($id = $this->compartilhamento->salvar($dados_form)) {
                    set_msg(getMsgOk('Assunto cadastrado!'));
                    redirect('compartilhar', 'refresh');
                } else {
                    set_msg(getMsgError('Problemas ao cadastrada !'));
                }
            } else {
                set_msg(getMsgError('Categoria já cadastrada!'));
            }
        }

        $dados = [];
        $dados['categorias'] = $this->categoria->getAll();
        $dados['data'] = (array)$this->compartilhamento->getByID($idConteudo);

        // carrega view
        $this->load->view('includes/head');
        $this->load->view('includes/header', $dados);
        $this->load->view('compartilhar/editar', $dados);
        $this->load->view('includes/footer');
    }


    public function buscar()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('documento_model', 'documentos');
        // Verificar login da sessão
        $per_page = 10;
        $param_from_get = '';
        $offset_aux = 10;
        $offset = null;
        if (isset($_GET['per_page'])) {
            $offset = ($_GET['per_page'] > 1) ? ($_GET['per_page'] * $offset_aux) - $offset_aux : 0;
        }
        $dados['$form_preenchido'] = null;

        // regras de validação
        $this->form_validation->set_rules('titulo', 'Título');
        $this->form_validation->set_rules('autor', 'Título');
        $this->form_validation->set_rules('orientador', 'Título');
        $this->form_validation->set_rules('tipo_doc', 'Tipo do documento');
        $this->form_validation->set_rules('idioma', 'Idioma');
        $this->form_validation->set_rules('data_defesa', 'Data da defesa');
        $this->form_validation->set_rules('ano_defesa', 'Ano da defesa');

        if ($dados_form = $this->input->post()) {
            $titulo = rtrim(preg_replace('/\s+/', ' ', $dados_form["titulo"]));
            $autor = rtrim(preg_replace('/\s+/', ' ', $dados_form["autor"]));
            $orientador = rtrim(preg_replace('/\s+/', ' ', $dados_form["orientador"]));
            $tipo_doc  = $dados_form["tipo_doc"];
            $idioma  = $dados_form["idioma"];
            $data_defesa  = changeDateToDB($dados_form["data_defesa"]);
            $ano_defesa  = $dados_form["ano_defesa"];
        } else {
            $titulo = (isset($_GET['titulo'])) ? $_GET['titulo'] : null;
            $autor = (isset($_GET['autor'])) ? $_GET['autor'] : null;
            $orientador = (isset($_GET['orientador'])) ? $_GET['orientador'] : null;
            $tipo_doc = (isset($_GET['tipo_doc'])) ? $_GET['tipo_doc'] : null;
            $idioma = (isset($_GET['idioma'])) ? $_GET['idioma'] : null;
            $data_defesa = (isset($_GET['data_defesa'])) ? $_GET['data_defesa'] : null;
            $ano_defesa = (isset($_GET['ano_defesa'])) ? $_GET['ano_defesa'] : null;

            if (isset($titulo)) {
                $param_from_get .= '&titulo=' . $_GET['titulo'];
            }
            if (isset($autor)) {
                $param_from_get .= '&autor=' . $_GET['autor'];
            }
            if (isset($orientador)) {
                $param_from_get .= '&orientador=' . $_GET['orientador'];
            }
            if (isset($tipo_doc)) {
                $param_from_get .= '&tipo_doc=' . $_GET['tipo_doc'];
            }
            if (isset($idioma)) {
                $param_from_get .= '&idioma=' . $_GET['idioma'];
            }
            if (isset($data_defesa)) {
                $param_from_get .= '&data_defesa=' . $_GET['data_defesa'];
            }
            if (isset($ano_defesa)) {
                $param_from_get .= '&ano_defesa=' . $_GET['ano_defesa'];
            }
        }

        $form_preenchido = 0;
        if (isset($titulo) && $titulo != '') {
            $param_from_get .= '&titulo=' . $titulo;
            $form_preenchido++;
        }
        if (isset($autor) && $autor != '') {
            $param_from_get .= '&autor=' . $autor;
            $form_preenchido++;
        }
        if (isset($orientador) && $orientador != '') {
            $param_from_get .= '&orientador=' . $orientador;
            $form_preenchido++;
        }
        if (isset($tipo_doc) && $tipo_doc != '') {
            $param_from_get .= '&tipo_doc=' . $tipo_doc;
            $form_preenchido++;
        }
        if (isset($idioma) && $idioma != '') {
            $param_from_get .= '&idioma=' . $idioma;
            $form_preenchido++;
        }
        if (isset($data_defesa) && $data_defesa != '') {
            $param_from_get .= '&data_defesa=' . changeDateToDB($data_defesa);
            $form_preenchido++;
        }
        if (isset($ano_defesa) && $ano_defesa != '') {
            $param_from_get .= '&ano_defesa=' . $ano_defesa;
            $form_preenchido++;
        }


        $dados['documentos'] = $this->documentos->searchDocumento($titulo, $autor, $orientador, $data_defesa, $tipo_doc, $idioma, $ano_defesa, $offset, $per_page);

        $config = array(
            "per_page" => 10,
            "num_links" => 3,
            "uri_segment" => 3,
            'use_page_numbers' => TRUE,
            'page_query_string' => TRUE,
            "total_rows" => $this->documentos->countAllFiltred($titulo, $autor, $orientador, $data_defesa, $tipo_doc, $idioma, $ano_defesa),
            "full_tag_open" => '<nav aria-label="..."><ul class="pagination">',
            "full_tag_close" => "</ul></nav>",
            'first_url' => base_url('buscar') . '?per_page=1' . $param_from_get,
            "last_link" => FALSE,
            "first_tag_open" => "<li class='page-item'><span class='page-link' href='#'>",
            "first_tag_close" => "</span></li>",
            'suffix' => $param_from_get,
            "prev_link" => "Anterior",
            "prev_tag_open" => "<li class='page-item'><span class='page-link' href='#'>",
            "prev_tag_close" => "</span></li>",
            "next_link" => "Próxima",
            "next_tag_open" => "<li class='page-item'><span class='page-link' href='#'>",
            "next_tag_close" => "</span></li>",
            "last_tag_open" => "<li class='page-item'><span class='page-link' href='#'>",
            "last_tag_close" => "</span></li>",
            "cur_tag_open" => "<li class='active'><span class='page-link' href='#'>",
            "cur_tag_close" => "</span></li>",
            "num_tag_open" => "<li class='page-item'><span class='page-link' href='#'>",
            "num_tag_close" => "</span></li>"
        );

        $dados['titulo'] = $titulo;
        $dados['autor'] = $autor;
        $dados['orientador'] = $orientador;
        $dados['tipo_doc'] = $tipo_doc;
        $dados['idioma'] = $idioma;
        $dados['data_defesa'] = $data_defesa;
        $dados['ano_defesa'] = $ano_defesa;
        $dados['form_preenchido'] = $form_preenchido;

        $dados['form'] = $this->pagination->initialize($config);
        $dados['paginacao'] = $this->pagination->create_links();
        $dados['title'] =  'Listagem de Documentos';
        $dados['subtitle'] =  'Listagem do notícias';
        $dados['tela'] =  'buscar';
        $dados['sidenav'] = 'buscar-doc';

        $this->load->view('includes/head', $dados);
        $this->load->view('documentos/buscar', $dados);
        $this->load->view('includes/footer', $dados);
    }

    public function apresentacao()
    {
        echo 'apresentacao';
        // $this->load->view('institucional/apresentacao');
    }

    public function contato()
    {
        // Loading helper FORM
        $this->load->helper('form');
        $this->load->library(array('form_validation', 'email'));

        // Regras validações dos inputs
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[40]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[3]|max_length[40]');
        $this->form_validation->set_rules('assunto', 'Assunto', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('mensagem', 'Mensagem', 'trim|required|min_length[3]');

        if ($this->form_validation->run() == FALSE) {
            $startOfAlert = '<div class="form-group alert alert-danger alert-dismissible fade show" role="alert">';
            $endOfAlert = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            // Erros recebidos pelo envio. -> com os um estilo pré definido estilos
            $db['form_errors'] = validation_errors($startOfAlert, $endOfAlert);
            // Recuperando as informações enviadas do formulário
        } else {
            $dados_form = $this->input->post();
            $this->email->from($dados_form['email'], $dados_form['nome']);
            $this->email->to('contato@email.com');
            $this->email->subject($dados_form['assunto']);
            $this->email->message($dados_form['mensagem']);
            if ($this->email->send()) {
                $db['form_errors'] = 'Email enviado com sucesso!';
            } else {
                $db['form_errors'] = 'Falha ao enviar o email!';
            }
        }
        $db['title'] = 'Contato';
        $this->load->view('includes/head');
        $this->load->view('includes/main-nav');
        $this->load->view('contato', $db);
        $this->load->view('includes/footer');
    }



    public function documento()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        if (($id = $this->uri->segment(3)) > 0) {
            if ($documento = $this->documentos->getDocumento($id)) {
                $dados['title']    = $documento->titulo;
                $dados["titulo"] = $documento->titulo;
                $dados["autor"] = $documento->autor;
                $dados["orientador"] = $documento->orientador;
                $dados["resumo"] = $documento->resumo;
                $dados["abstract"] = $documento->abstract;
                $dados["tipo_doc"] = $documento->tipo_doc;
                $dados["idioma"] = $documento->idioma;
                $dados["data_defesa"] = $documento->data_defesa;
                $dados['arquivo'] = $documento->arquivo;
            } else {
                $dados['title']        =  'Notícia não encontrada';
                $dados['titulo']  =  'Notícia não encontrada';
                $dados['autor'] = "<p>Nenhuma notícia foi encontrada com este esdereço</p>";
                // $dados['documento_imagem'] = "";
            }
        } else {
            redirect(base_url(), 'refresh');
        }
        if (!isset($dados['title'])) {
            $dados['title'] = 'Notícia não encontrada';
        }
        $dados['tela']         =  'documento';
        $this->load->view('includes/head', $dados);
        $this->load->view('documentos/documento', $dados);
        $this->load->view('includes/footer', $dados);
    }

    public function getSegments()
    {
        echo 'getSegments';
        echo 'URI - 1: ' . $this->uri->segment(1) . '<br/>';
        echo 'URI - 2: ' . $this->uri->segment(2) . '<br/>';
        echo 'URI - 3: ' . $this->uri->segment(3) . '<br/>';
        echo 'URI - 4: ' . $this->uri->segment(4) . '<br/>';
        echo 'URI - 5: ' . $this->uri->segment(5) . '<br/>';
    }
}
