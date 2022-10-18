<HR>

<!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
<P>
<?php printf(__('%1$s is proudly powered by %2$s', 'netscape'), get_bloginfo('name'),
'<a href="http://wordpress.org/">WordPress</a>'); ?>
<!-- <?php printf(__('%d queries. %s seconds.', 'netscape'), get_num_queries(), timer_stop(0, 3)); ?> -->
</P>

<?php wp_footer(); ?>
</BODY>
</HTML>