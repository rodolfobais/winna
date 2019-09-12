
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-contabilium" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach($breadcrumbs as $breadcrumb){ ?>
        <li><a href="<?php echo $breadcrumb['href'] ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if($error_warning){ ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-cogs"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data" id="form-contabilium" class="form-horizontal">
        <ul class="nav nav-tabs">
          <? $class=true; ?>
          <?php foreach($allstores as $store): ?>
          <li class="<?php if($class): echo 'active'; endif; ?>">
            <a href="#tab-store<?php echo $store['store_id'] ?>" data-toggle="tab" aria-expanded="<?php if($class): echo 'true'; else: echo 'false'; endif; ?>">
              <i class="fa fa-info-circle" aria-hidden="true"></i>
              <?php echo $store['name']; ?>
            </a>
          </li>
          <? $class=false; ?>
          <?php endforeach; ?>
        </ul>
        <div class="tab-content">
          <? $class=true; ?>
          <?php foreach($allstores as $store): ?>
          <div id="tab-store<?php echo $store['store_id'] ?>" class="tab-pane <?php if($class): echo 'active'; endif; ?> col-sm-10 col-sm-offset-1">
            <div class="row"><?php echo $placeholder; ?></div>
              <div class="form-group">
                <label for="contabiliumUsuario"><?php echo $text_active; ?></label>
                <br/>
                <div class="btn-group" id="active" data-toggle="buttons">
                  <label class="btn btn-default btn-on btn-xs <?php if($module_contabilium_active[$store['store_id']][0] == 1){ ?>active<?php } ?>">
                  <input type="radio" value="1" name="module_contabilium_active[<?php echo $store['store_id'] ?>][]" <?php if($module_contabilium_active[$store['store_id']][0] == 1){ ?> checked="checked"<?php } ?>><?php echo $text_on ?></label>
                  <label class="btn btn-default btn-off btn-xs <?php if($module_contabilium_active[$store['store_id']][0] == 0){ ?>active<?php } ?>">
                  <input type="radio" value="0" name="module_contabilium_active[<?php echo $store['store_id'] ?>][]" <?php if($module_contabilium_active[$store['store_id']][0] == 0){ ?> checked="checked"<?php } ?>><?php echo $text_off ?></label>
                </div>
                <?php echo $text_active_description; ?>
              </div>
              <div class="form-group <?php if($module_contabilium_email[$store['store_id']]){ ?> has-success <?php } ?>">
                <label for="contabiliumUsuario"><?php echo $text_email ?></label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa fa-user"></span></span>
                  <input id="contabiliumUsuario" type="email" class="form-control" name="module_contabilium_email[<?php echo $store['store_id'] ?>]" placeholder="Email" value="<?php echo $module_contabilium_email[$store['store_id']]; ?>">
                  <?php if($error_email[$store['store_id']]){ ?>
                    <div class="text-danger sr-only"><?php echo $error_email[$store['store_id']]; ?></div>
                  <?php } ?>
                </div>
                <?php if($error_email[$store['store_id']]){ ?>
                  <div class="text-danger"><?php echo $error_email[$store['store_id']]; ?></div>
                <?php } ?>
              </div>
              <div class="form-group <?php if($module_contabilium_apikey[$store['store_id']]){ ?> has-success <?php } ?>">
                <label for="contabiliumApiKey"><?php echo $text_apikey; ?></label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa fa-key"></span></span>
                  <input id="contabiliumApiKey" type="text" class="form-control" name="module_contabilium_apikey[<?php echo $store['store_id'] ?>]" placeholder="9999999999999" value="<?php echo $module_contabilium_apikey[$store['store_id']]; ?>">
                  <?php if($error_apikey[$store['store_id']]){ ?>
                    <div class="text-danger sr-only"><?php echo $error_apikey[$store['store_id']]; ?></div>
                  <?php } ?>
                </div>
                <?php if($error_apikey[$store['store_id']]){ ?>
                  <div class="text-danger"><?php echo $error_apikey[$store['store_id']]; ?></div>
                <?php } ?>
              </div>
              <div class="form-group <?php if($module_contabilium_id[$store['store_id']]){ ?> has-success <?php } ?>">
                <label for="contabiliumId"><?php echo $text_id; ?></label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa fa-slack"></span></span>
                  <input id="contabiliumId" type="text" class="form-control" name="module_contabilium_id[<?php echo $store['store_id'] ?>]" placeholder="9999999999999" value="<?php echo $module_contabilium_id[$store['store_id']]; ?>">
                  <?php if($error_id[$store['store_id']]){ ?>
                    <div class="text-danger sr-only"><?php echo $error_id[$store['store_id']]; ?></div>
                  <?php } ?>
                </div>
                <?php if($error_id[$store['store_id']]){ ?>
                  <div class="text-danger"><?php echo $error_id[$store['store_id']]; ?></div>
                <?php } ?>
              </div>
              <div class="row"><label for="contabiliumSinc"><?php echo $text_sinc; ?></label></div>
              <div class="form-group">
                <div class="btn-group" id="prices" data-toggle="buttons">
                  <label class="btn btn-default btn-on btn-xs <?php if($module_contabilium_prices[$store['store_id']][0] == 1){ ?>active<?php } ?>">
                  
                  <input type="radio" value="1" name="module_contabilium_prices[<?php echo $store['store_id'] ?>][]" <?php if($module_contabilium_prices[$store['store_id']][0] == 1){ ?> checked="checked"<?php } ?>><?php echo $text_on ?></label>
                  <label class="btn btn-default btn-off btn-xs <?php if($module_contabilium_prices[$store['store_id']][0] == 0){ ?>active<?php } ?>">
                  <input type="radio" value="0" name="module_contabilium_prices[<?php echo $store['store_id'] ?>][]" <?php if($module_contabilium_prices[$store['store_id']][0] == 0){ ?> checked="checked"<?php } ?>><?php echo $text_off ?></label>
                </div>
                <?php echo $text_prices ?>
              </div>
              <div class="form-group">
                <div class="btn-group" id="stock" data-toggle="buttons">
                  <label class="btn btn-default btn-on btn-xs <?php if($module_contabilium_stock[$store['store_id']][0] == 1){ ?>active<?php } ?>">
                  <input type="radio" value="1" name="module_contabilium_stock[<?php echo $store['store_id'] ?>][]" <?php if($module_contabilium_stock[$store['store_id']][0] == 1){ ?> checked="checked"<?php } ?>><?php echo $text_on ?></label>
                  <label class="btn btn-default btn-off btn-xs <?php if($module_contabilium_stock[$store['store_id']][0] == 0){ ?>active<?php } ?>">
                  <input type="radio" value="0" name="module_contabilium_stock[<?php echo $store['store_id'] ?>][]" <?php if($module_contabilium_stock[$store['store_id']][0] == 0){ ?> checked="checked"<?php } ?>><?php echo $text_off ?></label>
                </div>
                <?php echo $text_stock ?>
              </div>
              <div class="form-group <?php if($module_contabilium_accepted){ ?> has-success <?php } ?> <?php if($error_accepted[$store['store_id']]){ ?> has-error <?php } ?>">
                <label for="accepted"><?php echo $text_order_accepted; ?></label>
                <select class="form-control" id="accepted" name="module_contabilium_accepted[<?php echo $store['store_id'] ?>][]" multiple>
                  <option value=""></option>
                  <?php foreach($orderstatus as $status){ ?>
                  <option value="<?php echo $status["order_status_id"]; ?>" <?php if(in_array($status["order_status_id"], $module_contabilium_accepted[$store['store_id']])){ ?> selected="selected" <?php } ?>><?php echo $status["name"]; ?></option>
                  <?php } ?>
                </select>
                <?php if($error_accepted[$store['store_id']]){ ?>
                  <div class="text-danger"><?php echo $error_accepted[$store['store_id']] ?></div>
                <?php } ?>
              </div> 
              <div class="form-group <?php if($module_contabilium_canceled){ ?> has-success <?php } ?> <?php if($error_canceled[$store['store_id']]){ ?> has-error <?php } ?>">
                <label for="canceled"><?php echo $text_order_canceled ?></label>
                <select class="form-control" id="canceled" name="module_contabilium_canceled[<?php echo $store['store_id'] ?>][]" multiple>
                  <option value=""></option>
                  <?php foreach($orderstatus as $status){ ?>
                  <option value="<?php echo $status["order_status_id"] ?>" <?php if(in_array($status["order_status_id"], $module_contabilium_canceled[$store['store_id']])){ ?> selected="selected" <?php } ?>><?php echo $status["name"] ?></option>
                  <?php } ?>
                </select>
                <?php if($error_canceled[$store['store_id']]){ ?>
                  <div class="text-danger"><?php echo $error_canceled[$store['store_id']] ?></div>
                <?php } ?>
              </div> 
              <hr />
              <div class="alert alert-info">
                <strong><?php echo $text_callback ?>:</strong></br>
                <?php echo $store['url'].$contabilium_callback.$module_contabilium_token[$store['store_id']].'&s='.$store['store_id']; ?>
                <hr/>
                <strong><?php echo $text_status ?>:</strong>  
                <br/>
                <span class="label <?php echo $contabilium_online[$store['store_id']] ?> m-1"><?php echo $online_text[$store['store_id']] ?></span>
                <hr/>
                <?php if($module_contabilium_skuoption){ ?>
                <strong><?php echo $text_modulo_ok ?>:</strong>  
                <br/>
                <span class="label label-success m-1">OK</span>
                <hr/>
                <?php } ?>
                <?php if($module_contabilium_skucombination){ ?>
                <strong><?php echo $text_modulo_combination_ok ?>:</strong>  
                <br/>
                <span class="label label-success m-1">OK</span>
                <hr/>
                <?php } ?>
                <strong><?php echo $text_log ?>:</strong>  
                <br/>
                <a href="<?php echo $contabilium_log ?>" class="btn btn-default m-1"><?php echo $text_log_btn ?></a>
                <hr/>
                <div class="text-right">
                  <div id="contabilium_alert" class="alert pull-left alert-default"></div>
                  <button class="btn btn-success ladda-button update <?php if($contabilium_nosync[$store['store_id']]){ ?>disabled<?php } ?>" data-color="green" data-size="s" data-style="expand-right" data-link="<?php echo $contabilium_update[$store['store_id']] ?>" <?php if($contabilium_nosync[$store['store_id']]){ ?>disabled<?php } ?>><span class="ladda-label"><?php echo $text_update ?></span></button>
                </div>
              </div>
              <?php if(!$module_contabilium_skuoption){ ?>
              <div class="alert alert-warning">
                <?php echo $text_modulo ?> <a href="https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=32704&filter_search=Different%20SKU%20for%20each%20Option" target="_blank">Product Option SKU</a>
              </div>
              <?php } ?>
              <input type="hidden" name="module_contabilium_token[<?php echo $store['store_id'] ?>]" value="<?php echo $module_contabilium_token[$store['store_id']] ?>" />
              <input type="hidden" name="module_contabilium_status[<?php echo $store['store_id'] ?>]" value="<?php echo $module_contabilium_status[$store['store_id']] ?>" />
              <input type="hidden" name="module_contabilium_error[<?php echo $store['store_id'] ?>]" value="<?php echo $module_contabilium_error[$store['store_id']] ?>" />
              <input type="hidden" name="module_contabilium_skuoption[<?php echo $store['store_id'] ?>]" value="<?php echo $module_contabilium_skuoption ?>" />   
            </div>
          <? $class=false; ?>
          <?php endforeach; ?>
        </div>
        </form>
      </div>
      <div class="panel-footer text-right">
        
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>