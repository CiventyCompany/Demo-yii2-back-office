jQuery(document).ready(function () {
    "use strict";
    var body = $('body');

    /**
     * Log in for user to front - end profile
     */
    body.on('click', '#logInToFront', function () {
        var userId = $(this).attr('data-userId');
        $.ajax({
            'url': '/user/ajax/log-on-frontend',
            'type': 'POST',
            'data': {userId: userId},
            success: function (res) {
                if (res && res.res == 'ok') {
                    window.open(res.url);
                }
            }
        });
    });

    /**
     * Set deleted,blocked or frozen status to user with message
     */
    body.on('submit', '.modalForm', function (e) {
        e.preventDefault();
        var modal = $(this).closest('.modal');
        var data = $(this).serialize();
        var url = $(this).attr('action');
        var pjax = $('body').find('#balancePjax');
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                data: data
            },
            success: function (res) {
                if (res && res.res == 'ok') {
                    if (pjax.length) {
                        $.pjax.reload({container: '#balancePjax'});
                        $.pjax.reload({container: '#actionsPjax'});
                    }

                    modal.modal('hide');
                    alert(res.message);

                    if(!pjax.length){
                        location.reload();
                    }
                }
            }
        });
    });

    /**
     * Remove frozen status from user
     */
    body.on('click', '.freeze', function () {
        var status = $(this).attr('data-status');
        var userId = $(this).attr('data-userId');
        $.ajax({
            'url': '/user/ajax/frozen-user',
            'type': 'POST',
            'data': {
                userId: userId,
                status: status
            },
            success: function (res) {
                if (res && res.res == 'ok') {
                    alert(res.message);
                    location.reload();
                }
            }
        });
    });

    /**
     * Remove block status for user
     */
    body.on('click', '.block', function () {
        var status = $(this).attr('data-status');
        var userId = $(this).attr('data-userId');
        $.ajax({
            'url': '/user/ajax/blocked-user',
            'type': 'POST',
            'data': {
                userId: userId,
                status: status
            },
            success: function (res) {
                if (res && res.res == 'ok') {
                    alert(res.message);
                    location.reload();
                }
            }
        });
    });

    /**
     * Remove deleted status for user
     */
    body.on('click', '.delStatus', function () {
        var status = $(this).attr('data-status');
        var userId = $(this).attr('data-userId');
        $.ajax({
            'url': '/user/ajax/delete-status-user',
            'type': 'POST',
            'data': {
                userId: userId,
                status: status
            },
            success: function (res) {
                if (res && res.res == 'ok') {
                    alert(res.message);
                    location.reload();
                }
            }
        });
    });

    /**
     * Change user password
     */
    body.on('submit', '#changePassForm', function (e) {
        e.preventDefault();
        var $newPass = body.find('#newPass').val();
        var $userId  = $(this).attr('data-userId');
        if(confirm('Если вы измените пароль, пользователь более не сможет зайти на сайт используя старый пароль. Вы уверенны?')){
            $.ajax({
                'url': '/user/ajax/change-pass',
                'type': 'POST',
                'data': {pass: $newPass, user_id : $userId},
                success: function (res) {
                    if (res && res.res == 'ok') {
                        body.find('#newPass').val('');
                        alert(res.message);
                    }
                }
            });
        }

    });
});