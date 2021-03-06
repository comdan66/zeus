<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_works extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `works` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `is_enabled` int(11) NOT NULL DEFAULT '1',
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        PRIMARY KEY (`id`),
        KEY `is_enabled_index` (`is_enabled`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `works`;"
    );
  }
}