/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function() {
  var index = 0;

  $('#add_block').click (function () {
    var obj = {index: index++};
    $(_.template ($('#_block').html (), obj) (obj)).insertAfter ($('table').last ());
  });

  $('body').on ('click', '.add_item', function () {
    var $t = $(this).parents ('table');
    var index = $t.data ('index');
    var c = $t.data ('count');
    $t.data ('count', c + 1);

    var obj = {index: index, c: c};
    $(_.template ($('#_item').html (), obj) (obj)).insertAfter ($t.find ('tr').last ());
  });

  $('body').on ('click', '.delete', function () {
    $(this).parents ('table').remove ();
  });

  $('.add_pic').click (function () {
    $('.files').append (_.template ($('#_file').html (), {}) ({}))
  }).click ();

});