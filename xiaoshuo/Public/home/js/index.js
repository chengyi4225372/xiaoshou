$(document).ready(function() {
    $('.hot_label').slick({
        arrows: false, // 屏蔽左右控制箭头
        dots: false, // 启用计数点
        autoplay: false, // 启用自动播放
        infinite: false,
        slidesToShow: 6,
        slidesToScroll: 3
    });

    $('.autoplay').slick({
        arrows: false,
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000
    });

    $('.media').slick({
        arrows: false, // 屏蔽左右控制箭头
        dots: true, // 启用计数点
        autoplay: true, // 启用自动播放
        autoplaySpeed: 4000 //自动播放时间间隔
    });

});