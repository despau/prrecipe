<?php

function prrecipe_twitter_follow_shortcode( $atts, $content = null ){
  $atts         =   shortcode_atts( [ 'handle'    =>  'patronarrecipe' ], $atts);

	return '<a href="https:/twitter.com/' . $atts['handle'] . '"
				class="button button-rounded button-aqua" target="_blank">
				<i class="icon-twitter"></i> ' . do_shortcode($content) . '
			</a>';
}