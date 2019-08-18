<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documento_model extends CI_Model {
	var $table = 'documentos';
	function __construct(){
		parent::__construct();
	}
	
	public function salvar($dados) {
		if (isset($dados['id']) && $dados['id'] > 0) {
			// Documento já existe. Devo editar
			$this->db->where('id', $dados['id']);
			unset($dados['id']);
			$this->db->update($this->table, $dados);
			return $this->db->affected_rows();
		} else {
			// Documento não existe. Devo editar
			$this->db->insert($this->table, $dados);
			return $this->db->insert_id();
		}
	}
	
	public function getAll($sort = 'id', $limit = null, $offset = null, $order = 'asc'){
		$this->db->order_by($sort, $order);
		if($limit)
		$this->db->limit($limit,$offset);
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	private function removeBasicWords($word = ''){
		if(isset($word)) {
			$word = rtrim(str_replace(' da ',  ' ',$word));
			$word = rtrim(str_replace(' de ',  ' ',$word));
			$word = rtrim(str_replace(' di ',  ' ',$word));
			$word = rtrim(str_replace(' do ',  ' ',$word));
			$word = rtrim(str_replace(' du ',  ' ',$word));
			$word = rtrim(str_replace(' e ',   ' ',$word));
			$word = rtrim(str_replace(' das ', ' ',$word));
			$word = rtrim(str_replace(' des ', ' ',$word));
			$word = rtrim(str_replace(' dis ', ' ',$word));
			$word = rtrim(str_replace(' dos ', ' ',$word));
			$word = rtrim(str_replace(' dus ', ' ',$word));
			$word = rtrim(preg_replace('/\s+/', ' ',$word));
		}
		return $word;
	}
	public function searchDocumento($titulo = null,  $autor = null, $orientador = null, $data_defesa = null, $tipo_doc = null, $idioma = null, $ano_defesa=null, $offset = null, $limit = null, $order = 'asc'){
		
		if($limit) $this->db->limit($limit,$offset);
		
		$titulo_splited = explode(' ', $this->removeBasicWords($titulo));
		
		if($titulo) {
			foreach ($titulo_splited as $titulo_word) {
				$this->db->like('titulo',$titulo_word);
			}
		}
		
		$autor_splited = explode(' ', $this->removeBasicWords($autor));
		if($autor) {
			foreach ($autor_splited as $autor_word) {
				$this->db->like('autor',$autor_word);
			}
		}

		
		$orientador_splited = explode(' ', $this->removeBasicWords($orientador));
		if($orientador) {
			foreach ($orientador_splited as $orientador_word) {
				$this->db->like('orientador',$orientador_word);
			}
		}
		if($data_defesa && $data_defesa != ''){
			var_dump($data_defesa);
			$this->db->where('data_defesa',$data_defesa);
		} else if($ano_defesa  && $ano_defesa  != ''){
			$this->db->or_like('data_defesa',$ano_defesa);
		}
		
		if($tipo_doc) $this->db->where('tipo_doc',$tipo_doc);
		if($idioma) $this->db->where('idioma',$idioma);
		
		
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
	public function countAllFiltred($titulo = null, $autor = null, $orientador = null, $data_defesa = null, $tipo_doc = null, $idioma = null, $offset = null, $limit = null){
		if($limit) $this->db->limit($limit,$offset);
		if ($autor) $this->db->like('autor',$autor);
		if ($orientador) $this->db->like('orientador',$orientador);
		if($titulo) $this->db->like('titulo',$titulo);
		if($data_defesa) $this->db->where('data_defesa',$data_defesa);
		if($tipo_doc) $this->db->where('tipo_doc',$tipo_doc);
		if($idioma) $this->db->where('idioma',$idioma);
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}
	public function countAll($titulo = null, $data_defesa = null, $tipo_doc = null, $idioma = null){
		if($titulo) $this->db->like('titulo',$titulo);
		if($data_defesa) $this->db->where('data_defesa',$data_defesa);
		if($tipo_doc) $this->db->where('tipo_doc',$tipo_doc);
		if($idioma) $this->db->where('idioma',$idioma);
		return $this->db->count_all($this->table);
	}
	
	public function getDocumento($id = 0){
		if ($id>0) {
			$this->db->where('id', $id);
			$query = $this->db->get($this->table, 1);
			if($query->num_rows() == 1){
				$row = $query->row();
				return $row;
			} else {
				return NULL;
			}
		}
	}
	
	public function excluirDocumento($id = 0){
		$this->db->where('id',$id);
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}
}