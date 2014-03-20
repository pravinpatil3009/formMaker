<?php
// $Id: page.tpl.php,v 1.1 2009/09/30 01:27:41 blagoj Exp $
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head profile="http://gmpg.org/xfn/11">
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <!--[if lt IE 7]>
    <link rel="stylesheet" href="<?php print base_path() . path_to_theme(); ?>/ie6.css" type="text/css" media="screen" />
  <![endif]--> 

</head>
  <body>
    <!-- header starts-->
    <div id="wrapper">

      <div id="header">

        <div id="header_top"> 
          <div id="logo">
            <a href="<?php print $front_page; ?>"><?php print $site_name; ?></a>
            <h1><?php print $site_slogan; ?></h1>
          </div>
    
          <div id="header_menu">
            <?php print theme('links', $primary_links, array('class' => 'menu', 'id' => 'menu')); ?>
          </div>
        </div>
      </div><!-- #header end -->
      
      <div id="contents" class="clearfix">
        <div id="left_col">
          
          <div class="main_content">
          <div id="breadcrumb"><?php print $breadcrumb; ?></div>
            <?php if (!empty($title) && empty($node)): ?><h2><?php print $title; ?></h2><?php endif; ?>
            <?php if (!empty($tabs)): ?><div class="tabs"><?php print $tabs; ?></div><?php endif; ?>
            <?php if (!empty($messages)): print $messages; endif; ?>
            <?php if (!empty($help)): print $help; endif; ?>
          </div>
           <?php if ($wrap_content): ?>
           <div class="main_content">
           <?php endif; ?>
            <?php print $content; ?>
            <?php if ($wrap_content): ?>
           </div>
           <?php endif; ?>
  
       </div><!-- #left_col end -->
       
         <div id="right_col">
           <?php if ($mission && $is_front): ?>
             <div id="information_area" class="clearfix">
               <div class="side_box" id="information">
                 <h3><?php print t('Mission') ?></h3>
                 <div id="information_contents"><?php print $mission ?></div>
               </div>
            </div>
          <?php endif; ?>
         
          <?php if ($search_box): ?>
             <div class="side_box" id="search_area_top">
               <?php print $search_box ?>
             </div>
           <?php endif; ?>
           <?php print $right; ?>
         </div><!-- #right_col end -->
    </div><!-- #contents end -->
      
  <div id="footer">
    <ul id="copyright">
      <li><?php print $footer_msg ?></li>
      <?php if ($footer_message): ?><li><?php print $footer_message; ?></li><?php endif; ?>
      <li><a href="http://www.mono-lab.net/">Theme designed by mono-lab</a></li>     
      <li><a href="http://topdrupalthemes.net">Drupal Theme</a></li>
      <li><a href="http://www.newhostgatorcoupon.com">hostgator coupon</a></li>
    </ul>
  </div>
 
</div><!-- #wrapper end -->

<div id="return_top">
 <a href="#wrapper"></a>
</div>
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>
<?php print $closure; ?>
</body>
</html>