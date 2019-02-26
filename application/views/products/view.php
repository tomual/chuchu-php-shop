<?php $this->load->view('header') ?>
<div class="row my-5 text-secondary">
	<div class="col">
		<a href="" class="mx-2">Home</a> / 
		<a href="" class="mx-2">Accessories</a> / 
		<a href="" class="mx-2">Socks</a> / 
		<span class="mx-2 text-dark"><?php echo $product->name ?></span>
	</div>
</div>
<div class="row my-5 product">
	<div class="col-lg-6">
		<ul id="imageGallery">
			<?php foreach ($product->images as $image): ?>
				<li data-thumb="<?php echo $image ?>" data-src="<?php echo $image ?>">
					<img src="<?php echo $image ?>" />
				</li>
			<?php endforeach ?>
		</ul>
	</div>
	<div class="col px-5">
		<h1><?php echo $product->name ?></h1>
		<h2>$<?php echo number_format($product->price / 100, 2) ?></h2>
		<div class="actions my-5">
			<form method="post" action="<?php echo base_url('cart/add') ?>">
				<input type="hidden" name="product_id" value="<?php echo $product->id ?>">
				<input type="submit" class="btn btn-primary" value="Add to Cart">
				<a class="btn btn-secondary" href="<?php echo base_url("cart/add/{$product->id}") ?>"><i class="jam jam-star"></i></a>
			</form>
		</div>
		<table class="table table-sm small">
			<?php $detail_headers = array('material', 'size', 'color', 'size', 'delivery', 'return') ?>
			<?php foreach ($detail_headers as $header): ?>
				<?php if (!empty($details->{$header})): ?>
					<tr>
						<th><?php echo ucfirst($header) ?></th>
						<td><?php echo $details->{$header} ?></td>
					</tr>
				<?php endif ?>
			<?php endforeach ?>
		</table>
	</div>
</div>
<div class="row">
</div>
<?php $this->load->view('footer') ?>