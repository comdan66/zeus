<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */
class Main extends Admin_controller {
  public function __construct () {
    parent::__construct ();
  }

  public function index () {
    if (identity ()->user ())
      redirect (array ('admin', 'login'), 'refresh');

    $message = null;
    if ($this->has_post () && ($account = trim ($this->input_post ('account'))) && ($password = trim ($this->input_post ('password'))))
      if ($user = User::find ('one', array ('select' => 'id, login_count, logined_at', 'conditions' => array ('account = ? AND password = ?', $account, md5 ($password))))) {
        $user->login_count += 1;
        $user->logined_at = date ('Y-m-d H:i:s');
        $user->save ();
        identity ()->set_session ('user_id', $user->id)->set_session ('_flash_message', '登入成功!', true) && redirect (array ('admin', 'login'), 'refresh');
      } else $message = '帳號密碼錯誤，請重新輸入!';

    $this->set_frame_path ('frame', 'admin_index')
         ->load_view (array ('message' => $message));
  }

  public function login () {
    identity ()->user () || redirect (array ('admin'), 'refresh');

    $this->load_view ();
  }
  public function logout () {
    identity ()->user () || redirect (array ('admin'), 'refresh');

    identity ()->set_identity ('sign_out')->set_session ('_flash_message', '登出成功!', true);
    redirect (array ('admin'), 'refresh');
  }
  public function edit () {
    identity ()->user () || redirect (array ('admin'), 'refresh');

    $message = '';
    if ($this->has_post () && ($account = trim ($this->input_post ('account'))) && ($password = trim ($this->input_post ('password'))) && ($re_password = trim ($this->input_post ('re_password')))) {
      if ($password == $re_password) {
        identity ()->user ()->account = $account;
        identity ()->user ()->password = md5 ($password);
        identity ()->user ()->save ();
        identity ()->set_session ('_flash_message', '修改成功!', true);
      } else {
        $message = '確認密碼錯誤!';
      }
    }
    $this->load_view (array ('message' => $message));
  }
}
