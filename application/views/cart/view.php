<?php $this->load->view('header') ?>
<div class="row">
	<div class="col">
		<h1 class="my-5">My Cart</h1>
	</div>
</div>
<div class="row">
	<table class="cart table">
		<tr>
			<th></th>
			<th>Name</th>
			<th class="text-center">Quantity</th>
			<th class="text-right">Price</th>
			<th></th>
		</tr>
		<?php foreach ($items as $item): ?>
			<tr>
				<td><img src="<?php echo $item->image ?>"></td>
				<td><?php echo $item->name ?></td>
				<td class="text-center"><?php echo $item->quantity ?></td>
				<td class="text-right">$<?php echo number_format($item->price / 100, 2) ?></td>
				<td class="text-center">
					<form method="post" action="<?php echo base_url('cart/remove') ?>">
						<input type="hidden" name="sku_id" value="<?php echo $item->sku_id ?>">
						<input type="submit" name="remove" value="Remove" class="btn btn-secondary btn-sm">
					</form>
				</td>
			</tr>
		<?php endforeach ?>
		<?php if (!$items): ?>
			<tr>
				<td colspan="5" class="text-muted small p-5 text-center">You do not have any items in your cart. Click "Add to Cart" on an item to add an item to your cart.</td>
			</tr>
		<?php endif ?>
		<tr>	
			<td colspan="3" class="text-right"><b>Total</b></td>
			<td class="text-right">$<?php echo number_format($total / 100, 2) ?></td>
			<td></td>
		</tr>
	</table>
	<a href="<?php echo base_url('checkout/form') ?>" class="btn btn-primary btn-lg <?php echo $items ? '' : 'disabled' ?>">Checkout</a>
</div>
<?php $this->load->view('footer') ?>