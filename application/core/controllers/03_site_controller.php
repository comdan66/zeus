<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Site_controller extends Oa_controller {

  public function __construct () {
    parent::__construct ();
    $this->load->helper ('identity');

    $this
         ->set_componemt_path ('component', 'site')
         ->set_frame_path ('frame', 'site')
         ->set_content_path ('content', 'site')
         ->set_public_path ('public')

         ->set_title ("ZEUS // Designa Studio")

         ->_add_meta ()
         ->_add_css ()
         ->_add_js ()
         ->add_hidden (array ('id' => '_flash_message', 'value' => identity ()->get_session ('_flash_message', true)))
         ;
         
  }

  private function _add_meta () {
    return $this->add_meta (array ('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui'))
                ->add_meta (array ('name' => 'author', 'content' => 'Sylvain Lafitte, Web Designer, sylvainlafitte.com'))
                ->add_meta (array ('name' => 'keywords', 'content' => '宙思,品牌,設計,平面,包裝,台北,RWD,網頁設計,app,開發,ZEUS,zeus,zeusdesign'))
                ->add_meta (array ('name' => 'description', 'content' => '宙思設計, Designa Studio, a HTML5 / CSS3 template.'))
                ;
  }

  private function _add_css () {
    return $this->add_css ('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700')
                ->add_css (base_url (array ('resource', 'site', 'css', 'style.css')))
                ;
  }

  private function _add_js () {
    return $this->add_js (base_url (utilitySameLevelPath ('resource', 'jquery_v1.10.2', 'jquery-1.10.2.min.js')))
                ->add_js (base_url (utilitySameLevelPath ('resource', 'site', 'js', 'jquery.flexslider-min.js')))
                ->add_js (base_url (utilitySameLevelPath ('resource', 'site', 'js', 'scripts.js')))
                ;
  }
}