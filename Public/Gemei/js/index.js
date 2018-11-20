//homePro切换
$('.homeProContentNav li p').click(function () {
    $(this).addClass('homeProChecked').parents().siblings().children().removeClass('homeProChecked');
    $('.homProBoxPage').eq($('.homeProContentNav li p').index(this)).show().siblings().hide();
    console.log($('.homeProContentNav li p').index(this))
})

$('.homeProActive p img').attr('src', '/gemei_wj/Public/Gemei/images/pointyl.png');
$('.homeProNav li').click(function name(params) {
    $(this).addClass('homeProActive').siblings().removeClass('homeProActive');
    $('.homeProActive p img').attr('src', '/gemei_wj/Public/Gemei/images/pointyl.png');
    $(this).siblings().children().find('img').attr('src', '/gemei_wj/Public/Gemei/images/pointwt.png');
    $('.homeProContent').eq($(this).index()).show().siblings().hide();
})


//nav





// products
$('.homProBox').hover(function () {
    $(this).children().children().show()
},function () {
    $('.productsName').hide()
})





// navPhone

$('.navMenu').click(function(){
    $('.navPhone').slideToggle()
})
console.log($(window).width())
if($(window).width() < 600){
    $('.homeProActive').click(function(){
        // console.log(123);
        $('.homeProNav li').show();
        $('.homeProNav li').click(function(){
            // console.log(123);
            $(this).siblings().hide();
            
        })
        
    })

}