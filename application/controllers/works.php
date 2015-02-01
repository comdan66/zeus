<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Works extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function index ($tag_name = '') {
    if (($tag_name = urldecode ($tag_name)) && ($tag_name = field_array (WorkTag::find ('all', array ('select' => 'id', 'conditions' => array ('name = ?', $tag_name))), 'id')) && ($work_ids = field_array (WorkTagMap::find ('all', array ('select' => 'work_id', 'conditions' => array ('work_tag_id IN (?)', $tag_name))), 'work_id')))
      $works = Work::find ('all', array ('conditions' => array ('id IN (?)', $work_ids)));
    else
      $works = Work::find ('all', array ('conditions' => array ()));
    $this->load_view (array ('works' => $works));
  }

  public function content ($id) {
    if (!($work = Work::find ('one', array ('conditions' => array ('id = ?', $id)))))
      redirect (array ($this->get_class ()), 'refresh');

    $this->load_view (array ('work' => $work));
  }
}
