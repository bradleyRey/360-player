<?php get_header(); ?>

<?php
$video = get_field('video');
var_dump($video);
?>

<div id="video" class="valiant" data-video-src="<?php echo get_stylesheet_directory_uri(); ?>/js/valiant360/overpass-clip.mp4"></div>

<aside id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( have_rows('sidebar_groups') ) : ?>
	<ul id="modules">

	<?php while( have_rows('sidebar_groups') ): the_row();
		$start_time = ( isset( $end_time ) ? $end_time : 0 ); // Set start time to previous end time if exists, otherwise set to 0.
		$end_time = get_sub_field('end_time');
		?>

		<li class="module" style="display: none;" data-start="<?php echo $start_time; ?>" data-end="<?php echo $end_time; ?>">
		<?php if ( have_rows('group_modules') ) : ?>

			<?php while ( have_rows('group_modules') ) : the_row(); ?>
				<?php $layout = get_row_layout(); ?>
				<div class="<?php echo $layout; ?>">
					<?php
					switch ( $layout ) :
						case 'tweet':
							the_sub_field('url');
							break;
						case 'gallery':
							var_dump(get_sub_field('gallery'));
							break;
						case 'post':
							echo '<h2>' . get_sub_field('title') . '</h2>';
							the_sub_field('subtitle');
							break;
					endswitch;
					?>
				</div>
			<?php endwhile; ?>

		<?php endif; ?>
		</li>

	<?php endwhile; ?>

	</ul>

<?php endif; ?>
</aside>
