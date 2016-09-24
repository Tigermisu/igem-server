$(function(){
    app.init();
});

var app = {
    init: function() {
        uploader.init();
    }
}

var uploader = {
    init: function() {
        this.setEvents();
    },

    setEvents: function() {
        $('#uploadScans').click(function(){
            console.log('uploading');
        });

        $('#recurring').click(function(){
            var checked = $(this).prop('checked');
            if(checked) {
                $('#freqWrapper').fadeIn();
            } else {
                $('#freqWrapper').fadeOut();
            }
        });
    },

    upload: function() {

    },
}

var viewer = {}