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
	}
	event.preventDefault();
})
