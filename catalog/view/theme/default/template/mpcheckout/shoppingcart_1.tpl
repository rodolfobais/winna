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
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
          	<?php if($show_product_image) { ?>
            <td class="text-center"><?php echo $column_image; ?></td>
            <?php } ?>
            <td class="text-left"><?php echo $column_name; ?></td>
            <td class="text-left"><?php echo $column_model; ?></td>
            <td class="text-left"><?php echo $column_quantity; ?></td>
            <td class="text-right"><?php echo $column_price; ?></td>
            <td class="text-right"><?php echo $column_total; ?></td>
            <td class="text-right"><?php echo $column_remove; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product) { ?>
          <tr>
          	<?php if($show_product_image) { ?>
            <td class="text-center"><?php if ($product['thumb']) { ?>
              <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
              <?php } ?></td>
          	<?php } ?>
            <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
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
              <?php } ?></td>
            <td class="text-left"><?php echo $product['model']; ?></td>
            <td class="text-center">
            	<?php if($qty_update) { ?>
              	<div class="input-group btn-block increment-decrement" style="max-width: 200px;">
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
            </td>
            <td class="text-right"><?php echo $product['price']; ?></td>
            <td class="text-right"><?php echo $product['total']; ?></td>
            <td class="text-right"><button type="button" class="btn btn-danger button" onclick="MPSHOPPINGCART.removerefresh('<?php echo $product['cart_id']; ?>');"><i class="fa fa-times-circle"></i></button></td>
          </tr>
          <?php } ?>
          <?php foreach ($vouchers as $voucher) { ?>
          <tr>
            <td></td>
            <td class="text-left"><?php echo $voucher['description']; ?></td>
            <td class="text-left"></td>
            <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                <input type="text" name="" value="1" size="1" disabled="disabled" class="form-control" />
                <span class="input-group-btn">
                </span></div></td>
            <td class="text-right"><?php echo $voucher['amount']; ?></td>
            <td class="text-right"><?php echo $voucher['amount']; ?></td>
            <td class="text-right"><button type="button" class="btn btn-danger button" onclick="MPSHOPPINGCART.removerefresh('<?php echo $voucher['key']; ?>');"><i class="fa fa-times-circle"></i></button></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-sm-6 xl-50 sm-100 xs-100">
        <?php if ($modules) { ?>
        <div class="panel-group" id="accordion">
          <?php foreach ($modules as $module) { ?>
          <?php echo $module; ?>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <div class="col-md-6 col-sm-6 sm-100 xl-50 xs-100">
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
