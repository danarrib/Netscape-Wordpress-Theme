<?php get_header(); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<H2><?php netscape_the_title(); ?></H2>
<?php netscape_the_content('<p class="serif">' . __('Read the rest of this page &raquo;', 'netscape') . '</p>'); ?>

<?php wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'netscape') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

<?php endwhile; endif; ?>
<?php edit_post_link(__('Edit this entry.', 'netscape'), '<p>', '</p>'); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
