<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Works extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function index ($id = 0) {
    if ($id && is_numeric ($id))
      if (($id = field_array (WorkTag::find ('all', array ('select' => 'id', 'conditions' => array ('id = ?', $id))), 'id')) && ($id = field_array (WorkTagMap::find ('all', array ('select' => 'work_id', 'conditions' => array ('work_tag_id IN (?)', $id))), 'work_id')))
        $works = Work::find ('all', array ('conditions' => array ('id IN (?) AND is_enabled = ?', $id, 1)));
     else 
        $works = array ();
    else
      $works = Work::find ('all', array ('conditions' => array ('is_enabled = ?', 1)));
    $this->load_view (array ('works' => $works));
  }

  public function content ($id) {
    if (!($work = Work::find ('one', array ('conditions' => array ('id = ?', $id)))))
      redirect (array ($this->get_class ()), 'refresh');

    $this->load_view (array ('work' => $work));
  }
}
