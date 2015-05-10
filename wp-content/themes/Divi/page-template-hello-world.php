<?php
/*
Template Name: Hello World
*/

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
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
					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

					<div class="container-fluid">

					  <div class="row">
					      <div class="col-md-12">
						      <canvas id="c" style="border:1px solid black;"></canvas>
					          <!-- <input type="text" width="200" id="imgUrl" name="imgUrl"><input type="button" onClick="setUserImage();" value="Change Your Image"></input> -->

					          <br><br>
					          <!-- <input type="button" onClick="saveModifications();" value="I am done"></input> -->
					      </div>
					  </div>
					  <div class="row">
				        <form id="uploadImg" runat="server">
							<input type="file" id="uploadedImg"/>
						</form>

		  			  	<button type="submit" onclick="saveModifications();" class="btn btn-warning btn-lg">Add to cart</button>
		  			  	<button type="submit" onclick="removeSelectedImage();" class="btn btn-warning btn-lg">Remove Selected Image</button>
		  			  	<button type="submit" onclick="clearCanvas();" class="btn btn-warning btn-lg">Clear Canvas</button>
		  			  	<button type="submit" onclick="bringForward();" class="btn btn-warning btn-lg">Bring Forward</button>
		  			  	<button type="submit" onclick="sendBackwards();" class="btn btn-warning btn-lg">Send Backwards</button>
		  			  	<button type="submit" onclick="sendToBack();" class="btn btn-warning btn-lg">Send to Back</button>
		  			  	<button type="submit" onclick="bringToFront();" class="btn btn-warning btn-lg">Bring to Front</button>
		  			  	<button type="submit" onclick="resetPositions();" class="btn btn-warning btn-lg">Reset Positions</button>
				  	  </div>

				  	  <div class="row">
	  		  	  	    <h3>Pattern Features</h3>
						<div class="range">
							<input type="range" name="range" min="-50" max="50" value="0" onchange="range.value=value">
							<output id="range">50</output>
						</div>
				  	  </div>

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