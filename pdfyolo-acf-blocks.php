<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/sofyansitorus
 * @since             1.0.0
 * @package           ALDS
 *
 * @wordpress-plugin
 * Plugin Name:       Pdfyolo-blocks ACF Blocks

 * Description:       Pdfyolo-blocks ACF Blocks.
 * Version:           1.0.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       alpha
 * Domain Path:       /languages
 *
 * WC requires at least: 3.0.0
 * WC tested up to: 3.7.0
*/
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

if ( !function_exists('get_field') ) {
    die;
}

if ( ! function_exists( 'get_plugin_data' ) ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

function home_blog_page(){
    $heading=get_sub_field('heading');
    $view_more_button=get_sub_field('view_more_button');
    $number_of_posts=get_sub_field('number_of_posts');
	
	$html='';

	$html = '<section class="content-section">
				<header class="section-header">
					<h2 class="h2"><a href="'.$view_more_button['url'].'" class="text-link">'.$heading.'</a></h2>
				';
					if (!empty($view_more_button) && isset($view_more_button)) {
	$html .= '					<a href="'.$view_more_button["url"].'" class="btn btn-primary btn-sm ml-auto"> '.$view_more_button["title"].'</a>';
					}
					
					
	$html .= '	</header>
				<div class="row d-block">
					<div class="col-12">
						<div class="blogsSlider">
							<!-- blog-post -->';
							if(isset($number_of_posts)){
								$args = array(
									'post_type'         => 'post',
									'post_status'       => 'publish',
									'posts_per_page' => $number_of_posts,
									'orderby'           => 'date',
									'order'             =>  "DESC",
								);
								query_posts($args);
								if(have_posts()) {
									while (have_posts()) {
										the_post();
										global $post;
										$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
	$html.='					
										<div class="px-2">
											<a href="'.get_post_permalink($post->ID).'" class="blog-post bg-cover embed-responsive" style="background-image: url('.wp_get_attachment_image_url( $post_thumbnail_id).')">
												<div class="holder-wrap">
													<h3 class="h3">'.get_the_title().'</h3>
												</div>
											</a>

										</div>';
									}
								}
								wp_reset_query();
							}	
	$html.='			</div>
					</div>
				</div>
			</section>';
	return $html;

}



function games_block(){
	$heading=get_sub_field('heading');
    $view_more_button=get_sub_field('view_more_button');
    $number_of_posts=get_sub_field('number_of_posts');

    if (empty($heading)) {
    	$heading='Editors Choice';
    }

    if (empty($number_of_posts)) {
    	$number_of_posts=12;
    }

    $html='';

	$html='<section class="content-section">
				<header class="section-header">
					<h2 class="h2"><a href="'.$view_more_button["url"].'" class="text-link">'.$heading.'</a></h2>';
						if (!empty($view_more_button) && isset($view_more_button)) {
	$html .= '									<a href="'.$view_more_button["url"].'" class="btn btn-primary btn-sm ml-auto"> '.$view_more_button["title"].'</a>';
						}
	$html .= '	</header>
				<div class="row">
					<!-- category-post -->';
					$args = array(
                        'post_type' =>'games',
                        'orderby'           => 'date',
						'order'             =>  "DESC",  
                        'posts_per_page' => $number_of_posts, 
                    );

                    $wc_query = new WP_Query($args);
                    if ( $wc_query->have_posts()) {
                        while ( $wc_query->have_posts() ) {
                            $wc_query->the_post();
                            global $post;
							if(function_exists('get_field')){
								$size=get_field('size',$post->id);
								$author=get_field('author',$post->id);
							}
                            $post_id =$post->id;
                            $img_url = wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'full');

    $html .= '          <div class="col-12 col-sm-6 col-xl-4">
							<a href="'.get_post_permalink().'" class="category-post" title="'.get_the_title().'">
							<div class="cp-wrap">
								<div class="img-wrap">
									<img src="'.$img_url.'" class="img-fluid" alt="image description">
								</div>
								<div class="content-wrap">
									<h6 class="h6">'.get_the_title().'</h6>';
									if(!empty($size)){
	$html .= '							<div class="small text-truncate text-muted">
										<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M567.938 243.908L462.25 85.374A48.003 48.003 0 0 0 422.311 64H153.689a48 48 0 0 0-39.938 21.374L8.062 243.908A47.994 47.994 0 0 0 0 270.533V400c0 26.51 21.49 48 48 48h480c26.51 0 48-21.49 48-48V270.533a47.994 47.994 0 0 0-8.062-26.625zM162.252 128h251.497l85.333 128H376l-32 64H232l-32-64H76.918l85.334-128z"></path></svg>
											<span class="align-middle">'.$size.'</span>
										</div>';
									}
									if(!empty($author)){
	$html .= '								<div class="small text-truncate text-muted">
												<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16"><path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/></svg>
												<span class="align-middle">'.$author.'</span>
											</div>';
									}
	$html .= '					</div>
								
							</div>
						</a>
					</div>';
                        }
                    }	
                    wp_reset_postdata();
	$html .= '
				</div>
			</section>';

	return $html;
}


function editors_choice_block(){
	$heading=get_sub_field('heading');
    $view_more_button=get_sub_field('view_more_button');
    $number_of_posts=get_sub_field('number_of_posts');

    if (empty($heading)) {
    	$heading='Editors Choice';
    }

    if (empty($number_of_posts)) {
    	$number_of_posts=12;
    }

    $html='';

	$html='<section class="content-section">
				<header class="section-header">
					<h2 class="h2"><a href="'.$view_more_button["url"].'" class="text-link">'.$heading.'</a></h2>';
						if (!empty($view_more_button) && isset($view_more_button)) {
	$html .= '									<a href="'.$view_more_button["url"].'" class="btn btn-primary btn-sm ml-auto"> '.$view_more_button["title"].'</a>';
						}
	$html .= '	</header>
				<div class="row">
					<!-- category-post -->';
					$args = array(
                        'post_type' =>array( 'books', 'novels'),
                        'meta_query' => array(
                                            array(
                                                'key'=>'editors_choice',
                                                'value'=>'1',
                                                'compare'=>'IN',
                                            ),
                        ),
                        'orderby'           => 'date',
						'order'             =>  "DESC",  
                        'posts_per_page' => $number_of_posts, 
                    );
                    $wc_query = new WP_Query($args);
                    if ( $wc_query->have_posts()) {
                        while ( $wc_query->have_posts() ) {
                            $wc_query->the_post();
                            global $post;
							if(function_exists('get_field')){
								$size=get_field('size',$post->id);
								$author=get_field('author',$post->id);
							}
                            $post_id =$post->id;
                            $img_url = wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'full');

    $html .= '          <div class="col-12 col-sm-6 col-xl-4">
							<a href="'.get_post_permalink().'" class="category-post" title="'.get_the_title().'">
							<div class="cp-wrap">
								<div class="img-wrap">
									<img src="'.$img_url.'" class="img-fluid" alt="image description">
								</div>
								<div class="content-wrap">
									<h6 class="h6">'.get_the_title().'</h6>';
									if(!empty($size)){
	$html .= '							<div class="small text-truncate text-muted">
										<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M567.938 243.908L462.25 85.374A48.003 48.003 0 0 0 422.311 64H153.689a48 48 0 0 0-39.938 21.374L8.062 243.908A47.994 47.994 0 0 0 0 270.533V400c0 26.51 21.49 48 48 48h480c26.51 0 48-21.49 48-48V270.533a47.994 47.994 0 0 0-8.062-26.625zM162.252 128h251.497l85.333 128H376l-32 64H232l-32-64H76.918l85.334-128z"></path></svg>
											<span class="align-middle">'.$size.'</span>
										</div>';
									}
									if(!empty($author)){
	$html .= '								<div class="small text-truncate text-muted">
												<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16"><path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/></svg>
												<span class="align-middle">'.$author.'</span>
											</div>';
									}
	$html .= '					</div>
								
							</div>
						</a>
					</div>';
                        }
                    }	
                    wp_reset_postdata();
$html .= '
				</div>
			</section>';

	return $html;
}



function novel_block(){
	if(function_exists('get_field')){
		$heading=get_sub_field('heading');
		$view_more_button=get_sub_field('view_more_button');
		$number_of_posts=get_sub_field('number_of_posts');
	}


    if (empty($heading)) {
    	$heading='Novel';
    }

    if (empty($number_of_posts)) {
    	$number_of_posts=12;
    }

    $html='';

	$html='<section class="content-section">
				<header class="section-header">
					<h2 class="h2"><a href="'.$view_more_button["url"].'" class="text-link">'.$heading.'</a></h2>';
						if (!empty($view_more_button) && isset($view_more_button)) {
	$html .= '									<a href="'.$view_more_button["url"].'" class="btn btn-primary btn-sm ml-auto"> '.$view_more_button["title"].'</a>';
						}
	$html .= '	</header>
				<div class="row">
					<!-- category-post -->';
					$args = array(
                        'post_type' =>'novels',
                        'orderby'           => 'date',
						'order'             =>  "DESC",  
                        'posts_per_page' => $number_of_posts, 
                    );
                    $wc_query = new WP_Query($args);
                    if ( $wc_query->have_posts()) {
                        while ( $wc_query->have_posts() ) {
                            $wc_query->the_post();
                            global $post;
							if(function_exists('get_field')){
								$size=get_field('size',$post->id);
								$author=get_field('author',$post->id);
							}
                            $post_id =$post->id;
                            $img_url = wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'full');

    $html .= '          <div class="col-12 col-sm-6 col-xl-4">
							<a href="'.get_post_permalink().'" class="category-post" title="'.get_the_title().'">
							<div class="cp-wrap">
								<div class="img-wrap">
									<img src="'.$img_url.'" class="img-fluid" alt="image description">
								</div>
								<div class="content-wrap">
									<h6 class="h6">'.get_the_title().'</h6>';
									if(!empty($size)){
	$html .= '							<div class="small text-truncate text-muted">
										<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M567.938 243.908L462.25 85.374A48.003 48.003 0 0 0 422.311 64H153.689a48 48 0 0 0-39.938 21.374L8.062 243.908A47.994 47.994 0 0 0 0 270.533V400c0 26.51 21.49 48 48 48h480c26.51 0 48-21.49 48-48V270.533a47.994 47.994 0 0 0-8.062-26.625zM162.252 128h251.497l85.333 128H376l-32 64H232l-32-64H76.918l85.334-128z"></path></svg>
											<span class="align-middle">'.$size.'</span>
										</div>';
									}
									if(!empty($author)){
	$html .= '								<div class="small text-truncate text-muted">
												<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16"><path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/></svg>
												<span class="align-middle">'. $author.'</span>
											</div>';
									}
	$html .= '					</div>
								
							</div>
						</a>
					</div>';
                        }
                    }	
                    wp_reset_postdata();
$html .= '
				</div>
			</section>';

	return $html;
}


function books_block(){
	$heading=get_sub_field('heading');
    $view_more_button=get_sub_field('view_more_button');
    $number_of_posts=get_sub_field('number_of_posts');

    if (empty($heading)) {
    	$heading='Books';
    }

    if (empty($number_of_posts)) {
    	$number_of_posts=12;
    }
    $html='';
	$html='<section class="content-section">
				<header class="section-header">
					<h2 class="h2"><a href="'.$view_more_button["url"].'" class="text-link">'.$heading.'</a></h2>';
						if (!empty($view_more_button) && isset($view_more_button)) {
	$html .= '									<a href="'.$view_more_button["url"].'" class="btn btn-primary btn-sm ml-auto"> '.$view_more_button["title"].'</a>';
						}
	$html .= '	</header>
				<div class="row">
					<!-- category-post -->';
					$args = array(
                        'post_type' =>'books',
                        'orderby'           => 'date',
						'order'             =>  "DESC",  
                        'posts_per_page' => $number_of_posts, 
                    );
                    $wc_query = new WP_Query($args);
                    if ( $wc_query->have_posts()) {
                        while ( $wc_query->have_posts() ) {
                            $wc_query->the_post();
                            global $post;
							if(function_exists('get_field')){
								$size=get_field('size',$post->id);
								$author=get_field('author',$post->id);
							}
                            $post_id =$post->id;
                            $img_url = wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()), 'full');

    $html .= '          <div class="col-12 col-sm-6 col-xl-4">
							<a href="'.get_post_permalink().'" class="category-post" title="'.get_the_title().'">
							<div class="cp-wrap">
								<div class="img-wrap">
									<img src="'.$img_url.'" class="img-fluid" alt="image description">
								</div>
								<div class="content-wrap">
									<h6 class="h6">'.get_the_title().'</h6>';
									if(!empty($size)){
	$html .= '							<div class="small text-truncate text-muted">
										<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M567.938 243.908L462.25 85.374A48.003 48.003 0 0 0 422.311 64H153.689a48 48 0 0 0-39.938 21.374L8.062 243.908A47.994 47.994 0 0 0 0 270.533V400c0 26.51 21.49 48 48 48h480c26.51 0 48-21.49 48-48V270.533a47.994 47.994 0 0 0-8.062-26.625zM162.252 128h251.497l85.333 128H376l-32 64H232l-32-64H76.918l85.334-128z"></path></svg>
											<span class="align-middle">'.$size.'</span>
										</div>';
									}
									if(!empty($author)){
	$html .= '								<div class="small text-truncate text-muted">
												<svg class="svg-6 svg-muted mr-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16"><path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/></svg>
												<span class="align-middle">'.$author.'</span>
											</div>';
									}
	$html .= '					</div>
								
							</div>
						</a>
					</div>';
                        }
                    }	
                    wp_reset_postdata();
$html .= '
				</div>
			</section>';

	return $html;
}

function who_we_are(){
	if(function_exists('get_field')){
		$main_heading=get_sub_field('main_heading');
		$who_we_are_image=get_sub_field('who_we_are_image');
		$who_we_are_description=get_sub_field('who_we_are_description');
		$who_we_are_repeater=get_sub_field('who_we_are_repeater');
	}
	$html = '<section class="content-section">
					<header class="section-header">
						<h2 class="h2">'.$main_heading.' 
					</header>
					<p>
						<img class="wp-image-33945 aligncenter" src="'.$who_we_are_image.'" alt="'.$main_heading.'" width="61" height="61">
					</p>
					'.$who_we_are_description.'

					<div id="accordion-who-we-are" class="pb-3 accordion accordion-more-info">';
						$counter=1;
						foreach($who_we_are_repeater as $content){
	$html .= '						<div class="rounded border" style="margin-top: -1px;">
								<a class="rounded d-flex align-items-center py-2 px-3 toggler collapsed" data-toggle="collapse" href="#who-we-are-'.$counter.'" aria-expanded="false">'.$content['question'].'</a>
								<div id="who-we-are-'.$counter.'" class="collapse" data-parent="#accordion-who-we-are" style="">
									<div class="pt-3 px-3">
										'.$content['answer'].'
									</div>
								</div>
							</div>';
							$counter++;
						}
						
	$html .= '		</div>
				</section>';
	return $html;
}

function blogs_page_block(){
	$html= '';
	$heading=get_sub_field('heading');
    $view_more_button=get_sub_field('view_more_button');
    $number_of_posts=get_sub_field('number_of_posts');

    if (empty($heading)) {
    	$heading='Blogs';
    }

    if (empty($number_of_posts)) {
    	$number_of_posts=12;
    }


	$html= '<section class="content-section">
				<h1 class="h5 font-weight-semibold mb-3">'.$heading.'</h1>
				<div class="row">';
					if(isset($number_of_posts)){
						$args = array(
							'post_type'         => 'post',
							'post_status'       => 'publish',
							'posts_per_page' => $number_of_posts,
							'orderby'           => 'date',
							'order'             =>  "DESC",
						);
						query_posts($args);
						if(have_posts()) {
							while (have_posts()) {
								the_post();
								global $post;
								$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
	$html.='
								<div class="col-12 col-sm-6 col-lg-4">
									<a href="'.get_post_permalink($post->ID).'" class="blog-post bg-cover embed-responsive" style="background-image: url('.wp_get_attachment_image_url( $post_thumbnail_id).')">
										<div class="holder-wrap">
											<h3 class="h3">'.get_the_title().'</h3>
										</div>
									</a>
								</div>';
							}
						}
						wp_reset_query();
					}	
	$html.='
				</div>
			</section>';
	return $html;
}




function func_aplha_acf_blocks( $content ) {
        $shorthtml="";
		if( have_rows('content') ): while ( have_rows('content') ) : the_row();
	        if(get_row_layout() == "home_blog_page"): 
	            $shorthtml .=home_blog_page();
			elseif(get_row_layout() == "editors_choice_block"):
				$shorthtml .=editors_choice_block(); 
			elseif(get_row_layout() == "games_block"):
				$shorthtml .=games_block();
			elseif(get_row_layout() == "novel_block"):
				$shorthtml .=novel_block();
			elseif(get_row_layout() == "books_block"):
				$shorthtml .=books_block();
			elseif(get_row_layout() == "who_we_are"):
				$shorthtml .=who_we_are();
			elseif(get_row_layout() == "blogs_page_block"):
				$shorthtml .=blogs_page_block();
	        endif;      
    endwhile; else : endif; 
    return $shorthtml.$content;
}
add_filter( 'the_content', 'func_aplha_acf_blocks' );



function load_alpha_acf_plugin() {
    require plugin_dir_path( __FILE__ ) . 'inc/core_functions.php';
}
add_action( 'init', 'load_alpha_acf_plugin' );

add_action( 'wp_enqueue_scripts', 'alpha_acf_blocks' );
function alpha_acf_blocks() {

    wp_enqueue_style( 'alpharage-acf-block-css', plugin_dir_url( __FILE__ ) .'assets/css/alpha-acf-block.css' );
  
    wp_enqueue_script( 'alpharage-acf-block-js', plugin_dir_url( __FILE__ ) .'assets/js/alpha-acf-block.js','',false,true );


}


function extra_tax_for_products(){
    register_taxonomy(
        "product_purpose", array("product"), array(
            "hierarchical" => true,
            'show_ui' => true,
            'show_admin_column' => false,
            'query_var' => true,
            "label" => "Product Purpose",
            "singular_label" => "Product Purpose",
            "rewrite" => true));
    register_taxonomy_for_object_type('product_purposes', 'product');

    register_taxonomy(
        "product_occasion", array("product"), array(
            "hierarchical" => true,
            'show_ui' => true,
            'show_admin_column' => false,
            'query_var' => true,
            "label" => "Product Occasion",
            "singular_label" => "Product Occasion",
            "rewrite" => true));
    register_taxonomy_for_object_type('product_occasions', 'product');
    
}
//add_action("init","extra_tax_for_products");