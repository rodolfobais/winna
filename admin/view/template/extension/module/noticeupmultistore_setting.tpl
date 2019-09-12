<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-html" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-html" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_store; ?>"><?php echo $entry_store; ?></span></label>
          <div class="col-sm-10">
            <div class="well well-sm" style="height: 150px; overflow: auto;">
              <div class="checkbox">
                <label>
                  <?php if (in_array(0, $noticeupmultistore_store)) { ?>
                  <input type="checkbox" name="noticeupmultistore[stores][]" value="0" checked="checked" />
                  <?php echo $text_default; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="noticeupmultistore[stores][]" value="0" />
                  <?php echo $text_default; ?>
                  <?php } ?>
                </label>
              </div>
              <?php foreach ($stores as $store) { ?>
              <div class="checkbox">
                <label>
                  <?php if (in_array($store['store_id'], $noticeupmultistore_store)) { ?>
                  <input type="checkbox" name="noticeupmultistore[stores][]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                  <?php echo $store['name']; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="noticeupmultistore[stores][]" value="<?php echo $store['store_id']; ?>" />
                  <?php echo $store['name']; ?>
                  <?php } ?>
                </label>
              </div>
              <?php } ?>
            </div>
            <?php echo $help_about_theme; ?> <kbd><?php echo htmlspecialchars('<?php echo $noticeupmultistore; ?>');?></kbd>
          </div>
        </div>

        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script>
</div>
<?php echo $footer; ?>
