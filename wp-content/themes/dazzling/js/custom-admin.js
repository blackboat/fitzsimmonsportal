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
            $( "#cancel-order-dialog-form form" ).submit();
          },
          Cancel: function() {
            cancel_order_dialog.dialog( "close" );
          }
        },
        close: function() {
        }
    });

    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? false : sParameterName[1];
            }
        }
    };

    var cancel_order_id = getUrlParameter('cancel_comment');

    if (cancel_order_id !== false && cancel_order_id !== undefined) {
        cancel_order_dialog.dialog( "open" );
        var ajax_src = $( "#post-"+cancel_order_id+" .order_actions .cancelled").attr("href");
        $( "#cancel-order-dialog-form form" ).attr("action", ajax_src);
    }

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
    $("#product_cat-all input").on("click", function() {
        custom_pricing();
    });
});