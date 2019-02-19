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
		<?php foreach ($products as $product): ?>
			<tr>
				<td><img src="<?php echo base_url("img/products/{$product->thumb}") ?>"></td>
				<td><?php echo $product->name ?></td>
				<td><?php echo $product->quantity ?></td>
				<td><form><input type="submit" name="remove" value="Remove" class="btn btn-secondary"></form></td>
			</tr>
		<?php endforeach ?>
	</table>
	<a href="<?php echo base_url('checkout') ?>" class="btn btn-primary">Checkout</a>
</div>
<?php $this->load->view('footer') ?>