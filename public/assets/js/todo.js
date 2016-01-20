
var AFRAME = AFRAME || {};

AFRAME.todo = (function() {

    var init = function() {
        $('.deleteImage').on('click', __deleteThing);
        $('.deleteGroup').on('click', __deleteThing);

    };

    // var deleteImage = function(){
    //     var imageId = $(this).data('id');
    //     $.ajax({
    //         url: '/image?id=' + imageId,
    //         type: 'DELETE',
    //         success: function(result) {
    //             location.reload();
    //         }
    //     });
    // };

    __deleteThing: function(){
        var imageId = $(this).data('id');
        $.ajax({
            url: '/image?id=' + imageId,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    };

    return {
        init: init
    }

})();


AFRAME.todo.init();
