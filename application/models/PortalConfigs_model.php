<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PortalConfigs_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function get_option($option_name, $default_value = NULL) {
		$this->db->where('option_name', $option_name);
		$query = $this->db->get('portal_configs', 1);
		if ($query->num_rows() == 1 ) {
			$row = $query->row();
			return $row->option_value;
		} else {
			return $default_value;
		}
	}

	public function update_option($option_name, $option_value){
		$this->db->where('option_name', $option_name);
		$query = $this->db->get('portal_configs',1);
		if ($query->num_rows() == 1){
			// opção já existente, devo atualizar
			$this->db->set('option_value', $option_value);
			$this->db->where('option_name', $option_name);
			$this->db->update('portal_configs');
			return $this->db->affected_rows();
		} else {
		 	// opção não existente, devo inserir
		 	$dados = array(
				'option_name' => $option_name,
				'option_value' => $option_value
			);
			$this->db->insert('portal_configs', $dados);
			return $this->db->insert_id(); 
		}
	}
}