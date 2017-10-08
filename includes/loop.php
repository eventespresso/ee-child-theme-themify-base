<?php
/**
 * Template for generic post display.
 * @package themify
 * @since 1.0.0
 */

// Enable more link
if ( ! is_single() ) {
	global $more;
	$more = 0;
}
?>

<?php themify_base_post_before(); // hook ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
	
	<?php themify_base_post_start(); // hook ?>
		
	<?php themify_base_before_post_image(); // Hook ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="post-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail( 'medium' ); ?>
			</a>
		</figure>
	<?php endif; // has post thumbnail ?>

	<?php themify_base_after_post_image(); // Hook ?>

	<div class="post-content">
		<?php 
			if ( 'espresso_events' == get_post_type() && is_front_page() && function_exists( 'espresso_event_date'  ) ) :
				?>
				<time datetime="<?php echo espresso_event_date( '', '', get_the_ID() ); ?>" class="post-date"><?php echo espresso_event_date( '', '', get_the_ID() ); ?></time>
			<?php
			elseif ( 'espresso_venues' == get_post_type() ) :
				echo themify_ee_venue_city_state();
			elseif ( 'espresso_events' != get_post_type() ) : ?>
				<time datetime="<?php the_time('o-m-d') ?>" class="post-date"><?php echo get_the_date( apply_filters( 'themify_loop_date', '' ) ) ?></time>
			<?php endif ?>
			
		
		<?php themify_base_before_post_title(); // Hook ?>
		<h1 class="post-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		</h1>
		<?php themify_base_after_post_title(); // Hook ?>

		<?php if ( ! is_attachment() && ! is_singular( array( 'espresso_events', 'espresso_venues' ) ) && ! is_post_type_archive ( array( 'espresso_events', 'espresso_venues' ) ) ) : ?>
			<p class="post-meta">
				<span class="post-author"><?php the_author_posts_link(); ?></span>

				<?php the_terms( get_the_ID(), 'category', ' <span class="post-category">', ', ', '</span>' ); ?>

				<?php the_tags( ' <span class="post-tag">', ', ', '</span>' ); ?>

				<?php if ( comments_open() ) : ?>
					<span class="post-comment">
						<?php comments_popup_link( __( '0 Comments', 'themify' ), __( '1 Comment', 'themify' ), __( '% Comments', 'themify' ) ); ?>
					</span>
				<?php endif; //post comment ?>
			</p><!-- /.post-meta -->
			<?php if ( 'espresso_events' == get_post_type() && is_front_page() && function_exists( 'espresso_view_details_btn'  ) ) : ?>	
					<form action="<?php the_permalink(); ?>" method="POST">
						<input id="ticket-selector-submit-<?php the_ID(); ?>-btn" class="ticket-selector-submit-btn view-details-btn" type="submit" value="<?php _e( 'View Details' );?>">
					</form>
					<div class="clear"><br></div>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( is_singular() ) : ?>
			<?php the_content(); ?>
		<?php else: ?>
			<?php $entry_content_display = themify_base_get( 'setting-default_archive_content', 'full' ); ?>
			<?php if ( 'full' == $entry_content_display ) : ?>
				<?php the_content(); ?>
			<?php elseif ( 'excerpt' == $entry_content_display ) : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php edit_post_link(__('Edit', 'themify'), '<span class="edit-button">[', ']</span>'); ?>
		
	</div>
	<!-- /.post-content -->

	<?php themify_base_post_end(); // hook ?>
	
</article>
<!-- /.post -->

<?php themify_base_post_after(); // hook ?>