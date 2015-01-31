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
    array_map (function ($work) {
      array_map (function ($block) {
        if (($block->type == 'file_name') || $block->file_name)
          $block->file_name->cleanAllFiles ();

        $block->delete ();
      }, $work->blocks);

      $work->delete ();
    }, Work::find ('all', array ('conditions' => array ('id IN (?)', $ids))));

    identity ()->set_session ('_flash_message', '刪除成功!', true);

    redirect (array ('admin', $this->get_class (), 'index'), 'refresh');
  }

  public function index ($offset = 0) {
    $start       = trim ($this->input_post ('start'));
    $end         = trim ($this->input_post ('end'));
    $work_tag_id = trim ($this->input_post ('work_tag_id'));

    if ($delete_ids = $this->input_post ('delete_ids'))
      $this->_delete ($delete_ids);

    $conditions = $start && $end && $work_tag_id ? array ('date BETWEEN ? AND ? AND work_tag_id = ?', $start, $end, $work_tag_id) : ($start && $end ? array ('date BETWEEN ? AND ?', $start, $end) : ($work_tag_id ? array ('work_tag_id = ?', $work_tag_id) : array ()));

    $limit = 10;
    $total = Work::count (array ('conditions' => $conditions));
    $offset = $offset < $total ? $offset : 0;
    $works = Work::find ('all', array ('order' => 'id DESC', 'offset' => $offset, 'limit' => $limit, 'conditions' => $conditions));

    $page_total = ceil ($total / $limit);
    $now_page = ($offset / $limit + 1);
    $next_link = $now_page < $page_total ? base_url (array ('admin', $this->get_class (), $this->get_method (), $now_page * $limit)) : '#';
    $prev_link = $now_page - 2 >= 0 ? base_url (array ('admin', $this->get_class (), $this->get_method (), ($now_page - 2) * $limit)) : '#';
    $pagination = array ('total' => $total, 'page_total' => $page_total, 'now_page' => $now_page, 'next_link' => $next_link, 'prev_link' => $prev_link);

    $this->load_view (array ('works' => $works, 'pagination' => $pagination, 'work_tag_id' => $work_tag_id, 'start' => $start, 'end' => $end));
  }

  public function tags () {
    if ($this->has_post ()) {
      if (($name = trim ($this->input_post ('name'))) && verifyCreateOrm (WorkTag::create (array ('name' => $name, 'sort' => WorkTag::count () + 1))))
        identity ()->set_session ('_flash_message', '新增成功!', true) && redirect (array ('admin', $this->get_class (), $this->get_method ()), 'refresh');

      if ($tags = $this->input_post ('tags')) {
        if ($delete_ids = array_diff (field_array (WorkTag::find ('all', array ('select' => 'id')), 'id'), array_map (function ($tag) { return $tag['id']; }, $tags))) {
          WorkTag::delete_all (array ('conditions' => array ('id IN (?)', $delete_ids)));
          Work::update_all (array ('set' => 'work_tag_id = 0', 'conditions' => array ('work_tag_id IN (?)', $delete_ids)));
        }

        array_map (function ($tag) {
          if ($tag['id'] && trim ($tag['name']) && trim ($tag['sort']))
            WorkTag::table ()->update ($set = array ('name' => trim ($tag['name']), 'sort' => trim ($tag['sort'])), array ('id' => $tag['id']));
        }, $tags);

        if (identity ()->set_session ('_flash_message', '修改成功!', true))
          redirect (array ('admin', $this->get_class (), $this->get_method ()), 'refresh');
      }
    }

    $tags = WorkTag::find ('all', array ('order' => 'sort DESC, id DESC'));
    $this->load_view (array ('tags' => $tags));
  }

  public function create () {
    if ($this->has_post ()) {
      $title = trim ($this->input_post ('title'));
      $file  = $this->input_post ('file', true, true);
      $date  = trim ($this->input_post ('date'));
      $is_enabled  = $this->input_post ('is_enabled');
      $work_tag_id = $this->input_post ('work_tag_id');

      $blocks = $this->input_post ('blocks');
      $block_files = get_upload_file ('block_files', 'all', false);

      if (true || ($title && $file && $date && is_numeric ($is_enabled))) {
        if (verifyCreateOrm ($work = Work::create (array ('title' => $title ? $title : '', 'file_name' => '', 'content' => '', 'date' => $date ? $date : date ('Y-m-d'), 'is_enabled' => is_numeric ($is_enabled) ? $is_enabled : 1, 'work_tag_id' => $work_tag_id ? $work_tag_id : 0)))) {
          $work->file_name->put ($file);
          $content = '';
          if ($blocks)
            foreach ($blocks as $i => $block) {
              if ($block['type'] == 'youtube') {
                parse_str (parse_url ($block['youtube'], PHP_URL_QUERY ), $block['youtube']);
                $block['youtube'] = isset ($block['youtube']['v']) ? $block['youtube']['v'] : '';
              }
              $b = WorkBlock::create (array ('work_id' => $work->id, 'sort' => $block['sort'], 'youtube' => $block['type'] == 'youtube' ? $block['youtube'] : '', 'type' => $block['type'], 'title' => $block['type'] == 'title' ? $block['title'] : '', 'content' => $content .= $block['type'] == 'content' ? $block['content'] : '', 'file_name' => ''));

              if ($block['type'] == 'file_name')
                if (!$b->file_name->put (array_shift ($block_files)))
                  $b->delete ();
            }
          $work->content = $content;
          $work->save ();

          identity ()->set_session ('_flash_message', '新增成功!', true);
          redirect (array ('admin', $this->get_class ()));
        } else {
          @$work->delete ();
        }
      } else {
        $this->load_view (array ('message' => '填寫的資料不完整！'));
      }
    } else {
      $this->load_view ();
    }
  }

  public function edit ($id = 0) {
    if (!($work = Work::find ('one', array ('conditions' => array ('id = ?', $id)))))
      redirect (array ('admin', $this->get_class ()));

    if ($this->has_post ()) {

      $title = trim ($this->input_post ('title'));
      $file  = $this->input_post ('file', true, true);
      $date  = trim ($this->input_post ('date'));
      $is_enabled  = $this->input_post ('is_enabled');
      $work_tag_id = $this->input_post ('work_tag_id');

      $old_blocks = $this->input_post ('old_blocks');

      $blocks = $this->input_post ('blocks');
      $block_files = get_upload_file ('block_files', 'all', false);

      if (true || ($title && $date && is_numeric ($is_enabled))) {
        if ($file)
          $work->file_name->put ($file);

        if ($delete_ids = array_diff (field_array ($work->blocks, 'id'), array_map (function ($block) {
          if ($block['type'] == 'youtube') {
            parse_str (parse_url ($block['youtube'], PHP_URL_QUERY ), $block['youtube']);
            $block['youtube'] = isset ($block['youtube']['v']) ? $block['youtube']['v'] : '';
          }
          WorkBlock::table ()->update ($set = array ('sort' => $block['sort'], 'youtube' => $block['type'] == 'youtube' ? $block['youtube'] : '', 'title' => $block['type'] == 'title' ? $block['title'] : '', 'content' => $block['type'] == 'content' ? $block['content'] : ''), array ('id' => $block['id'])); return $block['id']; }, $old_blocks ? $old_blocks : array ())))
          WorkBlock::delete_all (array ('conditions' => array ('id IN (?) AND work_id = ?', $delete_ids, $work->id)));

        $content = '';
        if ($blocks)
          foreach ($blocks as $i => $block) {
            if ($block['type'] == 'youtube') {
              parse_str (parse_url ($block['youtube'], PHP_URL_QUERY ), $block['youtube']);
              $block['youtube'] = isset ($block['youtube']['v']) ? $block['youtube']['v'] : '';
            }
            $b = WorkBlock::create (array ('work_id' => $work->id, 'type' => $block['type'], 'youtube' => $block['type'] == 'youtube' ? $block['youtube'] : '', 'title' => $block['type'] == 'title' ? $block['title'] : '', 'content' => $content .= $block['type'] == 'content' ? $block['content'] : '', 'file_name' => ''));

            if ($block['type'] == 'file_name')
              if (!$b->file_name->put (array_shift ($block_files)))
                $b->delete ();
          }

        $work->title = $title;
        $work->date  = $date;
        if ($content)
          $work->content = $content;
        $work->is_enabled   = $is_enabled;
        $work->work_tag_id = $work_tag_id ? $work_tag_id : 0;
        $work->save ();

        identity ()->set_session ('_flash_message', '修改成功!', true);
        redirect (array ('admin', $this->get_class ()));
      } else {
        $this->load_view (array ('message' => '填寫的資料不完整！', 'work' => $work));
      }
    } else {
      $this->load_view (array ('work' => $work));
    }
  }
}