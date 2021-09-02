$(function () {
    $.extend({
        loadCities: function () {
            $.get({
                url: "/api/cities",
            })
                .then(function (response) {
                    let options = "<option value=''>---</option>";
                    response.forEach(function (item) {
                        options +=
                            "<option value='" +
                            item.matp +
                            "'>" +
                            item.name +
                            "</option>";
                    });

                    $('select[name="customer_province"]').html(options);
                })
                .catch(function (e) {
                    console.log(e);
                });
        },
        loadDistricts: function (city) {
            $.get({
                url: "/api/districts/" + city,
            })
            .then(function (response) {
                let options = "<option value=''>---</option>";
                response.forEach(function (item) {
                    options +=
                        "<option value='" +
                        item.matp +
                        "'>" +
                        item.name +
                        "</option>";
                });

                $('select[name="customer_district"]').html(options);
            })
            .catch(function (e) {
                console.log(e);
            });
        },
        loadDistricts: function (city) {
            $.get({
                url: "/api/districts/" + city,
            })
            .then(function (response) {
                let options = "<option value=''>---</option>";
                response.forEach(function (item) {
                    options +=
                        "<option value='" +
                        item.maqh +
                        "'>" +
                        item.name +
                        "</option>";
                });

                $('select[name="customer_district"]').html(options);
            })
            .catch(function (e) {
                console.log(e);
            });
        },
        loadBlocks: function (district) {
            $.get({
                url: "/api/blocks/" + district,
            })
                .then(function (response) {
                    let options = "<option value=''>---</option>";
                    response.forEach(function (item) {
                        options +=
                            "<option value='" +
                            item.xaid +
                            "'>" +
                            item.name +
                            "</option>";
                    });

                    $('select[name="customer_block"]').html(options);
                })
                .catch(function (e) {
                    console.log(e);
                });
        },
    });
});

$(document).ready(function () {
    $('.text-danger').hide();
    $(".payment-method-toggle").hide();
    $("input[name=payment_method]").click(function () {
        $(".payment-method-toggle").hide();
        $("#payment-method-info-" + $(this).val()).toggle();
    });

    $.loadCities();

    $('select[name="customer_province"]').change(function() {
        let city = $(this).val();
        $.loadDistricts(city);
        $(this).next().hide();
    });

    $('select[name="customer_district"]').change(function () {
        let district = $(this).val();
        $.loadBlocks(district);
        $(this).next().hide();
    });

    $('select[name="customer_block"]').change(function () {
        $(this).next().hide();
    });

    $(
        'input[name="customer_name"], input[name="customer_email"], input[name="customer_phone"], input[name="customer_address"]',
    ).keypress(function () {
        $(this).next().hide();
    });

    $("#submit_form_button").click(function () {

        let valid = true;

        $(".text-danger").hide();

        if (!$('input[name="customer_name"]').val().length) {
            $('input[name="customer_name"]').next().show();
            valid = false;
        }

        if (!$('input[name="customer_email"]').val().length) {
            $('input[name="customer_email"]').next().show();
            valid = false;
        }

        if (!$('input[name="customer_phone"]').val().length) {
            $('input[name="customer_phone"]').next().show();
            valid = false;
        }

        if (!$('select[name="customer_province"]').val().length) {
            $('select[name="customer_province"]').next().show();
            valid = false;
        }

        if (!$('select[name="customer_district"]').val().length) {
            $('select[name="customer_district"]').next().show();
            valid = false;
        }

        if (!$('select[name="customer_block"]').val().length) {
            $('select[name="customer_block"]').next().show();
            valid = false;
        }

        if (!$('input[name="customer_address"]').val().length) {
            $('input[name="customer_address"]').next().show();
            valid = false;
        }

        if (!valid) return false;

        $("#checkout_form").submit();
    });

});
