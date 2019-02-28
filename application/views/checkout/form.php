<?php $this->load->view('header') ?>

<div class="row">
	<div class="col">
		<h1 class="my-5">Shipping Information</h1>
	</div>
</div>
<div class="row">
	<div class="col-6">
		<form action="<?php echo base_url('checkout/form') ?>" method="post" id="payment-form" class="form">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control">
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" name="line1" class="form-control">
			</div>
			<div class="form-group">
				<div class="form-row">
					<div class="col-6">
						<label>City</label>
						<input type="text" name="city" class="form-control">
					</div>
					<div class="col-3">
						<label>State</label>
						<input type="text" name="state" class="form-control">
					</div>
					<div class="col-3">
						<label>ZIP</label>
						<input type="text" name="postal_code" class="form-control">
					</div>
				</div>
			</div>
			<button class="btn btn-primary">Continue</button>
		</form>
	</div>
	<div class="col-6">
		<table class="cart table">
			<?php foreach ($cart as $item): ?>
				<tr>
					<td><img src="<?php echo $item->image ?>"></td>
					<td><?php echo $item->name ?></td>
					<td class="text-muted"><?php echo $item->quantity > 1 ? '&times' . $item->quantity : '' ?></td>
					<td class="text-right"><?php echo number_format($item->price / 100, 2) ?></td>
				</tr>
			<?php endforeach ?>
			<tr>
				<td colspan="3" class="text-right"><b>Total</b></td>
				<td class="text-right">$<?php echo number_format($total / 100, 2) ?></td>
			</tr>
		</table>
	</div>
</div>


<?php $this->load->view('footer') ?>