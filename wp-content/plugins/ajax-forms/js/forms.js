//login js
jQuery(document).ready(function($){

  $('#ajax_login_submit').click(function(){
    $('#ajax_login_submit').attr('disabled', 'disabled');
    $('#ajax_login_loading').show();
    $('#login_feedback').html('');
    var data = {
      'action': 'login',
      'ajax_login_username': $('#ajax_login_username').val(),
      'ajax_login_password': $('#ajax_login_password').val(),
      'ajax_login_nonce' : ajax_object.ajax_login_nonce
    };
    //we need to use ajax object for ajax url for front end, in admin we can use ajaxurl global js variable
     $.post(ajax_object.ajax_url, data, function(response) {
      
      $('#ajax_login_submit').removeAttr('disabled');
      $('#ajax_login_loading').hide();
      if('success' != response){
       $('#login_feedback').html(response);
      }else{
        window.location.reload();
      }

    });
  });

});

//register js
jQuery(document).ready(function($){

  $('#ajax_register_submit').click(function(){
    $('#ajax_register_submit').attr('disabled', 'disabled');
    $('#ajax_register_loading').show();
    $('#register_feedback').html('');
    var data = {
      'action': 'register',
      'ajax_register_username': $('#ajax_register_username').val(),
      'ajax_register_email': $('#ajax_register_email').val(),
      'ajax_register_firstname': $('#ajax_register_firstname').val(),
      'ajax_register_lastname': $('#ajax_register_lastname').val(),
      'ajax_register_password': $('#ajax_register_password').val(),
      'ajax_register_password_again': $('#ajax_register_password_again').val(),
      'ajax_register_nonce' : ajax_object.ajax_register_nonce
    };
    //we need to use ajax object for ajax url for front end, in admin we can use ajaxurl global js variable
     $.post(ajax_object.ajax_url, data, function(response) {
      
      $('#ajax_register_submit').removeAttr('disabled');
      $('#ajax_register_loading').hide();
      
       $('#register_feedback').html(response);
      

    });
  });

});