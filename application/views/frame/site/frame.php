<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <?php echo isset ($meta) ? $meta:'';?>
    <title><?php echo isset ($title) ? $title : '';?></title>
    <link rel="chitorch icon" href="<?php echo base_url (array ('resource', 'site', 'images', 'favicon.ico'));?>">
    
<?php echo isset ($css) ? $css : '';?>
<?php echo isset ($js) ? $js : '';?>

  <body>
    <?php echo isset ($hidden) ? $hidden : '';?>
    <div class="container">
      <header id="navtop">
        <a href="<?php echo base_url ();?>" class="logo fleft">
          <img src="<?php echo base_url (array ('resource', 'site', 'images', 'logo.png'));?>" alt="ZEUS DESIGN">
        </a>
        <nav class="fright">
          <ul>
            <li><a href="<?php echo base_url ();?>" class="navactive">Home</a></li>
          </ul>
          <ul>
            <li><a href="<?php echo base_url (array ('abouts'));?>">關於宙思</a></li>
          </ul>
          <ul>
          <li><a href="<?php echo base_url (array ('works', '48'));?>">設計作品</a></li>
          </ul>
          <ul>
            <li><a href="<?php echo base_url (array ('contacts'));?>">聯絡我們</a></li>
          </ul>
        </nav>
      </header>

    <?php echo isset ($content) ? $content : '';?>

      <div class="divide-top">
        <footer class="grid-wrap">
          <ul class="grid col-one-third social">
            <li>© copyright 2014 ZEUS Design CO., Ltd.</li>
          </ul>
        
          <div class="up grid col-one-third ">
            <a href="#navtop" title="Go back up">&uarr;</a>
          </div>
          
          <nav class="grid col-one-third ">
            <ul>
              <li><a href="<?php echo base_url (array ());?>">Home</a></li>
              <li><a href="<?php echo base_url (array ('abouts'));?>">About ZEUS</a></li>
              <li><a href="<?php echo base_url (array ('works'));?>">Works</a></li>
              <li><a href="<?php echo base_url (array ('contacts'));?>">Contact</a></li>
            </ul>
          </nav>
        </footer>
      </div>

    </div>
  </body>
</html>