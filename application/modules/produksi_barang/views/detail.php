<input id="index" type="hidden" name="index">
<div class="form-group form-inline">
	<?php echo form_label('Barang','kode_barang',array('class'=>'control-label'))?>
	<?php echo form_dropdown('kode_barang',$this->general_model->dropdown('barang','Barang'),'','id="kode_barang" class="form-control input-sm"')?>
	<small><?php echo form_error('kode_barang')?></small>
</div>			
<div class="form-group form-inline">
  <?php echo form_label('Jumlah','jumlah',array('class'=>'control-label'))?>
  <?php echo form_input(array('id'=>'jumlah','name'=>'jumlah','class'=>'form-control input-sm input-uang','maxlength'=>'20','size'=>'10','autocomplete'=>'off'))?>
  <small><?php echo form_error('jumlah')?></small>
</div>
<div class="form-group form-inline">
  <?php echo form_label('Keterangan','keterangan',array('class'=>'control-label'))?>
  <?php echo form_input(array('id'=>'keterangan','name'=>'keterangan','class'=>'form-control input-sm','maxlength'=>'100','size'=>'50','autocomplete'=>'off'))?>
  <small><?php echo form_error('keterangan')?></small>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#kode_barang').select2({
        placeholder: "- Barang -",
        dropdownAutoWidth:'true',
        width: 'auto',    
        ajax: {
        url: '<?php echo base_url() ?>index.php/api/barang',
        dataType: 'json',
        processResults: function (data) {          
              return {
                  results: $.map(data, function (item) {
                      return {
                          text: item.name,
                          id: item.code
                      }
                  })
              };
          }
      }
    });
    $('#kode_barang').change(function(){
      var value = $(this).val();
      if (value != '') {
        $.ajax({
          url:'<?php echo base_url() ?>index.php/api/barang/get_harga/' + value,
          success:function(str){
            $('#harga').val(str);
          }
        });
      }
    });

  });
</script>