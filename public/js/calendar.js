$(function () {
  $('.edit-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var reserve_day = $(this).attr('data-day');
    var reserve_part = $(this).attr('data-part');
    $("#data").val(reserve_day);
    $("#part").val(reserve_part);
    $(".modal-inner-day").val(reserve_day);
    $(".modal-inner-part").val(reserve_part);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
