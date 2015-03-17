<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Work_tags extends Admin_controller {

  public function __construct () {
    parent::__construct ();
    identity ()->user () || redirect (array ('admin'));
  }

  private function _del ($ids) {
    if (!$ids) return false;

    return count (array_map (function ($tag) {
          if (!$tag->work_tag_id)
            WorkTag::table ()->update ($set = array ('work_tag_id' => 0), array ('work_tag_id' => $tag->id));
          WorkTagMap::delete_all (array ('conditions' => array ('work_tag_id = ?', $tag->id)));
          $tag->delete ();
        }, WorkTag::find ('all', array ('conditions' => array ('id IN (?)', $ids)))));
  }

  public function del_tag () {
    if (!$this->is_ajax ())
      show_error ("It's not Ajax request!<br/>Please confirm your program again.");
    
    $id = $this->input_post ('id');
    $this->_del (array ($id));

    return $this->output_json (array ('status' => true));
  }

  public function index () {
    if ($this->has_post ()) {
      if (($name = trim ($this->input_post ('name'))) && verifyCreateOrm (WorkTag::create (array ('name' => $name, 'sort' => WorkTag::count (array ('conditions' => array ('work_tag_id = ?', 0))) + 1, 'work_tag_id' => 0))))
        identity ()->set_session ('_flash_message', '新增成功!', true) && redirect (array ('admin', $this->get_class (), $this->get_method ()), 'refresh');

      if ($tags = $this->input_post ('tags')) {
        $this->_del (array_diff (field_array (WorkTag::find ('all', array ('select' => 'id')), 'id'), array_map (function ($tag) { return $tag['id']; }, $tags)));

        array_map (function ($tag) {
          if ($tag['id'] && trim ($tag['name']) && trim ($tag['sort']))
            WorkTag::table ()->update ($set = array ('name' => trim ($tag['name']), 'sort' => trim ($tag['sort'])), array ('id' => $tag['id']));
        }, $tags);

        if (identity ()->set_session ('_flash_message', '修改成功!', true))
          redirect (array ('admin', $this->get_class (), $this->get_method ()), 'refresh');
      }
    }

    $tags = WorkTag::find ('all', array ('order' => 'sort ASC, id DESC', 'include' => array ('sub_tags'), 'conditions' => array ('work_tag_id = ?', 0)));
    $this->add_hidden (array ('id' => 'get_del_tag_url', 'value' => base_url (array ('admin', $this->get_class (), 'del_tag'))))
         ->load_view (array ('tags' => $tags));
  }

  public function sub_tags ($id) {
    if (!($parent_tag = WorkTag::find ('one', array ('conditions' => array ('id = ?', $id))))) 
      redirect (array ('admin', $this->get_class ()), 'refresh');

    if ($this->has_post ()) {
      if (($name = trim ($this->input_post ('name'))) && verifyCreateOrm (WorkTag::create (array ('name' => $name, 'sort' => WorkTag::count (array ('conditions' => array ('work_tag_id = ?', $parent_tag->id))) + 1, 'work_tag_id' => $parent_tag->id))))
        identity ()->set_session ('_flash_message', '新增成功!', true) && redirect (array ('admin', $this->get_class (), $this->get_method (), $parent_tag->id), 'refresh');

      if ($tags = $this->input_post ('tags')) {
        $this->_del (array_diff (field_array ($parent_tag->sub_tags, 'id'), array_map (function ($tag) { return $tag['id']; }, $tags)));

        array_map (function ($tag) {
          if ($tag['id'] && trim ($tag['name']) && trim ($tag['sort']))
            WorkTag::table ()->update ($set = array ('name' => trim ($tag['name']), 'sort' => trim ($tag['sort'])), array ('id' => $tag['id']));
        }, $tags);

        if (identity ()->set_session ('_flash_message', '修改成功!', true))
          redirect (array ('admin', $this->get_class (), $this->get_method (), $parent_tag->id), 'refresh');
      }
    }

    $tags = WorkTag::find ('all', array ('order' => 'sort ASC, id DESC', 'conditions' => array ('work_tag_id = ?', $parent_tag->id)));
    $this->add_hidden (array ('id' => 'get_del_tag_url', 'value' => base_url (array ('admin', $this->get_class (), 'del_tag'))))
         ->load_view (array ('tags' => $tags, 'parent_tag' => $parent_tag));
  }
}