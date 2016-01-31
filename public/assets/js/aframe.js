
var AFRAME = AFRAME || {};

AFRAME.todo = (function() {

    var init = function() {
        $('.deleteGroup, .deleteImage').on('click', __deleteThing);
        $('.featureButton', '.image-table').on('click', __featureImage);
    };

    var __featureImage = function(e) {
        var $btn = $(this);
        var isFeatured = $btn.hasClass('btn-primary');
        var id = $btn.data('id');
        var group = $btn.data('group');
        var changeFeaturedStatusTo = !isFeatured ? 0 : 1;
        $.ajax({
            url: '/feature-image?group=' + group + '&id=' + id + '&changeStatus=' + changeFeaturedStatusTo,
            type: 'POST',
            success: function(result) {
                var response = JSON.parse(result);
                if (response.status === 'success') {
                    $btn.toggleClass('btn-primary', !isFeatured).toggleClass('btn-success', isFeatured);
                }
            }
        });
    };

    var __deleteThing = function(e){
        e.preventDefault();
        var id = $(this).data('id'),
            endpoint, type;

        if ($(this).hasClass('deleteImage')) {
            var fileName = $(this).data('file-name');
            var group = $(this).data('group');
            endpoint = '/image?id=' + id + '&group=' + group + '&fileName=' + fileName;
            type = 'image';
        } else {
            endpoint = '/group?id=' + id;
            type = 'group';
        }

        $.ajax({
            url: endpoint,
            type: 'DELETE',
            success: function(result) {
                var response = JSON.parse(result);
                if (response['type'] === 'group') {
                    if (response['status'] === 'success') {
                        window.location.href = '/';
                    } else {
                        window.location.reload();
                    }
                } else {
                    window.location.reload();
                }
            }
        });
    };

    return {
        init: init
    }

})();

AFRAME.todo.init();
