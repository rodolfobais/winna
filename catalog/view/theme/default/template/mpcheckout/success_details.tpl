<div class="table-responsive">
	<table class="table table-bordered table-hover list">
		<thead class="thead-inverse">
			<tr>
				<th class="text-left" colspan="2"><?php echo $text_order_detail; ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-left"><b><?php echo $text_order_id; ?></b> #<?php echo $order_id; ?><br />
					<b><?php echo $text_date_added; ?></b> <?php echo $date_added; ?>
				</td>
				<td class="text-left"><b><?php echo $text_payment_method; ?></b> <?php echo $payment_method; ?><br />
					<?php if ($shipping_method) { ?>
					<b><?php echo $text_shipping_method; ?></b> <?php echo $shipping_method; ?>
					<?php } ?></td>
			</tr>
		</tbody>
	</table>
	<table class="table table-bordered table-hover list">
		<thead class="thead-inverse">
			<tr>
				<th class="text-left"><?php echo $text_payment_address; ?></th>
				<?php if ($shipping_address) { ?>
				<th class="text-left"><?php echo $text_shipping_address; ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-left"><?php echo $payment_address; ?></td>
				<?php if ($shipping_address) { ?>
				<td class="text-left"><?php echo $shipping_address; ?></td>
				<?php } ?>
			</tr>
		</tbody>
	</table>
	<table class="table table-bordered table-hover list">
		<thead class="thead-inverse">
			<tr>
				<th class="text-center"><?php echo $text_image; ?></th>
				<th class="text-left"><?php echo $text_product; ?></th>
				<th class="text-left"><?php echo $text_model; ?></th>
				<th class="text-right"><?php echo $text_quantity; ?></th>
				<th class="text-right"><?php echo $text_price; ?></th>
				<th class="text-right"><?php echo $text_total; ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($products as $product) { ?>
			<tr>
				<td class="text-center"><img class="img-thumbnail" src="<?php echo $product['image']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></td>
				<td class="text-left"><?php echo $product['name']; ?>
					<?php foreach ($product['option'] as $option) { ?>
					<br />
					&nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
					<?php } ?></td>
				<td class="text-left"><?php echo $product['model']; ?></td>
				<td class="text-right"><?php echo $product['quantity']; ?></td>
				<td class="text-right"><?php echo $product['price']; ?></td>
				<td class="text-right"><?php echo $product['total']; ?></td>
			</tr>
			<?php } ?>
			<?php foreach ($vouchers as $voucher) { ?>
			<tr>
				<td class="text-left"><?php echo $voucher['description']; ?></td>
				<td class="text-left"></td>
				<td class="text-right">1</td>
				<td class="text-right"><?php echo $voucher['amount']; ?></td>
				<td class="text-right"><?php echo $voucher['amount']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<?php foreach ($totals as $total) { ?>
			<tr>
				<td class="text-right" colspan="5"><b><?php echo $total['title']; ?>:</b></td>
				<td class="text-right"><?php echo $total['text']; ?></td>
			</tr>
			<?php } ?>
		</tfoot>
	</table>
</div>
<style type="text/css">
	.mpt-success{
		font-size: 14px;
	}
	.mpt-success .thead-inverse th{
		background: #909090;
		color: #fff;
	}
</style>