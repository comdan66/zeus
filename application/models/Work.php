<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Work extends OaModel {

  static $table_name = 'works';

  static $has_one = array (
  );

  static $has_many = array (
    array ('work_tag_mappings', 'class_name' => 'WorkTagMap'),
    
    array ('tags', 'class_name' => 'WorkTag', 'through' => 'work_tag_mappings'),
    array ('root_tags', 'class_name' => 'WorkTag', 'through' => 'work_tag_mappings', 'conditions' => array ('work_tags.work_tag_id = ?', 0)),
    array ('pics', 'class_name' => 'WorkPicture', 'foreign_key' => 'work_id'),
    array ('blocks', 'class_name' => 'WorkBlock', 'foreign_key' => 'work_id')
  );

  public function __construct ($attributes = array (), $guard_attributes = true, $instantiating_via_find = false, $new_record = true) {
    parent::__construct ($attributes, $guard_attributes, $instantiating_via_find, $new_record);
    OrmImageUploader::bind ('file_name');
  }
}