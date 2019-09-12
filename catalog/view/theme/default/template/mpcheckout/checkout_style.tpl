<style type="text/css">
  
  /* Button Colors start */
  <?php if($background_button || $font_button || $border_button) { ?>
  .mp-checkout .mp-comments .btn-primary, .mp-checkout .login-panel .btn-primary, .mp-checkout .shoppingcart .table .input-group-btn .btn-primary{
    <?php if($background_button) { ?>
    background: <?php echo $background_button; ?>;
    <?php } ?>

    <?php if($font_button) { ?>
    color: <?php echo $font_button; ?>;
    <?php } ?>

    <?php if($border_button) { ?>
    border-color: <?php echo $border_button; ?>;
    <?php } ?>
  }
  <?php } ?>
  /* Button color end */

  /* Button Hover Colors start */
  <?php if($background_hover_button || $font_hover_button || $border_hover_button) { ?>
  .mp-checkout .mp-comments .btn-primary:hover, .mp-checkout .login-panel .btn-primary:hover,  .mp-checkout .shoppingcart .table .input-group-btn .btn-primary:hover{
    <?php if($background_hover_button) { ?>
    background: <?php echo $background_hover_button; ?>;
    <?php } ?>

    <?php if($font_hover_button) { ?>
    color: <?php echo $font_hover_button; ?>;
    <?php } ?>

    <?php if($border_hover_button) { ?>
    border-color: <?php echo $border_hover_button; ?>;
    <?php } ?>
  }
  <?php } ?>
  /* Button Hover Color end */


  /* Table Colors */
  <?php if($background_table) { ?>
  .mp-checkout .shoppingcart .table{
    background: <?php echo $background_table; ?>;
  }
  <?php } ?>

  <?php if($order_total_color || $font_order_total_color) { ?>
  .mp-checkout .shoppingcart .table tr:last-child .c-total {
    <?php if($order_total_color) { ?>
    background: <?php echo $order_total_color; ?>;
    <?php } ?>

    <?php if($font_order_total_color) { ?>
    color: <?php echo $font_order_total_color; ?>;
    <?php } ?>
  }
  <?php } ?>

  <?php if($border_table_data || $border_top_table_data || $font_table_data) { ?>
  .mp-checkout .shoppingcart .table thead td, .mp-checkout .shoppingcart .table thead tr:first-child td, .mp-checkout .shoppingcart .table tbody td{

  <?php if($border_table_data) { ?>   
    border-color: <?php echo $border_table_data; ?>;
    <?php } ?>

    <?php if($border_top_table_data) { ?>
    border-top: 3px solid <?php echo $border_top_table_data; ?>;
    <?php } ?>

  <?php if($font_table_data) { ?>
    color: <?php echo $font_table_data; ?>;
    <?php } ?>
  }
  <?php } ?>
  /* Table Colors End*/


  /* Panel Colors */
  <?php if($background_panel_icon || $font_panel_icon) { ?>
  .mp-checkout .panel-default > .panel-heading i, .mp-checkout .mp-comments .panel-heading i{
    <?php if($background_panel_icon) { ?>
    background: <?php echo $background_panel_icon; ?>;
    <?php } ?>

    <?php if($font_panel_icon) { ?>
    color: <?php echo $font_panel_icon; ?>;
    <?php } ?>
  }
  <?php } ?>

  <?php if($background_panel || $font_panel) { ?>
  .mp-checkout .panel{
    <?php if($background_panel) { ?>
    background: <?php echo $background_panel; ?>;
    <?php } ?>

    <?php if($font_panel) { ?>
    color: <?php echo $font_panel; ?>;
    <?php } ?>
  }
  .checkbox label, .radio label{
    <?php if($font_panel) { ?>
    color: <?php echo $font_panel; ?>;
    <?php } ?>
  }
  <?php } ?>


  <?php if($background_panel_heading) { ?>
  .mp-checkout .panel-default > .panel-heading, .mp-checkout .mp-comments .panel-heading span{
    background-color: <?php echo $background_panel_heading; ?>;
  }
  <?php } ?>

  <?php if($border_panel_body || $font_panel_body) { ?>
  .mp-checkout .panel-default > .panel-heading, .mp-checkout .mp-comments .panel-heading span, .mp-checkout .mp-comments .panel-body, .mp-checkout .panel-default > .panel-heading .accordion-toggle i{

    <?php if($font_panel_body) { ?>
    color: <?php echo $font_panel_body; ?>;
    <?php } ?>

    <?php if($border_panel_body) { ?>
    border-color: <?php echo $border_panel_body; ?>;
    <?php } ?>
  }
  <?php } ?>

  <?php if($border_panel_default) { ?>
  .mp-checkout .panel-default{
    border-color: <?php echo $border_panel_default; ?>; 
  }
  <?php } ?>

  <?php if($border_panel_confirm) { ?>
  .mp-checkout .mp-comments .panel-heading i{
    border-color: <?php echo $border_panel_confirm; ?>;
  }
  <?php } ?>

  /* Panel Colors End*/


  /* Container Colors */  
  <?php if($background_container) { ?>
  .mp-checkout, .mp-checkout .mp-comments .panel-heading{
    background-color: <?php echo $background_container; ?>;
  }
  <?php } ?>

  <?php if($background_container_heading || $font_container_heading) { ?>
  .mp-container h1{
    <?php if($background_container_heading) { ?>
    background: <?php echo $background_container_heading; ?>;
    <?php } ?>

    <?php if($font_container_heading) { ?>
    color: <?php echo $font_container_heading; ?>;
    <?php } ?>
  }
  <?php } ?>
  /* Container Colors End */
  /* Account Tabs Colors End */
  <?php if($font_account_panel || $background_account_panel) { ?>
  .mp-checkout .account-option-buttons .btn-default{
    <?php if($background_account_panel) { ?>
    background: <?php echo $background_account_panel; ?>;
    <?php } ?>

    <?php if($font_account_panel) { ?>
    color: <?php echo $font_account_panel; ?>;
    <?php } ?>
  }
  <?php } ?>

  <?php if($font_hover_account_panel || $background_hover_account_panel) { ?>
  .mp-checkout .account-option-buttons .btn-default.active, .mp-checkout .account-option-buttons .btn-default:active {
    <?php if($background_hover_account_panel) { ?>
    background: <?php echo $background_hover_account_panel; ?>;
    <?php } ?>

    <?php if($font_hover_account_panel) { ?>
    color: <?php echo $font_hover_account_panel; ?>;
    <?php } ?>
  }
  <?php } ?>
  /* Account Tabs Colors End */

  <?php if($background_container) { ?>
    .mp-checkout {
        border: 1px solid #ddd;
        padding: 15px 15px 0;
        padding-bottom: 0;
      }
      .mp-checkout .account-option-buttons .btn-default:nth-child(2){
        border-left: none;
        border-right: none;
      }
  <?php } ?>

  <?php if($overlay_blur) { ?>
  .mp-checkout .blur{
    filter: blur(1.5px);
    -o-filter: blur(1.5px);
    -webkit-filter: blur(1.5px);
  }
  .mpdisable{
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 999999;
    background: rgba(255,255,255,0.1);
  }
  <?php } ?>

  /* Custom CSS */
  <?php echo $custom_css; ?>
  /* Custom CSS End */  

</style>