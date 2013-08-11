<?php
/**
  @package    catalog::templates::boxes
  @author     Loaded Commerce, LLC
  @copyright  Copyright 2003-2013 Loaded Commerce Development Team
  @copyright  Portions Copyright 2003 osCommerce
  @copyright  Template built on DevKit http://www.bootstraptor.com under GPL license 
  @license    https://github.com/loadedcommerce/loaded7/blob/master/LICENSE.txt
  @version    $Id: tell_a_friend.php v1.0 2013-08-08 datazen $
*/
?>
<!--modules/boxes/tell_a_friend.php start-->
<div class="well" >
  <ul id="box-tell-a-friend" class="nav nav-list">
    <li class="nav-header"><?php echo $lC_Box->getTitle(); ?></li>
    <?php echo $lC_Box->getContent(); ?>
  </ul>
</div>
<script>
$(document).ready(function() {
  $("#box-tell-a-friend li").each(function(){
    if ($(this).attr('class') != 'nav-header') $(this).addClass('margin-left-li');
  });  
  $('#box-tell-a-friend-form').addClass('no-margin-bottom');
  $('#tell-a-friend-submit').html('<i class="btn btn-small btn-info cusrsor:pointer margin-bottom">Go</i>');
  $('#to_email_address').attr('style', 'width:73%;');
});
</script>
<!--modules/boxes/tell_a_friend.php end-->