<?php echo $header; ?>
<div class="container" id="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="mpt-success">
      <h1><?php echo $heading_title; ?></h1>
      <?php echo $text_message; ?>
      <div class="buttons clearfix">
        <div class="pull-right">
          <?php if($print_status) { ?>
          <a target="_blank" href="<?php echo $print_link; ?>" class="btn btn-primary button"><?php echo $button_print; ?></a>
          <?php } ?>
          <a href="<?php echo $continue; ?>" class="btn btn-primary button"><?php echo $button_continue; ?></a>
        </div>
      </div>
      </div>
      <?php if($products) { ?>
      <?php if($promote_title) { ?>
      <h3><?php echo $promote_title; ?></h3>
      <?php } ?>
      <div class="row main-products product-grid">
        <?php foreach ($products as $product) { ?>
        <div class="product-layout product-grid-item col-lg-3 col-md-3 col-sm-6 col-xs-12 xl-25 lg-25 md-50 sm-50 xs-100">
          <div class="product-thumb product-wrapper transition">
            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
            <div class="product-details">
            <div class="caption">
              <h4 class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
              <p class="description"><?php echo $product['description']; ?></p>
              <?php if ($product['rating']) { ?>
              <div class="rating">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                <?php if ($product['rating'] < $i) { ?>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                <?php } else { ?>
                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                <?php } ?>
                <?php } ?>
              </div>
              <?php } ?>
              <?php if ($product['price']) { ?>
              <p class="price">
                <?php if (!$product['special']) { ?>
                <?php echo $product['price']; ?>
                <?php } else { ?>
                <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                <?php } ?>
                <?php if ($product['tax']) { ?>
                <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                <?php } ?>
              </p>
              <?php } ?>
            </div>
            <div class="button-group">
              <button class="button" type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?php echo $button_cart; ?></span></button>
              <button class="button" type="button" data-toggle="tooltip" title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
              <button class="button" type="button" data-toggle="tooltip" title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
            </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
      
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
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
</div>
<?php echo $footer; ?>