<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News_model extends CI_Model
{
    var $table = 'news';
    function __construct()
    {
        parent::__construct();
    }

    public function save($dados)
    {
        $dados =  (array)$dados;
        if (isset($dados['ID']) && $dados['ID'] > 0) {
            // User já existe. Devo editar
            $this->db->where('ID', $dados['ID']);
            unset($dados['ID']);
            $this->db->update($this->table, $dados);
            return $this->db->affected_rows();
        } else {
            // User não existe. Devo editar
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


    public function countAllFiltred($news_date_published= NULL, $news_title= NULL, $news_body= NULL, $news_highlight= NULL, $news_date_to_publish= NULL, $offset = NULL, $limit = NULL)
    {
        if ($limit) $this->db->limit($limit, $offset);
        if ($news_title) $this->db->like('news_title', $news_title);
        if ($news_body) $this->db->like('news_body', $news_body);
        if ($news_highlight) $this->db->where('news_highlight', $news_highlight);
        if ($news_date_to_publish) $this->db->where('news_date_to_publish', $news_date_to_publish);
        if ($news_date_published) $this->db->where('news_date_published', $news_date_published);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function countAll($news_date_published= NULL, $news_title= NULL, $news_body= NULL, $news_highlight= NULL, $news_date_to_publish= NULL, $offset = NULL, $limit = NULL)
    {
        if ($limit) $this->db->limit($limit, $offset);
        if ($news_title) $this->db->like('news_title', $news_title);
        if ($news_body) $this->db->like('news_body', $news_body);
        if ($news_highlight) $this->db->where('news_highlight', $news_highlight);
        if ($news_date_to_publish) $this->db->where('news_date_to_publish', $news_date_to_publish);
        if ($news_date_published) $this->db->where('news_date_published', $news_date_published);
        return $this->db->count_all($this->table);
    }


    public function delete($id = 0)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }


    public function getNewsByBody($body = NULL)
    {
        return $this->getNews($body, NULL);
    }
    public function getNewsByTitle($title = NULL)
    {
        return $this->getNews(NULL, $title);
    }
    public function getNewsById($id = 0)
    {
        return $this->getNews(NULL, NULL, $id);
    }
    private function getNews($title = NULL, $body = NULL, $id = 0)
    {
        $return = NULL;
        if (isset($title)) {
            safeInput($title);
            $this->db->where('title', $title);
            $query = $this->db->get($this->table, 1);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $return = $row;
            }
        }
        if (isset($body) && is_null($return)) {
            safeInput($body);
            $this->db->where('body', $body);
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



    /**
     * =================================
     *        REMOVE SE NÃO USAR
     * =================================
     */
}
