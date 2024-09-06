<?php
/*
Plugin Name: Multi Video Slider Elementor Addon
Description: A custom Elementor addon for a multi-video slider with YouTube, self-hosted video options, and custom thumbnail & play icons.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Load Elementor Widget
function register_video_slider_widget($widgets_manager) {
    require_once(__DIR__ . '/widgets/video-slider-widget.php');
    $widgets_manager->register(new \Multi_Video_Slider_Widget());
}
add_action('elementor/widgets/register', 'register_video_slider_widget');

function enqueue_video_slider_assets() {
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], null, true);
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', [], null);
    wp_enqueue_script('video-slider-js', plugin_dir_url(__FILE__) . 'assets/js/video-slider.js', ['swiper-js'], null, true);
    wp_enqueue_style('video-slider-css', plugin_dir_url(__FILE__) . 'assets/css/video-slider.css');
}
add_action('wp_enqueue_scripts', 'enqueue_video_slider_assets');
