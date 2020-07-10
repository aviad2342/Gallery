$(document).ready(function(){

    var user_href;
    var user_href_split;
    var user_id;
    var image_src;
    var image_src_split;
    var image_name;
    var photo_id;

    $(".modal_thumbnails").click(function(){
        $("#set_user_image").prop("disabled", false);

        user_href = $("#user-id").prop('href');
        user_href_split = user_href.split("=");
        user_id = user_href_split[user_href_split.length - 1];

        image_src = $(this).prop("src");
        image_src_split = image_src.split("/");
        image_name = image_src_split[image_src_split.length - 1];

        photo_id  = $(this).attr("data");
        $.ajax({
            url: "includes/ajax_calls.php",
            data: {photo_id: photo_id},
            type: "POST",
            success: function(data) {
                if(!data.error) {
                    $("#modal_sidebar").html(data);
                }
            }
        });
        
    });

    $( ".bg-success" ).fadeOut(4000);
      


    $("#set_user_image").click(function(){
        $('#preview-image').attr('src', image_src);
        $.ajax({
            url: "includes/ajax_calls.php",
            data: {image_name: image_name, user_id: user_id},
            type: "POST",
            success: function(data) {
                if(!data.error) {
                }
            }
        });
    });

    $("#loginUserName").blur(function(){
        var username = $("#loginUserName").val();
        $.ajax({
            url: "includes/ajax_calls.php",
            data: {username: username},
            type: "GET",
            success: function(data) {
                if(!data.error) {
                    $('#loginProfileImage').attr('src', data);
                }
            }
        });
    });

    $(".info-box-header").click(function(){
        $('.inside').slideToggle("fast");
        $('#toggle').toggleClass(" glyphicon-menu-down glyphicon , glyphicon-menu-up glyphicon");
       
    });

    $(".delete_link").click(function(){
        return confirm("Are you sure you want to delete this item?");
       
    });

    $("#btn_choose_image").click(function(){
        $("#image_picker").click();
       
    });

    // $(function () {
    //     $('#datetimepicker').datetimepicker({
    //         format: 'LT'
    //     });
    // });


    var gallery = $('.gallery a').simpleLightbox();

    //tinymce.init({ selector:'textarea' });
});

function ValidateEmail(input) {
    var email = $("#"+input).val();
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(email)) {
        $('#emailAlert').hide();
    } else {
        $('#emailAlert').show();
    }
}

function hideAlert(input) {
    $("#"+input).hide();
}

function revealPassword() {
    $('#passwordIcon').toggleClass('glyphicon glyphicon-eye-close glyphicon glyphicon-eye-open');
    if($('#passwordIcon').hasClass('glyphicon glyphicon-eye-open')){
        $('#password').attr("type", "text");
    } else {
        $('#password').attr("type", "password");
    }
    
}

function openCalendar() {
    $('#date').click();
    
}



