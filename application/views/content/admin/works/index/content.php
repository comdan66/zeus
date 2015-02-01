<section class="grid col-three-quarters mq2-col-full">
  <h2>設計管理 > 設計列表</h2>
  <hr>

  <article id="navplace">
    <form action="<?php echo base_url (array ('admin', 'works'));?>" method="post">
      <button type="submit" id="delete">刪除</button>
      &nbsp;
      <button type="button" id="select_all">全選</button>
      &nbsp;
      <button type="button" id="create" onClick='window.location.assign("<?php echo base_url (array ('admin', 'works', 'create'));?>");'>新增</button>
      
      <br/><br/>
      
      <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
           <th width='20'><input type="checkbox" id='check_all'></th>
           <th width='120'>標題</th>
           <th >內容</th>
           <th width='125'>封面</th>
           <th width='100'>分類</th>
           <th width='40'>狀態</th>
           <th width="40">修改</th>
          </tr>
        </thead>
        <tbody>
          </tr>
    <?php if ($works) {
            foreach ($works as $work) { ?>
              <tr>
                <td><label><input type="checkbox" name='delete_ids[]' value='<?php echo $work->id;?>'></label></td>
                <td class="textleft"><?php echo $work->title;?></td>
                <td class="textleft"><?php echo $work->content;?></td>
                <td class="textleft">
            <?php if ((string)$work->file_name) { ?>
                    <img src='<?php echo $work->file_name->url ('122x78c');?>' />
            <?php } else { ?>
                    沒封面
            <?php } ?>
                </td>
                <td class="textleft w100">
                  <?php echo implode ('', array_map (function ($tag) { return '<span>' . $tag . '</span>';}, field_array ($work->tags, 'name')));?>
                </td>
                <td><?php echo $work->is_enabled ? '上架' : '下架';?></td>
                <td><a href="<?php echo base_url (array ('admin', 'works', 'edit', $work->id));?>">修改</a></td>
              </tr>
      <?php }
          } else { ?>
            <tr>
              <td colspan='6'>沒有任何資料產品</td>
            </tr>
    <?php } ?>
        </tbody>
      </table>
      <p>
        <a href="<?php echo $pagination['prev_link'];?>" class="arrowpre"></a>
        <?php echo $pagination['now_page'];?> / <?php echo $pagination['page_total'];?>
        <a href="<?php echo $pagination['next_link'];?>" class="arrow"></a>
        ｜ 筆數共<?php echo $pagination['total'];?>筆
      </p>
    </form>
  </article>
</section>