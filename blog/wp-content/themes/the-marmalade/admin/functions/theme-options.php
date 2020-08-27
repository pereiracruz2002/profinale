<?php 

	if ( ! function_exists( 'pryanik_init_custom_options' ) ) :
		function pryanik_init_custom_options(){
			
			add_option("site_layout", 'fullwidth', '', 'yes');
			add_option("add_loader", false, '', 'yes');

			add_option("logo_position", 'center', '', 'yes');
			add_option("logo_padding_top", 30, '', 'yes');
			add_option("logo_padding_bottom", 30, '', 'yes');
			add_option("logo_background_color", '#ffffff', '', 'yes');

			add_option("hide_menu", false, '', 'yes');
			add_option("menu_position", 'after', '', 'yes');
			add_option("menu_float", 'center', '', 'yes');
			add_option("menu_padding_top", 15, '', 'yes');
			add_option("menu_padding_bottom", 15, '', 'yes');
			add_option("menu_background_color", '#fff', '', 'yes');
			add_option("menu_li_padding", 30, '', 'yes');
			add_option("menu_font_family", 'Playfair Display', '', 'yes');
			add_option("menu_font_weight", true, '', 'yes');
			add_option("menu_text_transform", false, '', 'yes');
			add_option("menu_italic", false, '', 'yes');
			add_option("menu_font_size", 16, '', 'yes');
			add_option("menu_letterspacing", 0, '', 'yes');
			add_option("menu_lineheight", 1.9, '', 'yes');
			add_option("menu_color", '#222', '', 'yes');

			add_option("add_search", true, '', 'yes');
			add_option("search_type", 'default', '', 'yes');
			add_option("add_toggle", true, '', 'yes');
			add_option("search_position", 'logo', '', 'yes');
			add_option("search_color", '#222', '', 'yes');
			add_option("divider_color", '#ddd', '', 'yes');

			add_option("select_toggle_sidebar", 'post_sidebar2', '', 'yes');
			add_option("toggle_sidebar_color", '#222', '', 'yes');
			add_option("toggle_sidebar_widgets_color", 'dark', '', 'yes');
			add_option("toggle_sidebar_width", 500, '', 'yes');

			add_option("blog_type", 'grid', '', 'yes');
			add_option("blog_sidebar_layout", 'right', '', 'yes');
			add_option("blog_sidebar", 'blog_sidebar1', '', 'yes');
			add_option("blog_layout", '2col', '', 'yes');
			add_option("blog_order", 'last', '', 'yes');
			add_option("blog_pagination", 'short', '', 'yes');

			add_option("post_page_sidebar_layout", 'right', '', 'yes');
			add_option("post_page_sidebar", 'post_sidebar1', '', 'yes');
			add_option("post_title_padding_top", 90, '', 'yes');
			add_option("post_title_padding_bottom", 90, '', 'yes');

			add_option("search_grid_type", 'grid', '', 'yes');
			add_option("search_sidebar_layout", 'none', '', 'yes');
			add_option("search_sidebar", 'blog_sidebar2', '', 'yes');
			add_option("search_layout", '3col', '', 'yes');

			add_option("category_type", 'grid', '', 'yes');
			add_option("category_sidebar_layout", 'right', '', 'yes');
			add_option("category_sidebar", 'blog_sidebar3', '', 'yes');
			add_option("category_layout", '2col', '', 'yes');
			add_option("category_pagination", 'short', '', 'yes');

			add_option("show_title", 'always', '', 'yes');
			add_option("show_content", 'always', '', 'yes');
			add_option("show_counters", 'always', '', 'yes');
			add_option("show_share", 'always', '', 'yes');
			add_option("show_related", 'post', '', 'yes');
			add_option("show_author", true, '', 'yes');
			add_option("hide_nav", false, '', 'yes');

			add_option("background_color", '#fff', '', 'yes');
			add_option("background_stretch", 'false', '', 'yes');
			add_option("background_repeat", 'repeat', '', 'yes');
			add_option("background_position", 'center', '', 'yes');
			add_option("background_attachment", 'fixed', '', 'yes');

			add_option("skin_color1", '#cea97c', '', 'yes');
			add_option("skin_color2", '#f51746', '', 'yes');

			add_option("body_font_family", 'Hind', '', 'yes');
			add_option("body_font_size", 14, '', 'yes');

			add_option("h1_font_family", 'Playfair Display', '', 'yes');
			add_option("h1_font_weight", false, '', 'yes');
			add_option("h1_text_transform", false, '', 'yes');
			add_option("h1_italic", false, '', 'yes');
			add_option("h1_font_size", 60, '', 'yes');
			add_option("h1_letterspacing", -1, '', 'yes');

			add_option("h2_font_family", 'Playfair Display', '', 'yes');
			add_option("h2_font_weight", false, '', 'yes');
			add_option("h2_text_transform", false, '', 'yes');
			add_option("h2_italic", false, '', 'yes');
			add_option("h2_font_size", 36, '', 'yes');
			add_option("h2_letterspacing", -1, '', 'yes');

			add_option("h3_font_family", 'Playfair Display', '', 'yes');
			add_option("h3_font_weight", false, '', 'yes');
			add_option("h3_text_transform", false, '', 'yes');
			add_option("h3_italic", false, '', 'yes');
			add_option("h3_font_size", 24, '', 'yes');
			add_option("h3_letterspacing", -1, '', 'yes');

			add_option("h4_font_family", 'Playfair Display', '', 'yes');
			add_option("h4_font_weight", false, '', 'yes');
			add_option("h4_text_transform", false, '', 'yes');
			add_option("h4_italic", false, '', 'yes');
			add_option("h4_font_size", 18, '', 'yes');
			add_option("h4_letterspacing", -1, '', 'yes');

			add_option("h5_font_family", 'Montserrat', '', 'yes');
			add_option("h5_font_weight", false, '', 'yes');
			add_option("h5_text_transform", true, '', 'yes');
			add_option("h5_italic", false, '', 'yes');
			add_option("h5_font_size", 14, '', 'yes');
			add_option("h5_letterspacing", -1, '', 'yes');

			add_option("h6_font_family", 'Playfair Display', '', 'yes');
			add_option("h6_font_weight", false, '', 'yes');
			add_option("h6_text_transform", false, '', 'yes');
			add_option("h6_italic", false, '', 'yes');
			add_option("h6_font_size", 12, '', 'yes');
			add_option("h6_letterspacing", -1, '', 'yes');

			add_option("buttons_font_family", 'Hind', '', 'yes');
			add_option("buttons_font_weight", false, '', 'yes');
			add_option("buttons_text_transform", false, '', 'yes');
			add_option("buttons_italic", false, '', 'yes');
			add_option("buttons_xs_font_size", 10, '', 'yes');
			add_option("buttons_sm_font_size", 12, '', 'yes');
			add_option("buttons_font_size", 14, '', 'yes');
			add_option("buttons_lg_font_size", 18, '', 'yes');
			add_option("buttons_border_radius", 0, '', 'yes');
			add_option("buttons_border_width", 1, '', 'yes');

			add_option("footer_color", '#222', '', 'yes');
			add_option("footer_widgets_color", 'dark', '', 'yes');
			add_option("footer_widgets", 'footer_widgets1', '', 'yes');
			add_option("footer_layout", '3col', '', 'yes');
			add_option("copyright_text", '&copy; ' . date('Y') . ' Pryanik', '', 'yes');

			add_option("add_instagram_fullwidth", false, '', 'yes');
			add_option("instagram_user", '', '', 'yes');
			add_option("instagram_cols", '8', '', 'yes');
			add_option("instagram_rows", '1', '', 'yes');
			add_option("add_instagram_hover", false, '', 'yes');

		    $categories = get_terms('category');

		    if ($categories) {
		    	foreach ($categories as $category) {
					$t_id = $category->term_id;
					$term_meta = array('title_img' => '');
					add_option( "taxonomy_$t_id",$term_meta );
				}
		    }
		}
	endif;
    
    add_action('init', 'pryanik_init_custom_options');
 ?>