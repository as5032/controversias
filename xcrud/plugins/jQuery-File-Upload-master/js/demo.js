/*
 * jQuery File Upload Demo
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

/* global $ */

$(function() {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: Xcrud.config('blue_imp_server')
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(/\/[^/]*$/, '/cors/result.html?%s')
    );

    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        })
        .always(function() {
            $(this).removeClass('fileupload-processing');
        })
        .done(function(result) {
            $(this)
                .fileupload('option', 'done')
                // eslint-disable-next-line new-cap
                .call(this, $.Event('done'), { result: result });
        });

});