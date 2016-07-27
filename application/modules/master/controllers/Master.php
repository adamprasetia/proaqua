<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends MY_Controller 
{
	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->data['section'] = $this->uri->segment(2);
		$this->data['section_master'] = 'master/'.$this->uri->segment(2);
		$this->data['active_menu'] = $this->data['section'];
		$this->load->model('master_model','model');
	}
	public function index(){
		$offset = $this->general->get_offset();
		$limit = $this->general->get_limit();
		$total = $this->model->count_all();

		$this->data['action'] = $this->data['section_master'].'/search'.get_query_string(null,'offset');
		$this->data['action_delete'] = $this->data['section_master'].'/delete'.get_query_string();
		$this->data['add_btn'] = anchor($this->data['section_master'].'/add',$this->lang->line('new'),array('role'=>'tab'));
		$this->data['list_btn'] = anchor($this->data['section_master'],$this->lang->line('list'),array('role'=>'tab'));
		$this->data['delete_btn'] = '<button id="delete-btn" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> '.$this->lang->line('delete_by_checked').'</button>';

		$this->table->set_template(tbl_tmp());
		$head_data = array(
			'code'=>$this->lang->line('code'),
			'name'=>$this->lang->line('name')
		);
		$heading[] = form_checkbox(array('id'=>'selectAll','value'=>1));
		$heading[] = '#';
		foreach($head_data as $r => $value){
			$heading[] = anchor($this->data['section_master'].get_query_string(array('order_column'=>"$r",'order_type'=>$this->general->order_type($r))),"$value ".$this->general->order_icon("$r"));
		}		
		$heading[] = $this->lang->line('action');
		$this->table->set_heading($heading);
		$result = $this->model->get()->result();
		$i=1+$offset;
		foreach($result as $r){
			$this->table->add_row(
				array('data'=>form_checkbox(array('name'=>'check[]','value'=>$r->id)),'width'=>'10px'),
				$i++,
				$r->code,
				$r->name,
				anchor($this->data['section_master'].'/edit/'.$r->id.get_query_string(),$this->lang->line('edit'))
				."&nbsp;|&nbsp;".anchor($this->data['section_master'].'/delete/'.$r->id.get_query_string(),$this->lang->line('delete'),array('onclick'=>"return confirm('".$this->lang->line('confirm')."')"))
			);
		}
		$this->data['table'] = $this->table->generate();
		$this->data['total'] = page_total($offset,$limit,$total);
		
		$config = pag_tmp();
		$config['base_url'] = site_url($this->data['section_master'].get_query_string(null,'offset'));
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;

		$this->pagination->initialize($config); 
		$this->data['pagination'] = $this->pagination->create_links();

		$data['content'] = $this->load->view('master_list',$this->data,true);
		$this->load->view('template',$data);
	}
	public function search(){
		$data = array(
			'search'=>$this->input->post('search'),
			'limit'=>$this->input->post('limit')
		);
		redirect($this->data['section_master'].get_query_string($data));		
	}
	private function _field(){
		$data = array(
			'code'=>$this->input->post('code'),
			'name'=>strtoupper($this->input->post('name'))
		);
		return $data;		
	}
	private function _set_rules(){
		$this->form_validation->set_rules('name','Name','required|trim');
	}
	public function add(){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$this->data['action'] = $this->data['section_master'].'/add'.get_query_string();
			$this->data['add_btn'] = anchor($this->data['section_master'].'/add',$this->lang->line('new'),array('role'=>'tab'));
			$this->data['list_btn'] = anchor($this->data['section_master'],$this->lang->line('list'),array('role'=>'tab'));
			$this->data['breadcrumb'] = $this->data['section_master'].get_query_string();
			$this->data['heading'] = $this->lang->line('new');
			$this->data['owner'] = '';
			$data['content'] = $this->load->view('master_form',$this->data,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$data['user_create'] = $this->user_login['id'];
			$data['date_create'] = date('Y-m-d H:i:s');
			$this->model->add($data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">'.$this->lang->line('new_success').'</div>');
			redirect($this->data['section_master'].'/add'.get_query_string());
		}
	}
	public function edit($id){
		$this->_set_rules();
		if($this->form_validation->run()===false){
			$this->data['add_btn'] = anchor(current_url(),$this->lang->line('edit'),array('role'=>'tab'));
			$this->data['list_btn'] = anchor($this->data['section_master'],$this->lang->line('list'),array('role'=>'tab'));
			$this->data['row'] = $this->model->get_from_field('id',$id)->row();
			$this->data['action'] = $this->data['section_master'].'/edit/'.$id.get_query_string();
			$this->data['breadcrumb'] = $this->data['section_master'].get_query_string();
			$this->data['heading'] = $this->lang->line('edit');
			$this->data['owner'] = owner($this->data['row']);
			$data['content'] = $this->load->view('master_form',$this->data,true);
			$this->load->view('template',$data);
		}else{
			$data = $this->_field();
			$data['user_update'] = $this->user_login['id'];;
			$data['date_update'] = date('Y-m-d H:i:s');
			$this->model->edit($id,$data);
			$this->session->set_flashdata('alert','<div class="alert alert-success">'.$this->lang->line('edit_success').'</div>');
			redirect($this->data['section_master'].'/edit/'.$id.get_query_string());
		}
	}
	public function delete($id=''){
		if($id<>''){
			$this->model->delete($id);
		}
		$check = $this->input->post('check');
		if($check<>''){
			foreach($check as $c){
				$this->model->delete($c);
			}
		}
		$this->session->set_flashdata('alert','<div class="alert alert-success">'.$this->lang->line('delete_success').'</div>');
		redirect($this->data['section_master'].get_query_string());
	}
}