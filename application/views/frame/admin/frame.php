<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
  <head>
    <?php echo isset ($meta) ? $meta:''; ?>
    <title><?php echo isset ($title) ? $title : ''; ?></title>
    <link rel="chitorch icon" href="<?php echo base_url (array ('resource', 'site', 'images', 'favicon.ico'));?>">

    <?php echo isset ($css) ? $css:''; ?>
    <?php echo isset ($js) ? $js:''; ?>

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
<?php echo isset ($hidden) ? $hidden:'';?>

    <div class="container">
<?php echo render_cell ('admin_cells', 'main_header');?>

      <div class="services-page main grid-wrap">
  <?php echo render_cell ('admin_cells', 'sub_header');?>
  <?php echo render_cell ('admin_cells', 'side_menu');?>

  <?php echo isset ($content) ? $content : '';?>
      </div>
<?php echo render_cell ('admin_cells', 'footer');?>
    </div>
  </body>
</html>
