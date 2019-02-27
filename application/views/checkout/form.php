<?php $this->load->view('header') ?>

<div class="row">
	<div class="col">
		<h1 class="my-5">All Products</h1>
	</div>
</div>
<div class="row">
	<div class="col">
		<form action="<?php echo base_url('checkout/form') ?>" method="post" id="payment-form" class="form">
			<div class="form-row">
			</div>
			<button>Continue</button>
		</form>
	</div>
</div>


<?php $this->load->view('footer') ?>