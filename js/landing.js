$(document).ready(function(){
    $('#send_email').on("click", function(event){
        event.preventDefault();
        var feedEmail = $('#email').val();

        if(feedEmail == ''){
            $('.alert_wrong').show();
            $('.alert_wrong').fadeOut(5000);
        }
        else{
            $('.alert_well').show();
            $('.alert_well').fadeOut(5000);

            $('#email').val('');
        }
    }); 
});