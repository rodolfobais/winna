<?php echo $header; 
$theme_options = $registry->get('theme_options');
$config = $registry->get('config'); 
include('catalog/view/theme/' . $config->get($config->get('config_theme') . '_directory') . '/template/new_elements/wrapper_top.tpl'); ?>

<div class="contact-page">
     <div class="how-to-contact">
          <div class="row">
               <div class="contact-way col-lg-4 col-xs-12">
                    <div class="inner-contact">
                         <span class="icon_mobile icon-contact">&nbsp;</span>
                         <h3><?php echo $text_telephone; ?></h3>
                         <p><?php echo $telephone; ?></p>
                         <?php if ($fax) { ?>
                         <p><?php echo $text_fax; ?>: <?php echo $fax; ?></p>
                         <?php } ?>
                    </div>
               </div>
               
               <div class="contact-way col-lg-4 col-xs-12">
                    <div class="inner-contact">
                         <span class="icon_pin_alt icon-contact">&nbsp;</span>
                         <h3><?php echo $store; ?></h3>
                         <p><?php echo $address; ?></p>
                    </div>
               </div>
               
               <div class="contact-way col-lg-4 col-xs-12">
                    <div class="inner-contact">
                         <span class=" icon_clock_alt icon-contact">&nbsp;</span>
                         <?php if ($open) { ?>
                         <h3><?php echo $text_open; ?></h3>
                         <p><?php echo $open; ?></p>
                         <?php } ?>
                         <?php if ($comment) { ?>
                         <p><strong><?php echo $text_comment; ?></strong><br><?php echo $comment; ?></p>
                         <?php } ?>
                    </div>
               </div>
          </div>
     </div>
     
     <?php if ($locations) { ?>
     <h3><?php echo $text_store; ?></h3>
     <div class="panel-group" id="accordion">
       <?php foreach ($locations as $location) { ?>
       <div class="panel panel-default">
         <div class="panel-heading">
           <h4 class="panel-title"><a href="#collapse-location<?php echo $location['location_id']; ?>" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"><?php echo $location['name']; ?> <i class="fa fa-caret-down"></i></a></h4>
         </div>
         <div class="panel-collapse collapse" id="collapse-location<?php echo $location['location_id']; ?>">
           <div class="panel-body">
             <div class="row">
               <?php if ($location['image']) { ?>
               <div class="col-sm-3"><img src="<?php echo $location['image']; ?>" alt="<?php echo $location['name']; ?>" title="<?php echo $location['name']; ?>" class="img-thumbnail" /></div>
               <?php } ?>
               <div class="col-sm-3"><strong><?php echo $location['name']; ?></strong><br />
                 <address>
                 <?php echo $location['address']; ?>
                 </address>
                 <?php if ($location['geocode']) { ?>
                  <a href="https://maps.google.com/maps?q=<?php echo urlencode($location['geocode']); ?>&hl=<?php echo $geocode_hl; ?>&t=m&z=15" target="_blank" class="btn btn-info"><i class="fa fa-map-marker"></i> <?php echo $button_map; ?></a>
                 <?php } ?>
               </div>
               <div class="col-sm-3"> <strong><?php echo $text_telephone; ?></strong><br>
                 <?php echo $location['telephone']; ?><br />
                 <br />
                 <?php if ($location['fax']) { ?>
                 <strong><?php echo $text_fax; ?></strong><br>
                 <?php echo $location['fax']; ?>
                 <?php } ?>
               </div>
               <div class="col-sm-3">
                 <?php if ($location['open']) { ?>
                 <strong><?php echo $text_open; ?></strong><br />
                 <?php echo $location['open']; ?><br />
                 <br />
                 <?php } ?>
                 <?php if ($location['comment']) { ?>
                 <strong><?php echo $text_comment; ?></strong><br />
                 <?php echo $location['comment']; ?>
                 <?php } ?>
               </div>
             </div>
           </div>
         </div>
       </div>
       <?php } ?>
     </div>
     <?php } ?>
     
     <div class="contact-form">
          <div id="messages_product_view"></div>
          <form action="<?php echo $action; ?>" id="contactForm" method="post" enctype="multipart/form-data">
               <div class="fieldset">
                    <h2 class="legend"><?php echo $text_contact; ?></h2>
                    <ul class="form-list">
                         <li class="fields">
                              <div class="field">
                                   <div class="input-box">
                                        <input name="name" id="name" title="Name" value="<?php echo $name; ?>" class="input-text required-entry" type="text" placeholder="<?php echo $entry_name; ?>">
                                        
                                        <?php if ($error_name) { ?>
                                        <div class="text-danger"><?php echo $error_name; ?></div>
                                        <?php } ?>
                                   </div>
                              </div>
                              
                              <div class="field">
                                   <div class="input-box">
                                        <input name="email" id="email" title="Email" value="<?php echo $email; ?>" class="input-text required-entry validate-email" type="text" placeholder="<?php echo $entry_email; ?>">
                                        
                                        <?php if ($error_email) { ?>
                                        <div class="text-danger"><?php echo $error_email; ?></div>
                                        <?php } ?>
                                   </div>
                              </div>
                         </li>
                         <li class="wide"><div class="input-box"><textarea name="enquiry" id="comment" title="<?php echo $entry_enquiry; ?>" class="required-entry input-text" rows="5" placeholder="<?php echo $entry_enquiry; ?>"><?php echo $enquiry; ?></textarea>
                              <?php if ($error_enquiry) { ?>
                              <div class="text-danger"><?php echo $error_enquiry; ?></div>
                              <?php } ?>
                         </div></li>
                    </ul>
               </div>
               
               <div class="buttons-set">
                    <button type="submit" title="Send Message" class="button"><span><span><?php echo $button_submit; ?></span></span></button>
               </div>
          </form>  
     </div>
     
     <?php if ($geocode) { ?>
     <div class="contact-map"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="1170" height="470" src="https://maps.google.com/maps?q=<?php echo urlencode($geocode); ?>&hl=<?php echo $geocode_hl; ?>&ie=UTF8&t=roadmap&z=16&iwloc=B&output=embed"></iframe></div>
     <?php } ?>
</div>
  
<?php include('catalog/view/theme/' . $config->get($config->get('config_theme') . '_directory') . '/template/new_elements/wrapper_bottom.tpl'); ?>
<?php echo $footer; ?>