<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Migration_Add_work_tag_maps extends CI_Migration {
  public function up () {
    $this->db->query (
      "CREATE TABLE `work_tag_maps` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `work_id` int(11) NOT NULL,
        `work_tag_id` int(11) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        `updated_at` datetime NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
        PRIMARY KEY (`id`),
        KEY `work_id_index` (`work_id`),
        KEY `work_tag_id_index` (`work_tag_id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
    );
  }
  public function down () {
    $this->db->query (
      "DROP TABLE `work_tag_maps`;"
    );
  }
}