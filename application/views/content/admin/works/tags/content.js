/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function() {
  $('.del_cate').click (function () {
    if ($(this).parents ('table').find ('tr').length <= 2)
      $(this).parents ('table').append ($('<tr />').append ($('<td />').attr ('colspan', 3).text ('沒有任何產品分類')));
    $(this).parents ('tr').remove ();
  });
});