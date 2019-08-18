<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Compartilhamento_model extends CI_Model
{
    var $table = 'conteudo_compartilhado';
    function __construct()
    {
        parent::__construct();
    }

    public function salvar($dados)
    {
        $dados =  (array)$dados;
        if (isset($dados['ID']) && $dados['ID'] > 0) {
            // User já existe. Devo editar
            $this->db->where('ID', $dados['ID']);
            unset($dados['ID']);
            $this->db->update($this->table, $dados);
            return $this->db->affected_rows();
        } else {
            // User não existe. Devo salvar
            $this->db->insert($this->table, $dados);
            return $this->db->insert_id();
        }
    }


    public function getAllByIdCategoria( $id_categoria = 0, $sort = 'ID', $limit = NULL, $offset = NULL, $order = 'asc')
    {
        if ($id_categoria) $this->db->where('id_categoria', $id_categoria);

        $this->db->order_by($sort, $order);
        if ($limit)
            $this->db->limit($limit, $offset);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            for ($i = 0; $i < sizeof($result); $i++) {
                $result[$i]->password = '';
            }
            return $result;
        } else {
            return NULL;
        }
    }


    public function getAll($sort = 'ID', $limit = NULL, $offset = NULL, $order = 'asc')
    {
        $this->db->order_by($sort, $order);
        if ($limit)
            $this->db->limit($limit, $offset);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            for ($i = 0; $i < sizeof($result); $i++) {
                $result[$i]->password = '';
            }
            return $result;
        } else {
            return NULL;
        }
    }


    public function countAllByIdCategoria($id_categoria = 0)
    {
        if ($id_categoria) $this->db->where('id_categoria', $id_categoria);
        return  $this->db->count_all($this->table);
    }

    public function countMine($id_usuario = 0, $titulo = NULL )
    {
        if ($titulo) $this->db->like('titulo', $titulo);
        if ($id_usuario) $this->db->where('id_usuario', $id_usuario);
        return $this->db->count_all($this->table);
    }

    










    /**
     * =================================
     *        REMOVE SE NÃO USAR
     * =================================
     */






    public function countAllFiltred($titulo = NULL, $autor = NULL, $orientador = NULL, $data_defesa = NULL, $tipo_doc = NULL, $idioma = NULL, $offset = NULL, $limit = NULL)
    {
        if ($limit) $this->db->limit($limit, $offset);
        if ($autor) $this->db->like('autor', $autor);
        if ($orientador) $this->db->like('orientador', $orientador);
        if ($titulo) $this->db->like('titulo', $titulo);
        if ($data_defesa) $this->db->where('data_defesa', $data_defesa);
        if ($tipo_doc) $this->db->where('tipo_doc', $tipo_doc);
        if ($idioma) $this->db->where('idioma', $idioma);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function countAll($titulo = NULL, $data_defesa = NULL, $tipo_doc = NULL, $idioma = NULL)
    {
        if ($titulo) $this->db->like('titulo', $titulo);
        if ($data_defesa) $this->db->where('data_defesa', $data_defesa);
        if ($tipo_doc) $this->db->where('tipo_doc', $tipo_doc);
        if ($idioma) $this->db->where('idioma', $idioma);
        return $this->db->count_all($this->table);
    }


    public function remove($id = 0)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }


    public function getUserByLoginOrEmail($login = NULL)
    {
        return $this->getUser($login, $login);
    }
    public function getUserByLogin($login = NULL)
    {
        return $this->getUser($login, NULL);
    }
    public function getUserByEmail($email = NULL)
    {
        return $this->getUser(NULL, $email);
    }
    public function getUserById($id = 0)
    {
        return $this->getUser(NULL, NULL, $id);
    }
    private function getUser($login = NULL, $email = NULL, $id = 0)
    {
        $return = NULL;
        if (isset($login)) {
            safeInput($login);
            $this->db->where('login', $login);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
                $find = TRUE;
            } 
        } 
        if (isset($email) && is_null($return)) {
            safeInput($email);
            $this->db->where('email', $email);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
            } 
        } 
        if ($id > 0 && is_null($return)) {
            $this->db->where('ID', $id);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
            } 
            
        }
        // printInfoDump($return);
        return $return;
    }
}
