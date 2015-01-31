/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function() {
  var index = 0;
  $('#add_title').click (function () {
    var obj = {index: index++};
    $(_.template ($('#_title').html (), obj) (obj)).insertAfter ($('table').last ());
  });

  $('#add_content').click (function () {
    var obj = {index: index++};
    $(_.template ($('#_content').html (), obj) (obj)).insertAfter ($('table').last ());
  });

  $('#add_file_name').click (function () {
    var obj = {index: index++};
    $(_.template ($('#_file_name').html (), obj) (obj)).insertAfter ($('table').last ());
  });

  $('#add_youtube').click (function () {
    var obj = {index: index++};
    $(_.template ($('#_youtube').html (), obj) (obj)).insertAfter ($('table').last ());
  });
  
  $('body').on ('click', '.delete', function () {
    $(this).parents ('table').remove ();
  });

  // $('.add_pic').click (function () {
  //   $('.files').append (_.template ($('#_file').html (), {}) ({}))
  // }).click ();

  // $('#add_block1').click (function () {
  //   var obj = {index: index++};
  //   $(_.template ($('#_block1').html (), obj) (obj)).insertAfter ($('table').last ());
  // });
  // $('#add_block2').click (function () {
  //   var obj = {index: index++};
  //   $(_.template ($('#_block2').html (), obj) (obj)).insertAfter ($('table').last ());
  // });
  // $('body').on ('click', '.add_item', function () {
  //   var $t = $(this).parents ('table');
  //   var i = $t.data ('index');
  //   var c = $t.data ('count');
  //   $t.data ('count', c + 1);

  //   var obj = {i: i, c: c};
  //   $(_.template ($('#_block1_item').html (), obj) (obj)).insertAfter ($t.find ('tr').last ());
  // })

  // $('body').on ('click', '.delete', function () {
  //   $(this).parents ('table').remove ();
  // });
});