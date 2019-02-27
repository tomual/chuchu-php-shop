<?php $this->load->view('header') ?>

<div class="row">
	<div class="col">
		<h1 class="my-5">All Products</h1>
	</div>
</div>
<div class="row">
	<div class="col">
		<form action="<?php echo base_url('checkout/payment') ?>" method="post" id="payment-form" class="form">
			<div class="form-row">
				<label for="card-element">Credit or debit card</label>
				<div id="card-element"></div>
				<div id="card-errors" role="alert"></div>
			</div>
			<button>Pay $<?php echo $order->amount ?></button>
		</form>
	</div>
</div>


<?php $this->load->view('footer') ?>