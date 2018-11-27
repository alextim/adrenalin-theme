<?php
declare(strict_types=1);
/**
 * Template Name: Trip Search
 *
 * This is the custom template that displays Contact Us page
 *
 * @package Alpclub_Odessa
 */



get_header(); 
?>
<div id="content" class="site-content">
	<div class="section section-search">
		<div class="container">
		<?php		
			$search_form = new \AT_Trip\SearchForm( bloginfo('url') . '/travel/trip-search/', 4, '');
			$search_form->render();
			$the_query = $search_form->getQuery();
		?>
		</div>
		<div class="container">
			<h3>
			<?php if ($the_query->have_posts() ) : ?>
				<?php echo $the_query->found_posts . ' listings found'; ?>
			<?php else : ?>
				<span>We found no results</span>
			<?php endif; ?>
			</h3>
		</div>
	</div>
	
	<?php if ($the_query->have_posts() ) : ?>
		<div class="section section-<?php echo AT_TRIP_POST_TYPE; ?>">
			<div class="container">
				<table>
				<tbody>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post();?>
					<tr>
						<?php 
						$post_id = get_the_ID();
						$trip = new \AT_Trip\TripView();
						?>
						 
						<td><?php echo $post_id; ?></td>
						<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
						<td><?php $trip->print_date_range(); ?></td>
					</tr>
				<?php endwhile; ?>
				</tbody>
				</table>
			</div>
		</div>
<div class="row page-navigation">
	 <?php next_posts_link('&laquo; Older Entries', $the_query->max_num_pages) ?>
	 <?php previous_posts_link('Newer Entries &raquo;') ?>
</div>
	<?php endif; ?>
</div><!-- content -->

<?php
wp_reset_postdata();
get_footer();