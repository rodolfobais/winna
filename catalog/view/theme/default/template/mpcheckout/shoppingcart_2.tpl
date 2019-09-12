<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> <?php echo $panel_shopping_cart; ?> 
      <?php if ($weight) { ?>
      &nbsp;(<?php echo $weight; ?>)
      <?php } ?>
    </h4>
  </div>
  <div class="panel-body">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="cart-item">
      <?php foreach ($products as $product) { ?>
        <div class="inner-cart">
          <div class="row">
            <?php if($show_product_image) { ?>
              <?php if ($product['thumb']) { ?>
                <div class="col-sm-4">
                  <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
                </div>  
              <?php } ?>
            <?php } ?>
            <div class="col-sm-8">
              <a href="<?php echo $product['href']; ?>" class="name"><?php echo $product['name']; ?></a>
              <?php if (!$product['stock']) { ?>
              <span class="text-danger">***</span>
              <?php } ?>
              <?php if ($product['option']) { ?>
              <?php foreach ($product['option'] as $option) { ?>
              <br />
              <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
              <?php } ?>
              <?php } ?>
              <?php if ($product['reward']) { ?>
              <br />
              <small><?php echo $product['reward']; ?></small>
              <?php } ?>
              <?php if ($product['recurring']) { ?>
              <br />
              <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
              <?php } ?>
              <span class="price"><?php echo $product['price']; ?></span>
              <?php if($qty_update) { ?>
              <div class="input-group btn-block increment-decrement" style="max-width: 100px;">
                <span class="input-group-btn">
                  <button class="btn btn-primary button" data-action="minus" data-key="<?php echo $product['cart_id']; ?>"><i class="fa fa-minus"></i></button>
                </span>
                <input type="text" name="quantity[<?php echo $product['cart_id']; ?>]" data-key="<?php echo $product['cart_id']; ?>" value="<?php echo $product['quantity']; ?>" size="1" class="form-control cart-input-qty" />
                <span class="input-group-btn">
                  <button class="btn btn-primary button" data-action="plus" data-key="<?php echo $product['cart_id']; ?>"><i class="fa fa-plus"></i></button>
                </span>
              </div>
              <?php } else { ?>
                <?php echo $product['quantity']; ?>
               <?php } ?>
              <button type="button" class="btn-danger button" onclick="MPSHOPPINGCART.removerefresh('<?php echo $product['cart_id']; ?>');"><i class="fa fa-times-circle"></i></button>
            </div> 
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="row">
      <div class="col-sm-12 xl-50 sm-100 xs-100">
        <?php if ($modules) { ?>
        <div class="panel-group" id="accordion">
          <?php foreach ($modules as $module) { ?>
          <?php echo $module; ?>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <div class="col-sm-12 sm-100 xl-50 xs-100">
        <table class="table">
          <?php foreach ($totals as $total) { ?>
          <tr>
            <td class="text-right c-total"><strong><?php echo $total['title']; ?>:</strong></td>
            <td class="text-right c-total"><?php echo $total['text']; ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <div class="shoppingcart-loader"></div>
  </div>
</div>
