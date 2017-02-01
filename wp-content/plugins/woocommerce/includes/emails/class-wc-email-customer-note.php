<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email_Customer_Note' ) ) :

/**
 * Customer Note Order Email.
 *
 * Customer note emails are sent when you add a note to an order.
 *
 * @class       WC_Email_Customer_Note
 * @version     2.3.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */
class WC_Email_Customer_Note extends WC_Email {

	/**
	 * Customer note.
	 *
	 * @var string
	 */
	public $customer_note;
    public $venue_name;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id             = 'customer_note';
		$this->customer_email = true;
		$this->title          = __( 'Customer note', 'woocommerce' );
		$this->description    = __( 'Customer note emails are sent when you add a note to an order.', 'woocommerce' );

		$this->template_html  = 'emails/customer-note.php';
		$this->template_plain = 'emails/plain/customer-note.php';

		$this->subject        = __( 'Note added to your {site_title} order from {order_date}', 'woocommerce');
		$this->heading        = __( 'A note has been added to your order', 'woocommerce');

		// Triggers
		add_action( 'woocommerce_new_customer_note_notification', array( $this, 'trigger' ) );

		// Call parent constructor
		parent::__construct();
	}

	/**
	 * Trigger.
	 *
	 * @param array $args
	 */
	public function trigger( $args ) {

		if ( ! empty( $args ) ) {

			$defaults = array(
				'order_id'      => '',
				'customer_note' => ''
			);

			$args = wp_parse_args( $args, $defaults );

			extract( $args );

            $this->venue_name   = '';

			if ( $order_id && ( $this->object = wc_get_order( $order_id ) ) ) {
                $user_id = $this->object->get_user()->ID;
                $venue_id = get_venue_id($user_id);

                $area_email = get_field_object('area_manager', $venue_id)['value']['user_email'];

				$this->recipient               = $this->object->billing_email;
				$this->customer_note           = $customer_note;

				$this->find['order-date']      = '{order_date}';
				$this->find['order-number']    = '{order_number}';

				$this->replace['order-date']   = date_i18n( wc_date_format(), strtotime( $this->object->order_date ) );
				$this->replace['order-number'] = $this->object->get_order_number();
			} else {
				return;
			}
		}

		if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
			return;
		}

		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
        $this->venue_name   = get_post($venue_id)->post_title;
        add_filter( 'woocommerce_email_heading_' . $this->id, array($this, 'custom_heading'), 10, 2 );
        $this->send( $area_email, $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
	}

    public function custom_heading($heading, $object) {
        return 'Order is cancelled. - Venue: '.$this->venue_name;
    }

	/**
	 * Get content html.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_html() {
		return wc_get_template_html( $this->template_html, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'customer_note' => $this->customer_note,
			'sent_to_admin' => false,
			'plain_text'    => false,
			'email'			=> $this,
            'venue_name'    => $this->venue_name
		) );
	}

	/**
	 * Get content plain.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_plain() {
		return wc_get_template_html( $this->template_plain, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'customer_note' => $this->customer_note,
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this
		) );
	}
}

endif;

return new WC_Email_Customer_Note();
