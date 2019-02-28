<?php $this->load->view('header') ?>

<div class="row">
	<div class="col">
		<h1 class="my-5">Order Receipt</h1>
	</div>
</div>
<div class="row">
	<div class="col-4">
		<p>The payment was successfully processed.</p>
		<p>Your payment ID is <?php echo $charge->id ?>.</p>
		<p>A receipt was sent to <?php echo $charge->receipt_email ?? '<span class="text-muted">[Email Address]</span>' ?>.</p>
		<a href="/" class="btn btn-primary">Back to home</a> 
		<a href="<?php echo $charge->receipt_url ?>" target="_blank" class="btn btn-secondary">View Receipt</a>
	</div>
</div>

<?php $this->load->view('footer') ?>