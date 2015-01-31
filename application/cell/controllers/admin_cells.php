<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Admin_cells extends Cell_Controller {

  public function side_menu () {
    return $this->load_view ();
  }
  public function main_header () {
    return $this->load_view ();
  }
  public function sub_header () {
    return $this->load_view ();
  }
  public function footer () {
    return $this->load_view ();
  }
}