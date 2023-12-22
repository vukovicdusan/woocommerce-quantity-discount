<?php


add_action('woocommerce_before_calculate_totals', function () {

	if (is_admin() && !defined('DOING_AJAX'))
		return;

	if (did_action('woocommerce_before_calculate_totals') >= 2)
		return;

	global $woocommerce;

	$count = $woocommerce->cart->cart_contents_count;

	if ($count >= 3) {
		foreach (WC()->cart->get_cart() as $item) {
			// echo '<pre>',  $item['data'], '</pre>';
			$price = $item['data']->sale_price ?? $item['data']->regular_price;
			$discount = get_field('discount_for_3', $item['data']->id);
			$discountPrice = $price - (($price * $discount) / 100);
			$item['data']->set_price($discountPrice);
		}
	} elseif ($count === 2) {
		foreach (WC()->cart->get_cart() as $item) {
			$price = $item['data']->sale_price ?? $item['data']->regular_price;
			$discount = get_field('discount_for_2', $item['data']->id);
			$discountPrice = $price - (($price * $discount) / 100);
			$item['data']->set_price($discountPrice);
		}
	} else {
		foreach (WC()->cart->get_cart() as $item) {
			$price = $item['data']->sale_price ?? $item['data']->regular_price;
			$item['data']->set_price($price);
		}
	}
}, 20, 1);

add_filter('woocommerce_after_cart_item_quantity_update', function () {

	if (is_admin() && !defined('DOING_AJAX'))
		return;

	if (did_action('woocommerce_after_cart_item_quantity_update') >= 2)
		return;

	global $woocommerce;

	$count = $woocommerce->cart->cart_contents_count;

	if ($count >= 3) {
		foreach (WC()->cart->get_cart() as $item) {
			$price = $item['data']->sale_price ?? $item['data']->regular_price;
			$discount = get_field('discount_for_3', $item['data']->id);
			$discountPrice = $price - (($price * $discount) / 100);
			$item['data']->set_price($discountPrice);
		}
	} elseif ($count === 2) {
		foreach (WC()->cart->get_cart() as $item) {
			$price = $item['data']->sale_price ?? $item['data']->regular_price;
			$discount = get_field('discount_for_2', $item['data']->id);
			$discountPrice = $price - (($price * $discount) / 100);
			$item['data']->set_price($discountPrice);
		}
	} else {
		foreach (WC()->cart->get_cart() as $item) {
			$price = $item['data']->sale_price ?? $item['data']->regular_price;
			$item['data']->set_price($price);
		}
	}
}, 10, 3);
