<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categoria_model extends CI_Model
{
    var $table = 'categorias';
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


    public function countAll($titulo = NULL,  $ID = NULL)
    {

        if ($titulo) $this->db->like('titulo', $titulo);
        if ($ID) $this->db->where('ID', $ID);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }


    public function excluirUser($id = 0)
    {
        $this->db->where('ID', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }



    public function getItByTitulo($titulo = NULL)
    {
        return $this->getIt($titulo);
    }
    public function getItById($id = 0)
    {
        return $this->getIt(NULL, $id);
    }
    private function getIt($titulo = NULL, $id = 0)
    {
        $return = NULL;
        if (isset($titulo)) {
            safeInput($titulo);
            $this->db->where('id', $titulo);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
                $find = TRUE;
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
        return $return;
    }


}
