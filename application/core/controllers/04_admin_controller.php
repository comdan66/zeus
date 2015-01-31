<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Admin_controller extends Oa_controller {

  public function __construct () {
    parent::__construct ();
    $this->load->helper ('identity');

    $this
         ->set_componemt_path ('component', 'admin')
         ->set_frame_path ('frame', 'admin')
         ->set_content_path ('content', 'admin')
         ->set_public_path ('public')

         ->set_title ("管理後台 - 宙思設計有限公司")

         ->_add_meta ()
         ->_add_css ()
         ->_add_js ()
         ->add_hidden (array ('id' => '_flash_message', 'value' => identity ()->get_session ('_flash_message', true)))
         ;
  }

  private function _add_meta () {
    return $this;
  }

  private function _add_css () {
    return $this
            ->add_css ('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700')
            ->add_css (base_url (array ('resource', 'admin', 'css', 'style.css')))
            ->add_css (base_url (array ('resource', 'admin', 'css', 'form.css')))
            ->add_css (base_url (array ('resource', 'admin', 'css', 'DropMenu05.css')))
            ->add_css (base_url (array ('resource', 'jquery.jgrowl_v1.3.0', 'jquery.jgrowl.css')))
            ;
  }
  
  private function _add_js () {
    return $this->add_js (base_url (array ('resource', 'jquery_v1.10.2', 'jquery-1.10.2.min.js')))
                ->add_js (base_url (array ('resource', 'jquery-ui-1.10.3.custom', 'jquery-ui-1.10.3.custom.min.js')))
                ->add_js (base_url (array ('resource', 'jquery.jgrowl_v1.3.0', 'jquery.jgrowl.js')))
                ;
  }
}