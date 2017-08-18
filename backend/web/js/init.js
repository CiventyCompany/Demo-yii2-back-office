jQuery(document).ready(function($){
   "use strict";

    $(document)
        .on('click', '#end-all-sessions', function(event){
            $.ajax({
                url: '/user/registered/end-all-sessions',
                data: {
                    id: $(event.target).data('id')
                },
                success: function (res) {
                    alert( 'Все сеансы завершены' );
                }
            });
            return false;
        })
        .on('submit', '#method-cities', function(){
            var self = $(this);
            self.addClass('load');
            $.ajax({
                url: '/identification/identification-method/update-cities',
                data: self.serialize(),
                method: 'POST',
                dataType: 'json',
                success: function (res) {
                    self.removeClass('load');
                    console.log(res);
                }
            })
            return false;
        })
        .on('change', '#creditproductfield-multiple', function (event) {
            var value = $(this).val();
            if(value == 1){
                $(document).find('.field-creditproductfield-multiple_count').removeClass('hidden');
            } else {
                $(document).find('.field-creditproductfield-multiple_count').addClass('hidden');
            }
            return false;
        })
        .on('change', '#creditproductfield-type', function (event) {
            var value = $(this).val();
            if(value == 'reference'){
                $(document).find('.field-creditproductfield-credit_product_field_reference_id').removeClass('hidden');
            } else {
                $(document).find('.field-creditproductfield-credit_product_field_reference_id').addClass('hidden');
            }
            return false;
        })
        .on('change', 'select[name="CreditProduct[type_id]"]', function (event) {
            $.ajax({
                url: '/credit_product/credit-product-category/get-by-type',
                data: {type_id: $(this).val()},
                dataType: 'json',
                success: function (res) {
                    if(res.status == 'ok'){
                        $('select[name="CreditProduct[credit_product_category_ids][]"]').replaceWith( res.html );
                    }
                }
            });
        })
        .on('click', '.ajax-link', function (event) {
            var self = $(event.target).closest('a'),
                method = self.data('method') || 'get',
                success = self.data('success');
            $.ajax({
                url: self.attr('href'),
                dataType: 'json',
                success: function (res) {
                    if(res.status == 'ok'){
                        switch ( success ){
                            case 'remove':
                                $(event.target).remove();
                                alert( res.msg );
                                break;
                            case 'fn':
                                var fn = eval( self.data('fn') );
                                fn.call( self, res );
                                break;
                            default:
                                alert( res.msg );
                                break;
                        }
                    }
                }
            });
            return false;
        })
        .on('click', '.show-related', function (event) {
            $(this).parents('tr').next().toggleClass('hidden');
            return false;
        })
        .on('change', '#handler_model', function (event) {
            $('#handler-model-settings').html('');
            var value = $(this).val();
            if( value.length ){
                $.ajax({
                    url: '/event/event-action/get-model-settings?modelName=' + value,
                    dataType: 'json',
                    success: function (res) {
                        if(res.status && res.status == 'ok'){
                            $('#handler-model-settings').html( res.html );
                        }
                    }
                });
            }
        })
        .on('change', '#eventactioncondition-key', function (event) {
            eventConditionsCallback();
        })
    ;

    function markAsRead(id) {
        $.ajax({
            url: '/app_interface/notifications/mark-as-read',
            data: {id: id},
            method: 'GET'
        })
    }

    var notify = $("#notificationId");
    if(notify.length){
        var mark = notify.attr('data-mark');
        if(mark == '0'){
            var id = notify.attr('data-id');
            setTimeout(markAsRead(id), 5000);
        }
    }

    $('body').on('click','.hoverMark', function () {
        var self = $(this), id = self.attr('data-id');
        $.ajax({
            url  : '/app_interface/notifications/mark',
            type : 'POST',
            data : {id : id},
            success: function(res){
                if(res && res.res == 'ok'){
                    self.removeClass('hoverMark');
                    self.removeClass('label-info');
                    self.addClass('label-success');
                    self.html(res.text);
                }
            }
        });
    });

    $('body').on('click','.regenToken', function () {
        var target = $('#copyTarget'), id = $(this).attr('data-id');
        if( confirm('ACCESS TOKEN необходим для доступа партнёра в API нашего сайта. Это уникальное и секретное поле.')) {
            $.ajax({
                url  : '/partners/partners/regen-token',
                type : 'POST',
                data : {id : id},
                success: function(res){
                    if(res && res.res == 'ok'){
                        target.val('');
                        target.val(res.token);
                    }
                }
            });
        }
    });

    $('body').on('click','.ban', function () {
        var target = $('#copyTarget'), id = $(this).attr('data-id');
        if( confirm('Заблокировать ACCESS TOKEN? Все запросы со старым токеном будут отвергнуты!')) {
            $.ajax({
                url: '/partners/partners/ban',
                type: 'POST',
                data: {id: id},
                success: function (res) {
                    if (res && res.res == 'ok') {
                        target.val('');
                        target.val(res.banText);
                    }
                }
            });
        }
    });

    $('body').on('click','.mark-yes', function () {
        var table = $(this).closest('table');
        table.find('.field-yes').each(function () {
            $(this).click();
        });
    });

    $('body').on('click','.mark-no', function () {
        var table = $(this).closest('table');
        table.find('.field-no').each(function () {
            $(this).click();
        });
    });

    $('body').on('click','#notify_all', function () {
        var table = $(this).closest('table');
        $.ajax({
            url: '/app_interface/notifications/mark-all',
            data: {id: id},
            method: 'GET',
            success: function (res) {
                if (res && res.res == 'ok') {
                    table.find('.status_label').each(function () {
                        $(this).text('');
                        $(this).text('Прочитано');
                        $(this).removeClass('label-warning');
                        $(this).addClass('label-success');
                    });
                }
            }
        })
    });

    /*setTimeout(function () {
        $('.horizontal-scroll-pane').mousewheel(function(event, delta) {
            this.scrollLeft -= (delta * 50);
            event.preventDefault();
        });
    }, 500);*/

    if(  !$('#eventactioncondition-value').val() ){
        eventConditionsCallback();
    }

    initExport();
});

function eventConditionsCallback() {
    if( typeof eventConditions == "undefined"){
        return;
    }
    var key = $('#eventactioncondition-key').val();
    var select = $('#eventactioncondition-value');
    select.html('');
    for(var ecKey in eventConditions){
        if(key == ecKey){
            for( var value in eventConditions[ecKey] ){
                select.append( $('<option />').attr('value', value).text(eventConditions[ecKey][value]) );
            }
        }
    }
}

function initExport() {
    $('#exportqueue-model').on('change', function (event) {
        $.ajax({
            url: '/export/export-queue/get-model-settings',
            data: {
                model: $(this).val(),
            },
            dataType: 'json',
            success: function (res) {
                if (res && res.status == 'ok') {
                    $('#model-settings').html(res.html);
                    $('#model-settings').find('.datetimepicker').each(function (i) {
                        $(this).kvDatepicker({
                            autoclose: true,
                            language: "ru",
                            showTimepicker: false,
                            viewMode: 'days',
                            format: 'yyyy-mm-dd',
                        });
                    });
                }
            }
        });
    });

    $(document).on('click', 'a[href="#"][data-link]', function (event) {
        window.location.href = $(this).data('link');
        return false;
    });

    if ($('.export-waiting').length) {
        getExportStatus($('.export-waiting').eq(0));
    }

    function getExportStatus(obj) {
        $.ajax({
            url: '/export/export-queue/check?id=' + obj.data('id'),
            success: function (res) {
                if (res && res.status == 'ok') {
                    obj.after(res.html);
                    obj.remove();
                } else {
                    setTimeout(getExportStatus, 5000, obj);
                }
            }
        })
    }
}