<?php

/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 *
 * @var bool   $readonly If the input should be set to readonly mode.
 * @var string $type     The input type attribute.
 */


defined('ABSPATH') || exit;


/* translators: %s: Quantity. */
$label = !empty($args['product_name']) ? sprintf(esc_html__('%s quantity', 'woocommerce'), wp_strip_all_tags($args['product_name'])) : esc_html__('Quantity', 'woocommerce');
global $product;


?>
<div class="quantity">
	<?php
	/**
	 * Hook to output something before the quantity input field.
	 *
	 * @since 7.2.0
	 */
	do_action('woocommerce_before_quantity_input_field');
	?>
	<!-- <label class="screen-reader-text" for="<?php echo esc_attr($input_id); ?>"><?php echo esc_attr($label); ?></label>
	<input type="<?php echo esc_attr($type); ?>" <?php echo $readonly ? 'readonly="readonly"' : ''; ?> id="<?php echo esc_attr($input_id); ?>" class="<?php echo esc_attr(join(' ', (array) $classes)); ?>" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($input_value); ?>" aria-label="<?php esc_attr_e('Product quantity', 'woocommerce'); ?>" size="4" min="<?php echo esc_attr($min_value); ?>" max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>" <?php if (!$readonly) : ?> step="<?php echo esc_attr($step); ?>" placeholder="<?php echo esc_attr($placeholder); ?>" inputmode="<?php echo esc_attr($inputmode); ?>" autocomplete="<?php echo esc_attr(isset($autocomplete) ? $autocomplete : 'on'); ?>" <?php endif; ?> /> -->

	<?php
	$price = $product->get_price();
	$discountPriceFor2 = $price - (($price * get_field('discount_for_2')) / 100);
	$discountPriceFor3 = $price - (($price * get_field('discount_for_3')) / 100);
	?>
	<input class="bulk-buy" type="radio" id="buy-one" name="<?php echo esc_attr($input_name); ?>" value="1" price-attribute=<?php echo $price; ?>>
	<label for="buy-one">1x<?php echo $price . "RSD/kom" ?></label>
	<input class="bulk-buy" type="radio" id="buy-two" name="<?php echo esc_attr($input_name); ?>" value="2" price-attribute=<?php echo $discountPriceFor2; ?>>
	<label for="buy-two">2x<?php echo $discountPriceFor2 . "RSD/kom" ?></label>
	<input class="bulk-buy" type="radio" id="buy-three" name="<?php echo esc_attr($input_name); ?>" value="3" price-attribute=<?php echo $discountPriceFor3; ?>>
	<label for="buy-three">3x<?php echo $discountPriceFor3 . "RSD/kom" ?></label>
	<br>
	<div>
		<span id="price-value-placeholder"><?php echo $price . "RSD" ?></span>
	</div>
	<?php

	/**
	 * Hook to output something after quantity input field
	 *
	 * @since 3.6.0
	 */
	do_action('woocommerce_after_quantity_input_field');
	?>
</div>
<script>
	let one = document.getElementById('buy-one');
	let two = document.getElementById('buy-two');
	let three = document.getElementById('buy-three');
	let pricePlaceholder = document.getElementById('price-value-placeholder');


	let priceValue = "";


	let prices = document.querySelectorAll(".bulk-buy");
	prices.forEach(price => {
		price.addEventListener('click', (e) => {
			if (price) {
				pricePlaceholder.innerHTML = price.getAttribute("price-attribute") + "RSD";
			}
		});
	})
</script>
<?php
