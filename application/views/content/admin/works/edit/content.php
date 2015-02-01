<section class="grid col-three-quarters mq2-col-full">
  <h2>設計管理 > 新增設計</h2>
  <hr>

  <form action="<?php echo base_url (array ('admin', 'works', 'edit', $work->id));?>" method="post" enctype="multipart/form-data" >
    <article>
<?php if (isset ($message) && $message) { ?>
        <div class='error'><?php echo $message;?></div>
<?php } ?>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td width='150'>標題</td>
            <td class="textleft">
              <input type='text' name='title' value="<?php echo $work->title;?>" placeholder='請輸入標題..' maxlength='100' pattern=".{1,}" required title="請輸入標題!" />
            </td>
          </tr>
          <tr>
            <td>內容</td>
            <td class="textleft">
              <textarea name='content' cols="45" rows="5" placeholder='請輸入內容..' pattern=".{1,}" required title="輸入內文!" ><?php echo $work->content;?></textarea>
            </td>
          </tr>
          <tr>
            <td>
              封面
              <div class='info'>( 圖片格式：jpg / gif / png )</div>
            </td>
            <td class="textleft">
        <?php if ((string)$work->file_name) { ?>
                <img src="<?php echo $work->file_name->url ('246x157c');?>" alt="" width="80" height="80">
                <hr/>
        <?php } ?>
              <input type='file' name='file' value=''/>
            </td>
          </tr>
          <tr>
            <td>
              圖片
              <div class='info'>( 圖片格式：jpg / gif / png )</div>
            </td>
            <td class="textleft">
              <div class='files'>
                <button type="button" class='add_pic'>＋</button>
              </div>
        <?php if ($work->pics) { ?>
                <div class="pic">
                  <ul>
              <?php foreach ($work->pics as $pic) { ?>
                      <li>
                        <input type='hidden' name='pic_ids[]' value='<?php echo $pic->id;?>' />
                        <img src="<?php echo $pic->file_name->url ('100w');?>" alt="" width="80" height="80">
                        <a class='del_pic'>刪除</a>
                      </li>
              <?php } ?>
                  </ul>
                </div>
        <?php } ?>
            </td>
          </tr>
          <tr>
            <td>分類</td>
            <td class="textleft">
        <?php if ($tags = WorkTag::find ('all', array ('include' => array ('sub_tags'), 'conditions' => array ('work_tag_id = ?', 0)))) {
                $ids = field_array ($work->tags, 'id');

                foreach ($tags as $tag) {?>
                  <div class='main'>
                    <label><input type='checkbox' class='l' name='tag_ids[]' value='<?php echo $tag->id;?>'<?php echo $ids && in_array ($tag->id, $ids) ? ' checked' : '';?>/> <?php echo $tag->id;?></label>
                  </div>
            <?php if ($tag->sub_tags) {
                    foreach ($tag->sub_tags as $sub_tag) { ?>
                      <div class='sub'>
                        <label><input type='checkbox' class='l' name='tag_ids[]' value='<?php echo $sub_tag->id;?>'<?php echo $ids && in_array ($sub_tag->id, $ids) ? ' checked' : '';?>/> <?php echo $sub_tag->id;?></label>
                      </div>   
              <?php }
                  }
                }
              } else { ?>
                目前尚未新增任何分類。
        <?php } ?>
            </td>
          </tr>
          <tr>
            <td>狀態</td>
            <td class="textleft">
              <select name='is_enabled'>
                <option value='1'>上架</option>
                <option value='0'>下架</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>

<?php if ($blocks = WorkBlock::find ('all', array ('include' => array ('items'), 'conditions' => array ('work_id = ?', $work->id)))) {
        foreach ($blocks as $index => $block) { ?>
          <table data-index='<?php echo $index;?>' data-count='<?php echo count ($block->items);?>' width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;'>
            <tbody>
              <tr>
                <td width="80">標題</td>
                <td class="textleft">
                  <input type='text' value="<?php echo $block->title;?>" name='blocks[<?php echo $index;?>][title]' placeholder='請輸入標題' title="輸入100個字元以內" >
                  <div class='delete'>x</div>
                </td>
                <td width='120'>
                  <button type="button" class='add_item'>＋ 新增說明</button>
                </td>
              </tr>
        <?php if ($block->items) {
                foreach ($block->items as $c => $item) { ?>
                  <tr>
                    <td>說明</td>
                      <td class="textleft" colspan='2'>
                        <input type='text' name='blocks[<?php echo $index;?>][items][<?php echo $c;?>][title]' value="<?php echo $item->title;?>" placeholder='請輸入文字內容..'/>
                        <input type='text' name='blocks[<?php echo $index;?>][items][<?php echo $c;?>][link]' value="<?php echo $item->title;?>" placeholder='請輸入鏈結網址..'/>
                      </td>
                  </tr>
          <?php }
              } ?>
            </tbody>
          </table>
  <?php }
      } ?>

      <hr />

      <button type="button" id='add_block'>加入小區塊</button>
      <button type="submit">確定修改</button>
    </article>
  </form>
</section>

<script id='_file' type='text/x-html-template'>
  <input type="file" name='files[]' class='file' value='' accept="image/jpg, image/jpeg, image/png" />
</script>

<script id='_block' type='text/x-html-template'>
  <table data-index='<%=index%>' data-count='0' width="100%" border="0" cellspacing="0" cellpadding="0" style='margin: 15px auto;'>
    <tbody>
      <tr>
        <td width="80">標題</td>
        <td class="textleft">
          <input type='text' value="" name='blocks[<%=index%>][title]' placeholder='請輸入標題' title="輸入100個字元以內" >
          <div class='delete'>x</div>
        </td>
        <td width='120'>
          <button type="button" class='add_item'>＋ 新增說明</button>
        </td>
      </tr>
    </tbody>
  </table>
</script>

<script id='_item' type='text/x-html-template'>
  <tr>
    <td>說明</td>
      <td class="textleft" colspan='2'>
        <input type='text' name='blocks[<%=index%>][items][<%=c%>][title]' value="" placeholder='請輸入文字內容..'/>
        <input type='text' name='blocks[<%=index%>][items][<%=c%>][link]' value="" placeholder='請輸入鏈結網址..'/>
      </td>
  </tr>
</script>