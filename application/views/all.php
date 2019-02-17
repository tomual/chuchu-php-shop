<?php $this->load->view('header') ?>
<div class="row">
	<div class="col">
		<h1 class="my-5">All Products</h1>
	</div>
</div>
<div class="row">
	<?php foreach ($products as $product): ?>
		<div class="col-3 p-4">
			<?php $url_title = strtolower(url_title($product->name)) ?>
			<a class="card product-card" href="<?php echo base_url("products/$url_title/{$product->id}") ?>" data-id="<?php echo $product->id ?>">
				<img class="card-img-top" src="<?php echo base_url("img/products/{$product->thumb}") ?>" alt="Card image cap">
				<div class="card-img-overlay">
					<div class="btn btn-secondary" data-action="cart"><div class="jam jam-shopping-cart"></div></div>
					<div class="btn btn-secondary" data-action="save"><div class="jam jam-star-full"></div></div>
				</div>
				<div class="card-body">
					<div class="name small"><?php echo $product->name ?></div>
					<div class="price small text-secondary">$<?php echo $product->price ?></div>
				</div>
			</a>
		</div>
	<?php endforeach ?>
</div>
<?php $this->load->view('pagination') ?>
<?php $this->load->view('footer') ?>