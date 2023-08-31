<header id="masthead" class="site-header header-three" style="background-image: url(<?php echo esc_url( get_header_image() ); ?>);">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-md-3 align-self-center">
				<div class="site-branding">
					<?php
					if ( has_custom_logo() ) :
						the_custom_logo();
					endif;
					?>
				</div><!-- .site-branding -->
			</div>
			<div class="align-self-center text-center menu-wrap">
				<div class="cssmenu" id="cssmenu">
					<?php
						wp_nav_menu(
							array(
								'theme_location'    => 'main-menu',
								'container'         => 'ul',
							)
						);
						?>
				</div>
                <ul class="header-languages">
                    <?php pll_the_languages( ['show_flags' => 1,'show_names' => 0 ] ); ?>
                </ul>

            </div>
			<?php if (null != tech_blogging_social_activity()) : ?>
			<div class="col-md-3 align-self-center">
				<div class="social-link-top">
					<?php
					tech_blogging_social_activity();
					 ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</header><!-- #masthead -->
<div class="searchform-area">
	 <div class="search-close">
		 <i class="fa fa-close"></i>
	 </div>
	 <div class="search-form-inner">
		 <div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>
 </div>
