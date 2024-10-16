<?php
/*
Plugin Name: WooCommerce Order Subscription Status Logger
Description: Creates a log to track changes to order statuses
Version: 0.1
Author: @nicw
Requires Plugins: woocommerce
*/

namespace OrderSubscriptionStatusLogger;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'woocommerce_order_status_changed', 'OrderSubscriptionStatusLogger\log_order_status_update', 10, 3 );

function log_order_status_update( $order_id, $status_transition_from, $status_transition_to ){

	try{
		wc_get_logger()->debug(
			sprintf(
				'Order %s updated from %s to %s',
				$order_id,
				$status_transition_from,
				$status_transition_to
			),
			array(
				'source'    => 'order-status-updates',
				'data'      => '',
				'backtrace' => true,
			)
		);
	}catch( Exception $ex ){

	}
}


add_action( 'woocommerce_subscription_status_updated', 'OrderSubscriptionStatusLogger\log_subscription_status_update', 10, 3 );
add_action( 'woocommerce_subscription_status_changed', 'OrderSubscriptionStatusLogger\log_subscription_status_update', 10, 3 );

function log_subscription_status_update( $order_id, $status_transition_from, $status_transition_to ){

	try{
		wc_get_logger()->debug(
			sprintf(
				'Subscription %s updated from %s to %s',
				$order_id,
				$status_transition_from,
				$status_transition_to
			),
			array(
				'source'    => 'subscription-status-updates',
				'data'      => '',
				'backtrace' => true,
			)
		);
	}catch( Exception $ex ){

	}
}