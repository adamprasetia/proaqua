<section class="content-header">
	<h1>
		Beranda
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-aqua">
		    <div class="inner">
		      <h3><?php echo number_format($this->general_model->get_from_field_total('barang')) ?></h3>
		      <p>Barang</p>
		    </div>
		    <div class="icon">
		      <i class="ion-cube"></i>
		    </div>
		    <?php echo anchor('#','More info <i class="fa fa-arrow-circle-right"></i>',array('class'=>'small-box-footer')) ?>
		  </div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-green">
		    <div class="inner">
		      <h3><?php echo number_format($this->general_model->get_from_field_total('user')) ?></h3>
		      <p>Pengguna</p>
		    </div>
		    <div class="icon">
		      <i class="ion ion-person"></i>
		    </div>
		    <?php echo anchor('#','More info <i class="fa fa-arrow-circle-right"></i>',array('class'=>'small-box-footer')) ?>
		  </div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-yellow">
		    <div class="inner">
		      <h3><?php echo number_format($this->general_model->get_from_field_total('toko')) ?></h3>
		      <p>Toko</p>
		    </div>
		    <div class="icon">
		      <i class="ion ion-home"></i>
		    </div>
		    <?php echo anchor('#','More info <i class="fa fa-arrow-circle-right"></i>',array('class'=>'small-box-footer')) ?>
		  </div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-red">
		    <div class="inner">
		      <h3><?php echo number_format($this->general_model->get_from_field_total('barang_jenis')) ?></h3>
		      <p>Jenis Barang</p>
		    </div>
		    <div class="icon">
		      <i class="ion ion-gear-a"></i>
		    </div>
		    <?php echo anchor('#','More info <i class="fa fa-arrow-circle-right"></i>',array('class'=>'small-box-footer')) ?>
		  </div>
		</div><!-- ./col -->
	</div><!-- /.row -->
	<!-- LINE CHART -->
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Permintaan Barang Chart</h3>
		</div>
		<div class="box-body chart-responsive">
			<div class="chart" id="line-chart" style="height: 300px;"></div>
		</div>
	</div>
</section>
<!-- page script -->
<script>
	$('document').ready(function(){
		$.ajax({
			url:'<?php echo base_url("index.php/api/chart/permintaan_barang") ?>',
			type:'post',
			dataType:'json',
			success:function(str){
			    // LINE CHART
			    var line = new Morris.Line({
			      element: 'line-chart',
			      resize: true,
			      data: str,
			      xkey: 'y',
			      ykeys: ['item1'],
			      labels: ['Total'],
			      lineColors: ['#3c8dbc'],
			      hideHover: 'auto'
			    });
				console.log('success');
			}
		});
	});
</script>

