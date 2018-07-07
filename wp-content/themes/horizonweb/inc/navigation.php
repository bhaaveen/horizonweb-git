<?php
/*

Posts Navigation Function

*/
function stag_navigation($stag_pages = '', $stag_range = 2)
{
	$stag_show_items = ($stag_range * 2)+1; 

	global $paged;
	if(empty($paged)) $paged = 1;

	if($stag_pages == '')
	{
		global $wp_query, $stag_blog_query;
		if (is_page_template('template-blog.php')) {
			$stag_pages = $stag_blog_query->max_num_pages;
		}
		else $stag_pages = $wp_query->max_num_pages;
		if(!$stag_pages)
		{
		 $stag_pages = 1;
		}
	}  

	if(1 != $stag_pages)
		{
		echo "<div class=\"pagenav\">";
		if($paged > 2 && $paged > $stag_range+1 && $stag_show_items < $stag_pages) echo "<a href='".esc_url(get_pagenum_link(1))."'>".esc_html__('&laquo;', 'stag')." ".esc_html__('First', 'stag')."</a>";
		if($paged > 1 && $stag_show_items < $stag_pages) echo "<a href='".esc_url(get_pagenum_link($paged - 1))."'>".esc_html__('&lsaquo;', 'stag')." ".esc_html__('Previous', 'stag')."</a>";

		for ($i=1; $i <= $stag_pages; $i++)
		{
			if (1 != $stag_pages &&( !($i >= $paged+$stag_range+1 || $i <= $paged-$stag_range-1) || $stag_pages <= $stag_show_items ))
				{
					 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".esc_url(get_pagenum_link($i))."' class=\"inactive\">".$i."</a>";
				}
		}

		if ($paged < $stag_pages && $stag_show_items < $stag_pages) echo "<a href=\"".esc_url(get_pagenum_link($paged + 1))."\">".esc_html__('&rsaquo;', 'stag')."</a>";
		if ($paged < $stag_pages-1 &&  $paged+$stag_range-1 < $stag_pages && $stag_show_items < $stag_pages) echo "<a href='".esc_url(get_pagenum_link($stag_pages))."'>".esc_html__('&raquo;', 'stag')."</a>";
		echo "</div>\n";
		}
	}
?>