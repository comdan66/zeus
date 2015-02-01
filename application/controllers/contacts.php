<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Contacts extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function index () {
    $this->add_js (base_url (array ('resource', 'jquery-ui-1.10.3.custom', 'jquery-ui-1.10.3.custom.min.js')))
         ->add_js (base_url (array ('resource', 'jquery.jgrowl_v1.3.0', 'jquery.jgrowl.js')))
         ->add_js (base_url (utilitySameLevelPath ('resource', 'site', 'js', 'jquery.validate.min.js')))
         ->load_view (array ('message' => identity ()->get_session ('_message', true)));
  }

  public function submit () {
    if (!$this->has_post ()) redirect (array ($this->get_class ()));

    $name = trim (stripslashes ($this->input_post ('name')));
    $email = trim (stripslashes ($this->input_post ('email')));
    $message = trim (stripslashes ($this->input_post ('message')));

    if ($name && $email && $message) {
      $from = $email;
      // $to = 'comdan66@gmail.com';
      $to = 'info@zeusdesign.com.tw';
      $subject = 'Contact form';

      $body = '';
      $body .= 'Name: ' . $name . "\n";
      $body .= 'Email: ' . $email . "\n";
      $body .= "Message: \n\n" . $message . "\n";
      // mail ($to, $subject, $body, "From: <$from>")
    }
    identity ()->set_session ('_message', '成功寄出！', true);
    redirect (array ($this->get_class ()), 'refresh');
  }
}
