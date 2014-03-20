<?php
// $Id: block.tpl.php,v 1.1 2009/09/30 01:27:41 blagoj Exp $
?>
<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="side_box block-<?php print $block->module ?>" >
  <?php if ($block->subject): ?>
    <h3><?php print $block->subject ?></h3>
  <?php endif;?>
  <?php print $block->content ?>
</div>