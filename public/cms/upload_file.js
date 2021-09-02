const ERROR_UPLOAD_SIZE = "Tập tin được chọn có kích thước không hợp lệ.";
const ERROR_UPLOAD_TYPE = "Vui lòng chọn hình ảnh (jpg, jpeg, png, gif).";

$(function () {
    $.extend({
        
    });

    $(".upload-btn").click(function () {
        const parent = $(this).parent().parent();
        const id = parent.attr("id");
        const field_upload = parent.find('input[type="file"]');

        if (!field_upload.length) {
            let uploadField = document.createElement("input");
            uploadField.setAttribute("type", "file");
            uploadField.setAttribute("name", "upload_file[" + id + "][]");
            uploadField.setAttribute("class", "upload_file");
            uploadField.setAttribute("style", "display: none");
            uploadField.click();
            $(parent).append(uploadField);
        } else {
            field_upload.click();
        }
    });

    $("#submit-form").on("change", ".upload_file", function (e) {
        const parent = $(this).parent();
        const maxFileSize = Number(parent.attr("max-upload"));
        const file = $(this).get(0).files[0];

        if (file.size > maxFileSize) {
            toastr.error(ERROR_UPLOAD_SIZE);
            return false;
        }

        if (!file.type.match("image.*")) {
            toastr.error(ERROR_UPLOAD_TYPE);
            return false;
        }

        const image_object_url = URL.createObjectURL(file);
        const img = parent.find("img.preview");
        img.attr("src", image_object_url);
        img.show();
    });

    $(".upload-mutiple-btn").click(function (e) {
        const parent = $(this).parent().parent();
        const id = parent.attr("id");

        const uploadField = document.createElement("input");
        uploadField.setAttribute("type", "file");
        uploadField.setAttribute("multiple", true);
        uploadField.setAttribute("name", "upload_file[" + id + "][]");
        uploadField.setAttribute("class", "upload-image-file");
        uploadField.setAttribute("max-upload", parent.attr("max-upload"));
        uploadField.click();
        $("#submit-form").append(uploadField);
    });

    $("#submit-form").on("change", ".upload-image-file", function (e) {
        const maxFileSize = Number($(this).attr("max-upload"));
        for (let i = 0; i < $(this).get(0).files.length; i++) {
            let file = $(this).get(0).files[i];
            if (file.size > maxFileSize) {
                toastr.error(ERROR_UPLOAD_SIZE);
                continue;
            }

            if (!file.type.match("image.*")) {
                toastr.error(ERROR_UPLOAD_TYPE);
                continue;
            }

            let image_object_url = URL.createObjectURL(file);
            let clone = $(".clone")
                .clone()
                .removeClass("clone")
                .attr("data-image-name", $(this).get(0).files[i].name)
                .show();

            $('input[value="' + $(this).get(0).files[i].name + '"]').remove();

            clone.find("img").attr("src", image_object_url);
            $("#selected_images").append(clone);
        }
    });

    $("#submit-form").on("click", ".remove-image-btn", function (e) {
        let image_id = $(this).attr("data-image-id");
        if (image_id !== undefined) {
            let deletedField = document.createElement("input");
            deletedField.setAttribute("type", "hidden");
            deletedField.setAttribute("name", "delete_image_ids[]");
            deletedField.setAttribute("value", image_id);

            $("#submit-form").append(deletedField);
        } else {
            let image_name = $(this).parent().attr("data-image-name");

            let deletedField = document.createElement("input");
            deletedField.setAttribute("type", "hidden");
            deletedField.setAttribute("name", "delete_image_ids[]");
            deletedField.setAttribute("value", image_name);

            $("#submit-form").append(deletedField);
        }

        $(this).parent().remove();
    });
});
