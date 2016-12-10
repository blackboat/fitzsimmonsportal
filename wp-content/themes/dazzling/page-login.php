<?php
/**
 * Template Name: Login
 *
 * This is the template that displays full width page without sidebar
 *
 * @package dazzling
 */

get_header(); ?>

<div class="login-wp">
	<div class="row">
		<div class="col-xs-12">
			<?php
			if(defined('LOGIN_ERROR')){
			    foreach(unserialize(LOGIN_ERROR) as $error){
			    echo '<div class="alert alert-danger">'.$error.'</div>';
			    }
			}
			?>
			<form method="post" action="<?php echo add_query_arg('do', 'login', get_permalink( $post->ID )); ?>">
				<div class="form-group">
					<div class="logo-login">
							<a href="http://fitzsimmonsportal.com.au/restore/"><img src="http://fitzsimmonsportal.com.au/restore/wp-content/uploads/2016/12/fh-logo-2.png" alt="" /></a>
					</div>
				</div>
				<div class="login-inner">
					<div class="form-group">
						<h1>Login to Portal</h1>
					</div>
				  <div class="form-group username">
				    <input type="text" class="form-control" name="username" placeholder="Username">
				  </div>
				  <div class="form-group password">
				    <input type="password" class="form-control" name="password" placeholder="Password"><i class="password-icon fa fa-eye"></i>
				  </div>
				  <div class="checkbox"><label><input type="checkbox"> Remember Me</label>
				  </div>
				  <div class="btn-row text-center">
				  	<button type="submit" class="btn btn-default">Login</button>
				  </div>
			  </div>
			</form>
		</div>
	</div>
</div>

<?php get_footer(); ?>