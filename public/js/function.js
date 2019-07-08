$(function () {

    $('.btn-top-toggle').append( '<div class="before"></div>' );
    $('.btn-top-toggle').append( '<div class="after"></div>' );
    $('.body').append( '<div class="body-veil"></div>' );

    // aside navigation active action
    function asideNavigation_open() {
        $('.btn-top-toggle').addClass('active');
        $('.soc-container').addClass('active');
        $('.body').addClass('no-scroll');
        $('.body-veil').fadeIn();
        $('body').scrollTop(0);
        // console.log(scrollTop);
    }

    // aside navigation disactive action
    function asideNavigation_close() {
        $('.btn-top-toggle').removeClass('active');
        $('.soc-container').removeClass('active');
        $('.body').removeClass('no-scroll');
        $('.body-veil').fadeOut();
        // console.log(scrollTop);
    }

    $('.btn-top-toggle .before').on('click', function () {
        asideNavigation_open();
    });

    $('.btn-top-toggle .after').on('click', function () {
        asideNavigation_close();
    })

});

$(function () {

    $('.nav-depth-one>li>a').on('click', function () {
        $(this).parent().toggleClass('open');
        $(this).next().slideToggle('fast');
    });

});