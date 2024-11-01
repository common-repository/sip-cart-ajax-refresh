<?php 
	ob_start();
	require_once( $_GET['q'].'wp-config.php' );
	ob_end_clean();
?>

<th><?php _e( 'Total', 'woocommerce' ); ?></th>
<td><strong><?php echo WC()->cart->get_total_ex_tax();?></strong></td>