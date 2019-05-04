$('.product-card').on('mouseover', function (event) {
	var id = $(this).closest('.product-card').data('id');
	$('.product-card[data-id=' + id + '] .card-img-overlay').fadeIn('fast');
	closeOtherProductOverlays(id);
})

$('.product-card').on('mouseleave', function (event) {
	closeOtherProductOverlays();
})

function closeOtherProductOverlays(id) {
	if (!id) {
		id = 0;
	}
	var open = $('.card-img-overlay:visible');
	for (var i = 0; i < open.length; i++) {
		var openId = $(open[i]).closest('.product-card').data('id');
		if (openId != id) {
			$('.product-card[data-id=' + openId + '] .card-img-overlay').fadeOut('fast');
		}
	}
}

$('.product-card .btn').on('click', function (event) {
	var action = $(this).data('action');
	var id = $(this).closest('.product-card').data('id');
	if (action == 'save') {
		console.log('SAVE ' + id);
	}
	if (action == 'cart') {
		console.log('CART ' + id);
		var item = { sku_id: id };
		$.ajax({
			type: "POST",
			url: base_url + '/cart/add',
			data: item,
		});
	}
	$(event.target).closest('.btn-secondary').addClass('active');
	$(event.target).closest('.btn-secondary').append('<div class="jam jam-check"></div>');
	if ($('header .cart-badge').length) {
		$('header .cart-badge').text(parseInt($('header .cart-badge').text()) + 1);
	} else {
		$('header .header-nav').append('<span class="badge badge-pill badge-danger cart-badge">1</span>');
	}
	event.preventDefault();
})
