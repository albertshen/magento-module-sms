/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'Magento_Ui/js/modal/alert'
], function ($, alert) {

    var formSubmit = function (config) {
        var postData = {
            form_key: FORM_KEY
        };

        $.ajax({
            url: config.postUrl,
            type: 'post',
            dataType: 'html',
            data: postData,
            showLoader: true
        }).done(function (response) {
            if (typeof response === 'object') {
                if (response.error) {
                    alert({ title: 'Error', content: response.message });
                } else if (response.ajaxExpired) {
                    window.location.href = response.ajaxRedirect;
                }
            } else {
                alert({
                    title:'',
                    content:response,
                    buttons: []
                });
            }
        });
    };

    return function (config, element) {
        $(element).on('click', function () {
            formSubmit(config);
        });
    }
});
