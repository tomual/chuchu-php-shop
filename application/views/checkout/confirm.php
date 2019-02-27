<?php $this->load->view('header') ?>

<div class="row">
	<div class="col">
		<h1 class="my-5">All Products</h1>
	</div>
</div>
<div class="row">
	<div class="col">
		<form action="<?php echo base_url('checkout/process') ?>" method="post" id="payment-form" class="form">
			<div class="form-row">
				<input type="text" name="order" value="<?php $this->session->userdata('order') ?>">
				<label for="card-element">Credit or debit card</label>
				<div id="card-element"></div>
				<div id="card-errors" role="alert"></div>
			</div>
			<button>Submit Payment</button>
		</form>
	</div>
</div>


<?php $this->load->view('footer') ?>