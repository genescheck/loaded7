<?php
/**
  @package    catalog::admin::applications
  @author     Loaded Commerce
  @copyright  Copyright 2003-2014 Loaded Commerce, LLC
  @copyright  Portions Copyright 2003 osCommerce
  @copyright  Template built on Developr theme by DisplayInline http://themeforest.net/user/displayinline under Extended license 
  @license    https://github.com/loadedcommerce/loaded7/blob/master/LICENSE.txt
  @version    $Id: edit.php v1.0 2013-08-08 datazen $
*/
$bInfo = lC_Branding_manager_Admin::getAll();
?>
<section role="main" id="main">
  <noscript class="message black-gradient simpler">
    <?php echo $lC_Language->get('ms_error_javascript_not_enabled_warning'); ?>
  </noscript>
  <hgroup id="main-title" class="thin">
    <h1><?php echo $lC_Template->getPageTitle(); ?></h1>
  </hgroup>
  <div class="with-padding">
    <form name="branding_manager" id="branding_manager" action="<?php echo lc_href_link_admin(FILENAME_DEFAULT, $lC_Template->getModule() . '=' . '&action=save'); ?>" method="post">
    <div class="side-tabs tab-opened"> 
      <ul class="tabs">
        <li class="active"><a href="#home"><?php echo $lC_Language->get('tab_home_page'); ?></a></li>
        <li><a href="#header"><?php echo $lC_Language->get('tab_header'); ?></a></li>
        <li><a href="#company"><?php echo $lC_Language->get('tab_company_info'); ?></a></li>
        <li><a href="#seo"><?php echo $lC_Language->get('tab_seo'); ?></a></li>
        <li><a href="#social"><?php echo $lC_Language->get('tab_social_links'); ?></a></li>
        <li><a href="#footer"><?php echo $lC_Language->get('tab_footer_text'); ?></a></li>
      </ul>
      <div class="tabs-content">
        <div id="home" class="with-padding">
          <div class="bold mid-margin-bottom">
            <?php echo $lC_Language->get('field_home_page_text'); ?><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_home_page')); ?>
          </div>
          <!-- innrer tabs start -->
          <div class="standard-tabs">
            <!-- Tabs -->
            <ul class="tabs">
              <?php
                foreach ( $lC_Language->getAll() as $l ) {
                  $active = '';
                  if (DEFAULT_LANGUAGE == $l['code']){
                    $active = ' class="active"';
                  }
                  echo '<li' . $active . '><a href="#tab-' . $l['id'] . '">' . $lC_Language->showImage($l['code']) . ' ' . $l['name'] . '</a></li>';
                }
              ?>
            </ul>
            <!-- Content -->
            <div class="tabs-content">
              <?php
                foreach ( $lC_Language->getAll() as $l ) {
                ?>
                <div id="tab-<?php echo $l['id'];?>" class="with-padding">
                <span class="required full-width autoexpanding mid-margin-bottom">
                  <label for="ckEditor_branding_home_page_text[<?php echo $l['id'];?>]"></label>
                  <?php echo lc_draw_textarea_field('branding_home_page_text[' . $l['id'] . ']', (isset($bInfo) && isset($bInfo[$l['id']]['homepage_text']) ? $bInfo[$l['id']]['homepage_text'] : null), 48, 2, 'id="ckEditor_branding_home_page_text[' . $l['id'] . ']" class="required input full-width autoexpanding"'); ?>
                  </span>
                </div>
                <?php
                }
              ?>
            </div>
          </div>
          <!-- inner tab eof -->

          <?php if (lC_Branding_manager_Admin::mainpageContentInstalled() === false) { ?>
          <p class="message mid-margin-top"> <?php echo $lC_Language->get('text_content_not_installed_message');?></p>
          <?php } ?>
        </div>
          <div id="header" class="with-padding">
            <div class="columns">
              <div class="four-columns twelve-columns-mobile">
                <label class="label" for="branding_image"><?php echo $lC_Language->get('field_branding_manager_logo'); ?></label>
                <?php echo lc_show_info_bubble($lC_Language->get('info_bubble_branding_manager_logo'), 'margin-right:6px; margin-top:4px;'); ?> 
                <div class="mid-margin-top">
                  <div id="imagePreviewContainer" class="cat-image align-center">
                    <?php if (isset($bInfo) && !empty($bInfo['site_image'])) { ?>
                    <div style="position:relative;">
                      <div id="bmlogo_controls" class="controls">
                        <span class="button-group compact children-tooltip">
                          <a onclick="deleteBmLogo($('#branding_manager_logo').val());" class="button icon-trash" href="#" title="<?php echo $lC_Language->get('text_delete'); ?>"></a>
                        </span>
                      </div>
                    </div>
                    <?php } ?>
                    <img src="<?php echo '../' . DIR_WS_IMAGES . (isset($bInfo) && !empty($bInfo['site_image']) ? 'branding/' . $bInfo['site_image'] : 'no_image.png');?>" align="center" />
                    <input type="hidden" id="branding_manager_logo" name="branding_manager_logo" value="<?php echo (isset($bInfo) && isset($bInfo['site_image']) ? $bInfo['site_image'] : '');?>">
                  </div>
                </div>  
                <div class="thin mid-margin-top" align="center">
                  <?php echo $lC_Language->get('text_drag_drop_to_replace'); ?></p>
                  <center>
                    <div id="fileUploaderImageContainer" class="small-margin-top">
                      <noscript>
                        <p><?php echo $lC_Language->get('ms_error_javascript_not_enabled_for_upload'); ?></p>
                      </noscript>
                    </div>
                  </center>
                </div>
              </div>
              <div class="eight-columns twelve-columns-mobile">
                <span class="button-height block-label">
                  <label for="branding_name" class="label"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_site_name')) . $lC_Language->get('field_site_name'); ?></label>
                  <input type="text" name="branding_name" id="branding_name" class="input full-width required small-margin-top small-margin-bottom" value="<?php echo STORE_NAME; ?>">
                </span>
                <span class="button-height">
                  <span class="bold"><?php echo $lC_Language->get('field_site_slogan'); ?></span>
                  <?php echo lc_show_info_bubble($lC_Language->get('info_bubble_site_slogan'), 'margin-right:6px; margin-top:8px;'); ?>
                </span>
                <span class="button-height block-label">
                  <?php
                    foreach ( $lC_Language->getAll() as $l ) {
                    ?>
                    <span class="required input full-width mid-margin-bottom">
                      <label class="button silver-gradient glossy" for="branding_slogan[<?php echo $l['id'];?>]"><?php echo  $lC_Language->showImage($l['code']); ?></label>
                      <input type="text" value="<?php echo (isset($bInfo) && isset($bInfo[$l['id']]['slogan']) ? $bInfo[$l['id']]['slogan'] : null);?>" class="input-unstyled ten-columns required" id="branding_slogan[<?php echo $l['id']; ?>]" name="branding_slogan[<?php echo $l['id']; ?>]">
                    </span> 
                    <?php
                    }
                  ?>
                </span>
                <span class="button-height block-label">
                  <label for="branding_chat_code" class="label margin-top"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_live_chat_code')); ?><?php echo $lC_Language->get('field_live_chat_code'); ?></label>
                  <span class="required input full-width autoexpanding small-margin-top mid-margin-bottom"><?php echo lc_draw_textarea_field('branding_chat_code', (isset($bInfo) && isset($bInfo['chat_code']) ? $bInfo['chat_code'] : null) , 48, 2, 'class="required input-unstyled full-width autoexpanding"'); ?></span> 
                </span>
              </div>
            </div>
          </div>
          <div id="company" class="with-padding"> 
            <p class="button-height block-label mid-margin-bottom">
              <label class="label" for="branding_address"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_address')); ?><?php echo $lC_Language->get('field_address'); ?></label>
              <?php echo lc_draw_textarea_field('branding_address',  STORE_NAME_ADDRESS, 48, 2, 'id="branding_address" class="input full-width required autoexpanding small-margin-top margin-bottom"');?>
            </p>
            <p class="button-height block-label mid-margin-bottom mid-margin-top">
              <label class="label" for="branding_support_phone"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_support_phone')) . $lC_Language->get('field_support_phone'); ?></label>
              <input type="text" value="<?php echo (isset($bInfo) && isset($bInfo['support_phone']) ? $bInfo['support_phone'] : null); ?>" class="input full-width required small-margin-top margin-bottom" id="branding_support_phone" name="branding_support_phone">
            </p>
            <p class="button-height block-label mid-margin-bottom mid-margin-top">
              <label class="label" for="branding_support_email"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_support_email')) . $lC_Language->get('field_support_email'); ?></label>
              <input type="text" value="<?php echo (isset($bInfo) && isset($bInfo['support_email']) ? $bInfo['support_email'] : null); ?>" class="input full-width required small-margin-top margin-bottom" id="branding_support_email" name="branding_support_email">
            </p>
            <p class="button-height block-label mid-margin-bottom">
              <label class="label" for="branding_sales_phone"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_sales_phone')) . $lC_Language->get('field_sales_phone'); ?></label>
              <input type="text" value="<?php echo (isset($bInfo) && isset($bInfo['sales_phone']) ? $bInfo['sales_phone'] : null); ?>" class="input full-width required small-margin-top margin-bottom" id="branding_sales_phone" name="branding_sales_phone">
            </p>
            <p class="button-height block-label mid-margin-bottom">
              <label class="label" for="branding_sales_email"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_sales_email')) . $lC_Language->get('field_sales_email'); ?></label>
              <input type="text" value="<?php echo (isset($bInfo) && isset($bInfo['sales_email']) ? $bInfo['sales_email'] : null); ?>" class="input full-width required small-margin-top margin-bottom" id="branding_sales_email" name="branding_sales_email">
            </p>
          </div>
          <div id="seo" class="with-padding">
            <div class="columns">
              <div class="four-columns twelve-columns-mobile">
                <label class="label" for="branding_image"><?php echo $lC_Language->get('field_open_graph_site_thumbnail'); ?></label>
                <?php echo lc_show_info_bubble($lC_Language->get('info_bubble_open_graph_site_thumbnail'), 'margin-right:6px; margin-top:4px;'); ?> 
                <div class="mid-margin-top">
                  <div id="ogimagePreviewContainer" class="cat-image align-center">
                    <?php if (isset($bInfo) && !empty($og_image)) { ?>
                      <div style="position:relative;">
                        <div id="og_image_controls" class="controls">
                          <span class="button-group compact children-tooltip">
                            <a onclick="deleteOgImage($('#branding_graph_site_thumbnail').val());" class="button icon-trash" href="#" title="<?php echo $lC_Language->get('text_delete'); ?>"></a>
                          </span>
                        </div>
                      </div>
                      <?php } ?>
                    <img src="<?php echo '../' . DIR_WS_IMAGES . (isset($bInfo) && !empty($bInfo['og_image']) ? 'branding/' . $bInfo['og_image'] : 'no_image.png'); ?>" align="center" />
                    <input type="hidden" id="branding_graph_site_thumbnail" name="branding_graph_site_thumbnail" value="<?php echo (isset($bInfo) && isset($bInfo['og_image']) ? $bInfo['og_image'] : ''); ?>">
                  </div>
                </div>
                <div class="thin mid-margin-top" align="center"><?php echo $lC_Language->get('text_drag_drop_to_replace'); ?></p>
                  <center>
                    <div id="ogfileUploaderImageContainer" class="small-margin-top">
                      <noscript>
                        <p><?php echo $lC_Language->get('ms_error_javascript_not_enabled_for_upload'); ?></p>
                      </noscript>
                    </div>
                  </center>
                </div>
              </div>
              <div class="eight-columns twelve-columns-mobile">
                <span class="button-height block-label">
                  <span class="bold"><?php echo $lC_Language->get('field_site_meta_description'); ?></span>
                  <?php echo lc_show_info_bubble($lC_Language->get('info_bubble_site_meta_description'), 'margin-right:6px; margin-top:8px;'); ?>
                </span>
                <?php
                  foreach ( $lC_Language->getAll() as $l ) {
                  ?>
                  <span class="required input full-width mid-margin-bottom">
                    <label for="branding_meta_description[' . $l['id'] . ']" class="button silver-gradient glossy"><?php echo  $lC_Language->showImage($l['code']); ?></label>
                    <?php echo lc_draw_textarea_field('branding_meta_description[' . $l['id'] . ']', (isset($bInfo) && isset($bInfo[$l['id']]['meta_description']) ? $bInfo[$l['id']]['meta_description'] : null), 48, 2, 'id="branding_meta_description[' . $l['id'] . ']" class="input-unstyled full-width required autoexpanding"'); ?>
                  </span>
                  <?php
                  }
                ?>
                <span class="button-height block-label">
                  <span class="bold"><?php echo $lC_Language->get('field_site_meta_keywords'); ?></span>
                  <?php echo lc_show_info_bubble($lC_Language->get('info_bubble_site_meta_keywords'), 'margin-right:6px; margin-top:8px;'); ?>
                </span>                
                <?php
                  foreach ( $lC_Language->getAll() as $l ) {
                  ?>
                  <span class="required input full-width mid-margin-bottom">
                    <label class="button silver-gradient glossy" for="branding_meta_keywords[<?php echo $l['id'];?>]"><?php echo  $lC_Language->showImage($l['code']); ?></label>
                    <input type="text" value="<?php echo (isset($bInfo) && isset($bInfo[$l['id']]['meta_keywords']) ? $bInfo[$l['id']]['meta_keywords'] : null);?>" class="input-unstyled ten-columns required" id="branding_meta_keywords[<?php echo $l['id']; ?>]" name="branding_meta_keywords[<?php echo $l['id']; ?>]">
                  </span>
                  <?php
                  }
                ?>
                </span> 
                <span class="button-height block-label">
                  <span class="bold"><?php echo $lC_Language->get('field_home_page_meta_title'); ?></span>
                  <?php echo lc_show_info_bubble($lC_Language->get('info_bubble_home_page_meta_title'), 'margin-right:6px; margin-top:8px;'); ?>
                </span>
                <?php
                  foreach ( $lC_Language->getAll() as $l ) {
                  ?>
                  <span class="required input full-width mid-margin-bottom">
                    <label class="button silver-gradient glossy" for="branding_meta_title[<?php echo $l['id'];?>]"><?php echo  $lC_Language->showImage($l['code']); ?></label>
                    <input type="text" value="<?php echo (isset($bInfo) && isset($bInfo[$l['id']]['meta_title']) ? $bInfo[$l['id']]['meta_title'] : null);?>" class="input-unstyled ten-columns required" id="branding_meta_title[<?php echo $l['id']; ?>]" name="branding_meta_title[<?php echo $l['id']; ?>]">
                  </span>
                  <?php
                  }
                ?>
                <span class="button-height block-label">
                  <span class="bold"><?php echo $lC_Language->get('field_site_meta_title_prefix'); ?></span>
                  <?php echo lc_show_info_bubble($lC_Language->get('info_bubble_site_meta_title_prefix'), 'margin-right:6px; margin-top:8px;'); ?>
                </span>
                <?php
                  foreach ( $lC_Language->getAll() as $l ) {
                  ?>
                  <span class="required input full-width mid-margin-bottom">
                    <label class="button silver-gradient glossy" for="branding_meta_title_prefix[<?php echo $l['id']; ?>]"><?php echo  $lC_Language->showImage($l['code']); ?></label>
                    <input type="text" value="<?php echo (isset($bInfo) && isset($bInfo[$l['id']]['meta_title_prefix']) ? $bInfo[$l['id']]['meta_title_prefix'] : null);?>" class="input-unstyled ten-columns required" id="branding_meta_title_prefix[<?php echo $l['id']; ?>]" name="branding_meta_title_prefix[<?php echo $l['id']; ?>]">
                  </span>
                  <?php
                  }
                ?>
                <span class="button-height block-label"> 
                  <span class="bold"><?php echo $lC_Language->get('field_site_meta_title_suffix'); ?></span>
                  <?php echo lc_show_info_bubble($lC_Language->get('info_bubble_site_meta_title_suffix'), 'margin-right:6px; margin-top:8px;'); ?>
                </span>
                <?php
                  foreach ( $lC_Language->getAll() as $l ) {
                  ?>
                  <span class="required input full-width mid-margin-bottom">
                    <label class="button silver-gradient glossy" for="branding_meta_title_suffix[<?php echo $l['id']; ?>]"><?php echo  $lC_Language->showImage($l['code']); ?></label>
                    <input type="text" value="<?php echo (isset($bInfo) && isset($bInfo[$l['id']]['meta_title_suffix']) ? $bInfo[$l['id']]['meta_title_suffix'] : null); ?>" class="input-unstyled ten-columns required" id="branding_meta_title_suffix[<?php echo $l['id']; ?>]" name="branding_meta_title_suffix[<?php echo $l['id']; ?>]">
                  </span>
                  <?php
                  }
                ?>
                <p class="button-height block-label">
                  <label for="branding_meta_title_delimeter" class="label margin-top"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_site_meta_title_delimeter')) . $lC_Language->get('field_site_meta_title_delimeter'); ?></label>
                  <input type="text" name="branding_meta_title_delimeter" id="branding_meta_title_delimeter" class="input full-width required mid-margin-top" value="<?php echo (isset($bInfo) && isset($bInfo['meta_delimeter']) ? $bInfo['meta_delimeter'] : null); ?>">
                </p>
              </div>
            </div>
          </div>
          <div id="social" class="with-padding">
            <p class="button-height block-label">
              <label for="branding_social_fb_page" class="label"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_facebook_page')) . $lC_Language->get('field_facebook_page'); ?> </label>
              <input type="text" name="branding_social_fb_page" id="branding_social_fb_page" class="input full-width required small-margin-top margin-bottom" value="<?php echo (isset($bInfo) && isset($bInfo['social_facebook_page']) ? $bInfo['social_facebook_page'] : null); ?>">
            </p>
            <p class="button-height block-label">
              <label for="branding_social_twitter" class="label"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_twitter')) . $lC_Language->get('field_twitter'); ?> </label>
              <input type="text" name="branding_social_twitter" id="branding_social_twitter" class="input full-width required small-margin-top margin-bottom" value="<?php echo (isset($bInfo) && isset($bInfo['social_twitter']) ? $bInfo['social_twitter'] : null); ?>">
            </p>
            <p class="button-height block-label">
              <label for="branding_social_pinterest" class="label"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_pinterest')) . $lC_Language->get('field_pinterest'); ?> </label>
              <input type="text" name="branding_social_pinterest" id="branding_social_pinterest" class="input full-width required small-margin-top margin-bottom" value="<?php echo (isset($bInfo) && isset($bInfo['social_pinterest']) ? $bInfo['social_pinterest'] : null); ?>">
            </p>
            <p class="button-height block-label">
              <label for="branding_social_google_plus" class="label"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_google_plus')) . $lC_Language->get('field_google_plus'); ?> </label>
              <input type="text" name="branding_social_google_plus" id="branding_social_google_plus" class="input full-width required small-margin-top margin-bottom" value="<?php echo (isset($bInfo) && isset($bInfo['social_google_plus']) ? $bInfo['social_google_plus'] : null); ?>">
            </p>
            <p class="button-height block-label">
              <label for="branding_social_youtube" class="label"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_youtube')) . $lC_Language->get('field_youtube'); ?> </label>
              <input type="text" name="branding_social_youtube" id="branding_social_youtube" class="input full-width required small-margin-top margin-bottom" value="<?php echo (isset($bInfo) && isset($bInfo['social_youtube']) ? $bInfo['social_youtube'] : null); ?>">
            </p>
            <p class="button-height block-label">
              <label for="branding_social_linkedin" class="label"><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_linkedin')) . $lC_Language->get('field_linkedin'); ?> </label>
              <input type="text" name="branding_social_linkedin" id="branding_social_linkedin" class="input full-width required small-margin-top margin-bottom" value="<?php echo (isset($bInfo) && isset($bInfo['social_linkedin']) ? $bInfo['social_linkedin'] : null); ?>">
            </p>
          </div>
          <div id="footer" class="with-padding">
            <div class="bold mid-margin-bottom">
              <?php echo $lC_Language->get('field_site_footer_text'); ?><?php echo lc_show_info_bubble($lC_Language->get('info_bubble_footer')); ?>
            </div>
            <?php
              foreach ( $lC_Language->getAll() as $l ) {
              ?>
              <span class="required input full-width autoexpanding mid-margin-bottom">
                <label for="branding_footer_text[<?php echo $l['id']; ?>]" class="button silver-gradient glossy"><?php echo  $lC_Language->showImage($l['code']); ?></label>
                <?php echo lc_draw_textarea_field('branding_footer_text[' . $l['id'] . ']', (isset($bInfo) && isset($bInfo[$l['id']]['footer_text']) ? $bInfo[$l['id']]['footer_text'] : null), 48, 2, 'id="branding_footer_text[' . $l['id'] . ']" class="required input-unstyled full-width autoexpanding"'); ?>
              </span>
              <?php
              }
            ?>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="clear-both"></div>
  <div class="six-columns twelve-columns-tablet margin-bottom">
    <div id="buttons-menu-div-listing">
      <div id="buttons-container" style="position: relative;" class="clear-both">
        <div style="float:right;">
          <p class="button-height" align="right">
            <a class="button<?php echo (((int)$_SESSION['admin']['access'][$lC_Template->getModule()] < 3) ? ' disabled' : NULL); ?> big icon-tick green-gradient" href="<?php echo (((int)$_SESSION['admin']['access'][$lC_Template->getModule()] < 2) ? '#' : 'javascript://" onclick="validateForm(\'#branding_manager\');'); ?>">
              <span><?php echo $lC_Language->get('button_save'); ?></span>
            </a>&nbsp;
          </p>
        </div>
      </div>
    </div>
  </div>
</section>