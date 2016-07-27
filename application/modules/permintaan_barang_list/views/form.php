<section class="content-header">
	<h1>
		<?php echo $title ?>
		<small><?php echo $heading ?></small>
	</h1>
	<ol class="breadcrumb">
		<li><?php echo anchor('home','<span class="glyphicon glyphicon-home"></span> '.$this->lang->line('home'))?></li>
	  <li><?php echo anchor($breadcrumb,$this->lang->line('list'))?></li>
	  <li class="active"><?php echo $heading?></li>
	</ol>
</section>
<section class="content">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="">View</a></li>
		<li role="presentation"><?php echo $list_btn ?></li>
	</ul>
	<?php echo $this->session->flashdata('alert')?>
	<?php echo form_open($action)?>	
	<div class="box box-default">
		<div class="box-header owner">
			<?php echo $owner?>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group form-inline">
						<?php echo form_label('No Dokumen','nomor',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'nomor','class'=>'form-control input-sm','maxlength'=>'100','size'=>'50','autocomplete'=>'off','value'=>set_value('nomor',(isset($row->nomor)?$row->nomor:'')),'required'=>'required','autofocus'=>'autofocus','readonly'=>'true'))?>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Tanggal','tanggal',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'tanggal','class'=>'form-control input-sm','maxlength'=>'10','autocomplete'=>'off','value'=>set_value('tanggal',(isset($row->tanggal)?$row->tanggal:'')),'required'=>'required','readonly'=>'true'))?>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Toko','toko',array('class'=>'control-label'))?>
						<?php echo form_dropdown('toko',$this->general_model->dropdown('toko','Toko'),set_value('toko',(isset($row->toko)?$row->toko:'')),'required=required class="form-control input-sm select2" disabled="disabled"')?>
					</div>																		
				</div>
				<div class="col-md-6">
					<div class="form-group form-inline">
						<?php echo form_label('Status','status',array('class'=>'control-label'))?>
						<?php echo form_dropdown('status',$this->general_model->dropdown('permintaan_barang_status','Status'),set_value('status',(isset($row->status)?$row->status:'')),'required=required class="form-control input-sm select2"')?>
					</div>																						
				</div>
			</div>
		</div>
	</div>
	<div class="box box-default">
		<div class="box-header">
			Detail Barang
		</div>
		<div class="box-body">
			<div class="table-responsive form-inline">
				<table id="detail-table" class="table table-bordered">
					<tr>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Harga</th>
						<th>Total</th>
						<th>Keterangan</th>
					</tr>
					<?php if (isset($row_detail)): ?>
						<?php $total_all=0;foreach ($row_detail as $row): ?>
							<tr>
								<input type="hidden" name="kode_barang[]" value="<?php echo $row->kode_barang ?>">
								<input type="hidden" name="jumlah[]" value="<?php echo $row->jumlah ?>">
								<input type="hidden" name="harga[]" value="<?php echo $row->harga ?>">
								<input type="hidden" name="keterangan[]" value="<?php echo $row->keterangan ?>">

								<td class="kode_barang"><?php echo $row->kode_barang ?></td>
								<td class="nama_barang"><?php echo $this->general_model->get_from_field_row('barang','code',$row->kode_barang)->name ?></td>
								<td class="jumlah" align="right"><?php echo number_format($row->jumlah) ?></td>
								<td class="harga" align="right"><?php echo number_format($row->harga) ?></td>
								<td class="total" align="right"><?php echo number_format($row->jumlah*$row->harga) ?></td>
								<td class="keterangan"><?php echo $row->keterangan ?></td>
							</tr>							
						<?php $total_all+=$row->jumlah*$row->harga;endforeach ?>
					<?php endif ?>
				</table>
			</div>
		</div>
		<div class="box-footer">
			<p id="total_all">Total : <strong><?php echo (isset($total_all)?number_format($total_all):"0") ?></strong></p>
		</div>		
	</div>
	<div class="box box-default">
		<div class="box-footer">
			<button class="btn btn-success btn-sm" type="submit" onclick="return confirm('Are you sure')"><span class="glyphicon glyphicon-save"></span> <?php echo $this->lang->line('save') ?></button>
			<?php echo anchor($breadcrumb,'<span class="glyphicon glyphicon-repeat"></span> '.$this->lang->line('cancel'),array('class'=>'btn btn-danger btn-sm'))?>
		</div>
	</div>
	<?php echo form_close()?>
</section>