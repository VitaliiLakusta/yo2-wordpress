<?php
/*
Template Name: Hello World
*/

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container-fluid">

					    <div class="row" id="canvas-sidebar">
					      <div class="col-md-offset-1 col-md-6 canvas-col">
						      <canvas id="c" style="border:1px solid black;"></canvas>
					          <!-- <input type="text" width="200" id="imgUrl" name="imgUrl"><input type="button" onClick="setUserImage();" value="Change Your Image"></input> -->
					          <!-- <input type="button" onClick="saveModifications();" value="I am done"></input> -->
					      </div>
					      <div id="functions-sidebar">
					      	<div class="btn-group-vertical">
					      		
					      		<button type="button" onclick="chooseFile();" class="btn-gost btn btn-warning btn-lg btn-custom-sidebar"><i class="fa fa-upload fa-2x"></i></button>
							    <button type="submit" onclick="removeSelectedImage();" class="btn-gost btn btn-warning btn-lg btn-custom-sidebar"><i class="fa fa-trash-o fa-2x"></i></button>
							    <button type="submit" onclick="resetPositions();" class="btn-gost btn btn-warning btn-lg btn-custom-sidebar"><i class="fa fa-refresh fa-2x"></i></button>
							    <button type="submit" onclick="bringForward();" class="btn-gost btn btn-warning btn-lg btn-custom-sidebar"><i class="fa fa-angle-double-up fa-2x"></i></button>
							    <button type="submit" onclick="sendBackwards();" class="btn-gost btn btn-warning btn-lg btn-custom-sidebar"><i class="fa fa-angle-double-down fa-2x"></i></button>
				      		</div>
			      		  </div>
						</div>
						<input type="file" id="uploadedImg"/>
					  <div class="row">
				  		<div class="col-md-offset-2">
		  			  		<button type="submit" onclick="saveModifications();" id="btn-add-mask-to-cart" class="btn btn-warning btn-lg"><i class="fa fa-shopping-cart fa-2x"></i> &nbsp; &nbsp; CREATE YOUR MASK</button>
	  			  		</div>	
				  	  </div>

		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">

<!-- OUR CONTENT GOES HERE (FOR NOW) -->


					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

					<div class="container-fluid">




					</div>

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<!-- FOR CUSTOMIZATION PAGE -->
<script src="../wp-content/themes/Divi/js/fabric-canvas.js"></script>


<?php get_footer(); ?>