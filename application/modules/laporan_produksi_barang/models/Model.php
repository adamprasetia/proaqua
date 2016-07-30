<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Model 
{
	private $tbl_name = 'produksi_barang';
	private $tbl_key 	= 'id';

	public function query()
	{
		$data[] = $this->db->select('a.*,count(b.id) as jumlah');
		$data[] = $this->db->from($this->tbl_name.' a');
		$data[] = $this->db->join($this->tbl_name.'_detail b','a.id=b.id_parent','left');
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		if($date_from <> '' && $date_to <> ''){
			$data[] = $this->db->where('a.tanggal >=',format_ymd($date_from));
			$data[] = $this->db->where('a.tanggal <=',format_ymd($date_to));
		}		
		$data[] = $this->db->group_by('a.id');
		$data[] = $this->db->order_by($this->general->get_order_column('a.tanggal'),$this->general->get_order_type('desc'));
		return $data;
	}
	public function get()
	{
		$this->query();
		return $this->db->get();
	}
	public function get_detail($id)
	{	
		$this->db->select('a.*,b.name as barang_name,b.price as harga');
		$this->db->from('produksi_barang_detail a');
		$this->db->join('barang b','a.kode_barang=b.code','left');
		$this->db->where('id_parent',$id);
		return $this->db->get();
	}
}