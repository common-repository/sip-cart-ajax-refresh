<?php 
	ob_start();
	require_once( $_GET['q'].'wp-config.php' );
	ob_end_clean();
?>
<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
	<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
		<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
		<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
	</tr>
<?php endforeach; ?>