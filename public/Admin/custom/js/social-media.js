
$(document).ready(function () {

    $('.icon-select').select2({
        templateResult: formatIcon,
        templateSelection: formatIcon,
        escapeMarkup: function (markup) { return markup; }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let sm_settings_ajax_url = $("#sm_settings_ajax_url").val();
    let settings_ajax_url = $("#settings_ajax_url").val();


    

    var i = 1;
    let lasttablerow = $("#add_more_media_box tbody").find('tr').last();
    if (lasttablerow && lasttablerow.length) {
        i = lasttablerow.data('index');
    } else {
        addDynamicMediaBlock(1);
    }

    $('#add_more_media_btn').click(function () {
        event.preventDefault();
        i++;
        addDynamicMediaBlock(i);
    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });


    $(".form-check-input").on('change', function () {
        if ($(this).is(':checked')) {
            $(this).attr('value', 'active');
        } else {
            $(this).attr('value', 'inactive');
        }
    });

    
    $("#setting_social_media_status").on('change', function () {
         let status = $(this).val();
         console.log("STATUS",status);
            $.ajax({
                url: settings_ajax_url,
                method: "POST",
                dataType: "JSON",
                data: {
                    "action": "update-setting-through-key",
                    "key": "social_media_enabled",
                    "value" : status
                },
                success: function (data) {
                    if (data.success) {
                        $('#result').html('<div class="alert alert-success">' + data.success + '</div>');
                    }else{
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++) {
                            error_html += '<p>' + data.error[count] + '</p>';
                        }
                        $('#result').html('<div class="alert alert-danger">' + error_html + '</div>');
                    }
                },
                error: function (res) {
                    console.log("Ajax error");
                }
            });
        
    });

    $('#sm_settings_form').on('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        console.log("formData", formData);

        $.ajax({
            url: sm_settings_ajax_url,
            method: 'POST',
            dataType: "JSON",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            // beforeSend:function(){
            //     $('#submit').attr('disabled','disabled');
            // },
            success: function (data) {
                if (data.error) {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++) {
                        error_html += '<p>' + data.error[count] + '</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">' + error_html + '</div>');
                }
                else {
                    $('#result').html('<div class="alert alert-success">' + data.success + '</div>');
                }
                $('#save').attr('disabled', false);
            }
        });

    });

    function formatIcon(icon) {
        if (!icon.id) { return icon.text; }
        var iconClass = $(icon.element).data('icon');
        var $icon = $('<span class="icon-preview"><i class="' + iconClass + '"></i> ' + icon.text + '</span>');
        return $icon;
    }

    function addDynamicMediaBlock(index = 1) {

        $.ajax({
            url: sm_settings_ajax_url,
            method: "POST",
            dataType: "JSON",
            data: {
                "action": "fetch-media-block",
                "index": index
            },
            success: function (res) {
                console.log("Ajax RES", res);
                if (res.success) {
                    if (index > 1) {
                        $('#add_more_media_box').append(res.template);
                    } else {
                        $('#add_more_media_box tbody').html(res.template);
                    }

                }
            },
            error: function (res) {
                console.log("Ajax error");
            }
        });
    }

});
