<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-autodetect" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-autodetect" class="form-horizontal">

          <div class="forom-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="autodetect_status" id="input-status" class="form-control">
                <?php if ($autodetect_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
	        <label class="col-sm-2 control-label " for="input-language"><?php echo $text_default; ?></label>
          <div class="col-sm-10">
	          <table class="table table-striped">
              <thead>
                <tr>
                  <td class="text-left"><?php echo $entry_language; ?></td>
                  <td class="text-left"><?php echo $entry_currency; ?></td>
                </tr>
              </thead>
              <tbody>
                 <tr>
                  <td class="text-left">
                     	<select name="autodetect_language_id" id="input-language" class="form-control">
                        <?php foreach ($languages as $language) { ?>
                        <option value="<?php echo $language['language_id']; ?>" <?php if($language['language_id']==$autodetect_language_id){ echo "selected"; } ?> ><?php echo $language['name']; ?></option>
                        <?php } ?>
                      </select>
                  </td>
                  <td class="text-left">
                    	<select name="autodetect_currency_id" id="input-currency" class="form-control">
                        <?php foreach ($currencies as $currency) { ?>
                        <option value="<?php echo $currency['currency_id']; ?>" <?php if($currency['currency_id']==$autodetect_currency_id){ echo "selected"; } ?>><?php echo $currency['title']; ?></option>
                        <?php } ?>
                      </select>
               	</td>
                </tr>
              </tbody>
          </table>
        </div>
          </div>
          <table id="ttr" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <td class="text-left"><?php echo $entry_country; ?></td>
                <td class="text-left"><?php echo $entry_language; ?></td>
                <td class="text-right"><?php echo $entry_currency; ?></td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <?php $auto_detect_row = 0; ?>
              <?php if(isset($autodetect_values)){ 
                  foreach ($autodetect_values as $autodetect_value) {  ?>
              <tr id="ttr-row<?php echo $auto_detect_row; ?>">
                
                  <td class="text-left">

                    <select name="autodetect_value[<?php echo $auto_detect_row ?>][country_id]" class="form-control">
                      <?php foreach ($countries as $country) { 
                      if($country['country_id'] == $autodetect_value['country_id']){  ?>
                        <option value="<?php echo $country['country_id']; ?>" selected > <?php echo $country['name']; ?> </option>
                      <?php }else{ ?>
                        <option value="<?php echo $country['country_id']; ?>"> <?php echo $country['name']; ?> </option>
                      <?php   } ?>
                      <?php } ?>
                    </select>
                  </td>

                  <td class="text-left">
                    <select name="autodetect_value[<?php echo $auto_detect_row ?>][language_id]" class="form-control">
                      <?php foreach ($languages as $language) { 
                      if($language['language_id']==$autodetect_value['language_id']){  ?>
                      <option value="<?php echo $language['language_id']; ?>" selected > <?php echo $language['name']; ?> </option>
                      <?php }else{ ?>
                      <option value="<?php echo $language['language_id']; ?>"> <?php echo $language['name']; ?> </option>
                      <?php   } ?>
                      <?php } ?>
                    </select>
                  </td>

                   <td class="text-left">
                    <select name="autodetect_value[<?php echo $auto_detect_row ?>][currency_id]" class="form-control">
                      <?php foreach ($currencies as $currency) { 
                      if($currency['currency_id']==$autodetect_value['currency_id']){  ?>
                       <option value="<?php echo $currency['currency_id']; ?>" selected > <?php echo $currency['title']; ?> </option>
                      <?php }else{ ?>
                        <option value="<?php echo $currency['currency_id']; ?>"> <?php echo $currency['title']; ?> </option>
                      <?php   } ?>
                      <?php } ?>
                    </select>
                  </td>
                  
                  <td class="text-left"><button type="button" onclick="$('#ttr-row<?php echo $auto_detect_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $text_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
        
              </tr>
              <?php $auto_detect_row++; ?>
               <?php } ?>
                <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3"></td>
                <td class="text-left"><button type="button" onclick="addTest();" data-toggle="tooltip" title="<?php echo $text_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
var auto_detect_row = <?php echo $auto_detect_row; ?>;

function addTest() {
  html ='';
  html+= '<tr id="ttr-row' + auto_detect_row + '">'; 

  html += '<td class="text-left"><select name="autodetect_value['+ auto_detect_row +'][country_id]" class="form-control">';
  html += '<option value="" > <?php echo $text_select; ?> </option>';
      <?php foreach ($countries as $country) { ?>
  html += "<option value='<?php echo $country['country_id']; ?>' > <?php echo $country['name']; ?> </option>";
      <?php } ?>
  html += '</seclect>';
  html += '</td>';

  html += '<td class="text-left"><select name="autodetect_value['+ auto_detect_row +'][language_id]" class="form-control">';
  html += '<option value="" > <?php echo $text_select; ?> </option>';
      <?php foreach ($languages as $language) { ?>
  html += '<option value="<?php echo $language['language_id']; ?>" > <?php echo $language['name']; ?> </option>';
      <?php } ?>
  html += '</seclect></td>';

  html += ' <td class="text-left"><select name="autodetect_value['+ auto_detect_row +'][currency_id]" class="form-control">';
    html += '<option value="" > <?php echo $text_select; ?> </option>';
      <?php foreach ($currencies as $currency) { ?>
  html += '<option value="<?php echo $currency['currency_id']; ?>" > <?php echo $currency['title']; ?> </option>';
      <?php } ?>
  html += '</seclect></td>';

  html += '  <td class="text-left"><button type="button" onclick="$(\'#ttr-row' + auto_detect_row + '\').remove();" data-toggle="tooltip" title="<?php echo $text_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>'; 
  html +='</tr>';
  $('#ttr tbody').append(html);
  
  auto_detect_row++;
}
</script>
<?php echo $footer; ?>