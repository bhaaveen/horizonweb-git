 		<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
			<label>
				<span class="screen-reader-text"><?php echo esc_html__( 'Search for:', 'stag' ) ?></span>
				<input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'search...', 'stag' ) ?>" value="<?php echo esc_attr(get_search_query()) ?>" name="s" title="<?php echo esc_attr__( 'Search for:', 'stag' ) ?>" />
			</label>

		</form>