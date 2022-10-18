<?php

add_action('template_redirect', 'netscape_buffer_start', 0);
add_action( 'send_headers', 'netscape_headers' );

function netscape_headers() {
    header('Content-Type: text/html; charset=ISO-8859-1');
}

function netscape_buffer_start() {
    add_action('shutdown', 'netscape_buffer_stop', PHP_INT_MAX);
    ob_start('netscape_modify_content'); 
}

function netscape_buffer_stop() {
    ob_end_flush();
}

function netscape_modify_content($content) {
    //modify $content
    return utf8_decode($content . '<!-- Netscape Theme converted contents to ISO-8859-1 -->');
}

load_theme_textdomain('netscape');

//Force PNG Thumbnails into JPGs
add_filter('wp_generate_attachment_metadata','netscape_force_png_to_jpg');

function netscape_force_png_to_jpg($image_data) {

  $sizes = get_intermediate_image_sizes();

  $upload_dir = wp_upload_dir();
  $file = $upload_dir['basedir'] . '/' . $image_data['file'];

  foreach($sizes as $size){

    if(isset($image_data['sizes'][$size]))
    {
      if( $image_data['sizes'][$size]['mime-type'] == "image/png" ){

        //change format and filename for jpg
        $dest_file = preg_replace('/\.png$/i', '.jpg', $image_data['sizes'][$size]['file']);
        $image_data['sizes'][$size]['file'] = $dest_file;
        $image_data['sizes'][$size]['mime-type'] = "image/jpg";

        //process image into jpg using standard gd lib
        $image = imagecreatefrompng($file);
        $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
        imagealphablending($bg, TRUE);
        imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
        $bg = imagescale($bg, $image_data['sizes'][$size]['width'], $image_data['sizes'][$size]['height'] );
        imagedestroy($image);

        //set quality and save
        $quality = 80; // 0 = worst / smaller file, 100 = better / bigger file 
        imagejpeg($bg, dirname($file) . '/' . $dest_file, $quality);
        imagedestroy($bg);
      }
    }
  }

  return $image_data;
}

// Disable RSS Feeds
function wp_disable_feeds() {
    wp_die( __('No feeds available!') );
}
      
add_action('do_feed', 'wp_disable_feeds', 1);
add_action('do_feed_rdf', 'wp_disable_feeds', 1);
add_action('do_feed_rss', 'wp_disable_feeds', 1);
add_action('do_feed_rss2', 'wp_disable_feeds', 1);
add_action('do_feed_atom', 'wp_disable_feeds', 1);
add_action('do_feed_rss2_comments', 'wp_disable_feeds', 1);
add_action('do_feed_atom_comments', 'wp_disable_feeds', 1);

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_resource_hints', 2, 99 ); 
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'rsd_link');
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10);
remove_action( 'template_redirect', 'wp_shortlink_header', 11);

// Disable the emoji's
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

// Filter out the tinymce emoji plugin.
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

function netscape_remove_block_library_css(){
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'global-styles' );
} 
add_action( 'wp_enqueue_scripts', 'netscape_remove_block_library_css' );

?>