jQuery(document).ready(function($){
  $('#bangla-ajax-form').submit(function(){ 
     $('#submit-button').attr('disabled', 'disabled'); 
     $('#bangla_loading').show(); 
    data = {
      'action' : 'bangla_get_results',      
      'post_type' : $('#post_type').val(),
      'bangla_nonce'   : ajax_object.bangla_nonce
    };       
    $.post(ajaxurl, data, function(response){
         $('#bangla_results').html(response);
         $('#bangla_loading').hide(); 
         $('#submit-button').removeAttr('disabled'); 
    });
    return false;
  });
});