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
			<div class="form-group form-inline">
				<?php echo form_label('Kode Barang','code',array('class'=>'control-label'))?>
				<?php echo form_input(array('name'=>'code','class'=>'form-control input-sm','maxlength'=>'15','autocomplete'=>'off','value'=>set_value('code',(isset($row->code)?$row->code:'')),'required'=>'required','autofocus'=>'autofocus'))?>
				<small><?php echo form_error('code')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label('Nama Barang','name',array('class'=>'control-label'))?>
				<?php echo form_input(array('name'=>'name','class'=>'form-control input-sm','maxlength'=>'100','size'=>'60','autocomplete'=>'off','value'=>set_value('name',(isset($row->name)?$row->name:'')),'required'=>'required'))?>
				<small><?php echo form_error('name')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label('Harga Barang','price',array('class'=>'control-label'))?>
				<?php echo form_input(array('name'=>'price','class'=>'form-control input-sm input-uang','maxlength'=>'100','size'=>'60','autocomplete'=>'off','value'=>set_value('price',(isset($row->price)?$row->price:'')),'required'=>'required'))?>
				<small><?php echo form_error('price')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label("Jenis",'jenis',array('class'=>'control-label'))?>
				<?php echo form_dropdown('jenis',$this->general_model->dropdown('barang_jenis','Jenis'),set_value('jenis',(isset($row->jenis)?$row->jenis:'')),'required=required class="form-control input-sm select2"')?>
				<small><?php echo form_error('jenis')?></small>
			</div>						
		</div>
		<div class="box-footer">
			<button class="btn btn-success btn-sm" type="submit" onclick="return confirm('Are you sure')"><span class="glyphicon glyphicon-save"></span> <?php echo $this->lang->line('save') ?></button>
			<?php echo anchor($breadcrumb,'<span class="glyphicon glyphicon-repeat"></span> '.$this->lang->line('cancel'),array('class'=>'btn btn-danger btn-sm'))?>
		</div>
	</div>
	<?php echo form_close()?>
</section>
