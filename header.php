<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
<HEAD>
    <TITLE><?php
        if(is_front_page() || is_home())
        {
			echo get_bloginfo('name');
		}
        else
        {
			echo wp_title('') . ' | ' . get_bloginfo('name');
		}
        ?></TITLE>
    <META HTTP-EQUIV="Content-Type" CONTENT="<?php bloginfo('html_type'); ?>;charset=ISO-8859-1"></META>
    <META NAME="viewport" CONTENT="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</HEAD>
<BODY>
    <H1><A HREF="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></A></H1>
    <P><?php bloginfo('description'); ?></P>
