<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<?php $mobiletheme = 'yes'; ?>
  <head>

    <title><?php print $head_title; ?></title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <link rel="apple-touch-icon" href="<?php print $base_path . path_to_theme() ?>/apple-touch-icon.png"/>
    <?php print $head; ?>
    <?php print $styles; ?>
    <?php print $scripts; ?>
    <script type=”text/javascript” src=”http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js”></script>

  <body class="<?php print $body_classes; ?>">

    <div id="page">

    <!-- ______________________ HEADER _______________________ -->

    <div id="header">
      <div id="header-inner" class="inner">

      <div id="logo-title">

        <?php if (!empty($logo)): ?>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
          </a>
        <?php endif; ?>

        <div id="name">
          <?php if (!empty($site_name)): ?>
            <h1 id="site-name">
              <a href="<?php print $front_page ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
            </h1>
          <?php endif; ?>

        </div> <!-- /name -->

      </div> <!-- /logo-title -->

      <?php if ($header): ?>
        <div id="header-region">
          <?php print $header; ?>
        </div>
      <?php endif; ?>

      <?php print $search_box; ?>
      </div> <!-- /header-inner -->
    </div> <!-- /header -->

    <!-- ______________________ MAIN _______________________ -->

    <div id="main" class="clearfix">

    <?php if (!empty($primary_links) || !empty($secondary_links)): ?>
      <div id="navigation" class="menu <?php if (!empty($primary_links)) { print "with-main-menu"; } if (!empty($secondary_links)) { print " with-sub-menu"; } ?>">
        <?php if (!empty($primary_links)){ print theme('links', $primary_links, array('id' => 'primary', 'class' => 'links main-menu')); } ?>
        <?php if (!empty($secondary_links)){ print theme('links', $secondary_links, array('id' => 'secondary', 'class' => 'links sub-menu')); } ?>
      </div> <!-- /navigation -->
    <?php endif; ?>

      <div id="content">
        <div id="content-inner" class="inner column center">

          <?php if ($content_top): ?>
            <div id="content-top">
              <?php print $content_top; ?>
            </div> <!-- /#content-top -->
          <?php endif; ?>

          <?php if ($breadcrumb || $title || $mission || $messages || $help || $tabs): ?>
            <div id="content-header">

              <?php print $breadcrumb; ?>

              <?php if ($title): ?>
                <h1 class="title"><?php print $title; ?></h1>
              <?php endif; ?>

              <?php if ($mission): ?>
                <div id="mission"><?php print $mission; ?></div>
              <?php endif; ?>

              <?php print $messages; ?>

              <?php print $help; ?>

              <?php if ($tabs): ?>
                <div class="tabs"><?php print $tabs; ?></div>
              <?php endif; ?>

            </div> <!-- /#content-header -->
          <?php endif; ?>

          <div id="content-area">
            <?php print $content; ?>
          </div> <!-- /#content-area -->

          <?php print $feed_icons; ?>

          <?php if ($content_bottom): ?>
            <div id="content-bottom">
              <?php print $content_bottom; ?>
            </div><!-- /#content-bottom -->
          <?php endif; ?>

          </div>
        </div> <!-- /content-inner /content -->

      </div> <!-- /main -->

      <!-- ______________________ FOOTER _______________________ -->

      <?php if(!empty($footer_message) || !empty($footer_block)): ?>
        <div id="footer">
          <?php print $footer_message; ?>
          <?php print $footer_block; ?>
        </div> <!-- /footer -->
      <?php endif; ?>

    </div> <!-- /page -->
    <?php print $closure; ?>
  </body>
</html>