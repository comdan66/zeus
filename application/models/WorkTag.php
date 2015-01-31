<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class WorkTag extends OaModel {

  static $table_name = 'work_tags';

  static $has_many = array (
    array ('work_tag_mappings', 'class_name' => 'WorkTagMap'),

    array ('works', 'class_name' => 'Work', 'through' => 'work_tag_mappings'),
    array ('sub_tags', 'class_name' => 'WorkTag', 'foreign_key' => 'work_tag_id'),
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
  }
}