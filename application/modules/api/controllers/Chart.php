<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model');
	}
	public function permintaan_barang()
	{
		$result = $this->model->chart_permintaan_barang()->result();
		echo json_encode($result);
	}
}