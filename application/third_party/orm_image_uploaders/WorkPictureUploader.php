<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class WorkPictureUploader extends OrmImageUploader {

  public function d4_url () {
    return '';
  }

  public function getVersions () {
    return array (
        '100w' => array ('resize', 100, 100, 'width'),
        '800w' => array ('resize', 800, 800, 'width')
      );
  }
}