$(function () {
    $.extend({
        addItem: function (data, success) {
            $.post({
                url: "/cart/add-item",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
            .then(function (response) {
                success();
            })
            .catch(function (e) {
                console.log(e);
            });
        },

        removeItem: function (id) {
            $.post({
                url: "/cart/remove-item",
                data: {
                    id: id,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
                .then(function () {
                    window.location.reload();
                })
                .catch(function (e) {
                    console.log(e);
                });
        },

        updateCart: function () {
            let updateCart = [];
            $(".input-qty").each(function () {
                let qty = $(this).val();
                let id = $(this).attr("data-id");
                updateCart.push({
                    id: id,
                    qty: qty,
                });
            });

            $.post({
                url: "/cart/update",
                data: {
                    updateCart: updateCart,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
                .then(function () {
                    window.location.reload();
                })
                .catch(function (e) {
                    console.log(e);
                });
        },

        destroyCart: function (success) {
            $.post({
                url: "/cart/destroy",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
                .then(function () {
                    success();
                })
                .catch(function (e) {
                    console.log(e);
                });
        },

        cartTop: function () {
            $.get({
                url: "/cart/cart-top",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
                .then(function (response) {
                    if (response.cart.length) {
                        $(".cart-total").html("(" + response.cart.length + ")");
                        let html = '<ul class="list-item-cart">';
                        for (const item of response.cart) {
                            html += '<li class="item productid-0">';
                            html += '<div class="border_list">';
                            html +=
                                '<a class="product-image" href="' +
                                item.image +
                                '" title="' +
                                item.name +
                                '">';
                            html +=
                                '<img alt="' +
                                item.name +
                                '" src="' +
                                item.image +
                                '" width="100">';
                            html += "</a>";

                            html += '<div class="detail-item">';
                            html += '    <div class="product-details">';
                            html += '       <p class="product-name">';
                            html +=
                                '            <a class="text2line" href="#">' +
                                item.image +
                                "</a>";
                            html += "       </p>";
                            html += "    </div>";
                            html += '    <div class="product-details-bottom">';
                            html +=
                                '        <span class="price">' +
                                item.price +
                                "</span>";
                            html +=
                                '        <div class="quantity-select qty_drop_cart">x ' +
                                item.qty +
                                "</div>";
                            html += "    </div>";
                            html += "</div>";

                            html += "</div>";
                            html += "</li>";
                        }
                        html += "</ul>";

                        html += '<div class="pd">';
                        html += '    <div class="top-subtotal">';
                        html +=
                            '        Thành tiền: <span class="price">' +
                            response.subtotal +
                            "</span>";
                        html += "    </div>";
                        html += '    <div class="top-subtotal">';
                        html +=
                            '        Tổng số: <span class="price">' +
                            response.total +
                            "</span>";
                        html += "    </div>";
                        html += "</div>";

                        html += '<div class="pd right_ct">';
                        html += '<a href="/cart" class="btn btn-cart-custom">';
                        html += "<span>Giỏ hàng</span>";
                        html += "</a>";
                        html +=
                            '<a href="/cart/checkout" class="btn btn-checkout-custom">';
                        html += "<span>Thanh toán</span>";
                        html += "</a>";
                        html += "</div>";
                        $("#cart-sidebar").html(html);
                    } else {
                        $(".cart-total").html("(0)");
                        $("#cart-sidebar").html(
                            '<div class="no-item"><p>Giỏ hàng của bạn trống!</p></div>'
                        );
                    }
                })
                .catch(function (e) {
                    console.log(e);
                });
        },
    });
});

$(document).ready(function() {

    $.cartTop();

    $(".add-to-cart").click(function () {
        let id = $(this).attr("data-id");
        let qty = $('input[name="quantity"').val();
        $.addItem({ id: id, qty: qty }, function () {
            $("#cart-success").show();
            $.cartTop();
        });
    });

    $(document).on('click', ".buy-now", function () {
        let id = $(this).attr("data-id");
        let qty = 1;
        $.addItem({ id: id, qty: qty }, function () {
            $("#buy_now_modal").modal("show");
            $.cartTop();
        });
    });

    $(".remove-item-cart").click(function () {
        let id = $(this).attr("data-id");
        $.removeItem(id);
        $.cartTop();
    });

    $(".destroy-cart").click(function() {
        $.destroyCart(function() {
            window.location.reload();
        });
    });

    $(".update-cart").click(function () {
        $.updateCart();
        $.cartTop();
    });

    $(".btn-minus").click(function () {
        let inputQty = $(this).parent().parent().find(".input-qty").first();
        let qty = Number(inputQty.val()) - 1;
        qty = qty == 0 ? 1 : qty;
        inputQty.val(qty);
    });

    $(".btn-plus").click(function () {
        let inputQty = $(this).parent().parent().find(".input-qty").first();
        let qty = Number(inputQty.val()) + 1;
        qty = qty > 99 ? 1 : qty;
        inputQty.val(qty);
    });
})

