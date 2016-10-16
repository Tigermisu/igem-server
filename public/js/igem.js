$(function(){
    app.init();
});

var app = {
    init: function() {
        uploader.init();
    }
}

var uploader = {
    uploadInterval: null,
    currentFile: null,

    init: function() {
        this.setEvents();
    },

    print: function(text, style = null) {        
        var d = new Date(),
            hr = d.getHours(),
            min = d.getMinutes();
            sec = d.getSeconds();
        if (min < 10) min = "0" + min;    
        if (sec < 10) sec = "0" + sec;                       
        var timestamp = '[' + hr + ':' + min + ':' + sec + ']';
        $('#console').append('<p>' + timestamp + ' ' + text + '</p>');
        var newP = $('#console').find('p').last();
        $('#console').scrollTop($('#console')[0].scrollHeight);
        if(style != null) newP.addClass(style);
    },

    setEvents: function() {
        $('#recurring').click(function(){
            var checked = $(this).prop('checked');
            if(checked) {
                $('#freqWrapper').fadeIn();
            } else {
                $('#freqWrapper').fadeOut();
            }
        });

        $('#cancelRecurring').click(function(){            
            if(uploader.uploadInterval != null) {
                clearInterval(uploader.uploadInterval);
                uploader.print('Cancelled previous upload interval.', 'bad');
                uploader.uploadInterval = null;
               $('#cancelRecurring').animate({
                    opacity: 0
                }); 
            }
        });

        $('#file').change(function(){
            uploader.currentFile = this.files[0];
        });

        $('#uploadForm').submit(function(e){
            e.preventDefault();
            var recurring = $('#recurring').prop('checked'),
                recurringFrequency = parseInt($('#frequency').val()),
                file = $('#file').val().split('\\')[2],
                name = $('#name').val(),
                url = $(this).data('url');
                uploadFunction = function() {                    
                    var reader = new FileReader(),
                        fileData = [];
                    uploader.print('Uploading scan ' + name + ' from file ' + file);
                    
                    reader.onload = function(progressEvent){
                        var lines = this.result.split('\n');
                        fileData = [];
                        for(var line = 0; line < lines.length; line++){
                            if(lines[line].length > 0 && !isNaN(lines[line])) fileData.push(lines[line]);
                        }
                        $.ajax({
                            url: url,
                            method: 'post',
                            data: {
                                _token: window.Laravel.csrfToken,
                                file: fileData,
                                name: name,
                            },
                            success: function(response) {
                                uploader.print('Succesfully uploaded scan data.', 'good');
                            },
                            error: function(response) {
                                console.log(response);
                                uploader.print('Error uploading scan data: ' + response.statusText, 'bad');
                            }
                        });
                    };
                reader.readAsText(uploader.currentFile);                    
            }   

            if(uploader.uploadInterval != null) {
                clearInterval(uploader.uploadInterval);
                uploader.print('Cancelled previous upload interval.', 'bad');
                uploader.uploadInterval = null;
            }
            if(recurring) {
                $('#cancelRecurring').animate({
                    opacity: 1
                });
                if(recurringFrequency < 1) recurringFrequency = 1;
                uploader.print('Recurring upload set for every ' + (recurringFrequency > 1? recurringFrequency + ' minutes.':'minute.'), 'info');
                uploader.uploadInterval = setInterval(uploadFunction, recurringFrequency * 1000 * 60);
            } else {
               $('#cancelRecurring').animate({
                    opacity: 0
                }); 
            }
            uploadFunction();
        });
    },

    upload: function() {

    },
}

var viewer = {}