<?php

/**
 *
 * Install
 * =======
 * Move this file to /site/snippets/ and rename it audio.php
 * 
 * @author: Thomas Fanninger <thomas@fanninger.at>
 * @version: 0.3
 */

?>

<audio<?php echo (!empty($preload))?' preload="'.$preload.'"':''; ?><?php echo ($controls)?' controls="constrols"':''; ?><?php echo ($loop)?' loop="loop"':''; ?><?php echo ($autoplay)?' autoplay="autoplay"':''; ?><?php echo ($muted)?' muted="muted"':''; ?><?php echo (!empty($class))?' class="'.$class.'"':''; ?>>
  <?php if(!empty($mp3)) { ?>
  <source src="<?php echo $mp3; ?>" type="audio/mpeg"/>
  <?php } ?>
  <?php if(!empty($ogg)){ ?>
  <source src="<?php echo $ogg; ?>" type="audio/ogg"/>
  <?php } ?>
  <?php if(!empty($wav)){ ?>
  <source src="<?php echo $wav; ?>" type="audio/wav"/>
  <?php } ?>
  Your browser does not support the <code>audio</code> element.
</audio>