<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permintaan_barang_list extends MY_Controller 
{
	private $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->data['title'] = 'List Permintaan Barang';
		$this->data['index'] = 'permintaan_barang_list';
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
		$this->data['action_delete'] = $this->data['index'].'/delete'.get_query_string();
		$this->data['list_btn'] = anchor($this->data['index'].get_query_string(),$this->lang->line('list'));
		$this->data['delete_btn'] = '<button id="delete-btn" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> '.$this->lang->line('delete_by_checked').'</button>';

		$this->table->set_template(tbl_tmp());
		$head_data = array(
			'nomor' => 'Nomor',
			'tanggal' => 'Tanggal',
			'toko_name' => 'Toko',
			'jumlah' => 'Jumlah',
			'total' => 'Total',
			'status_name' => 'Status',
		);
		$heading[] = '#';
		foreach($head_data as $r => $value){
			$heading[] = anchor($this->data['index'].get_query_string(array('order_column'=>"$r",'order_type'=>$this->general->order_type($r))),"$value ".$this->general->order_icon("$r"));
		}		
		$heading[] = $this->lang->line('action');
		$this->table->set_heading($heading);
		$result = $this->model->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				$i++,
				$r->nomor,
				format_dmy($r->tanggal),
				$r->toko_name,
				array('data'=>number_format($r->jumlah),'align'=>'right'),
				array('data'=>number_format($r->total),'align'=>'right'),
				$r->status_name,
				anchor($this->data['index'].'/edit/'.$r->id.get_query_string(),'Edit')
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
			'search' => $this->input->post('search'),
			'limit' => $this->input->post('limit'),
			'date_from' => $this->input->post('date_from'),
			'date_to' => $this->input->post('date_to')
		);
		redirect($this->data['index'].get_query_string($data));		
	}
	private function _field(){
		$data = array(
			'status' => $this->input->post('status')
		);
		return $data;		
	}
	private function _set_rules(){
		$this->form_validation->set_rules('status','Toko','required|trim');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
	public function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$this->data['title'] = $this->data['title'];
			$this->data['index'] = $this->data['index'];
			$this->data['row'] = $this->model->get_from_field('id',$id)->row();
			$this->data['row_detail'] = $this->model->get_from_field_detail('id_parent',$id)->result();
			$this->data['row']->tanggal = format_dmy($this->data['row']->tanggal);
			$this->data['add_btn'] = anchor(current_url(),$this->lang->line('edit'));
			$this->data['list_btn'] = anchor($this->data['index'].get_query_string(),$this->lang->line('list'));
			$this->data['action'] = $this->data['index'].'/edit/'.$id.get_query_string();
			$this->data['breadcrumb'] = $this->data['index'].get_query_string();
			$this->data['heading'] = $this->lang->line('edit');
			$this->data['owner'] = owner($this->data['row']);
			$data['content'] = $this->load->view($this->data['index'].'/form',$this->data,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$data['user_update'] = $this->user_login['id'];
			$data['date_update'] = date('Y-m-d H:i:s');
			$this->model->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">'.$this->lang->line('edit_success').'</div>');
			redirect($this->data['index'].'/edit/'.$id.get_query_string());
		}
	}
}