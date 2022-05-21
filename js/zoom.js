let zoomer = function () {
    document.querySelector('#image')
        .addEventListener('mousemove', function (e) {

            let original = document.querySelector('#image-principale'),
                magnified = document.querySelector('#zoom'),
                style = magnified.style,
                x = e.pageX - this.offsetLeft,
                y = e.pageY - this.offsetTop,
                imgWidth = original.offsetWidth,
                imgHeight = original.offsetHeight,
                xperc = ((x / imgWidth) * 100),
                yperc = ((y / imgHeight) * 100);

            //lets user scroll past right edge of image
            if (x > (.01 * imgWidth)) {
                xperc += (.15 * xperc);
            };

            //lets user scroll past bottom edge of image
            if (y >= (.01 * imgHeight)) {
                yperc += (.15 * yperc);
            };

            style.backgroundPositionX = (xperc - 9) + '%';
            style.backgroundPositionY = (yperc - 9) + '%';

            style.left = (x + 160) + 'px';
            style.top = (y - 10) + 'px';

        }, false);
}();