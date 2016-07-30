<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stok_barang extends MY_Controller 
{
	private $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = 'Stok Barang';
		$this->data['index'] = 'stok_barang';
		$this->data['active_menu'] = $this->data['index'];
		$this->load->model($this->data['index'].'/model');
	}
	public function index()
	{
		$offset = $this->general->get_offset();
		$limit 	= $this->general->get_limit();
		$total 	= $this->model->count_all();

		$this->data['title'] = $this->data['title'];
		$this->data['action'] = $this->data['index'].'/search'.get_query_string(null,'offset');

		$this->table->set_template(tbl_tmp());
		$head_data = array(
			'nomor' => 'Kode Barang',
			'tanggal' => 'Nama Barang',
		);
		$heading[] = '#';
		foreach($head_data as $r => $value){
			$heading[] = anchor($this->data['index'].get_query_string(array('order_column'=>"$r",'order_type'=>$this->general->order_type($r))),"$value ".$this->general->order_icon("$r"));
		}		
		$heading[] = 'Stok';
		$this->table->set_heading($heading);
		$result = $this->model->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$masuk = $this->model->get_masuk($r->code)->row()->total;
			$keluar = $this->model->get_keluar($r->code)->row()->total;
			$stok = number_format($masuk-$keluar);
			$this->table->add_row(
				$i++,
				$r->code,
				$r->name,
				$stok
			);
		}
		$this->data['table'] = $this->table->generate();
		$this->data['total'] = page_total($offset,$limit,$total);
		
		$config = pag_tmp();
		$config['base_url'] = $this->data['index'].get_query_string(null,'offset');
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;

		$this->pagination->initialize($config); 
		$this->data['pagination'] = $this->pagination->create_links();
		$data['content'] = $this->load->view($this->data['index'].'/list',$this->data,true);
		$this->load->view('template',$data);
	}
	public function search(){
		$data = array(
			'limit' => $this->input->post('limit'),
			'search' => $this->input->post('search')
		);
		redirect($this->data['index'].get_query_string($data));		
	}
}