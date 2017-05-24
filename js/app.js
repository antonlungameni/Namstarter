

// Wait for window load
/*$(window).load(function () {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");

});*/

$(document).ready(function () {
    $("img").unveil();
     $(document).foundation();
   $(".animsition").animsition({
    inClass: 'fade-in',
    outClass: 'fade-out',
    inDuration: 1500,
    outDuration: 800,
    linkElement: '.animsition-link',
    // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
    loading: true,
    loadingParentElement: 'body', //animsition wrapper element
    loadingClass: 'animsition-loading',
    loadingInner: '', // e.g '<img src="loading.svg" />'
    timeout: false,
    timeoutCountdown: 5000,
    onLoadEvent: true,
    browser: [ 'animation-duration', '-webkit-animation-duration'],
    // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
    // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
    overlay : false,
    overlayClass : 'animsition-overlay-slide',
    overlayParentElement : 'body',
    transition: function(url){ window.location.href = url; }
  });
});

function previewVideoFile() {
    if (document.getElementById('pro_vid') != null) {
        //var preview = document.getElementById('Pro_prev_vid'); //selects the query named img
        var file = document.getElementById('pro_vid').files[0]; //sames as here
        var reader = new FileReader();

//        reader.onloadend = function () {
//            preview.src = reader.result;
//        };

        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
            $('#video_name').html('<i class="fa fa-video-camera" aria-hidden="true"></i> ' + file.name);
        } else {
            $('#video_name').text("No Video Uploaded");
            
        }
  
    }
}









function previewFile() {
    if (document.querySelector('input[type=file]') != null) {
        var preview = document.getElementById('Pro_prev'); //selects the query named img
        var file = document.querySelector('input[type=file]').files[0]; //sames as here
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            $('#Pro_prev').removeClass('hide');
        };

        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
        } else {
            preview.src = "";
        }
    }
}

previewVideoFile();
previewFile();

