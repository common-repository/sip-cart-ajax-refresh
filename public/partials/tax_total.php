<?php 
	ob_start();
	require_once( $_GET['q'].'wp-config.php' );
	ob_end_clean();
?>
<?php if ( wc_tax_enabled() && WC()->cart->tax_display_cart === 'excl' ) : ?>
	<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
		<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
			<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
				<th><?php echo esc_html( $tax->label ); ?></th>
				<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
			</tr>
		<?php endforeach; ?>
	<?php else : ?>
		<tr class="tax-total">
			<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
			<td><?php wc_cart_totals_taxes_total_html(); ?></td>
		</tr>
	<?php endif; ?>
<?php endif; ?>