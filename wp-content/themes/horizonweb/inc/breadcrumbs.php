<?php
/** Breadcrumbs */

function stag_breadcrumbs() {

    $stag_data = stag_dt_data();
 
    $stag_text['home']     = esc_html__('Home', 'stag'); 
    $stag_text['category'] = '%s'; 
    $stag_text['search']   = "%s";
    $stag_text['tag']      = "%s";
    $stag_text['author']   = '%s'; 
    $stag_text['404']      = esc_html__('Error 404', 'stag'); 
 
    $stag_show_current   = 1; 
    $stag_show_on_home   = 0;
    $stag_show_home_link = 1;
    $stag_show_title     = 1;
    $stag_delimiter      = ' <i class="fa fa-angle-right"></i> '; 
    $stag_before         = '<span class="current">';
    $stag_after          = '</span>';
 
    global $post;
    $stag_home_link    = home_url('/');
    $stag_link_before  = '';
    $stag_link_after   = '';
    $stag_link_attr    = '';
    $stag_link         = $stag_link_before . '<a' . $stag_link_attr . ' href="%1$s">%2$s</a>' . $stag_link_after;
    $stag_parent_id    = $stag_parent_id_2 = isset($post) ? $post->post_parent : 0;
    $stag_frontpage_id = get_option('page_on_front');

    $stag_blog_keyword = esc_html__('Blog', 'stag'); 
    $stag_portfolio_keyword = $stag_blog_keyword = esc_html__('Portfolio', 'stag'); 
    if(!empty($stag_data['stag_breadcrumbs_blog_keyword'])) {
        $stag_blog_keyword = $stag_data['stag_breadcrumbs_blog_keyword'];
    }
    if(!empty($stag_data['stag_breadcrumbs_portfolio_keyword'])) {
        $stag_portfolio_keyword = $stag_data['stag_breadcrumbs_portfolio_keyword'];
    }    
 
    if (is_home() || is_front_page()) {
 
        if ($stag_show_on_home == 1) echo '<span class="current">' . $stag_text['home'] . '</span>';
 
    } else {
 
        if ($stag_show_home_link == 1) {
            echo sprintf($stag_link, $stag_home_link, $stag_text['home']);
            if ($stag_frontpage_id == 0 || $stag_parent_id != $stag_frontpage_id) echo $stag_delimiter;
        }
 
        if ( is_category() ) {
            $stag_this_cat = get_category(get_query_var('cat'), false);
            if ($stag_this_cat->parent != 0) {
                $stag_cats = get_category_parents($stag_this_cat->parent, TRUE, $stag_delimiter);
                if ($stag_show_current == 0) $stag_cats = preg_replace("#^(.+)$stag_delimiter$#", "$1", $stag_cats);
                $stag_cats = str_replace('<a', $stag_link_before . '<a' . $stag_link_attr, $stag_cats);
                $stag_cats = str_replace('</a>', '</a>' . $stag_link_after, $stag_cats);
                if ($stag_show_title == 0) $stag_cats = preg_replace('/ title="(.*?)"/', '', $stag_cats);
                echo $stag_cats;
            }
            if ($stag_show_current == 1) echo $stag_before . sprintf($stag_text['category'], single_cat_title('', false)) . $stag_after;
 
        } elseif ( is_search() ) {
            echo $stag_before . sprintf($stag_text['search'], get_search_query()) . $stag_after;
 
        } elseif ( is_day() ) {
            echo sprintf($stag_link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $stag_delimiter;
            echo sprintf($stag_link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $stag_delimiter;
            echo $stag_before . get_the_time('d') . $stag_after;
 
        } elseif ( is_month() ) {
            echo sprintf($stag_link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $stag_delimiter;
            echo $stag_before . get_the_time('F') . $stag_after;
 
        } elseif ( is_year() ) {
            echo $stag_before . get_the_time('Y') . $stag_after;
 
        } elseif ( is_single() && !is_attachment() ) {
             if ( get_post_type() == 'post' ) {
                if(!empty($stag_data['stag_breadcrumbs_blog_url'])) {
                    echo '<a href="' . esc_url($stag_data['stag_breadcrumbs_blog_url']) . '">' . $stag_blog_keyword . '</a> ' . $stag_delimiter . ' ';
                }
                echo $stag_before . get_the_title() . $stag_after;
            }
            else
            if ( get_post_type() == 'portfolio' ) {
                if(!empty($stag_data['stag_breadcrumbs_blog_url'])) {
                    echo '<a href="' . esc_url($stag_data['stag_breadcrumbs_portfolio_url']) . '">' . $stag_portfolio_keyword . '</a> ' . $stag_delimiter . ' ';
                }
                echo $stag_before . get_the_title() . $stag_after;
            }   

             else {
                $stag_cat = get_the_category(); $stag_cat = $stag_cat[0];
                if ($stag_cat->cat_ID != 1) { //Не показывать категорию "Без рубрики"
                    $stag_cats = get_category_parents($stag_cat, TRUE, $stag_delimiter);
                    if ($stag_show_current == 0) $stag_cats = preg_replace("#^(.+)$stag_delimiter$#", "$1", $stag_cats);
                    $stag_cats = str_replace('<a', $stag_link_before . '<a' . $stag_link_attr, $stag_cats);
                    $stag_cats = str_replace('</a>', '</a>' . $stag_link_after, $stag_cats);
                    if ($stag_show_title == 0) $stag_cats = preg_replace('/ title="(.*?)"/', '', $stag_cats);
                    echo $stag_cats;
                }
                if ($stag_show_current == 1) echo $stag_before . get_the_title() . $stag_after;
            }
 
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $stag_post_type = get_post_type_object(get_post_type());
            echo $stag_before . $stag_post_type->labels->singular_name . $stag_after;
 
        } elseif ( is_attachment() ) {
            $stag_parent = get_post($stag_parent_id);
            $stag_cat = get_the_category($stag_parent->ID); $stag_cat = $stag_cat[0];
            $stag_cats = get_category_parents($stag_cat, TRUE, $stag_delimiter);
            $stag_cats = str_replace('<a', $stag_link_before . '<a' . $stag_link_attr, $stag_cats);
            $stag_cats = str_replace('</a>', '</a>' . $stag_link_after, $stag_cats);
            if ($stag_show_title == 0) $stag_cats = preg_replace('/ title="(.*?)"/', '', $stag_cats);
            echo $stag_cats;
            printf($stag_link, get_permalink($stag_parent), $stag_parent->post_title);
            if ($stag_show_current == 1) echo $stag_delimiter . $stag_before . get_the_title() . $stag_after;
 
        } elseif ( is_page() && !$stag_parent_id ) {
            if ($stag_show_current == 1) echo $stag_before . get_the_title() . $stag_after;
 
        } elseif ( is_page() && $stag_parent_id ) {
            if ($stag_parent_id != $stag_frontpage_id) {
                $stag_breadcrumbs = array();
                while ($stag_parent_id) {
                    $page = get_page($stag_parent_id);
                    if ($stag_parent_id != $stag_frontpage_id) {
                        $stag_breadcrumbs[] = sprintf($stag_link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $stag_parent_id = $page->post_parent;
                }
                $stag_breadcrumbs = array_reverse($stag_breadcrumbs);
                for ($stag_i = 0; $stag_i < count($stag_breadcrumbs); $stag_i++) {
                    echo $stag_breadcrumbs[$stag_i];
                    if ($stag_i != count($stag_breadcrumbs)-1) echo $stag_delimiter;
                }
            }
            if ($stag_show_current == 1) {
                if ($stag_show_home_link == 1 || ($stag_parent_id_2 != 0 && $stag_parent_id_2 != $stag_frontpage_id)) echo $stag_delimiter;
                echo $stag_before . get_the_title() . $stag_after;
            }
 
        } elseif ( is_tag() ) {
            echo $stag_before . sprintf($stag_text['tag'], single_tag_title('', false)) . $stag_after;
 
        } elseif ( is_author() ) {
            global $author;
            $stag_userdata = get_userdata($author);
            echo $stag_before . sprintf($stag_text['author'], $stag_userdata->display_name) . $stag_after;
 
        } elseif ( is_404() ) {
            echo $stag_before . $stag_text['404'] . $stag_after;
        }
 
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo esc_html__('Page', 'stag') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
 
    }
}
?>