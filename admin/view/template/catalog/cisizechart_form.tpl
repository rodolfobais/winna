<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" class="cisizechart">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-cisizechart" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-cisizechart" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-lang" data-toggle="tab"><i class="fa fa-language"></i> <?php echo $tab_lang; ?></a></li>
            <li><a href="#tab-general" data-toggle="tab"><i class="fa fa-cog"></i> <?php echo $tab_general; ?></a></li>
            <li><a href="#tab-link" data-toggle="tab"><i class="fa fa-link"></i> <?php echo $tab_link; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-lang">
              <ul class="nav nav-tabs" id="language">
                <?php foreach ($languages as $language) { ?>
                <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab">
                <?php if(VERSION >= '2.2.0.0') { ?>
                <img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /> 
                <?php } else{ ?>
                <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" />
                <?php } ?>
                <?php echo $language['name']; ?></a></li>
                <?php } ?>
              </ul>
              <div class="tab-content">
                <?php foreach ($languages as $language) { ?>
                <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-title<?php echo $language['language_id']; ?>"><?php echo $entry_title; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="cisizechart_description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($cisizechart_description[$language['language_id']]) ? $cisizechart_description[$language['language_id']]['title'] : ''; ?>" placeholder="<?php echo $entry_title; ?>" id="input-title<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_title[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_title[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-description<?php echo $language['language_id']; ?>"><?php echo $entry_description; ?></label>
                    <div class="col-sm-10">
                      <textarea name="cisizechart_description[<?php echo $language['language_id']; ?>][description]" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control summernote" data-toggle="summernote"><?php echo isset($cisizechart_description[$language['language_id']]) ? $cisizechart_description[$language['language_id']]['description'] : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-button<?php echo $language['language_id']; ?>"><?php echo $entry_button; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="cisizechart_description[<?php echo $language['language_id']; ?>][button]" value="<?php echo isset($cisizechart_description[$language['language_id']]) ? $cisizechart_description[$language['language_id']]['button'] : ''; ?>" placeholder="<?php echo $entry_button; ?>" id="input-button<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_button[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_button[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-tab-text<?php echo $language['language_id']; ?>"><?php echo $entry_tab_text; ?></label>
                    <div class="col-sm-10">
                      <input type="text" name="cisizechart_description[<?php echo $language['language_id']; ?>][tab_text]" value="<?php echo isset($cisizechart_description[$language['language_id']]['tab_text']) ? $cisizechart_description[$language['language_id']]['tab_text'] : ''; ?>" placeholder="<?php echo $entry_tab_text; ?>" id="input-tab-text<?php echo $language['language_id']; ?>" class="form-control" />
                      <?php if (isset($error_tab_text[$language['language_id']])) { ?>
                      <div class="text-danger"><?php echo $error_tab_text[$language['language_id']]; ?></div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="tab-pane" id="tab-general">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_display_layout; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <label class="display_layout btn btn-default <?php echo $display_layout == 'popup' ? 'active' : ''; ?>" rel="popup">
                      <input name="display_layout" <?php echo $display_layout == 'popup' ? 'checked="checked"' : ''; ?> autocomplete="off" value="popup" type="radio"> <?php echo $text_popup; ?>
                    </label>
                    <label class="display_layout btn btn-default <?php echo $display_layout == 'tab' ? 'active' : ''; ?>" rel="tab">
                      <input name="display_layout" <?php echo $display_layout == 'tab' ? 'checked="checked"' : ''; ?> autocomplete="off" value="tab" type="radio"><?php echo $text_tab; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group popup_group <?php echo $display_layout != 'popup' ? 'hide' : ''; ?> ">
                <label class="col-sm-2 control-label"><?php echo $entry_popup_type; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <label class="popup_type btn btn-default <?php echo $popup_type == 'icon' ? 'active' : ''; ?>" rel="icon">
                      <input name="popup_type" <?php echo $popup_type == 'icon' ? 'checked="checked"' : ''; ?> autocomplete="off" value="icon" type="radio"> <?php echo $text_icon; ?>
                    </label>
                    <label class="popup_type btn btn-default <?php echo $popup_type == 'button' ? 'active' : ''; ?>" rel="button">
                      <input name="popup_type" <?php echo $popup_type == 'button' ? 'checked="checked"' : ''; ?> autocomplete="off" value="button" type="radio"><?php echo $text_button; ?>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group icon_group <?php echo $display_layout == 'popup' && $popup_type == 'icon' ? '' : 'hide'; ?>">
                <label class="col-sm-2 control-label"><?php echo $entry_icon; ?></label>
                <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                  <input type="hidden" name="icon" value="<?php echo $icon; ?>" id="input-image" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    <?php if ($status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-link">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $help_product; ?>"><?php echo $entry_product; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="product_name" value="" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
                  <div id="product" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($sizechart_products as $product) { ?>
                    <div id="product<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
                      <input type="hidden" name="cisizechart_product[]" value="<?php echo $product['product_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<style type="text/css">
.cisizechart .nav > li > a{ padding: 15px 35px; text-transform: uppercase; }
.cisizechart .nav > li > a i{ font-size: 18px; padding-right: 5px; }
.btn-group .active{ background : #1872A2; color: #fff; border-color: #1872A2; }
.btn-group .btn:hover{ background : #1872A2; color: #fff; border-color: #1872A2; }
</style>
<?php if(VERSION <= '2.2.0.0') { ?>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
$('#input-description<?php echo $language['language_id']; ?>').summernote({ height: 300 });
<?php } ?>
//--></script>
<?php } else if (VERSION <= '2.3.0.2') { ?>
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
<?php } else { ?>
<link href="view/javascript/codemirror/lib/codemirror.css" rel="stylesheet" />
<link href="view/javascript/codemirror/theme/monokai.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/codemirror/lib/codemirror.js"></script> 
<script type="text/javascript" src="view/javascript/codemirror/lib/xml.js"></script> 
<script type="text/javascript" src="view/javascript/codemirror/lib/formatting.js"></script> 
<script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
<link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/summernote/summernote-image-attributes.js"></script> 
<script type="text/javascript" src="view/javascript/summernote/opencart.js"></script> 
<?php } ?>
<script type="text/javascript"><!--
$('#language a:first').tab('show');

$('.display_layout').click(function() {
  var rel = $(this).attr('rel');
  if(rel == 'popup') {
    $('.popup_group').removeClass('hide');    

    $('.popup_type.active').trigger('click');
  } else {
    $('.popup_group').addClass('hide');
    $('.icon_group').addClass('hide');
  }
});

$('.popup_type').click(function() {
  var rel = $(this).attr('rel');
  if(rel == 'icon') {
    $('.icon_group').removeClass('hide');
  } else {
    $('.icon_group').addClass('hide');
  }
});
//--></script>
<script type="text/javascript"><!--
$('input[name=\'product_name\']').autocomplete({
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/product/autocomplete&<?php echo $module_token; ?>=<?php echo $ci_token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['product_id']
          }
        }));
      }
    });
  },
  select: function(item) {
    $('input[name=\'product_name\']').val('');
    
    $('#product' + item['value']).remove();
    
    $('#product').append('<div id="product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="cisizechart_product[]" value="' + item['value'] + '" /></div>');  
  }
});
  
$('#product').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});
//--></script>
</div>
<?php echo $footer; ?>