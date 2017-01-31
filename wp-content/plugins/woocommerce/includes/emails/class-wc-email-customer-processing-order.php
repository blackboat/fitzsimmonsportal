<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email_Customer_Processing_Order' ) ) :

/**
 * Customer Processing Order Email.
 *
 * An email sent to the customer when a new order is paid for.
 *
 * @class       WC_Email_Customer_Processing_Order
 * @version     2.0.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */
class WC_Email_Customer_Processing_Order extends WC_Email {

    public $venue_name;
    public $user_id;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id               = 'customer_processing_order';
		$this->customer_email   = true;
		$this->title            = __( 'Processing order', 'woocommerce' );
		$this->description      = __( 'This is an order notification sent to customers containing order details after payment.', 'woocommerce' );
		$this->heading          = __( 'Thank you for your order', 'woocommerce' );
		$this->subject          = __( 'Your {site_title} order receipt from {order_date}', 'woocommerce' );
		$this->template_html    = 'emails/customer-processing-order.php';
		$this->template_plain   = 'emails/plain/customer-processing-order.php';

		// Triggers for this email
		add_action( 'woocommerce_order_status_on-hold_to_processing_notification', array( $this, 'trigger' ) );
		add_action( 'woocommerce_order_status_pending_to_processing_notification', array( $this, 'trigger' ) );

		// Call parent constructor
		parent::__construct();

		// Other settings
		$this->recipient = $this->get_option( 'recipient', get_option( 'admin_email' ) );
	}

	/**
	 * Trigger.
	 *
	 * @param int $order_id
	 */
	public function trigger( $order_id ) {

		if ( $order_id ) {
			$this->object       = wc_get_order( $order_id );
            $this->user_id = $this->object->get_user()->ID;
			$this->venue_name   = get_post(get_venue_id($this->user_id))->post_title;
            update_user_meta($this->user_id, 'order_approve_reject_key_'.$order_id, md5('user_'.$this->user_id));

			$this->find['order-date']      = '{order_date}';
			$this->find['order-number']    = '{order_number}';

			$this->replace['order-date']   = date_i18n( wc_date_format(), strtotime( $this->object->order_date ) );
			$this->replace['order-number'] = $this->object->get_order_number();
		}

		if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
			return;
		}

        $this->send( $this->object->billing_email, $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
        add_filter( 'woocommerce_email_heading_' . $this->id, array($this, 'custom_heading'), 10, 2 );
        $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
	}

    public function custom_heading($heading, $object) {
        return $heading.' - Venue: '.$this->venue_name;
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
			'sent_to_admin' => false,
			'plain_text'    => false,
			'email'			=> $this,
            'approve_link'  => get_page_link( get_page_by_path( 'update-order' )->ID ).'?key='.get_user_meta($this->user_id, 'order_approve_reject_key_'.$this->object->id, true).'&action=approve&order_id='.$this->object->id,
            'reject_link'  => get_page_link( get_page_by_path( 'update-order' )->ID ).'?key='.get_user_meta($this->user_id, 'order_approve_reject_key_'.$this->object->id, true).'&action=reject&order_id='.$this->object->id
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
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this
		) );
	}

	/**
	 * Initialise settings form fields.
	 */
	public function init_form_fields() {
		$this->form_fields    = array(
			'enabled'         => array(
				'title'       => __( 'Enable/Disable', 'woocommerce' ),
				'type'        => 'checkbox',
				'label'       => __( 'Enable this email notification', 'woocommerce' ),
				'default'     => 'yes'
			),
			'recipient' 		=> array(
				'title'         => __( 'Recipient(s)', 'woocommerce' ),
				'type'          => 'text',
				'description'   => sprintf( __( 'Enter recipients (comma separated) for this email. Defaults to <code>%s</code>.', 'woocommerce' ), esc_attr( get_option('admin_email') ) ),
				'placeholder'   => '',
				'default'       => '',
				'desc_tip'      => true
			),
			'subject'         => array(
				'title'       => __( 'Email Subject', 'woocommerce' ),
				'type'        => 'text',
				'description' => sprintf( __( 'Defaults to <code>%s</code>', 'woocommerce' ), $this->subject ),
				'placeholder' => '',
				'default'     => '',
				'desc_tip'    => true
			),
			'heading'         => array(
				'title'       => __( 'Email Heading', 'woocommerce' ),
				'type'        => 'text',
				'description' => sprintf( __( 'Defaults to <code>%s</code>', 'woocommerce' ), $this->heading ),
				'placeholder' => '',
				'default'     => '',
				'desc_tip'    => true
			),
			'email_type'      => array(
				'title'       => __( 'Email type', 'woocommerce' ),
				'type'        => 'select',
				'description' => __( 'Choose which format of email to send.', 'woocommerce' ),
				'default'     => 'html',
				'class'       => 'email_type wc-enhanced-select',
				'options'     => $this->get_email_type_options(),
				'desc_tip'    => true
			)
		);
	}
}

endif;

return new WC_Email_Customer_Processing_Order();
