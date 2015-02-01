  <div class="work-page main grid-wrap">
    <header class="grid col-full">
      <hr />
      <p class="fleft">
        <a href="<?php echo base_url (array ('works'));?>">設計作品 </a>&raquo; <?php echo $work->title;?>
      </p>
    </header>

    <aside class="grid col-one-quarter mq2-col-one-third mq3-col-full">
<?php if ($work->blocks) {
        foreach ($work->blocks as $block) { ?>
          <h6><?php echo $block->title;?></h6>
    <?php if ($block->items) { ?>
            <ul class="halfmbottom">
        <?php foreach ($block->items as $item) { ?>
                <li>
                  <?php echo $item->link ? anchor ($item->link, $item->title, 'target="_blank"') : $item->title;?>
                </li>
        <?php } ?>
            </ul>
    <?php }
        }
      } ?>
    </aside>

    <section class="grid col-three-quarters mq2-col-two-thirds mq3-col-full">
<?php if ($work->pics) {
        foreach ($work->pics as $pic) { ?>
          <figure class="">
            <a>
              <img src="<?php echo $pic->file_name->url ('800w');?>" alt="<?php echo $work->title;?>" >
            </a>
            <figcaption>
              <p></p>
            </figcaption>
          </figure>    
  <?php }
      } ?>
    </section>  
  </div>
