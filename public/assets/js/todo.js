
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
                console.log(result);
                // if (type === 'image') {
                //     location.reload();
                // } else {
                //     window.location.href = '/';
                // }
            }
        });
    };

    return {
        init: init
    }

})();


AFRAME.todo.init();
