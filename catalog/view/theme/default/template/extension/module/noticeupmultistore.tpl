<!--Noticeup Multistore-->
<?php if(isset($stores)){ ?>
<table class="table">
<thead><tr><th colspan="4"><?php echo $text_header; ?></th></tr></thead>
<tbody>
<?php foreach($stores as $store){?>
  <tr>
    <td><a href="<?php echo $store['url'];?>"><?php echo $store['name'];?></a></td>
    <td><?php echo $store['address'];?></td>
    <td><?php echo $store['stock_status'];?></td>
    <td>
    <?php if (!$store['special']) { ?>
      <span><?php echo $store['price'];?></span>
    <?php } else { ?>
    <span style="text-decoration: line-through;"><?php echo $store['price']; ?></span><span><?php echo $store['special']; ?></span>
    <?php } ?>
    </td>
  </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<!--/Noticeup Multistore-->
