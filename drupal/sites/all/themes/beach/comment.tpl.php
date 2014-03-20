<?php
?><div class="comment<?php print(isset($comment->status) && $comment->status == COMMENT_NOT_PUBLISHED) ? ' comment-unpublished' : ''; ?> <?php print comment_classes($comment) .' '. $zebra ?> clear-block">

  <div class="comment-info">

    <?php if ($submitted): ?>
      <div class="picture">
        <?php print $picture ?>
        <span class="username"><strong><?php print t('By ') ?><?php print theme('username', $comment); ?></strong></span>
      </div>
    <?php endif; ?>

    <div class="meta">
      <span class="date">
        <?php print t('!date ago', array( '!date' => format_interval(time() - $comment->timestamp))); ?>
      </span>
      <?php if ($comment->new) : ?>
        <a id="new"></a>
        <span class="new"><?php print drupal_ucfirst($new) ?></span>
      <?php endif; ?>
    </div>

  </div> <!--/comment-info-->

  <div class="comment-content clear-block">

      <div class="permalink">
        <?php print l('#'. $comment->cid, 'node/'. $comment->nid, array('fragment' => 'comment-'. $comment->cid)); ?>
      </div>

      <?php if ($title): ?><h3 class="title"><?php print $title; ?></h3><?php endif; ?>

      <?php print $content ?>

      <?php if ($signature): ?>
        <div class="user-signature clear-block">
          <?php print $signature ?>
        </div>
      <?php endif; ?>

      <div class="links clear-block"><?php if ($links): ?><?php print $links ?><?php endif; ?></div>

  </div> <!--/comment-content-->

</div>
