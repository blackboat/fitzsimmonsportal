<?php
/**
 * Template Name: User Profile
 *
 * Allow users to update their profiles from Frontend.
 *
 * @package dazzling
 */

/* Get user info. */
global $current_user, $wp_roles;

/* Load the registration file. */
//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
$error = array();    
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

    /* Update user password. */
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
    }

    /* Update user information. */
    if ( !empty( $_POST['url'] ) )
        wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
    if ( !empty( $_POST['email'] ) ){
        if (!is_email(esc_attr( $_POST['email'] )))
            $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
        elseif(email_exists(esc_attr( $_POST['email'] )) == true ) {
            if (get_user_by('email', esc_attr($_POST['email']))->ID != $current_user->ID)
                $error[] = __('This email is already used by another user.  try a different one.', 'profile');
        } else {
            wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
        }
    }

    update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    update_user_meta( $current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );

    /* Redirect so the page will show updated info.*/
  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
    if ( count($error) == 0 ) {

        $post_id = get_user_meta( $current_user->ID, 'wp_metronet_post_id', true );
        if (!$post_id) {
            // get post id in metro profile plugin
            $post_args = array(
                'post_type' => 'mt_pp',
                'author' => $current_user->ID,
                'post_status' => 'publish'
            );
            $posts = get_posts($post_args);
            if (!$posts) {
                $post_id = wp_insert_post(array(
                    'post_author' => $current_user->ID,
                    'post_type' => 'mt_pp',
                    'post_status' => 'publish',
                ));
            } else {
                $post = end($posts);
                $post_id = $post->ID;
            }
        }

        $thumbnail_id = empty( $_POST['shr_image_id']) ? '' : $_POST['shr_image_id'];
        update_user_option( $current_user->ID, 'metronet_post_id', $post_id );
        update_user_option( $current_user->ID, 'metronet_image_id', $thumbnail_id );
        set_post_thumbnail( $post_id, $thumbnail_id );
        wp_redirect( get_permalink() );
        exit;
    }
}
?>

<?php

get_header();
wp_enqueue_media(); ?>

	<div class="top-title">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<header class="entry-header page-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					<?php
						echo do_shortcode( '[breadcrumb]' ); 
					?>
				</div>
			</div>
		</div>
	</div>

       
    <div class="content-boxs">
        <div id="content" class="site-content container">

            <div class="container main-content-area"><?php

                global $post;
                if( get_post_meta($post->ID, 'site_layout', true) ){
                        $layout_class = get_post_meta($post->ID, 'site_layout', true);
                }
                else{
                        $layout_class = of_get_option( 'site_layout' );
                }
                if( is_home() && is_sticky( $post->ID ) ){
                        $layout_class = of_get_option( 'site_layout' );
                }

                // get user profile image
                $profile_pic = get_user_meta( $current_user->ID, 'wp_metronet_image_id', true );
                if( $profile_pic ){
                    $image = wp_get_attachment_image_src( $profile_pic, 'thumbnail' );
                }

                ?>
                <div class="row <?php echo $layout_class; ?>">
					<div id="primary" class="content-area col-sm-12 col-md-12">
						<main id="main" class="site-main" role="main">

							<?php while ( have_posts() ) : the_post(); ?>

								<div id="post-<?php the_ID(); ?>">
						        <div class="entry-content entry woocommerce user-profile">
						            <?php the_content(); ?>
						            <?php if ( !is_user_logged_in() ) : ?>
						                    <p class="warning">
						                        <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
						                    </p><!-- .warning -->
						            <?php else : ?>
						                <?php if ( count($error) > 0 ) echo '<ul class="woocommerce-error"><li>' . implode("<br />", $error) . '</li></ul>'; ?>
						                <form method="post" id="adduser" action="<?php the_permalink(); ?>">
                                            <p class="form-profile-image form-row">
                                                <label for="first-name"><?php _e('Avatar', 'profile'); ?></label>
                                                <!-- <div class="image"> -->
                                                    <input type="hidden" class="button" name="shr_image_id" id="shr_image_id" value="<?php echo !empty($profile_pic) ? $profile_pic : ''; ?>" />
                                                    <img id="shr-img" src="<?php echo !empty($profile_pic) ? $image[0] : 'http://dev.fitzsimmonsportal.com/wp-content/plugins/metronet-profile-picture/img/mystery.png'; ?>" style="max-width: 100px; max-height: 100px;" />
                                                    <input type="button" data-id="shr_image_id" data-src="shr-img" class="button shr-image" name="shr_image" id="shr-image" value="Upload" />
                                                <!-- </div> -->
                                            </p>
                                            <div class="clear"></div>
						                    <p class="form-username form-row form-row-first">
						                        <label for="first-name"><?php _e('First Name ', 'profile'); ?><span class="required">*</span></label>
						                        <input class="input-text" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" required />
						                    </p><!-- .form-username -->
						                    <p class="form-username form-row form-row-last">
						                        <label for="last-name"><?php _e('Last Name ', 'profile'); ?><span class="required">*</span></label>
						                        <input class="input-text" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" required />
						                    </p><!-- .form-username -->
						                    <div class="clear"></div>
						                    <p class="form-email form-row">
						                        <label for="email"><?php _e('E-mail ', 'profile'); ?><span class="required">*</span></label>
						                        <input class="input-text" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" required />
						                    </p><!-- .form-email -->
						                    <p class="form-password form-row">
						                        <label for="pass1"><?php _e('Password', 'profile'); ?> </label>
						                        <input class="input-text" name="pass1" type="password" id="pass1" />
						                    </p><!-- .form-password -->
						                    <p class="form-password form-row">
						                        <label for="pass2"><?php _e('Repeat Password', 'profile'); ?></label>
						                        <input class="input-text" name="pass2" type="password" id="pass2" />
						                    </p><!-- .form-password -->

						                    <?php 
						                        //action hook for plugin and extra fields
						                        do_action('edit_user_profile',$current_user); 
						                    ?>
						                    <div class="form-submit">
						                        <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Save Changes', 'profile'); ?>" />
						                        <?php wp_nonce_field( 'update-user' ) ?>
						                        <input name="action" type="hidden" id="action" value="update-user" />
						                    </div><!-- .form-submit -->
						                </form><!-- #adduser -->
						            <?php endif; ?>
						        </div><!-- .entry-content -->
						    	</div><!-- .hentry .post -->

							<?php endwhile; // end of the loop. ?>

						</main><!-- #main -->
					</div><!-- #primary -->


<?php get_footer(); ?>

<script type="text/javascript">
    jQuery( document ).ready( function() {

        /* WP Media Uploader */
        var _shr_media = true;
        var _orig_send_attachment = wp.media.editor.send.attachment;

        jQuery( '.shr-image' ).click( function() {

            var button = jQuery( this ),
                textbox_id = jQuery( this ).attr( 'data-id' ),
                image_id = jQuery( this ).attr( 'data-src' ),
                _shr_media = true;

            wp.media.editor.send.attachment = function( props, attachment ) {

                if ( _shr_media && ( attachment.type === 'image' ) ) {
                    if ( image_id.indexOf( "," ) !== -1 ) {
                        image_id = image_id.split( "," );
                        $image_ids = '';
                        jQuery.each( image_id, function( key, value ) {
                            if ( $image_ids )
                                $image_ids = $image_ids + ',#' + value;
                            else
                                $image_ids = '#' + value;
                        } );

                        var current_element = jQuery( $image_ids );
                    } else {
                        var current_element = jQuery( '#' + image_id );
                    }

                    jQuery( '#' + textbox_id ).val( attachment.id );
                    console.log(textbox_id)
                    current_element.attr( 'src', attachment.url ).show();
                } else {
                    alert( 'Please select a valid image file' );
                    return false;
                }
            }

            wp.media.editor.open( button );
            return false;
        } );

    } );
</script>
