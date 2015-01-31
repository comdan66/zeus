/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

$(function() {
  $('.del_cate').click (function () {
    if ($(this).parents ('table').find ('tr').length <= 2)
      $(this).parents ('table').append ($('<tr />').append ($('<td />').attr ('colspan', 5).text ('沒有任何產品分類')));

    $.ajax ({
      url: $('#get_del_tag_url').val (),
      data: { id: $(this).parents ('tr').data ('id') },
      async: true, cache: false, dataType: 'json', type: 'POST',
      beforeSend: function () {}
    })
    .done (function (result) {
      result.status && $(this).parents ('tr').remove () && $.jGrowl ('刪除成功');
      location.reload();
    }.bind ($(this)))
    .fail (function (result) {  })
    .complete (function (result) { });

    // $(this).parents ('tr').remove ();
  });
});