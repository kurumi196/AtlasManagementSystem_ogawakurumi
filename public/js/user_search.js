$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
    $('.search_conditions').toggleClass('open');
  });

  $('.subject_edit_btn').click(function () {
    $('.subject_inner').slideToggle();
  });

  $('.person_link').hover(
    function () {
      $(this).parents('.one_person').toggleClass('on');
    });
});
