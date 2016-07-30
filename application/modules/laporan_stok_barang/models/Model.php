<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Model 
{
	private $tbl_name = 'barang';
	private $tbl_key 	= 'id';

	public function query()
	{
		$data[] = $this->db->select('a.*');
		$data[] = $this->db->from($this->tbl_name.' a');
		$data[] = $this->search();
		$data[] = $this->db->order_by($this->general->get_order_column('a.code'),$this->general->get_order_type('asc'));
		return $data;
	}
	public function get(){
		$this->query();
		return $this->db->get();
	}
	public function count_all(){
		$this->query();
		return $this->db->get()->num_rows();
	}
	public function search(){
		$result = $this->input->get('search');
		if($result <> ''){
			return $this->db->where('(a.code like "%'.$result.'%" or a.name like "%'.$result.'%")');
		}		
	}
	public function get_masuk($id)
	{
		$this->db->select('sum(jumlah) as total');
		$this->db->where('kode_barang',$id);
		$this->db->from('produksi_barang_detail');
		return $this->db->get();
	}
	public function get_keluar($id)
	{
		$this->db->select('sum(jumlah) as total');
		$this->db->where('kode_barang',$id);
		$this->db->from('pengiriman_barang_detail');
		return $this->db->get();
	}
}