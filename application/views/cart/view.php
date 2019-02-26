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
			<th>Quantity</th>
			<th></th>
		</tr>
		<?php foreach ($items as $item): ?>
			<tr>
				<td><img src="<?php echo $item->image ?>"></td>
				<td><?php echo $item->name ?></td>
				<td><?php echo $item->quantity ?></td>
				<td><form><input type="submit" name="remove" value="Remove" class="btn btn-secondary"></form></td>
			</tr>
		<?php endforeach ?>
	</table>
	<a href="<?php echo base_url('checkout/payment') ?>" class="btn btn-primary">Checkout</a>
</div>
<?php $this->load->view('footer') ?>