/**
 * Theme Options Scripts
 */

jQuery(document).ready(function($){

    cancel_order_dialog = $( "#cancel-order-dialog-form" ).dialog({
        autoOpen: false,
        width: 500,
        modal: true,
        position: { my: 'center', at: 'center' },
        title: 'Cancel Order',
        closeOnEscape: false,
        buttons: {
          Send: function() {
            cancel_order_dialog.dialog( "close" );
          }
        },
        close: function() {
            $( "#cancel-order-dialog-form form" ).submit();
        }
    });

    $( "td.order_actions a.cancelled" ).on( "click", function() {
        cancel_order_dialog.dialog( "open" );
        $( "#cancel-order-dialog-form form" ).attr("action", $(this).attr("href"));
        return false;
    });
  
    $( "#woocommerce-order-actions .submitbox .save_order" ).on( "click", function() {
        var status = $( ".order_data_column_container .wc-order-status span.select2-chosen").text();
        if ( status == "Reject" ) {
            cancel_order_dialog.dialog( "open" );
            return false;
        }
        return true;
    });
});