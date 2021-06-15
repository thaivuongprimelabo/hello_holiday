const ERROR_UPLOAD_SIZE = 'Tập tin được chọn có kích thước không hợp lệ.';
const ERROR_UPLOAD_TYPE = "Vui lòng chọn hình ảnh (jpg, jpeg, png, gif).";

$(function() {
    $.extend({
        url: window.location.href + '/search',
        params: {},
        searchList: function(url) {
            let _url = url ? url : $.url;
            let _param = $.param( $.params );
            if(Object.keys(_param).length) {
                if(_url.indexOf('?') >= 0) {
                    _url = _url + '&' + _param;
                } else {
                    _url = _url + '?' + _param;
                }
            }
            if($('#search-result').length) {
                $('#page-overlay').show();
                $.get(_url).then(function(data) {
                    $('#search-result').html(data.search_result);
                    $('#pagination').html(data.pagination);
                    $('#total-record').html(data.total);
                    $('#page-overlay').hide();
                })
            }
        }
    })
    
    $.searchList();

    $(document).on("click", "#reload", function() {
        $.searchList();
    });

    $(document).on('click', '.page-link', function() {
        let page = $(this).attr('data-page');
        $.params['page'] = page;
        $.searchList();
    })

    $(document).on('click', '#search-btn', function() {
        let keyword = $('#search-form').serialize();
        let params = Object.fromEntries(new URLSearchParams(keyword));
        $.params = {...params};
        $.searchList();
    })

    $(document).on('click', '#create-btn', function() {
        window.open($('#create_url').val(), '_self');
    })

    $(document).on('click', '#check-all', function(e) {
        $('.primary-id').not(this).prop('checked', this.checked);
    })

    $('.upload-btn').click(function() {
        const parent = $(this).parent().parent();
        const id = parent.attr('id');
        const field_upload= parent.find('input[type="file"]');

        if(!field_upload.length) {
            let uploadField = document.createElement('input');
            uploadField.setAttribute("type", "file");
            uploadField.setAttribute("name", "upload_file[" + id + "][]");
            uploadField.setAttribute("class", "upload_file");
            uploadField.setAttribute("style", "display: none");
            uploadField.click();
            $(parent).append(uploadField);
        } else {
            field_upload.click();
        }
        
    })

    $('#submit-form').on('change', '.upload_file', function(e) {
        const parent = $(this).parent();
        const maxFileSize = Number(parent.attr("max-upload"));
        const file = $(this).get(0).files[0];

        if(file.size > maxFileSize) {
            toastr.error(ERROR_UPLOAD_SIZE);
            return false;
        }

        if(!file.type.match('image.*')) {
            toastr.error(ERROR_UPLOAD_TYPE);
            return false;
        }

        const image_object_url = URL.createObjectURL(file);
        const img = parent.find('img.preview');
        img.attr('src', image_object_url);
        img.show();
    })

    $('.upload-mutiple-btn').click(function(e) {

        const parent = $(this).parent().parent();
        const id = parent.attr('id');

        const uploadField = document.createElement('input');
        uploadField.setAttribute("type", "file");
        uploadField.setAttribute("multiple", true);
        uploadField.setAttribute("name", "upload_file[" + id + "][]");
        uploadField.setAttribute("class", "upload-image-file");
        uploadField.setAttribute("max-upload", parent.attr('max-upload'));
        uploadField.click();
        $('#submit-form').append(uploadField);
    })

    $('#submit-form').on('change', '.upload-image-file', function(e) {
        const maxFileSize = Number($(this).attr('max-upload'));
        for(let i = 0; i < $(this).get(0).files.length; i++) {
            let file = $(this).get(0).files[i];
            if(file.size > maxFileSize) {
                toastr.error(ERROR_UPLOAD_SIZE);
                continue;
            }

            if(!file.type.match('image.*')) {
                toastr.error(ERROR_UPLOAD_TYPE);
                continue;
            }

            let image_object_url = URL.createObjectURL(file);
            let clone = $(".clone")
            .clone()
            .removeClass('clone')
            .attr('data-image-name', $(this).get(0).files[i].name)
            .show();

            $('input[value="' + $(this).get(0).files[i].name + '"]').remove();

            clone.find('img').attr('src', image_object_url);
            $('#selected_images').append(clone);
        }
    })

    $('#submit-form').on('click', '.remove-image-btn', function(e) {
        let image_id = $(this).attr('data-image-id');
        if(image_id !== undefined) {

            let deletedField = document.createElement('input');
            deletedField.setAttribute("type", "hidden");
            deletedField.setAttribute("name", "delete_image_ids[]");
            deletedField.setAttribute("value", image_id);

            $('#submit-form').append(deletedField);
            

        } else {

            let image_name = $(this).parent().attr('data-image-name');
            
            let deletedField = document.createElement('input');
            deletedField.setAttribute("type", "hidden");
            deletedField.setAttribute("name", "delete_image_ids[]");
            deletedField.setAttribute("value", image_name);

            $('#submit-form').append(deletedField);

        }

        $(this).parent().remove();
        
    })

    $('#remove-btn').click(function(e) {

        let hasChecked = $('.primary-id:checked').length;
        if(!hasChecked) {
            return false;
        }

        if (!confirm("Are you sure want to delete " + hasChecked + " items?")) {
            return false;
        }

        let ids = [];
        $('.primary-id:checked').each(function() {
            ids.push($(this).val());
        });

        if(!$('#remove_url').length) {
            alert('Server not found!');
            return false;
        }

        let url = $('#remove_url').val();

        $.post({
            url: url,
            data: { ids: ids }, 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then(function() {
            $.searchList();
        })
    });

    $('#submit-form').on('change', '#field_customer_province', function(e) {
        $('#field_customer_district').html("<option value=''>---</option>");
        $.get({
            url: '/api/districts/' + $(this).val(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then(function(res) {
            const obj = (res);
            let options = "";
            for(const item of obj) {
                options += '<option value="' + item.maqh + '">' + item.name + '</option>';
            }
            $('#field_customer_district').append(options);
        })
    })

    $('#submit-form').on('change', '#field_customer_district', function(e) {
        $('#field_customer_block').html("<option value=''>---</option>");
        $.get({
            url: '/api/blocks/' + $(this).val(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then(function(res) {
            const obj = (res);
            let options = "";
            for(const item of obj) {
                options += '<option value="' + item.xaid + '">' + item.name + '</option>';
            }
            $('#field_customer_block').append(options);
        })
    })

    // Jquery Validation
    if ($("#submit-form").length) {
        $("#submit-form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 200,
                },
                vendor_id: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                seo_keywords: {
                    maxlength: 300,
                },
                seo_description: {
                    maxlength: 300,
                },
            },
            messages: {
                name: {
                    required: "Vui lòng nhập",
                    maxlength: "Tối đa 200 ký tự",
                },
                category_id: {
                    required: "Vui lòng chọn",
                },
                vendor_id: {
                    required: "Vui lòng chọn",
                },
                seo_keywords: {
                    maxlength: "Tối đa 300 ký tự",
                },
                seo_description: {
                    maxlength: "Tối đa 300 ký tự",
                },
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass("is-invalid");
            },
            submitHandler: function (form) {
                $("#submit-form").attr("disabled", "disabled");
                form.submit();
            },
        });
    }
        
})