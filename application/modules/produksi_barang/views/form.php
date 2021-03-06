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
		<li role="presentation" class="active"><?php echo $add_btn ?></li>
		<li role="presentation"><?php echo $list_btn ?></li>
	</ul>
	<?php echo $this->session->flashdata('alert')?>
	<?php echo form_open_multipart($action)?>
	<div class="box box-default">
		<div class="box-header owner">
			<?php echo $owner?>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group form-inline">
						<?php echo form_label('No Dokumen','nomor',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'nomor','class'=>'form-control input-sm','maxlength'=>'100','size'=>'50','autocomplete'=>'off','value'=>set_value('nomor',(isset($row->nomor)?$row->nomor:'')),'required'=>'required','autofocus'=>'autofocus'))?>
						<small><?php echo form_error('nomor')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Tanggal','tanggal',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'tanggal','class'=>'form-control input-sm input-tanggal','maxlength'=>'10','autocomplete'=>'off','value'=>set_value('tanggal',(isset($row->tanggal)?$row->tanggal:'')),'required'=>'required'))?>
						<small><?php echo form_error('tanggal')?></small>
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
				<button type="button" class="btn btn-primary btn-sm" onclick="add_detail()">
					<span class="glyphicon glyphicon-plus"></span> <?php echo $this->lang->line('new') ?>
				</button>			
				<table id="detail-table" class="table table-bordered">
					<tr>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Keterangan</th>
						<th><?php echo $this->lang->line('action') ?></th>
					</tr>
					<?php if (isset($row_detail)): ?>
						<?php $total_all=0;foreach ($row_detail as $row): ?>
							<tr>
								<input type="hidden" name="kode_barang[]" value="<?php echo $row->kode_barang ?>">
								<input type="hidden" name="jumlah[]" value="<?php echo $row->jumlah ?>">
								<input type="hidden" name="keterangan[]" value="<?php echo $row->keterangan ?>">

								<td class="kode_barang"><?php echo $row->kode_barang ?></td>
								<td class="nama_barang"><?php echo $this->general_model->get_from_field_row('barang','code',$row->kode_barang)->name ?></td>
								<td class="jumlah" align="right"><?php echo number_format($row->jumlah) ?></td>
								<td class="keterangan"><?php echo $row->keterangan ?></td>
								<td>
									<button type="button" onclick="edit_detail(this)" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span> <?php echo $this->lang->line("edit") ?></button>
									&nbsp;
									<button type="button" onclick="delete_detail(this)" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> <?php echo $this->lang->line("delete") ?></button>
								</td>
							</tr>							
						<?php $total_all++;endforeach ?>
					<?php endif ?>
				</table>
			</div>
		</div>
		<div class="box-footer">
			<p id="total_all">Jumlah Item: <strong><?php echo (isset($total_all)?number_format($total_all):"0") ?></strong></p>
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
<!-- Modal -->
<div class="modal fade" id="detail-modal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Detail</h4>
      </div>
      <div class="modal-body">
		<?php echo $this->load->view($index.'/detail') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel') ?></button>
        <button id="save-modal" type="button" class="btn btn-primary" ><?php echo $this->lang->line('save') ?></button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
		if(e.keyCode == 13) {
			e.preventDefault();
			return false;
		}
	});
	function number_format(user_input){
	    var filtered_number = user_input.replace(/[^0-9]/gi, '');
	    var length = filtered_number.length;
	    var breakpoint = 1;
	    var formated_number = '';

	    for(i = 1; i <= length; i++){
	        if(breakpoint > 3){
	            breakpoint = 1;
	            formated_number = ',' + formated_number;
	        }
	        var next_letter = i + 1;
	        formated_number = filtered_number.substring(length - i, length - (i - 1)) + formated_number; 

	        breakpoint++;
	    }

	    return formated_number;
	}		
	function add_detail(){
		$('#save-modal').attr("onclick","do_add_detail()");
		$('#kode_barang').val("").trigger("change");
		$('#jumlah').val("");
		$('#keterangan').val("");
		$('#detail-modal').modal('show');
	}
	function do_add_detail(){		
		var kode_barang = $('#kode_barang').val();
		var nama_barang = $('#kode_barang option:selected').text();
		nama_barang = nama_barang.split(" - ");
		nama_barang = nama_barang[1];
		var jumlah = $('#jumlah').val();
		var keterangan = $('#keterangan').val();
		$('#detail-table').append(
			'<tr>'
			+'<input type="hidden" name="kode_barang[]" value="'+kode_barang+'">'
			+'<input type="hidden" name="jumlah[]" value="'+jumlah+'">'
			+'<input type="hidden" name="keterangan[]" value="'+keterangan+'">'
				+'<td class="kode_barang">'+kode_barang+'</td>'
				+'<td class="nama_barang">'+nama_barang+'</td>'
				+'<td class="jumlah" align="right">'+jumlah+'</td>'
				+'<td class="keterangan">'+keterangan+'</td>'
				+'<td><button type="button" onclick="edit_detail(this)" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span> <?php echo $this->lang->line("edit") ?></button>&nbsp;'
				+'<button type="button" onclick="delete_detail(this)" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> <?php echo $this->lang->line("delete") ?></button></td>'
			+'</tr>'
		);
		total_all();
		$('#detail-modal').modal('hide');
	}
	function edit_detail(t){
		$('#save-modal').attr("onclick","do_edit_detail()");
		var index = $("#detail-table tr").index($(t).parent().parent());
		var kode_barang = $(t).parent().parent().find('td.kode_barang').html();
		var jumlah = $(t).parent().parent().find('td.jumlah').html();
		var keterangan = $(t).parent().parent().find('td.keterangan').html();
		$('#index').val(index);
		$('#kode_barang').val(kode_barang).trigger("change");
		$('#jumlah').val(jumlah);
		$('#keterangan').val(keterangan);
		$('#detail-modal').modal('show');
	}		
	function do_edit_detail(){
		var index = $('#index').val();
		var kode_barang = $('#kode_barang').val();
		var nama_barang = $('#kode_barang option:selected').text();
		nama_barang = nama_barang.split(" - ");
		nama_barang = nama_barang[1];
		var jumlah = $('#jumlah').val();
		var harga = $('#harga').val();
		var total = $('#total').val();
		var rekening = $('#rekening').val();
		var keterangan = $('#keterangan').val();
		var parent = $('#detail-table tbody tr:nth-child('+(parseInt(index)+1)+')'); 
		parent.find('td.kode_barang').html(kode_barang);
		parent.find('td.nama_barang').html(nama_barang);
		parent.find('td.jumlah').html(jumlah);
		parent.find('td.keterangan').html(keterangan);
		parent.find('input[name="kode_barang[]"]').val(kode_barang);
		parent.find('input[name="jumlah[]"]').val(jumlah);
		parent.find('input[name="keterangan[]"]').val(keterangan);
		total_all();
		$('#detail-modal').modal('hide');
	}	
	function delete_detail(t){
		$(t).parent().parent().remove();
		total_all();
	}	
	function total_all(){
		var count = $('#detail-table tbody tr').length-1; 
		$('#total_all').html('Total : <strong>'+number_format(count.toString())+'</strong>');
	}		
</script>