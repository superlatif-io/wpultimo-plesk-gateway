<?php
/**
 * This file runs when the plugin in uninstalled (deleted).
 * This will not run when the plugin is deactivated.
 * Ideally you will add all your clean-up scripts here
 * that will clean-up unused meta, options, etc. in the database.
 *
 * @package WordPress Plugin Template/Uninstall
 */

// If plugin is not being uninstalled, exit (do nothing).
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Do something here if plugin is being uninstalled.
$blog_id = 1;
delete_blog_option($blog_id, 'wpupg_plesk_url');
delete_blog_option($blog_id, 'wpupg_parent_domain');
delete_blog_option($blog_id, 'wpupg_domain_status');
delete_blog_option($blog_id, 'wpupg_synchronize_dns');
delete_blog_option($blog_id, 'wpupg_seo_redirect');