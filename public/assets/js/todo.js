
var AFRAME = AFRAME || {};

AFRAME.todo = (function() {

    var init = function() {
        $('.deleteTask').on('click', deleteTask);
    };

    var deleteTask = function(){
        var taskId = $(this).data('id');
        console.log(taskId);
        $.ajax({
            url: '/?id=' + taskId,
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