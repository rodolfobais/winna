<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $heading_title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
</head>
<body>
  <div style="padding: 10px;">
      <?php if ($logo) { ?>
      <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
      <?php } else { ?>
      <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
      <?php } ?>
    <br/>
    <div class="mpt-success">
    <?php echo $text_message; ?>
    </div>
  </div>
<style type="text/css">
<?php if($background_success_table) { ?>
.mpt-success .thead-inverse th {
  background: <?php echo $background_success_table; ?>;
}
<?php } ?>

<?php if($font_success_table) { ?>
.mpt-success .thead-inverse th {
  color: <?php echo $font_success_table; ?>;
}
<?php } ?>
</style>
<script type="text/javascript"><!--
$(document).ready(function() {
 setTimeout(function() { window.print(); }, 1000);
});
//--></script>
</body>
</html>