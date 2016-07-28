<section class="content-header">
	<h1>
		<?php echo $title ?>
		<small><?php echo $this->lang->line('list') ?></small>
	</h1>
	<ol class="breadcrumb">
		<li><?php echo anchor('home','<span class="glyphicon glyphicon-home"></span> '.$this->lang->line('home'))?></li>
		<li class="active"><?php echo $this->lang->line('list') ?></li>
	</ol>
</section>
<section class="content">
	<?php echo form_open($action,array('class'=>'form-inline','method'=>'post'))?>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#">Laporan</a></li>
	</ul>
	<div class="box box-default">
		<div class="box-body">
			<div class="form-group">
				Tanggal : 
				<?php echo form_input(array('name'=>'date_from','placeholder'=>$this->lang->line('from'),'class'=>'form-control input-sm input-tanggal','size'=>'10','value'=>$this->input->get('date_from')))?>
				<?php echo form_input(array('name'=>'date_to','placeholder'=>$this->lang->line('to'),'class'=>'form-control input-sm input-tanggal','size'=>'10','value'=>$this->input->get('date_to')))?>
			</div>	
			<?php echo validation_errors(); ?>
		</div>
	</div>
	<div class="box box-default">
		<div class="box-body">
			<button type="submit" class="btn btn-primary">Execute</button>
		</div>
	</div>
	<?php echo form_close()?>
</section>