<H2><?php _e('Search'); ?></H2>
<form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
		<input type="text" name="s" id="s" size="15" /><br />
		<input type="submit" value="<?php _e('Search'); ?>" />
</form>

<H2><?php _e('Categories'); ?></H2>
<UL><?php wp_list_cats('sort_column=namonthly'); ?></UL>

<H2><?php _e('Archives'); ?></H2>
<UL><?php wp_get_archives(); ?></UL>
