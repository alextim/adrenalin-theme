<?php
/*
Theme Name:    Alpclub Odessa
Template Name: Single Trip
Template Post Type: trip
*/

if (!AT_TRIP_USE_GOOGLE_FORMS) {
	if (class_exists('AT_Process_ContactForm')) {
		$at_cf = new AT_Process_ContactForm(true, true); 
		if ( $at_cf->is_submit_enabled() ) {
			wp_enqueue_style('aco-contact_form', get_stylesheet_directory_uri() . '/css/contact-form.css' );
		}
	}
}

get_header(); 

while ( have_posts() ) : the_post();
	global $post;
	
	$tripView = new \AT_Trip\TripView( $post );
?>		
	<div class="container single-trip">
		<div class="row">
			<div class="column column-7">
				<?php surya_chandra_single_post_thumbnail(); ?>
			</div>

			<div class="column column-5">
				<div class="container">
					<h2><?php the_title(); ?></h2>
					<div class="trip-brief">
						<?php $tripView->print_all_info(); ?>
					</div><!-- .trip-brief -->
					
					<?php if (AT_TRIP_USE_GOOGLE_FORMS) : ?>
						<div>
							<?php $tripView->print_registration_url('Регистрация', 'reg-form-button', 'custom-button reg-form-button' ); ?>
						</div>
					<?php endif; ?>
					
				</div>
			</div>
		</div>
		
<?php			
		$tabs = $tripView->get_tabs();
		if ($tabs) :
			if (!AT_TRIP_USE_GOOGLE_FORMS) {
				$form_is_active = false;
				
				if (class_exists('AT_Process_ContactForm')) {
					if ( $at_cf->is_submit_enabled() ) {
						if( isset($_POST['submitted'])) {
							$form_is_active = true;
						}	
						
						$at_cf->setSubjectField($post->post_title);
						
						if ($at_cf->process_data()) {

							ob_start();
							$at_cf->render_form();
							$contact_form_html = ob_get_contents();
							ob_end_clean();			
							
							$tabs[] = new \AT_Trip\Tab( 'reg-form-tab', 'Записаться', $contact_form_html, 'reg-form-tab' );
						}
					}
				}
			}
					
?>
			<div class="row">
				<div class="column column-12">
					<div class="tabs">
					<?php $is_active = true;
						if (AT_TRIP_USE_GOOGLE_FORMS) {
							foreach( $tabs as $tab ) {
								$tab->render( $is_active );
								if ( $is_active ) {
									$is_active = false;
								}
							}
						} else {
							foreach( $tabs as $tab ) {
								if ($form_is_active) {
									$tab->render( 'reg-form-tab' === $tab->id );
								} else {
									$tab->render( $is_active );
									if ( $is_active ) {
										$is_active = false;
									}
								}
							}
						}

					?>
					</div>
				</div>
			</div>
		
<?php   endif; ?>

<?php $related_trips = $tripView->getRelatedTrips(); ?>
<?php if ( $related_trips ) : ?>
<div class="panel-grid-cell">
<div class="so-panel panel-first-child panel-last-child" data-index="2">
<div class="">
<aside class="section section-latest-news heading-left">
<h3 class="widget-title">Мероприятия</h3>	
<p class="widget-subtitle">Возможно Вас также могут заинтересовать следующие путешествия</p>
<div class="latest-news-section latest-news-col-3">
	<div class="inner-wrapper">
		
	<?php foreach($related_trips as $trip) : ?>
		<div class="latest-news-item latest-news-item-1">
			<div class="latest-news-wrapper">
				<?php if ( has_post_thumbnail($trip) ) : ?>
				<div class="latest-news-thumb">
					<a href="<?php echo get_permalink( $trip );?>">
						<?php echo get_the_post_thumbnail( $trip, 'full'); ?>
						<?php
						//<img width="1024" height="675" src="http://localhost/travel/wp-content/uploads/2018/08/nanda-devi-1024x675.jpg" class="aligncenter wp-post-image" alt="" srcset="http://localhost/travel/wp-content/uploads/2018/08/nanda-devi-1024x675.jpg 1024w, http://localhost/travel/wp-content/uploads/2018/08/nanda-devi-300x198.jpg 300w, http://localhost/travel/wp-content/uploads/2018/08/nanda-devi-768x506.jpg 768w, http://localhost/travel/wp-content/uploads/2018/08/nanda-devi.jpg 1213w" sizes="(max-width: 1024px) 100vw, 1024px">
						?>
					</a>
				</div><!-- .latest-news-thumb -->
				<?php endif; ?>
				
				<div class="latest-news-text-content">
					<div class="news-meta-wrapper">
						
						<h5 class="latest-news-title">
							<a href="<?php echo get_permalink( $trip );?>"><?php echo esc_attr( $trip->post_title );?></a>
						</h5>
					</div> <!-- .news-meta-wrapper -->

				</div><!-- .latest-news-text-content -->
			</div><!-- .latest-news-wrapper -->
		</div><!-- .latest-news-item  -->
	<?php endforeach; ?>
			
			
	<div class="more-wrapper">
		<a href="http://localhost/travel/trips/" class="custom-button">Посмотреть больше</a>
	</div><!-- .more-wrapper -->
	
	</div><!-- .inner-wrapper -->
</div><!-- .latest-news-section -->
</aside><!-- .section-latest-news -->
</div></div></div>
<br>
		
<?php endif; ?>
		
		
<?php				
		echo aco_get_social_buttons();
?>
	</div><!-- .container -->
<?php 
endwhile;
get_footer();