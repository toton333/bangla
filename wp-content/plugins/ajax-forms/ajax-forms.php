<?php
/**
 * Plugin Name: Ajax Forms.
 * Plugin URI: http://localhost/bangla
 * Description: Simple and easy to use login and registration forms.
 * Version: 1.0.0
 * Author: ajax Ghosal
 * Author URI: http://localhost/bangla
 * License: GPL2
 */

//user registration form

function ajax_registration_form(){

	if (!is_user_logged_in()) {
		global $load_js;
        $load_js = true;
		$registration_enabled = get_option('users_can_register');
		if ($registration_enabled) {
			$output = ajax_registration_form_fields();
		} else {
			$output = _e('User registration is not enabled.');
		}
		
		return $output;
	} 
}
add_shortcode('register_form', 'ajax_registration_form');



//html of registration form
function ajax_registration_form_fields(){
	ob_start(); ?>

	
	<form id="ajax_registration_form" class="ajax_form" action="" method="POST">
		<fieldset>
			<legend><h3 class="ajax_header"><?php _e('Registration Form'); ?></h3></legend>
			<h4 id="register_feedback"></h4>
			<img id="ajax_register_loading" src="<?php echo admin_url('/images/loading.gif'); ?>" alt="" style="display:none">
			<p>
			<label for="ajax_register_username"><?php _e('Username') ?></label>
			<input id="ajax_register_username" name="ajax_register_username" class="required" type="text">
            </p>
            <p>
			<label for="ajax_register_email"><?php _e('Email') ?></label>
			<input id="ajax_register_email" name="ajax_register_email" class="required" type="email">
            </p>
            <p>
			<label for="ajax_register_firstname"><?php _e('Firstname') ?></label>
			<input id="ajax_register_firstname" name="ajax_register_firstname"  type="text">
            </p>
            <p>
			<label for="ajax_register_lastname"><?php _e('Lastname') ?></label>
			<input id="ajax_register_lastname" name="ajax_register_lastname"  type="text">
            </p>
            <p>
			<label for="ajax_register_password"><?php _e('Password') ?></label>
			<input id="ajax_register_password" name="ajax_register_password" class="required" type="password">
            </p>
            <p>
			<label for="ajax_register_password_again"><?php _e('Password Again') ?></label>
			<input id="ajax_register_password_again" name="ajax_register_password_again" class="required"  type="password">
            </p>
            <input name="ajax_register_nonce" value="<?php echo wp_create_nonce('ajax-register-nonce'); ?>" type="hidden">
            <input id="ajax_register_submit" type="submit" value="<?php _e('Register Your Account'); ?>" >

		</fieldset>


	</form>

	<?php
	return ob_get_clean();
}


//user login form

function ajax_login_form(){

	if (!is_user_logged_in()) {
		global $load_js;
        $load_js = true;
		$output = ajax_login_form_fields();
	} else {
		
        $current_user_login_name = wp_get_current_user()->user_login;
        $output = 'Hello '.$current_user_login_name. ' | <a href="'.wp_logout_url(get_permalink()).'" title="Logout">Logout</a>';
	}
	return $output;
	
}

add_shortcode('ajax_login', 'ajax_login_form');

//html of login form
function ajax_login_form_fields(){

	ob_start();
	
	 ?>
<h3><?php _e('Login Form'); ?></h3>
<h4 id="login_feedback"></h4>
<img id="ajax_login_loading" src="<?php echo admin_url('/images/loading.gif'); ?>" alt="" style="display:none">		
	<form id="ajax_login_form" class="ajax_form" action="" method="POST" >
		<fieldset>
			<label for="ajax_login_username"><?php _e('Username'); ?></label>
			<input id="ajax_login_username" name="ajax_login_username" class="required" type="text">
			
			<label for="ajax_login_password"><?php _e('Password'); ?></label>
			<input id="ajax_login_password" name="ajax_login_password" class="required" type="password">

			<input id="ajax_login_submit" type="submit" value="<?php _e('Login'); ?>">
		</fieldset>
	</form>


	<?php
	return ob_get_clean();

}

//js registering
add_action('wp_enqueue_scripts', 'js_registering');
function js_registering(){

	wp_register_script('test_js', plugin_dir_url(__FILE__).'js/forms.js', array('jquery') );
}

//js loading
add_action('wp_footer', 'js_loading');
function js_loading(){
    global $load_js;
    if(!$load_js)
     return;
	wp_enqueue_script('test_js' );
	wp_localize_script('test_js', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php'), 'ajax_login_nonce'=> wp_create_nonce('ajax-login-nonce'), 'ajax_register_nonce'=> wp_create_nonce('ajax-register-nonce')));
}

//ajax register callback
add_action('wp_ajax_nopriv_register', 'ajax_register_callback');
function ajax_register_callback(){

 if (isset($_POST['ajax_register_username']) && wp_verify_nonce($_POST['ajax_register_nonce'], 'ajax-register-nonce' )){
 	$user_login = $_POST['ajax_register_username'];
 	$user_email = $_POST['ajax_register_email'];
 	$user_first = $_POST['ajax_register_firstname'];
 	$user_last  = $_POST['ajax_register_lastname'];
 	$user_pass  = $_POST['ajax_register_password'];
 	$pass_confirm = $_POST['ajax_register_password_again'];

 	// this is required for username checks
		//require_once(ABSPATH . WPINC . '/registration.php');

		if (username_exists($user_login)) {
			ajax_errors()->add('username_unavailable', 'Username already taken');
		}

		if($user_login == ''){
			ajax_errors()->add('username_empty', 'Please insert a username');
		}

		if (empty($user_email)) {
			ajax_errors()->add('email_empty', 'Please insert an email address');
		}else if(!is_email($user_email)){
			ajax_errors()->add('email_invalid', 'Invalid email address');
		}

		if (email_exists($user_email)) {
			ajax_errors()->add('email_users', 'This email address is already registered.');
		}

		if ($user_pass == '') {
			ajax_errors()->add('password_empty', 'Please insert a password');
		}

		if ($user_pass != $pass_confirm) {
			ajax_errors()->add('password_mismatch', 'Two password fields have to be matched');
		}

		$errors = ajax_errors()->get_error_messages();

		if (empty($errors)) {
			$new_user_id = wp_insert_user(array(

                    'user_login'		=> $user_login,
					'user_pass'	 		=> $user_pass,
					'user_email'		=> $user_email,
					'first_name'		=> $user_first,
					'last_name'			=> $user_last,
					'user_registered'	=> date('Y-m-d H:i:s'),
					'role'				=> 'subscriber'
				)
				);

			if($new_user_id) {
							// send an email to the admin alerting them of the registration
							wp_new_user_notification($new_user_id);
			 
							echo 'Registration successful.';
						}

		}else{
			ajax_show_error_messages();
		}
 }

	wp_die();
}

//ajax login callback
add_action('wp_ajax_nopriv_login', 'ajax_login_callback');
function ajax_login_callback(){

	if (isset($_POST['ajax_login_username']) 
		&& !empty($_POST['ajax_login_username']) 
		&& wp_verify_nonce($_POST['ajax_login_nonce'], 'ajax-login-nonce') ) {

		$user = get_user_by('login', $_POST['ajax_login_username']);
		
		if ($user) {
			if (!isset($_POST['ajax_login_password']) || empty($_POST['ajax_login_password']) ) {
				ajax_errors()->add('empty_password', _e('Please enter a password.'));
			}else if(!wp_check_password($_POST['ajax_login_password'] , $user->data->user_pass, $user->ID  )) {
				ajax_errors()->add('empty_password', 'Incorrect password.');
			}
		}else{
           ajax_errors()->add('empty_username', _e('Invalid Username'));
		}

		

		$errors = ajax_errors()->get_error_messages();
        if (empty($errors)) {
        	wp_set_auth_cookie($user->ID);
        	wp_set_current_user($user->ID, $_POST['ajax_login_username']);

        	do_action('wp_login', $_POST['ajax_login_username']);
        	echo 'success';
        }else{
        	ajax_show_error_messages();
        }
	}

	wp_die();
}

// used for tracking error messages
function ajax_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function ajax_show_error_messages() {
	if($codes = ajax_errors()->get_error_codes()) {
		
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = ajax_errors()->get_error_message($code);
		        echo  $message.'<br/>' ;
		    }
		
	}	
}

