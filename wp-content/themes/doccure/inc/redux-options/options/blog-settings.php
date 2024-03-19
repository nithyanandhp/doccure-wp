<?php
/**
 * Blog Settings
 *
 * @package doccure
 */
return array(
    'title' => esc_html('Blog Settings', 'doccure'),
    'id' => 'blog_settings',
    'icon' => 'el el-blogger',
    'fields' => array(
        array(
            'id' => 'blog-style',
            'type' => 'image_select',
            'title' => esc_html__('Select Blog Style', 'doccure'),
            'subtitle' => esc_html__('Please select the blog style to display.', 'doccure'),
            'options' => array(
               
                'style-7' => array(
                    'alt' => esc_html__('Blog Style 7', 'doccure'),
                    'img' => get_parent_theme_file_uri('assets/images/theme-options/blog-settings/blog-7.jpg'),
                ),
               
            ),
            'default' => 'style-7',
        ),
        array(
            'id' => 'blog_sidebar',
            'type' => 'image_select',
            'title' => esc_html__('Blog Sidebar', 'doccure'),
            'subtitle' => esc_html__('Select the blog sidebar position.', 'doccure'),
            'options' => array(
                'full-width' => array(
                    'alt' => esc_html__('No Sidebar', 'doccure'),
                    'img' => get_parent_theme_file_uri('assets/images/theme-options/blog-settings/full-width.jpg'),
                ),
                'left-sidebar' => array(
                    'alt' => esc_html__('Left Sidebar', 'doccure'),
                    'img' => get_parent_theme_file_uri('assets/images/theme-options/blog-settings/left-sidebar.jpg'),
                ),
                'right-sidebar' => array(
                    'alt' => esc_html__('Right Sidebar', 'doccure'),
                    'img' => get_parent_theme_file_uri('assets/images/theme-options/blog-settings/right-sidebar.jpg'),
                ),
            ),
            'default' => 'right-sidebar',
        ),
        array(
            'id' => 'blog_sidebar_style',
            'type' => 'select',
            'title' => esc_html__('Blog Sidebar Style', 'doccure'),
            'subtitle' => esc_html__('Select the style for blog sidebar.', 'doccure'),
            'options' => array(
                'style-1' => esc_html__('Style 1', 'doccure'),
                'style-2' => esc_html__('Style 2', 'doccure'),
                'style-4' => esc_html__('Style 4', 'doccure'),
                'style-9' => esc_html__('Style 9', 'doccure')
            ),
            'default' => 'style-9',
        ),
        array(
            'id' => 'blog_details_style',
            'type' => 'image_select',
            'title' => esc_html__('Blog Details Style', 'doccure'),
            'subtitle' => esc_html__('Select the blog details style.', 'doccure'),
            'options' => array(
                'style-4' => array(
                    'alt' => esc_html__('Style 4', 'doccure'),
                    'img' => get_parent_theme_file_uri('assets/images/theme-options/blog-settings/details/style-4.jpg'),
                ),
            ),
            'default' => 'style-4',
        ),
        
        
       
        array(
            'id' => 'blog_post_archive_meta',
            'type' => 'divide'
        ),
       
        array(
            'id' => 'show_share',
            'type' => 'switch',
            'title' => esc_html__('Show Post Share', 'doccure'),
            'subtitle' => esc_html__('Enable to show post share.', 'doccure'),
            'default' => true,
            'required' => array('blog-style', '=', 'style-6'),
        ),

        array(
            'id' => 'blog_post_share_meta',
            'type' => 'divide'
        ),
        array(
            'id' => 'facebook_share',
            'type' => 'switch',
            'title' => esc_html__('Facebook Share', 'doccure'),
            'subtitle' => esc_html__('You can share post on facebook.', 'doccure'),
            'default' => false,
        ),
        array(
            'id' => 'twitter_share',
            'type' => 'switch',
            'title' => esc_html__('Twitter Share', 'doccure'),
            'subtitle' => esc_html__('You can share post on twitter', 'doccure'),
            'default' => false,
        ),
        array(
            'id' => 'linkedin_share',
            'type' => 'switch',
            'title' => esc_html__('Linkedin Share', 'doccure'),
            'subtitle' => esc_html__('You can share post on linkedin', 'doccure'),
            'default' => false,
        ),
        array(
            'id' => 'pinterest_share',
            'type' => 'switch',
            'title' => esc_html__('Pinterest Share', 'doccure'),
            'subtitle' => esc_html__('You can share post on pinterest', 'doccure'),
            'default' => false,
        ),
        array(
            'id' => 'tumblr_share',
            'type' => 'switch',
            'title' => esc_html__('Tumblr Share', 'doccure'),
            'subtitle' => esc_html__('You can share post on Tumblr', 'doccure'),
            'default' => false,
        ),
        array(
            'id' => 'skype_share',
            'type' => 'switch',
            'title' => esc_html__('Skype Share', 'doccure'),
            'subtitle' => esc_html__('You can share post on Skype', 'doccure'),
            'default' => false,
        ),
    ),
);
