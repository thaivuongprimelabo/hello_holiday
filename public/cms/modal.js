$(function () {
    $.extend({
        parentElement: "#submit-form",
        buttonId: "",
        url: "/api/select-products",
        params: {},
        searchProductList: [],
        orderProductList: {
            details: [],
            subtotal: 0,
            total: 0,
        },
        initSelectProducts: function(buttonId) {
            $.buttonId = buttonId;
        },
        createModal: function() {
            let html = '<div class="modal fade" id="modal-default">';
            html += '<div class="modal-dialog">';
            html += '<div class="modal-content">';
            html += '<div class="modal-header">';
            html += '    <h4 class="modal-title">Tìm kiếm sản phẩm</h4>';
            html += '    <button';
            html += '        type="button"';
            html += '        id="close_modal"';
            html += '        class="close"';
            html += '        aria-label="Close">';
            html += '        <span aria-hidden="true">&times;</span>';
            html += '    </button>';
            html += '</div>';


            html += '<div class="modal-body">';
            html += '    <div class="input-group input-group-sm mb-2">';
            html += '        <input type="text" class="form-control" id="product_info_se" placeholder="Nhập thông tin sản phẩm">';
            html += '        <span class="input-group-append">';
            html += '            <button type="button" id="search_select_products" class="btn btn-primary btn-flat">Tìm kiếm</button>';
            html += '        </span>';
            html += '    </div>';

            html += '    <table id="select_products_list" class="table table-bordered">';
            html += '        <thead>';
            html += '            <tr>';
            html += '                <td></td>';
            html += '                <th>Mã SP</th>';
            html += '                <th>Tên SP</th>';
            html += '                <th>Giá bán</th>';
            html += '            </tr>';
            html += '        </thead>';
            html += '        <tbody></tbody>';
            html += '        <tfoot></tfoot>';
            html += '    </table>';

            html += '</div>';

            html += '<div class="modal-footer justify-content-between">';
            html += '  <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>';
            html += '  <button type="button" id="select_products_btn" class="btn btn-primary">Chọn</button>';
            html += "</div>";

            html += '</div>';
            html += '</div>';
            html += '</div>';

            $($.parentElement).append(html);
        },
        selectProducts: function () {

            let _url = $.url;
            let _param = $.param($.params);
            if (Object.keys(_param).length) {
                if (_url.indexOf("?") >= 0) {
                    _url = _url + "&" + _param;
                } else {
                    _url = _url + "?" + _param;
                }
            }

            $.get({
                url: _url,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            }).then(function (res) {
                $.searchProductList = res.searchList.data;
                let row = "";
                for (const item of $.searchProductList) {
                    row += "<tr>";
                    row +=
                        '<td><input type="checkbox" class="product-row" value="' +
                        item.id +
                        '" /></td>';
                    row += "<td>" + item.id + "</td>";
                    row += "<td>" + item.name + "</td>";
                    row +=
                        "<td>" +
                        $.formatCurrency(item.price, ".", ".") +
                        "</td>";
                    row += "</tr>";
                }
                $("#select_products_list tbody").html("");
                $("#select_products_list tbody").append(row);
                $("#select_products_list tfoot").html("");
                $("#select_products_list tfoot").append(
                    '<tr><td colspan="4">' + res.pagination + "</td></tr>"
                );
            });
        },
        calculateOrderProducts: function (params) {
            params = params || {};
            $("#order_products").find("tbody").html("");
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
                    item.qty = item.hasOwnProperty("qty") ? item.qty : 1;

                    if (
                        params.hasOwnProperty("id") &&
                        params.update_qty &&
                        params.id == item.id
                    ) {
                        item.qty = Number(params.value);
                    }

                    if (
                        params.hasOwnProperty("id") &&
                        params.update_price &&
                        params.id == item.id
                    ) {
                        item.price = params.value;
                    }

                    item.cost = Number(item.qty * item.price);
                    subtotal += Number(item.cost);

                    order_product_row += "<tr>";
                    order_product_row +=
                        "<td>" +
                        item.id +
                        "<br/><a href='javascript:void(0)' data-id='" +
                        item.id +
                        "' class='remove-order-product'>Xoá</a></td>";
                    order_product_row += "<td>" + item.name + "</td>";
                    order_product_row +=
                        "<td><input type='number' class='qty-order-product' data-id='" +
                        item.id +
                        "' value='" +
                        item.qty +
                        "' style='width:80px' /></td>";
                    order_product_row +=
                        "<td><input type='number' class='price-order-product'  data-id='" +
                        item.id +
                        "' value='" +
                        item.price +
                        "' style='width:80px' /></td>";
                    order_product_row +=
                        "<td>" +
                        $.formatCurrency(item.cost, ".", ".") +
                        "</td>";
                    order_product_row += "</tr>";
                }

                $.orderProductList.subtotal = subtotal;
                $.orderProductList.total = subtotal;

                $("#order_products").find("tbody").append(order_product_row);
                $("#subtotal").html(
                    $.formatCurrency($.orderProductList.subtotal, ".", ".")
                );
                $("#total").html(
                    $.formatCurrency($.orderProductList.total, ".", ".")
                );

                let dataField = document.createElement("input");
                dataField.setAttribute("type", "hidden");
                dataField.setAttribute("name", "order_details");
                dataField.setAttribute(
                    "value",
                    JSON.stringify($.orderProductList)
                );
                $($.parentElement).append(dataField);
            }

            setTimeout(function () {
                $("#page-overlay").hide();
            }, 100);
        },
    });

    $($.parentElement).on("shown.bs.modal", "#modal-default", function () {
        // $.selectProducts();
    });

    $($.parentElement).on("hide.bs.modal", "#modal-default", function (e) {
        $(this).remove();
    });

    $($.parentElement).on("click", "#search_select_products", function () {
        const keyword = $("#product_info_se").val();
        $.params["keyword"] = keyword;
        $.selectProducts();
    });

    $($.parentElement).on("click", ".page-link", function () {
        let page = $(this).attr("data-page");
        $.params["page"] = page;
        $.selectProducts();
    });

    $($.parentElement).on("click", "#select_products_btn", function () {
        let hasChecked = $(".product-row:checked").length;
        if (!hasChecked) {
            alert("Vui lòng chọn sản phẩm");
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

        $("#modal-default").modal("hide");
    });

    $($.parentElement).on("click", "#select_products", function () {
        $.createModal();
        $("#modal-default").modal();
    });

    $($.parentElement).on("click", "#close_modal", function() {
        $("#modal-default").modal('hide');
    });

    $($.parentElement).on("click", ".remove-order-product", function () {
        const id = $(this).attr("data-id");
        $.calculateOrderProducts({ id: id, remove: true });
    });

    $($.parentElement).on("blur", ".qty-order-product, .price-order-product",
        function (e) {
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
        }
    );
});
