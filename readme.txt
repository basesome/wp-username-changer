Plugin Name: WP Username Changer

Description: The WP Username Changer plugin allows users to change their usernames in WordPress.

Installation:

Upload the wp-username-changer folder to the /wp-content/plugins/ directory.
Activate the plugin through the 'Plugins' menu in WordPress.

Usage:

To use the plugin, add the [username_change] shortcode to a page or post. This will display a form where users can enter their new username and submit the form.

Once the form is submitted, the user's username will be changed to the new username they entered in the form.

Note that only logged-in users can use the plugin to change their usernames. Non-logged-in users will be prompted to log in before they can use the form.

Technical details:

The plugin creates a shortcode that displays a form with a text input for the new username. When the user submits the form, the plugin uses the WordPress wp_update_user function to update the user's username.

The plugin also includes a nonce field to prevent cross-site request forgery (CSRF) attacks, which is checked in the change_username function.

Support:

If you need support or have any questions about the Username Change Plugin, please contact the plugin author through the WordPress support forums or via email at osobase@gmail.com