function actualizar_navbar(user_id,navbar_id)
{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url : '/themeuser/actualizar-navbar',
        method: 'POST',
        data :{
            user_id : user_id,
            navbar_id:navbar_id,
            '_method' : 'POST',
            '_token' : CSRF_TOKEN
        },
        success: function (response) {
            window.location.href = window.location.pathname
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) === false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    });
}

function actualizar_sidebar_dark(user_id,sidebar_id)
{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url : '/themeuser/actualizar-sidebar',
        method: 'POST',
        data :{
            user_id : user_id,
            sidebar_id:sidebar_id,
            '_method' : 'POST',
            '_token' : CSRF_TOKEN
        },
        success: function (response) {
            window.location.href = window.location.pathname
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) === false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    });
}

function actualizar_sidebar_light(user_id,sidebar_id)
{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url : '/themeuser/actualizar-sidebar',
        method: 'POST',
        data :{
            user_id : user_id,
            sidebar_id:sidebar_id,
            '_method' : 'POST',
            '_token' : CSRF_TOKEN
        },
        success: function (response) {
            window.location.href = window.location.pathname
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) === false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    });
}

function actualizar_brandlogo(user_id,brandlogo_id)
{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url : '/themeuser/actualizar-brandlogo',
        method: 'POST',
        data :{
            user_id : user_id,
            brandlogo_id:brandlogo_id,
            '_method' : 'POST',
            '_token' : CSRF_TOKEN
        },
        success: function (response) {
            window.location.href = window.location.pathname
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) === false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    });
}

function resetear(user_id)
{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url : '/themeuser/resetear',
        method: 'POST',
        data :{
            user_id : user_id,
            '_method' : 'POST',
            '_token' : CSRF_TOKEN
        },
        success: function (response) {
            window.location.href = window.location.pathname
        },
        error : function (xhr) {
            var res = xhr.responseJSON;
            if ($.isEmptyObject(res) === false) {
                $.each(res.errors, function (key, value) {
                    $('#' + key)
                        .closest('.form-group')
                        .addClass('has-error')
                        .append('<span class="help-block"><strong>' + value + '</strong></span>');
                });
            }
        }
    });
}
