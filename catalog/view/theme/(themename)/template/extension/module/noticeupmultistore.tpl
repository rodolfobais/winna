<!--Noticeup Multistore-->
<?php if(isset($stores)){ ?>
<div class="product-points" style="background-color: #f4f4f4;padding:10px"><div class="h3"><?php echo $text_header; ?></div>
<?php foreach($stores as $store){?>
  <div class="h5"><a href="<?php echo $store['url'].substr( $_SERVER[REQUEST_URI], 1);?>"><?php echo $store['name'];?></a> - <?php echo $store['stock_status'];?> -  <?php echo $store['price'];?></div>
<?php } ?>
</div>
<?php } ?>
<!--/Noticeup Multistore-->
