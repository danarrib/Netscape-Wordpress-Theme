<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<H2><?php the_title(); ?></H2>
<?php // custom-featured-image
the_post_thumbnail('medium_large'); ?>

<?php the_content('<p class="serif">' . __('Read the rest of this entry &raquo;', 'netscape') . '</p>'); ?>

<?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'netscape') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

<HR>

<?php the_tags( '<p>' . __('Tags:', 'netscape') . ' ', ', ', '</p>'); ?>

<P><?php printf(__('This entry was posted %1$s on %2$s at %3$s and is filed under %4$s.', 'netscape'), $time_since, get_the_time(__('l, F jS, Y', 'netscape')), get_the_time(), get_the_category_list(', ')); ?></P>

<P>
<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
// Both Comments and Pings are open ?>
<?php printf(__('You can <a href="#respond">leave a response</a>, or <a href="%s" rel="trackback">trackback</a> from your own site.', 'netscape'), trackback_url(false)); ?>

<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
// Only Pings are Open ?>
<?php printf(__('Responses are currently closed, but you can <a href="%s" rel="trackback">trackback</a> from your own site.', 'netscape'), trackback_url(false)); ?>

<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
// Comments are open, Pings are not ?>
<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.', 'netscape'); ?>

<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
// Neither Comments, nor Pings are open ?>
<?php _e('Both comments and pings are currently closed.', 'netscape'); ?>

<?php } edit_post_link(__('Edit this entry', 'netscape'),'','.'); ?>
</P>

<P>
<?php previous_post_link('&laquo; %link') ?> - 
<?php next_post_link('%link &raquo;') ?>
</p>

<HR>

<?php comments_template(); ?>

<?php endwhile; else: ?>

<p><?php _e('Sorry, no posts matched your criteria.', 'netscape'); ?></p>

<?php endif; ?>
<?php get_footer(); ?>


