<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Stag Theme
 */

get_header(); ?>

	<div class="page-title-wrapper">
		<div class="container">
			<h1><?php esc_html_e('OOOOOOPS', 'stag'); ?></h1>
		</div>
	</div>

	<div class="space"></div>

	<div class="container">
		<section>
			<article>
				<h1 class="aligncenter"><?php esc_html_e('Error 404 - Not Found', 'stag'); ?></h1>
				<h4 class="aligncenter"><?php esc_html_e('Sorry, but the requested resource was not found on this site. Please try again or contact the administrator for assistance.', 'stag'); ?></h4>
				<div class="space"></div>
				<p class="aligncenter"><?php esc_html_e('Are you looking for something?', 'stag'); ?></p>
				<div class="no-page"><?php get_search_form(); ?></div>
				<div class="space"></div>
			</article>
		</section>
	</div>

<?php get_footer(); ?>
