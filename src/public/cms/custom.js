const ERROR_UPLOAD_SIZE = 'Tập tin được chọn có kích thước không hợp lệ.';
const ERROR_UPLOAD_TYPE = "Vui lòng chọn hình ảnh (jpg, jpeg, png, gif).";

$(function() {
    $.extend({
        url: window.location.href + '/search',
        searchProductList: [],
        orderProductList: {
            details: [],
            subtotal: 0,
            total: 0
        },
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
        },
        calculateOrderProducts: function(params) {
            params = params || {};
            $("#order_products").find('tbody').html("");
            $("#subtotal").html("0");
            $("#total").html("0");

            $.orderProductList.subtotal = 0;
            $.orderProductList.total = 0;

            if (params.hasOwnProperty("remove")) {
                const index = $.orderProductList.details.findIndex(
                    (item) => item.id == params.id
                );
                $.orderProductList.details.splice(index, 1);
            }

            if ($.orderProductList.details.length) {
                let subtotal = 0;
                let order_product_row = "";
                for (let item of $.orderProductList.details) {

                    item.qty = item.hasOwnProperty('qty') ? item.qty : 1;

                    if (params.hasOwnProperty('id') && params.update_qty && params.id == item.id) {
                        item.qty = Number(params.value);
                    }

                    if (params.hasOwnProperty('id') && params.update_price && params.id == item.id) {
                        item.price = params.value;
                    }
                    
                    item.cost = Number(item.qty * item.price);
                    subtotal += Number(item.cost);

                    order_product_row += "<tr>";
                    order_product_row += "<td>" + item.id + "<br/><a href='javascript:void(0)' data-id='" + item.id + "' class='remove-order-product'>Xoá</a></td>";
                    order_product_row += "<td>" + item.name + "</td>";
                    order_product_row +=
                        "<td><input type='number' class='qty-order-product' data-id='" + item.id + "' value='" +
                        item.qty +
                        "' style='width:80px' /></td>";
                    order_product_row +=
                        "<td><input type='number' class='price-order-product'  data-id='" + item.id + "' value='" +
                        item.price +
                        "' style='width:80px' /></td>";
                    order_product_row += "<td>" + $.formatCurrency(item.cost, '.', '.') + "</td>";
                    order_product_row += "</tr>";
                }

                $.orderProductList.subtotal = subtotal;
                $.orderProductList.total = subtotal;

                $("#order_products").find('tbody').append(order_product_row);
                $("#subtotal").html($.formatCurrency($.orderProductList.subtotal, '.', '.'));
                $("#total").html($.formatCurrency($.orderProductList.total, '.', '.'));

                let dataField = document.createElement("input");
                dataField.setAttribute('type', 'hidden');
                dataField.setAttribute("name", "order_details");
                dataField.setAttribute('value', JSON.stringify($.orderProductList));
                $('#submit-form').append(dataField);

                
            }

            setTimeout(function() {
                $("#page-overlay").hide();
            }, 100)
        },
        formatCurrency: function (nStr, decSeperate, groupSeperate) {
            if(nStr == null) {
                return '0 ' + Constants.CURRENCY;
            }
            nStr = Math.round(Number(nStr));
            nStr += '';
            x = nStr.split(decSeperate);
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
            }
            return x1 + x2 + '₫';
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

    $('#search_select_products').click(function() {
        const keyword = $("#product_info_se").val();
        $.get({
            url: "/api/select-products?keyword=" + keyword,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        }).then(function (res) {
            $.searchProductList = res;
            let row = "";
            for (const item of $.searchProductList) {
                row += "<tr>";
                row += '<td><input type="checkbox" class="product-row" value="' + item.id + '" /></td>';
                row += "<td>" + item.id + "</td>";
                row += "<td>" + item.name + "</td>";
                row += "<td>" + item.price + "</td>";
                row += "</tr>";
            }
            $("#select_products_list tbody").html("");
            $("#select_products_list tbody").append(row);
        });
    });

    $("#select_products_btn").click(function() {
        let hasChecked = $(".product-row:checked").length;
        if (!hasChecked) {
            alert('Vui lòng chọn sản phẩm');
            return false;
        }

        $(".product-row:checked").each(function (item) {
            let id = $(this).val();
            let select = $.searchProductList.find(function (item) {
                return item.id == id;
            });

            $.orderProductList.details.push(select);
        });

        $.calculateOrderProducts();

        $("#modal-default").modal('hide');
        
    });

    $("#select_products").click(function() {
        $("#select_products_list tbody").html("");
        $("#modal-default").modal();
    })

    $("#order_products").on("click", ".remove-order-product", function () {
        const id = $(this).attr("data-id");
        $.calculateOrderProducts({ id: id, remove: true });
    });

    $(document).on("blur", ".qty-order-product, .price-order-product", function (e) {
        $("#page-overlay").show();
        let id = $(this).attr("data-id");
        let value = $(this).val();
        let params = {
            id: id,
            value: value,
        };

        if ($(this).attr("class") == "qty-order-product") {
            params.update_qty = true;
        }

        if ($(this).attr("class") == "price-order-product") {
            params.update_price = true;
        }

        $.calculateOrderProducts(params);
        
    });

    // Jquery Validation
    if ($("#submit-form").length) {
        $("#submit-form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 200,
                },
                customer_name: {
                    required: true,
                    maxlength: 200,
                },
                customer_address: {
                    required: true,
                    maxlength: 200,
                },
                customer_phone: {
                    required: true,
                    maxlength: 200,
                },
                customer_province: {
                    required: true,
                },
                customer_district: {
                    required: true,
                },
                customer_block: {
                    required: true,
                },
                payment_method: {
                    required: true,
                },
                status: {
                    required: true,
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
                customer_name: {
                    required: "Vui lòng nhập",
                    maxlength: "Tối đa 200 ký tự",
                },
                customer_address: {
                    required: "Vui lòng nhập",
                    maxlength: "Tối đa 200 ký tự",
                },
                customer_phone: {
                    required: "Vui lòng nhập",
                    maxlength: "Tối đa 200 ký tự",
                },
                customer_province: {
                    required: "Vui lòng chọn",
                },
                customer_district: {
                    required: "Vui lòng chọn",
                },
                customer_block: {
                    required: "Vui lòng chọn",
                },
                payment_method: {
                    required: "Vui lòng chọn",
                },
                status: {
                    required: "Vui lòng chọn",
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