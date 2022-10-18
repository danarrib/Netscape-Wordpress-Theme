<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<TABLE><TR><TD>
<?php // custom-featured-image
the_post_thumbnail('thumbnail', ['align' => 'left']); ?>
<H2>
    <A HREF="<?php the_permalink() ?>" REL="bookmark" TITLE="<?php printf(__('Permanent Link to %s', 'netscape'), the_title_attribute('echo=0')); ?>">
        <?php the_title(); ?>
    </A>
</H2>
<P><?php the_time(__('F jS, Y', 'netscape')) ?> - <?php the_author() ?></P>
<?php the_content(__('Read the rest of this entry &raquo;', 'netscape')); ?>
</TD></TR></TABLE>
<?php endwhile; ?>

<?php next_posts_link(__('&laquo; Older Entries', 'netscape')) ?> - 
<?php previous_posts_link(__('Newer Entries &raquo;', 'netscape')) ?>

<?php else : ?>

<H2><?php _e('Not Found', 'netscape'); ?></H2>
<P><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'netscape'); ?></P>

<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>