<header id="navtop">
  <a href="<?php echo base_url (array ());?>" class="logo fleft">
    <img src="/resource/admin/images/logo_m.png" alt="ZEUS DESIGN">
  </a>
<?php
  if (identity ()->user ()) { ?>
    <nav class="fright">
      <ul>
        <li>
          <a href="<?php echo base_url (array ('admin', 'logout'));?>" class="navactive">登出</a>
        </li>
      </ul>
    </nav>
<?php
  } ?>
</header>
