<?php
/**
 * Template Name: Update order
 *
 * Page when click approve or reject on email.
 *
 * @package dazzling
 */

/* Get user info. */
global $current_user, $wp_roles;

/* Load the registration file. */
//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
//get_header();
wp_enqueue_media();


?>
<script type="text/javascript" src="http://dev.fitzsimmonsportal.com/wp-includes/js/jquery/jquery.js?ver=1.12.4"></script>
<script type="text/javascript" src="http://dev.fitzsimmonsportal.com/wp-content/themes/dazzling/js/jquery-ui/jquery-ui.js?ver=4.6.1"></script>
<link rel="stylesheet" id="front-jquery-ui-style-css" href="http://dev.fitzsimmonsportal.com/wp-content/themes/dazzling/js/jquery-ui/jquery-ui.css?ver=4.6.1" type="text/css" media="all">

<?php
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'approve' ) {
    $order = wc_get_order($_POST['order_id']);
    $order->update_status('processing', '', true);
} else if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'reject' ) {
    $order = wc_get_order($_POST['order_id']);
    $order->update_status('cancelled', $_POST['comment'], true);
}
if ( !empty( $_GET['order_id'] ) ) {
    $nonce = areamanager_nonce( 'woocommerce-mark-order-status' );
?>
<div id="approve-order-dialog" title="Approve Order" style="display:none;">
    <p class="validateTips">Order #<?php echo $_GET['order_id']; ?> is approved.</p>
    <form method="POST">
        <input type="hidden" name="action" value="approve" />
    </form>
</div>
<div id="reject-order-dialog" title="Reject Order" style="display:none;">
    <?php if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'reject' ) { ?>
    <p>Please leave your comment to reject Order #<?php echo $_GET['order_id']; ?>.</p>
    <?php } else { ?>
    <p class="validateTips">Order #<?php echo $_GET['order_id']; ?> is rejected.</p>

  <form method="POST">
    <fieldset style="border: none;">
        <textarea name="comment" value="" class="comment text ui-widget-content ui-corner-all" style="width:100%;height:150px;"></textarea>
        <input type="hidden" name="action" value="reject" />
        <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>" />
        <!-- Allow form submission with keyboard without duplicating the dialog button -->
        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px"/>
    </fieldset>
  </form>
    <?php } ?>
</div>
<?php } ?>

<script type="text/javascript">
    jQuery( document ).ready( function($) {
        var approve_dlg = $( "#approve-order-dialog" ).dialog({
          autoOpen: false,
          width: 350,
          position: { my: 'center', at: 'center' },
          modal: true,
          title: 'Order is approved',
          buttons: {
//            Login: function() {
//              dialog.dialog( "close" );
//            }
          },
          open: function() {
          },
          close: function() {
          }
        });
        <?php if (!empty( $_POST['action'] ) && $_POST['action'] == 'reject') { ?>
        var reject_dlg = $( "#reject-order-dialog" ).dialog({
            autoOpen: false,
            width: 350,
            position: { my: 'center', at: 'center' },
            modal: true,
            title: 'Order is rejected',
            buttons: {
                Login: function() {
                    reject_dlg.dialog( "close" );
                }
            }
        });
        <?php } else { ?>
        var reject_dlg = $( "#reject-order-dialog" ).dialog({
            autoOpen: false,
            width: 350,
            position: { my: 'center', at: 'center' },
            modal: true,
            title: 'Order is rejected',
            buttons: {
                Send: function() {
                    reject_dlg.dialog( "close" );
                    $( "#reject-order-dialog form" ).submit();
                }
            }
        });
        <?php } ?>
        $( ".ui-dialog-titlebar-close" ).hide();
        <?php if ( !empty( $_GET['action'] ) || !empty( $_POST['action'] ) ) {
            if ( $_GET['action'] == 'approve' ) { ?>
                $('#approve-order-dialog').show();
                approve_dlg.dialog( "open" );
        <?php } else if ( $_GET['action'] == 'reject' || $_POST['action'] == 'reject' ) { ?>
                $('#reject-order-dialog').show();
                reject_dlg.dialog( "open" );
        <?php }
        } ?>
    });
</script>