<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template extends CI_Controller
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
        $this->load->view('template/includes/head');
        $this->load->view('template/includes/header');
        $this->load->view('template/template');
        $this->load->view('template/includes/footer');
    }
    public function template2()
    {
        $this->load->view('template/includes/head');
        $this->load->view('template/template2');
        $this->load->view('template/includes/footer');
    }
}
