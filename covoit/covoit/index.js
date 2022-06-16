function on() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("connection").style.display = "block";

}

function off() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("connection").style.display = "none";

}

config ={
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "d-m-Y",
    maxDate: "today",
    defaultDate: "1-1-2000"
}
flatpickr("input[type=date]", config);

$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});

$(document).ready(function() {
    $("#show_hide_password2 a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password2 input').attr("type") == "text"){
            $('#show_hide_password2 input').attr('type', 'password');
            $('#show_hide_password2 i').addClass( "fa-eye-slash" );
            $('#show_hide_password2 i').removeClass( "fa-eye" );
        }else if($('#show_hide_password2 input').attr("type") == "password"){
            $('#show_hide_password2 input').attr('type', 'text');
            $('#show_hide_password2 i').removeClass( "fa-eye-slash" );
            $('#show_hide_password2 i').addClass( "fa-eye" );
        }
    });
});

