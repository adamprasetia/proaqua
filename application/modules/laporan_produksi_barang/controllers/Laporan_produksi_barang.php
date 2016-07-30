<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_produksi_barang extends MY_Controller 
{
	private $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->data['active_menu'] = 'laporan_produksi_barang';
		$this->data['title'] = 'Laporan Produksi Barang';
		$this->data['index'] = 'laporan_produksi_barang';
		$this->load->model($this->data['index'].'/model');
	}
	public function index()
	{
		$this->_set_rules();
		if ($this->form_validation->run()===false) {
			$this->data['action'] = site_url('laporan_produksi_barang');
			$this->data['content'] = $this->load->view($this->data['index'].'/view',$this->data,true);
			$this->load->view('template',$this->data);
		}else{
			require_once "assets/plugins/fpdf/fpdf.php";
			$pdf = new FPDF();
			$pdf->AliasNbPages();
			$pdf->AddPage('L','A4');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(0,5,'PT PRO-AQUA INDONESIA',0,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(0,5,'Laporan Produksi Barang',0,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(0,5,'Periode Tanggal : '.$this->input->post('date_from').' s/d '.$this->input->post('date_to'),0,0,'L');
			$pdf->Ln(10);
			$i=1;
			$result = $this->model->get()->result();
			foreach ($result as $row) {
				$pdf->SetFont('Arial','B',8);
				$pdf->Cell(20,5,'NO',0,0,'L');
				$pdf->Cell(10,5,':',0,0,'C');
				$pdf->Cell(50,5,$i,0,0,'L');
				$pdf->Cell(20,5,'NOMOR',0,0,'L');
				$pdf->Cell(10,5,':',0,0,'C');
				$pdf->Cell(50,5,$row->nomor,0,0,'L');
				$pdf->Ln(5);
				$pdf->Cell(20,5,'TANGGAL',0,0,'L');
				$pdf->Cell(10,5,':',0,0,'C');
				$pdf->Cell(50,5,format_dmy($row->tanggal),0,0,'L');
				$pdf->Cell(20,5,'JUMLAH ITEM',0,0,'L');
				$pdf->Cell(10,5,':',0,0,'C');
				$pdf->Cell(0,5,number_format($row->jumlah),0,0,'L');
				$pdf->Ln(5);
				$j=1;
				$pdf->Cell(10,5,'No',1,0,'C');
				$pdf->Cell(40,5,'Kode Barang',1,0,'C');
				$pdf->Cell(60,5,'Nama Barang',1,0,'C');
				$pdf->Cell(30,5,'Jumlah',1,0,'C');
				$pdf->Cell(0,5,'Keterangan',1,0,'C');
				$pdf->Ln(5);
				$result_detail = $this->model->get_detail($row->id)->result();
				foreach ($result_detail as $rows) {
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(10,5,$j,1,0,'C');
					$pdf->Cell(40,5,$rows->kode_barang,1,0,'C');
					$pdf->Cell(60,5,$rows->barang_name,1,0,'L');
					$pdf->Cell(30,5,number_format($rows->jumlah),1,0,'R');
					$pdf->Cell(0,5,$rows->keterangan,1,0,'L');
					$pdf->Ln(5);
					$j++;
				}
				$pdf->Ln(5);
				$i++;
			}
			$pdf->Ln(5);
			$pdf->Cell(35,5,'Jakarta, '.date('d M Y'),0,0,'C');
			$pdf->Ln(5);
			$pdf->Cell(35,5,'Dibuat Oleh',0,0,'C');
			$pdf->Ln(5);
			$pdf->Cell(35,20,'',0,0,'C');
			$pdf->Ln(20);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(35,5,'('.$this->user_login['name'].')',0,0,'C');

			$pdf->Output();
		}
	}
	private function _set_rules(){
		$this->form_validation->set_rules('date_from','Date From','trim');
		$this->form_validation->set_rules('date_to','Date To','trim');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
}