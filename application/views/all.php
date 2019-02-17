<?php $this->load->view('header') ?>
<div class="row">
	<div class="col">
		<h1 class="my-5">All Products</h1>
	</div>
</div>
<div class="row">
	<?php foreach ($products as $product): ?>
		<div class="col-3 mb-4">
			<div class="card">
				<img class="card-img-top" src="<?php echo base_url("img/products/{$product->thumb}") ?>" alt="Card image cap">
				<div class="card-body">
					<?php echo $product->name ?>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
<?php $this->load->view('pagination') ?>
<?php $this->load->view('footer') ?>