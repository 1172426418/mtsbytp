/**
 * Created by admin on 2017/10/17.
 */
$('.paging a').css('cursor','pointer');


$('#user-check').click(function(){
    if($(this).prop('checked')){
        $('.user-check').prop('checked',true);
    }else{
        $('.user-check').prop('checked','');
    }
})
$('.user-check').click(function(){
    var num = $('.user-check').length;
    var n = $('.user-check:checked').length;
    if(num == n){
        $('#user-check').prop('checked',true);
    }else{
        $('#user-check').prop('checked','');
    }
})

$('.effect img').css('cursor','pointer');

$('.div_button .search_button').mouseover(function () {
    $(this).css('background','#888');
})
$('.div_button .search_button').mouseout(function () {
    $(this).css('background','#ccc');
})
$('.div_button .button').mouseover(function () {
    $(this).css('background','#888');
})
$('.div_button .button').mouseout(function () {
    $(this).css('background','white');
})
$('.yes').mouseover(function () {
    $(this).css('background','#888');
})
$('.yes').mouseout(function () {
    $(this).css('background','white');
})
$('.no').mouseover(function () {
    $(this).css('background','#888');
})
$('.no').mouseout(function () {
    $(this).css('background','white');
})

$('#infor_insert').mouseover(function () {
    $(this).css('background','#888');
})
$('#infor_insert').mouseout(function () {
    $(this).css('background','white');
})

/* 弹窗 */
$('#header-success1 .yes').click(function(){
    var url=$(this).attr('url');
    window.location.href=url;
})
$('#header-success1 .no').click(function(){
    $('#header-success1').css('display','none');
    $('.cover').remove();
})

$('#header-success2 .yes').click(function(){
    var url=$(this).attr('url');
    if(url!==''){
        window.location.href=url;
    }else{
        $('#header-success2').css('display','none');
        $('.cover').remove();
    }
})

$('.free_time .no').click(function(){
    $('.free_time').css('display','none');
    $('.free_time .yes').attr('data-id','');
    $('.cover').remove();
})

//双选提示框
function resize1(){
    $('#header-success1').offset({left:($(document.body).width()-$('#header-success1').width())/2,top:$(document.body).scrollTop()+200});
    $('.cover').width($(document).width()).height($(document).height());
}
//单选提示框
function resize2(){
    $('#header-success2').offset({left:($(document.body).width()-$('#header-success2').width())/2,top:$(document.body).scrollTop()+200});
    $('.cover').width($(document).width()).height($(document).height());
}

//输入框
function resize3(){
    $('.free_time').offset({left:($(document.body).width()-$('.free_time').width())/2,top:$(document.body).scrollTop()+200});
    $('.cover').width($(document).width()).height($(document).height());
}

$(window).resize(function(){
    resize1();
    resize2();
    resize3();
})

function Double_button(success,url){
    $('#header-success1 .yes').attr('url',url);
    $('#header-success1 h1').html(success);
    $('#header-success1').css('display','block');
    $('<div></div>').prependTo(document.body).addClass('cover').width($(document).width()).height($(document).height());
    resize1();
}

function One_button(success){
    $('#header-success2 h1').html(success);
    $('#header-success2').css('display','block');
    $('<div></div>').prependTo(document.body).addClass('cover').width($(document).width()).height($(document).height());
    resize2();
}

function Update_button(success){
    $('.free_time h1').html(success);
    $('.free_time').css('display','block');
    $('<div></div>').prependTo(document.body).addClass('cover').width($(document).width()).height($(document).height());
    resize3();
}