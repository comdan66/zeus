
<div class="works-page main grid-wrap">
  <header class="grid col-full">
    <hr>
    <p class="fleft">設計作品</p>
  </header>

  <aside class="grid col-one-quarter mq2-col-full">
    <menu>
<?php if ($tags = WorkTag::find ('all', array ('include' => array ('sub_tags'), 'conditions' => array ('work_tag_id = ?', 0)))) {
        foreach ($tags as $tag) {?>
          <a href='<?php echo base_url (array ('works', $tag->name));?>'><?php echo $tag->name;?></a><br>
    <?php if ($tag->sub_tags) {
            foreach ($tag->sub_tags as $sub_tag) { ?>
              <a href='<?php echo base_url (array ('works', $sub_tag->name));?>' class='meulist'>- <?php echo $sub_tag->name;?></a><br>
      <?php }
          }
        }
      } ?>
    </menu>
  </aside>
  
  <section class="grid col-three-quarters mq2-col-full">
    <div class="grid-wrap works">
<?php if ($works) {
        foreach ($works as $work) { ?>
          <figure class="grid col-one-third mq1-col-one-half mq2-col-one-third mq3-col-full work_1">
            <a href="<?php echo base_url (array ('work', $work->id));?>">
              <img src="<?php echo $work->file_name->url ('246x157c');?>" alt="<?php echo $work->title;?>" style='width: 246px; height: 157px;' width='246' height='157' />
              <span class="zoom"></span>
            </a>
            <figcaption>
              <a href="<?php echo base_url (array ('work', $work->id));?>"><?php echo $work->title;?></a>
              <p class="gral"><?php echo $work->content;?></p>
            </figcaption>
          </figure>
  <?php }
      } ?>
    </div>
  </section>  
</div>