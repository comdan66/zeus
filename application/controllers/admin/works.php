<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Works extends Admin_controller {

  public function __construct () {
    parent::__construct ();
    identity ()->user () || redirect (array ('admin'));
  }

  private function _delete ($ids) {
    if ($ids)
      array_map (function ($work) {
        array_map (function ($block) {
          array_map (function ($item) { $item->delete (); }, $block->items);
          $block->delete ();
        }, $work->blocks);

        array_map (function ($pic) {
          $pic->file_name->cleanAllFiles ();
          $pic->delete ();
        }, $work->pics);

        WorkTagMap::delete_all (array ('conditions' => array ('work_id = ?', $work->id)));

        $work->file_name->cleanAllFiles ();
        $work->delete ();
      }, Work::find ('all', array ('conditions' => array ('id IN (?)', $ids))));

    identity ()->set_session ('_flash_message', '刪除成功!', true);
    redirect (array ('admin', $this->get_class ()), 'refresh');
  }

  public function index ($offset = 0) {
    if ($delete_ids = $this->input_post ('delete_ids'))
      $this->_delete ($delete_ids);

    $conditions = array ();

    $limit = 10;
    $total = Work::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;
    $works = Work::find ('all', array ('order' => 'id DESC', 'offset' => $offset, 'limit' => $limit, 'conditions' => $conditions));

    $page_total = ceil ($total / $limit);
    $now_page = ($offset / $limit + 1);
    $next_link = $now_page < $page_total ? base_url (array ('admin', $this->get_class (), $this->get_method (), $now_page * $limit)) : '#';
    $prev_link = $now_page - 2 >= 0 ? base_url (array ('admin', $this->get_class (), $this->get_method (), ($now_page - 2) * $limit)) : '#';
    $pagination = array ('total' => $total, 'page_total' => $page_total, 'now_page' => $now_page, 'next_link' => $next_link, 'prev_link' => $prev_link);

    $this->load_view (array ('works' => $works, 'pagination' => $pagination));
  }

  public function create () {
    if ($this->has_post ()) {
      $title       = trim ($this->input_post ('title'));
      $content     = trim ($this->input_post ('content'));
      $file        = $this->input_post ('file', true, true);
      $files       = $this->input_post ('files[]', true, true);
      $is_enabled  = $this->input_post ('is_enabled');
      $tag_ids     = ($tag_ids = $this->input_post ('tag_ids')) ? $tag_ids : array ();
      $blocks      = $this->input_post ('blocks');

      if (verifyCreateOrm ($work = Work::create (array ('title' => $title ? $title : '', 'content' => $content ? $content : '', 'file_name' => '', 'is_enabled' => is_numeric ($is_enabled) ? $is_enabled : 1)))) {
        if ($file)
          $work->file_name->put ($file);

        if ($files)
          foreach ($files as $file)
            if (verifyCreateOrm ($pic = WorkPicture::create (array ('work_id' => $work->id, 'file_name' => ''))))
              $pic->file_name->put ($file);
            else 
              @$pic->delete ();

        if ($tag_ids)
          array_map (function ($tag) use ($work) {
            WorkTagMap::create (array ('work_id' => $work->id, 'work_tag_id' => $tag->id));
          }, WorkTag::find ('all', array ('select' => 'id', 'conditions' => array ('id IN (?)', $tag_ids))));

        if ($blocks)
          array_map (function ($block) use ($work) {
            if (verifyCreateOrm ($b = WorkBlock::create (array ('work_id' => $work->id, 'title' => $block['title']))) && isset ($block['items']))
              array_map (function ($item) use ($b) {
                WorkBlockItem::create (array ('work_block_id' => $b->id, 'title' => $item['title'], 'link' => $item['link']));
              }, $block['items']);
          }, $blocks);

        identity ()->set_session ('_flash_message', '新增成功!', true);
        redirect (array ('admin', $this->get_class ()));
      } else {
        @$work->delete ();
      }
    } else {
      $this->load_view ();
    }
  }

  public function edit ($id = 0) {
    if (!($work = Work::find ('one', array ('conditions' => array ('id = ?', $id)))))
      redirect (array ('admin', $this->get_class ()));

    if ($this->has_post ()) {
      $title       = trim ($this->input_post ('title'));
      $content     = trim ($this->input_post ('content'));
      $file        = $this->input_post ('file', true, true);
      $pic_ids     = ($pic_ids = $this->input_post ('pic_ids')) ? $pic_ids : array ();
      $files       = $this->input_post ('files[]', true, true);
      $is_enabled  = $this->input_post ('is_enabled');
      $tag_ids     = ($tag_ids = $this->input_post ('tag_ids')) ? $tag_ids : array ();
      $blocks      = $this->input_post ('blocks');
      $old_tag_ids = field_array ($work->tags, 'id');

      if ($file)
        $work->file_name->put ($file);

      if ($del_ids = array_diff (field_array ($work->pics, 'id'), $pic_ids))
        array_map (function ($pic) {
          $pic->file_name->cleanAllFiles ();
          $pic->delete ();
        }, WorkPicture::find ('all', array ('conditions' => array ('id IN (?) AND work_id = ?', $del_ids, $work->id))));

      if ($files)
        foreach ($files as $file)
          if (verifyCreateOrm ($pic = WorkPicture::create (array ('work_id' => $work->id, 'file_name' => ''))))
            $pic->file_name->put ($file);
          else 
            @$pic->delete ();

      if ($del_ids = array_diff ($old_tag_ids, $tag_ids))
        WorkTagMap::delete_all (array ('conditions' => array ('work_id = ? AND work_tag_id IN (?)', $work->id, $del_ids)));

      if ($tag_ids = array_diff ($tag_ids, $old_tag_ids))
        array_map (function ($tag) use ($work) {
          WorkTagMap::create (array ('work_id' => $work->id, 'work_tag_id' => $tag->id));
        }, WorkTag::find ('all', array ('select' => 'id', 'conditions' => array ('id IN (?)', $tag_ids))));
      
      if ($work->blocks)
        array_map (function ($block) {
          array_map (function ($item) {
            $item->delete ();
          }, $block->items);

          $block->delete ();
        }, $work->blocks);

      if ($blocks)
        array_map (function ($block) use ($work) {
          if (verifyCreateOrm ($b = WorkBlock::create (array ('work_id' => $work->id, 'title' => $block['title']))) && isset ($block['items']))
            array_map (function ($item) use ($b) {
              WorkBlockItem::create (array ('work_block_id' => $b->id, 'title' => $item['title'], 'link' => $item['link']));
            }, $block['items']);
        }, $blocks);

      $work->title = $title ? $title : '';
      $work->content = $content ? $content : '';
      $work->save ();

      identity ()->set_session ('_flash_message', '修改成功!', true);
      redirect (array ('admin', $this->get_class ()));
    } else {
      $this->load_view (array ('work' => $work));
    }
  }
}