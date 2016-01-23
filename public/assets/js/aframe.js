
var AFRAME = AFRAME || {};

AFRAME.todo = (function() {

    var init = function() {
        $('.deleteGroup, .deleteImage').on('click', __deleteThing);

    };

    var __deleteThing = function(e){
        e.preventDefault();
        var id = $(this).data('id'),
            endpoint, type;

        if ($(this).hasClass('deleteImage')) {
            endpoint = '/image?id=' + id;
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
