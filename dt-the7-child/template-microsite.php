<?php
/**
 * Mirosite template.
 *
 * @package the7
 * @since 3.0.0
 */

/* Template Name: Microsite */

if ( ! defined( 'ABSPATH' ) ) { exit; }

presscore_config()->set( 'template', 'microsite' );
get_header(); ?>

		<?php // Custom Factor1 homepage ?>
		<?php if (true == get_field( 'factor1_homepage' )) : ?>
				<?php $hero_bg = get_field('hero_image') ? sprintf('style="background-image: url(%s)"', get_field('hero_image')['url']) : ''; ?>
				<div id="f1-home">
						<section id="f1-hero" class="stripe" <?php echo $hero_bg; ?>>
		            <div class="wrapper">
		                <h1 class="f1-hero_title"><?php the_field( 'hero_title' ); ?></h1>
		                <p class="f1-hero_content"><?php the_field( 'hero_content' ); ?></p>

		                <?php if (true == get_field( 'hero_button' )) : ?>
		                    <a class="f1-button" href="<?php echo get_acf_link('hero_button_internal', 'hero_button_external'); ?>"><?php the_field( 'hero_button_text' ); ?></a>
		                <?php endif; ?>
		            </div>
						</section>

						<section id="f1-body">
							<div id="f1-content">
									<?php $body_img = get_field('body_image') ? sprintf('style="background: url(%s) top center/cover no-repeat"', get_field('body_image')['sizes']['large']) : ''; ?>
									<div class="f1-content_image" <?php echo $body_img; ?>></div>
									<div class="f1-content_content">
											<?php the_field('body_content'); ?>
									</div>
							</div>

							<?php if ( have_rows( 'features' ) ) : ?>
									<div id="f1-features">
											<?php while ( have_rows( 'features' ) ) : the_row(); ?>
												<?php $feature_img = get_sub_field('feature_image') ? sprintf('style="background: url(%s) center center/cover no-repeat"', get_sub_field('feature_image')['sizes']['medium_large']) : ''; ?>
												<?php $feature_color = ('dark' == get_sub_field('feature_color')) ? 'color-darkgray' : 'color-white'; ?>
												<?php $feature_link = (true == get_sub_field( 'feature_link' )) ? sprintf('href="%s"', get_sub_field( 'feature_page' )) : ''; ?>

			                  <a class="f1-feature <?php echo $feature_color; ?>" <?php echo $feature_link; echo $feature_img; ?>>
			                      <h3 class="f1-feature_title"><?php the_sub_field( 'feature_title' ); ?></h3>
														<p><?php the_sub_field( 'feature_content' ); ?></p>
												</a>
											<?php endwhile; ?>
									</div>
							<?php endif; ?>
						</section>
				</div>
		<?php endif; ?>

		<?php // The rest of the Visual Composer content ?>
		<?php if ( presscore_is_content_visible() ): ?>

			<div id="content" class="content" role="main">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<?php do_action('presscore_before_loop'); ?>

					<?php the_content(); ?>

					<?php presscore_display_share_buttons_for_post( 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'microsite' ); ?>

			<?php endif; ?>

			</div><!-- #content -->

			<?php do_action('presscore_after_content'); ?>

		<?php endif; // if content visible ?>

<?php get_footer(); ?>
