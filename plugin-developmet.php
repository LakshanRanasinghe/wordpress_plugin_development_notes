<?php

/**
* 01. How to add plugin settings link
*/
public $plugin;
$this->plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$this->plugin", array( $this, "settings_link" ) );

public function settings_link( $links ) {
  $settings_link = '<a href="admin.php?page=lakshan_plugin">Settings</a>';
  array_push( $links, $settings_link );
  return $links;
}


/**
* 02. How to add admin page
*/
add_action( 'admin_menu', array( $this, 'add_admin_pages') );

public function add_admin_pages() {
  add_menu_page( 'Lakshan Plugin', 'Lakshan', 'manage_options', 'lakshan_plugin', array( $this, 'admin_index'), 'dashicons-store', 110 );
}

/**
* 03. How to add enqueue admin scripts
*/
add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

function enqueue() {
  wp_enqueue_style( 'lakshan-styles', plugins_url( '/assets/lak-style.css', __FILE__ ) );
  wp_enqueue_script( 'lakshan-styles', plugins_url( '/assets/lak-script.js', __FILE__ ) );
}

/**
* 04. How to add enqueue frontend scripts
*/
add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

function enqueue() {
  wp_enqueue_style( 'lakshan-styles', plugins_url( '/assets/lak-style.css', __FILE__ ) );
  wp_enqueue_script( 'lakshan-styles', plugins_url( '/assets/lak-script.js', __FILE__ ) );
}

/**
* 05. How to use require_once inside plugin
*/
require_once plugin_dir_path( __FILE__ ) . 'inc/lakshan-plugin-activate.php';


/**
* 06. Hooks that trigger on plugin activation and deactivation
*/
register_activation_hook( __FILE__, '');
register_deactivation_hook( __FILE__, '');

/**
* 07. How to add custom post type(CPT)
*/
add_action( 'init', array( $this, 'custom_post_type' ) );

function custom_post_type() {
  register_post_type( 'book', ['public' => true, 'label' => 'Book'] );
}

