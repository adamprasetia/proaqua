<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Model 
{
	function result($tbl_name = '')
	{
		$q = $this->input->get('q');
		if($q){
			$this->db->where('(code like "%'.$q.'%" OR name like "%'.$q.'%")');
		}
		$this->db->from($tbl_name);
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	function result_barang($type = '')
	{
		if($type){
			$this->db->where('type',$type);
		}		
		$q = $this->input->get('q');
		if($q){
			$this->db->where('(code like "%'.$q.'%" OR name like "%'.$q.'%")');
		}
		$this->db->from('barang');
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	function chart_permintaan_barang()
	{
		$this->db->select('date_format(tanggal,"%Y-%m") as y,count(id) as item1');
		$this->db->group_by('date_format(tanggal,"%Y-%m")');
		$this->db->order_by('tanggal','asc');
		return $this->db->get('permintaan_barang');			
	}
}