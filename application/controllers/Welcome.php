<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('domaineModel');
		$this->load->model('sousDomaineModel');
	}

	public function index()
	{
		//$this->load->view('welcome_message');
		$data = array();
		$domaine = "";
		$data['nom_domaine'] = $this->domaineModel->recupererNomDomaine();
		foreach ($data['nom_domaine'] as $row ) {
			$domaine = $row->nom_domaine;
			$data['nom_sous_domaine'] = $this->sousDomaineModel->recupererNomSousDomaine($domaine);
			//var_dump($data['nom_sous_domaine']);
		}
		
		$this->load->view('/nav/header',$data);
		$this->load->view('/nav/footer');
	}
}
