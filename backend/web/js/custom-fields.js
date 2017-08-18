jQuery(document).ready(function($){
   "use strict";

    $(document)
        .on('click', '.add-field-item', function(event){
            var parent = $(this).parents('.form-group');
            addEmptyExample(parent);
            return false;
        })
        .on('click', '.drop-custom-field', function (event) {
            var parent = $(this).parents('.form-group'),
                row = $(this).parents('.row');
            row.remove();
            var count = parent.find('.row').length;
            if( parent.data('multiple') && (parent.data('multiple_count') == 0 || parent.data('multiple_count') > count)){
                parent.find('.add-more-wrap').removeClass('hidden');
            }
            if( !parent.find('.custom-field-list .row').length ){
                addEmptyExample(parent);
            }
            return false;
        })
        .on('click', '.init-popup-icons', function (event) {
            $('#icons .select-icon').removeClass('active');
            $('#icons').find('#icon-title').val('');
            $('#icons').find('#icon-link').val('');
            $('#icons').data('element', this).modal('show');
            return false;
        })
        .on('click', '#icons .select-icon', function (event) {
            $('#icons .select-icon').removeClass('active');
            $(this).addClass('active');
            return false;
        })
        .on('click', '#icons .btn-primary', function (event) {
            var element = $( $('#icons').data('element') ),
                input = $(element).parents('.input-group').find('input'),
                icon = $('#icons').find('.select-icon.active'),
                title = $('#icons').find('#icon-title').val(),
                link = $('#icons').find('#icon-link').val();

            if(!icon.length){
                alert('Выберите иконку');
                return false;
            }

            var out = '<span class="' + icon.data('class') + '" data-title="' + title + '" data-link="' + link + '"></span>';
            input.val( input.val() + out );
            $('#icons').modal('hide')
            return false;
        })
    ;

    $('div[data-type="text"] .custom-field-list').each(function (event) {
        console.log( $(this).find('textarea') );
        $(this).find('textarea').each(function () {
            initCKEDITOR( $(this).attr('id') );
        });
    });

    $('div[data-type="image"]').each(function () {

    });
    $('div[data-type="image"] button').unbind();
    $('div[data-type="image"] button').each(function () {
        initElFinder( $(this).parents('.input-group').find('input').attr('id') );
    });

});

function addEmptyExample(parent) {
    var max = parent.data('multiple_count'),
        multiple = parent.data('multiple'),
        example = parent.find('.custom-field-example'),
        exampleEmpty = example.html().replace(/\[example\]/g, '[]'),
        type = parent.data('type'),
        newId = 'w' + new Date().getTime();
    parent.find('.custom-field-list').append( exampleEmpty );
    var rows = parent.find('.custom-field-list .row');
    if( multiple && max != 0 && rows.length >= max ){
        parent.find('.add-more-wrap').addClass('hidden');
    }

    switch (type){
        case 'text':
            rows.last().find('textarea').eq(0).attr('id', newId);
            initCKEDITOR( newId );
            break;
        case 'reference':
            rows.last().find('select').eq(0).attr('id', newId);
            break;
        case 'image':
            rows.last().find('input').eq(0).attr('id', newId);
            initElFinder( newId );
            break;
        default:
            rows.last().find('input').eq(0).attr('id', newId);
            break;
    }

}

function initCKEDITOR( id ) {
    var editor = CKEDITOR.instances[ id ];
    /*
    if (editor) { editor.destroy(true); }
    CKEDITOR.replace(name);
    */
    if(!editor){
        CKEDITOR.replace(id, {"height":250,"toolbarGroups":[{"name":"clipboard","groups":["mode","undo","selection","clipboard","doctools"]},{"name":"editing","groups":["find","spellchecker","tools","about"]},"/",{"name":"paragraph","groups":["templates","list","indent","align"]},{"name":"forms"},"/",{"name":"styles"},{"name":"blocks"},"/",{"name":"basicstyles","groups":["basicstyles","colors","cleanup"]},{"name":"links","groups":["links","insert"]},{"name":"others"}],"on":{"instanceReady":function( ev ){mihaildev.ckEditor.registerOnChange(id);}}});
    }
}

function initElFinder( id ) {
    mihaildev.elFinder.register(id, function(file, id){ $('#' + id).val(file.url).trigger('change', [file, id]);; return true;});
    $('#' + id).parents('.input-group').find('button').on('click', function(){
        mihaildev.elFinder.openManager({"url":"/elfinder/manager?filter=image&callback="+id+"&lang=ru&path=image","width":"auto","height":"auto","id":id});
    });
}
