<?php $this->load->view('header') ?>

<div class="row">
	<div class="col">
		<h1 class="my-5">Contact Form</h1>
	</div>
</div>
<div class="row">
	<div class="col-6">
		<?php alerts() ?>
		<p>If you have any questions or require some assistance, please fill in the form below and we would be happy to help you.</p>
		<form action="<?php echo base_url('contact/form') ?>" method="post" id="payment-form" class="form">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control <?php if (form_error('name')) echo 'is-invalid' ?>">
				<?php echo form_error('name') ?>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control <?php if (form_error('email')) echo 'is-invalid' ?>">
				<?php echo form_error('email') ?>
			</div>
			<div class="form-group">
				<label>Message</label>
				<textarea rows="5" name="message" class="form-control <?php if (form_error('message')) echo 'is-invalid' ?>"></textarea>
				<?php echo form_error('message') ?>
			</div>
			<button class="btn btn-primary">Send</button>
		</form>
	</div>
</div>


<?php $this->load->view('footer') ?>