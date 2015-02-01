<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class WorkUploader extends OrmImageUploader {

  public function d4_url () {
    return '';
  }

  public function getVersions () {
    return array (
        '122x78c' => array ('adaptiveResizeQuadrant', 122, 78, 'c'),
        '246x157c' => array ('adaptiveResizeQuadrant', 246, 157, 'c')
      );
  }
}