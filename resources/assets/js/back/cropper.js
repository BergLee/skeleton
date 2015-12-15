$(function () {

    $(function () {
        var $image = $('.img-container > img');

        $image.cropper({
            movable: false,
            zoomable: false,
            rotatable: false,
            scalable: false
        });

        $('#replace').on('click', function () {
            $image.cropper('replace', 'http://www.planwallpaper.com/static/images/kartandtinki1_photo-wallpapers_02.jpg');
        });
    });

});