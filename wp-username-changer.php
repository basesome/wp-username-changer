<?php
/*
Plugin Name: WordPress Username Changer
Plugin URI: https://ciphermedialtd.com
Description: Allows users to change their usernames
Version: 1.0
Author: Osobase
Author URI: https://osobase.com
*/

/* Generates the HTML form for changing the username */

function username_change_form() {
    ?>
    <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
        <input type="hidden" name="action" value="change_username">
        <label for="new_username">New Username:</label>
        <input type="text" name="new_username" id="new_username">
        <?php wp_nonce_field( 'change_username_nonce', 'change_username_nonce' ); ?>
        <input type="submit" value="Change Username">
    </form>
    <?php
}

/* Function that handles the form submission and changes the username */

function change_username() {
    if ( ! isset( $_POST['change_username_nonce'] ) || ! wp_verify_nonce( $_POST['change_username_nonce'], 'change_username_nonce' ) ) {
        wp_die( 'Unauthorized access' );
    }

    $user_id = get_current_user_id();
    $new_username = sanitize_user( $_POST['new_username'] );

    if ( ! validate_username( $new_username ) ) {
        wp_die( 'Invalid username' );
    }

    $update = wp_update_user(
        array(
            'ID' => $user_id,
            'user_login' => $new_username,
        )
    );

    if ( is_wp_error( $update ) ) {
        wp_die( $update->get_error_message() );
    }

    wp_redirect( home_url() );
    exit;
}

add_action( 'admin_post_change_username', 'change_username' );

/* Add a shortcode that displays the username change form on a WordPress page */

function username_change_shortcode() {
    ob_start();
    username_change_form();
    return ob_get_clean();
}

add_shortcode( 'username_change', 'username_change_shortcode' );
