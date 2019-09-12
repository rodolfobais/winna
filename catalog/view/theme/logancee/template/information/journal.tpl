<?php echo $header; ?>

<div class="container">

	<div id="instafeed" class="row gallery"></div>

</div>

<style>
#instafeed{ margin-top:55px;}
.instaimg img {margin-bottom:30px;}
.instaimg img:hover {
	opacity:0.8;
	-moz-opacity:0.8;
	-webkit-opacity:0.8;
}
</style>
 <!--  <div class="row"><?php echo $column_left; ?>

    <?php if ($column_left && $column_right) { ?>

    <?php $class = 'col-sm-6'; ?>

    <?php } elseif ($column_left || $column_right) { ?>

    <?php $class = 'col-sm-9'; ?>

    <?php } else { ?>

    <?php $class = 'col-sm-12'; ?>

    <?php } ?>

    

    <?php echo $content_top; ?>

    

    <div class="<?php echo $class; ?>">

 	      <div class="container">

	      	<div class="row info_content journal" style="min-height:600px;">

				   <?php  

				  	//ini_set('error_reporting', E_ALL);

				  	

					$apikey = "xg9dLLLuDKOuHx6VoEo4OUDhIOAM1xjNt9pMiNK3CH3yAh5lmg";

				    $limit = 10;

				    $tumblr = "lebasnews.tumblr.com";

				

				    $apidata = json_decode(file_get_contents("https://api.tumblr.com/v2/blog/$tumblr/posts?api_key=$apikey&limit=$limit"));

					$mypostsdata = $apidata->response->posts;

				    $myposts = array();

				

				    $i = 0;

				    foreach($mypostsdata as $postdata) {

				        $post['id'] = $postdata->id;

				        $post['type'] = $postdata->type;

				        //$post['description'] = $postdata->description;

				        //$post['date'] = $postdata->date;

						$post['date'] = strtok($postdata->date," ");

				        $post['short_url'] = $postdata->short_url;

				        $post['caption'] = $postdata->caption;

				

				        $post["photo_url"] = $postdata->photos[0]->original_size->url;

				        $post["width"] = $postdata->photos[0]->original_size->width;

				        $post["height"] = $postdata->photos[0]->original_size->height;

				

				        $myposts[$i] = $post;

				        $i++;

				    } 

				

				   ?>

					 

				   <?php $j = 0; ?>	

  			  	   <?php foreach ($myposts as $post) { ?>

  			  	   <?php $j++; ?>		

			        <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">

			          <div class="product-thumb">

			             <div class="image"><a href="<?php echo $post['short_url']; ?>"><img src="<?php echo $post['photo_url']; ?>" alt="<?php //echo $post['caption']; ?>" title="<?php //echo $post['caption']; ?>" class="img-responsive" /></a></div>

			           

			            <div>

			              <div class="caption">

			                <h4><a href="<?php echo $post['short_url']; ?>"><?php echo date("d M Y", strtotime($post['date'])); ?></a></h4>

			              </div>

			            </div>

			          </div>

			        </div>

			        

			        <?php if ($j % 3 == 0) { ?>

			        	<div class="clearfix hidden-md hidden-sm"></div>

			        <?php } ?>	

			        

			       <?php } ?>

  				</div>	

		</div>

	</div>

</div>



</div> -->

<?php echo $footer; ?>