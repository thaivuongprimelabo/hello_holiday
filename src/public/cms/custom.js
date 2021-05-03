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
                    $('#page-overlay').hide();
                })
            }
        }
    })
    
    $.searchList();

    $(document).on('click', '.page-link', function() {
        let url = $(this).attr('data-url');
        $.searchList(url);
    })

    $(document).on('click', '#search-btn', function() {
        let keyword = $('#keyword').val();
        $.params['keyword'] = keyword;
        $.searchList();
    })

    $('#upload-avatar-btn').click(function() {
        $('#upload-avatar-file').click();
    })

    $('#upload-avatar-file').change(function(e) {
        let image_object_url = URL.createObjectURL($(this).get(0).files[0]);
        $("#preview").attr('src', image_object_url);
    })

    $('#remove-avatar-btn').click(function(e) {
        let default_image = $(this).attr('data-default-image');
        $('#upload-avatar-file').val('');
        $('#current-avatar').val(null);
        $("#preview").attr('src', default_image);
    })
})