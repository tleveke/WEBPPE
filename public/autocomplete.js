$(document).ready(function () {
    'use strict';

    /* ajax modal (you need this onlu for the "add new" feature. See README) */
    $('body').on('click', 'a.ajax-modal', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url, function (data) {
            $(data).modal();
        });
    });

    /* form modal to insert a new Author (you need this onlu for the "add new" feature. See README) */
    var modalForm = function (prefix) {
        $('body').on('submit', '.modal form', function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var data = $(this).serialize();
            var $modal = $(this).parents('.modal');
            $modal.on('hidden.bs.modal', function () {
                $(this).data('bs.modal', null);
            });
            $.ajax({
                url: url,
                method: method,
                data: data
            }).done(function (res) {    // res can be a JSON object or an HTML string
                if (typeof res === 'object') {
                    // if it'a a JSON, form is valid
                    $modal.modal('hide');
                    var $input = $('#' + prefix + '_' + res.type);
                    $input.val(res.id).trigger('change');
                    // this workaround is needed because we can't set a val() to a non-existant option
                    $('.select2-chosen').each(function () {
                        if ($(this).parents('div').attr('id').indexOf(prefix + '_' + res.type) > -1) {
                            $(this).text(res.name);
                        }
                    });
                } else {
                    // if is HTML, form is invalid (has errors)
                    $modal.modal('hide');
                    $(res).modal();
                }
            });
        });
    };

    /* autocomplete Author on new Book (this is the main feature) */
    (function () {
        $('#book_author').autocompleter({
            url_list: '/author_search',
            url_get: '/author_get/'
        });
    }());
});