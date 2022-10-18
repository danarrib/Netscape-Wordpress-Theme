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

?>