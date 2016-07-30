<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_stok_barang extends MY_Controller 
{
	private $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->data['active_menu'] = 'laporan_stok_barang';
		$this->data['title'] = 'Laporan Stok Barang';
		$this->data['index'] = 'laporan_stok_barang';
		$this->load->model($this->data['index'].'/model');
	}
	public function index()
	{
		require_once "assets/plugins/fpdf/fpdf.php";
		$pdf = new FPDF();
		$pdf->AliasNbPages();
		$pdf->AddPage('L','A4');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,5,'PT PRO-AQUA INDONESIA',0,0,'L');
		$pdf->Ln(4);
		$pdf->Cell(0,5,'Laporan Stok Barang',0,0,'L');
		$pdf->Ln(10);
		$pdf->Cell(10,5,'No',1,0,'C');
		$pdf->Cell(40,5,'Kode Barang',1,0,'C');
		$pdf->Cell(60,5,'Nama Barang',1,0,'C');
		$pdf->Cell(20,5,'Stok',1,0,'C');
		$pdf->Ln(5);
		$i=1;
		$result = $this->model->get()->result();
		foreach ($result as $row) {
			$masuk = $this->model->get_masuk($row->code)->row()->total;
			$keluar = $this->model->get_keluar($row->code)->row()->total;
			$stok = number_format($masuk-$keluar);			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(10,5,$i,1,0,'C');
			$pdf->Cell(40,5,$row->code,1,0,'C');
			$pdf->Cell(60,5,$row->name,1,0,'L');
			$pdf->Cell(20,5,$stok,1,0,'R');
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