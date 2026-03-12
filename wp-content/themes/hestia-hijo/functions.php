<?php 
function my_theme_enqueue_styles() { 
$parent_style = 'hestia'; // carpeta del tema Padre 
wp_enqueue_style( $parent_style, get_template_directory_uri() . 
'/style.css' ); 
wp_enqueue_style( 'child-style', 
get_stylesheet_directory_uri() . '/style.css', 
array( $parent_style ), 
wp_get_theme()->get('Version') 
); 
} 
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function hestia_hijo_section_priority( $priority, $section ) {
	if ( $section === 'hestia_about' ) {
		return 61;
	}
	return $priority;
}
add_filter( 'hestia_section_priority', 'hestia_hijo_section_priority', 10, 2 );

add_action( 'wp_footer', 'hestia_hijo_add_section_classes', 50 );
function hestia_hijo_add_section_classes() {
	if ( ! is_front_page() ) {
		return;
	}
	?>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var blog = document.getElementById('blog');
			if (blog) {
				blog.classList.add('bio-videos');
			}
			var about = document.getElementById('about');
			if (about) {
				about.classList.add('acerca');
			}
			var cards = document.querySelectorAll('.hestia-about .wp-block-themeisle-blocks-advanced-columns.acerca, .hestia-about .wp-block-themeisle-blocks-advanced-columns.contacto');
			cards.forEach(function (card) {
				if (!card.querySelector('.fold-vert')) {
					var line = document.createElement('span');
					line.className = 'fold-vert';
					card.appendChild(line);
				}
				if (!card.querySelector('.fold-fill')) {
					var fill = document.createElement('span');
					fill.className = 'fold-fill';
					card.appendChild(fill);
				}
				if (!card.querySelector('.pin-image')) {
					var pinImage = document.createElement('span');
					pinImage.className = 'pin-image';
					card.appendChild(pinImage);
				}
			});
		});
	</script>
	<?php
}

add_action( 'wp_footer', 'hestia_hijo_inline_card_styles', 60 );
function hestia_hijo_inline_card_styles() {
	if ( ! is_front_page() ) {
		return;
	}
	?>
	<style>
		.home .main-raised > section.hestia-about,
		.hestia-about {
			background-color: var(--hestia-primary-color, #f4911f) !important;
		}
		.hestia-about .container,
		.hestia-about .hestia-about-content {
			background: transparent !important;
		}
		.hestia-about .wp-block-themeisle-blocks-advanced-columns.acerca,
		.hestia-about .wp-block-themeisle-blocks-advanced-columns.contacto {
			position: relative !important;
			border: 2px solid var(--hestia-primary-color, #f4911f) !important;
			border-radius: 22px !important;
			overflow: visible !important;
			background: #ffffff !important;
			padding: 70px 80px !important;
		}
		.hestia-about .wp-block-themeisle-blocks-advanced-columns.acerca::before,
		.hestia-about .wp-block-themeisle-blocks-advanced-columns.contacto::before {
			content: "" !important;
			position: absolute !important;
			top: 70px !important;
			right: -4px !important;
			width: 100px !important;
			height: 2px !important;
			background: #f4911f !important;
			transform: rotate(45deg) !important;
			transform-origin: top right !important;
			z-index: 3 !important;
			pointer-events: none !important;
		}
		.hestia-about .wp-block-themeisle-blocks-advanced-columns.acerca::after,
		.hestia-about .wp-block-themeisle-blocks-advanced-columns.contacto::after {
			content: "" !important;
			position: absolute !important;
			top: 72px !important;
			right: -4px !important;
			width: 78px !important;
			height: 78px !important;
			border-top: 2px solid #f4911f !important;
			border-right: 2px solid #f4911f !important;
			background: transparent !important;
			pointer-events: none !important;
		}
		.hestia-about .fold-vert {
			position: absolute !important;
			top: 0px !important;
			right: 72px !important;
			width: 2px !important;
			height: 73px !important;
			background: #f4911f !important;
			z-index: 6 !important;
			pointer-events: none !important;
		}
		.hestia-about .fold-fill {
			position: absolute !important;
			top: 0px !important;
			right: -4px !important;
			width: 78px !important;
			height: 78px !important;
			background: #f4911f !important;
			clip-path: polygon(0 0, 100% 0, 100% 100%) !important;
			z-index: 1 !important;
			pointer-events: none !important;
		}
		.hestia-about .pin-image {
			position: absolute !important;
			top: -2px !important;
			left: 6px !important;
			width: 80px !important;
			height: 80px !important;
			background: url("<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/chincheta.jpg") no-repeat center !important;
			background-size: contain !important;
			z-index: 10 !important;
			pointer-events: none !important;
		}
		.hestia-about .hestia-about-content {
			gap: 90px !important;
		}
		.hestia-about .wp-block-themeisle-blocks-advanced-columns + .wp-block-themeisle-blocks-advanced-columns,
		.hestia-about .contact-card {
			margin-top: 90px !important;
		}
		.hestia-about .contact-plain {
			display: flex !important;
			flex-direction: column !important;
			gap: 10px !important;
			margin: 16px 0 10px !important;
		}
		.hestia-about .contact-plain p {
			margin: 0 !important;
		}
		.hestia-about .contact-plain .contact-icon {
			color: #f4911f !important;
			font-weight: 700 !important;
			margin-right: 8px !important;
		}
	</style>
	<?php
}
?>
