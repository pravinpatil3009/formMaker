<?php
// $Id: block.tpl.php,v 1.1 2009/03/02 08:20:32 drupalexpertamit Exp $
// Drupal themes designed by DrupalThemeBank.com.
// Created Feb 13, 2009, Last Updated: Feb 16, 2009
?>
  <div class="block block-<?php print $block->module; ?>" id="block-<?php print $block->module; ?>-<?php print $block->delta; ?>">
   <h2 class="title"><?php print $block->subject; ?></h2>
    <div class="content"><?php print $block->content; ?></div>
 </div>
