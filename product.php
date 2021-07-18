
<?php
/*
 * Template Name: Product
*/

if ( ! defined( 'ABSPATH' ) ){
	exit; // Exit if accessed directly
}
get_header();

global $post, $rosa_private_post, $page_section_idx, $header_height;

$page_section_idx       = 0;

if ( post_password_required() && ! $rosa_private_post['allowed'] ) {
	// password protection
	get_template_part( 'template-parts/password-request-form' );
} else {

	while ( have_posts() ) : the_post();
		$classes = 'article--page  article--main' ;

		$border_style = 'simple';
		if ( ! empty( $border_style ) ) {
			$classes .= ' border-' . $border_style;
		}

		$show_main_content = apply_filters( 'rosa_avoid_empty_markup_if_no_page_content', ( ! empty( $post->post_content ) ), $post );

		if ( $show_main_content ) : ?>
		<style>
.pl-4, .px-4 {
    padding-left: 1.5rem !important;
}
.pr-4, .px-4 {
    padding-right: 1.5rem !important;
}
.justify-content-between {
    -webkit-box-pack: justify !important;
    -ms-flex-pack: justify !important;
    justify-content: space-between !important;
}
.row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.bread-crumb {
    cursor: pointer
}

.bread-crumb:hover {
    text-decoration: underline
}

.block {
    position: relative;
    background-color: #fff;
    width: 24%;
    height: 300px;
    border: 2px solid #E0E0E0;
    box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.2);
    cursor: pointer;
    margin-bottom: 25px
}

.block.active {
    border: 2px solid #FBC02D;
    box-shadow: 0 4px 8px 0 #FBC02D
}

.price {
    position: absolute;
    background-color: #E0E0E0;
    padding: 25px 10px;
    top: 70%;
    left: 66%;
    border-radius: 50%;
    width: 70px;
    height: 70px
}

.price.active {
    background-color: #FBC02D;
    box-shadow: 0 3px 6px 0 #FBC02D
}

.image {
    width: 150px;
    height: 180px
}

.prod-name {
    font-size: 20px
}

@media screen and (max-width: 992px) {
    .block {
        width: 48%
    }
}

@media screen and (max-width: 768px) {
    .block {
        width: 98%
    }
}


</style>
			<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
				<section class="article__content">
					<div class="container">
						<section class="page__content  js-post-gallery  cf">
						<!-- Your Custom Code here-->
							<div class="row justify-content-between px-4">

							    <?php 
								    $connection=mysqli_connect("localhost", "root", "root", "stage_new");

									$query_product = "SELECT * FROM `product`";

									$products = mysqli_query($connection,$query_product);
									while($product = mysqli_fetch_assoc($products))
									{


										$p_id=$product['id'];
										$p_name=$product['name'];
										$p_price=$product['price'];
										$p_pic=$product['picture'];


										?>

    								<div onclick="select(this.children , this.id)" id="<?php echo  $p_id ; ?>" class="block text-center">
    								    <p class="my-3 prod-name"><?php echo $p_name  ; ?></p> <img class="image" src="<?php echo  $p_pic ; ?>">
    								    <div class="price">
    								        <h6 class="mb-0"><?php echo  $p_price ; ?>DH</h6>
    								    </div>
    								</div>
    						<?php } ?>
						<!-- End Your Custom Code here-->
						</section>
						
						</div>
					</div>
				</section>
			</article>
		<?php endif;

		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || get_comments_number() ) { ?>
			<div class="container">
				<?php comments_template(); ?>
			</div>
		<?php }
	endwhile;

} // close if password protection

get_footer();
