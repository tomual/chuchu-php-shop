<?php $this->load->view('header') ?>

<div class="row">
	<div class="col">
		<h1 class="my-5">Payment Information</h1>
	</div>
</div>
<div class="row">
	<div class="col-8">
		<table class="table">
			<tr>
				<th>Email</th>
				<td><?php echo $order->email ?></td>
			</tr>
			<tr>
				<th>Name</th>
				<td><?php echo $order->shipping->name ?></td>
			</tr>
			<tr>
				<th>Address</th>
				<td>
					<?php echo $order->shipping->address->line1 ?><br>
					<?php echo $order->shipping->address->city ?>
					<?php echo $order->shipping->address->state ?>
					<?php echo $order->shipping->address->postal_code ?>
				</td>
			</tr>
			<tr>
				<th>Items</th>
				<td>
					<table class="table table-borderless table-sm small">
					<?php foreach ($order->items as $item): ?>
						<?php if ($item->type == 'sku'): ?>
							<tr>
								<td><?php echo $item->description ?></td>
								<td class="text-muted">&times;<?php echo $item->quantity ?></td>
								<td class="text-right"><?php echo number_format($item->amount / 100, 2) ?></td>
							</tr>
						<?php endif ?>
					<?php endforeach ?>
					</table>
				</td>
			</tr>
			<tr>
				<th>Total</th>
				<td>$<?php echo number_format($order->amount / 100, 2) ?></td>
			</tr>
		</table>
	</div>
	<div class="col-4 px-5">
		<h6>Shipping information header</h6>
		<div class="text-muted small">
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.
			</p>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et <a href="">dolore</a> magna aliqua.
			</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-6 mt-4">
		<form action="<?php echo base_url('checkout/payment') ?>" method="post" id="payment-form" class="form">
			<div class="form-group">
				<label for="card-element">Credit or debit card</label>
				<div id="card-element"></div>
				<div id="card-errors" role="alert"></div>
			</div>
			<button class="btn btn-primary mt-4">Confirm and Pay</button>
		</form>
	</div>
</div>


<?php $this->load->view('footer') ?>