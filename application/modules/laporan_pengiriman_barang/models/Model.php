<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Model 
{
	private $tbl_name = 'pengiriman_barang';
	private $tbl_key 	= 'id';

	public function query()
	{
		$data[] = $this->db->select('a.*,count(b.id) as jumlah,c.name as toko_name');
		$data[] = $this->db->from($this->tbl_name.' a');
		$data[] = $this->db->join($this->tbl_name.'_detail b','a.id=b.id_parent','left');
		$data[] = $this->db->join('toko c','a.toko=c.code','left');
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
		$this->db->select('a.*,b.name as barang_name');
		$this->db->from($this->tbl_name.'_detail a');
		$this->db->join('barang b','a.kode_barang=b.code','left');
		$this->db->where('id_parent',$id);
		return $this->db->get();
	}
}