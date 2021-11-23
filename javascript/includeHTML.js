function includeHTML(callback) {
    var z, i, elmnt, file, xhr;
    /*loop through a collection of all HTML elements:*/
    z = document.getElementsByTagName("*");
    for (i = 0; i < z.length; i++) {
        elmnt = z[i];
        /*search for elements with a certain atrribute:*/
        file = elmnt.getAttribute("include-html");
        //console.log(file);
        if (file) {
            /*make an HTTP request using the attribute value as the file name:*/
            xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        elmnt.innerHTML = this.responseText;
                    }
                    if (this.status == 404) {
                        elmnt.innerHTML = "Page not found.";
                    }
                    /*remove the attribute, and call this function once more:*/
                    elmnt.removeAttribute("include-html");
                    includeHTML(callback);
                }
            };
            xhr.open("GET", file, true);
            xhr.send();
            /*exit the function:*/
            return;
        }
    }
    setTimeout(function() {
        callback();
    }, 0);
}


function showLeftMenu(){
    var circleBtObj = document.getElementById('circleBt');
    var leftMenuObj = document.getElementById('hideMenuBodyId');
    circleBtObj.style['display'] = "none";
    leftMenuObj.style['transform'] = "translate(0px, 0px)";
    
    leftMenuObj.style['msTransform'] = "translate(0px, 0px)";
    leftMenuObj.style['mozTransform'] = "translate(0px, 0px)";
    leftMenuObj.style['webkitTransform'] = "translate(0px, 0px)";
    leftMenuObj.style['oTransform'] = "translate(0px, 0px)";
}

function closeLeftMenu() {
    var circleBtObj = document.getElementById('circleBt');
    var leftMenuObj = document.getElementById('hideMenuBodyId');

    circleBtObj.style['display'] = "block";
    leftMenuObj.removeAttribute("style");
}

function showLeftMenu(){
    var circleBtObj = document.getElementById('circleBt');
    var leftMenuObj = document.getElementById('hideMenuBodyId');
    circleBtObj.style['display'] = "none";
    leftMenuObj.style['transform'] = "translate(0px, 0px)";
    
    leftMenuObj.style['msTransform'] = "translate(0px, 0px)";
    leftMenuObj.style['mozTransform'] = "translate(0px, 0px)";
    leftMenuObj.style['webkitTransform'] = "translate(0px, 0px)";
    leftMenuObj.style['oTransform'] = "translate(0px, 0px)";
}

function closeLeftMenu() {
    var circleBtObj = document.getElementById('circleBt');
    var leftMenuObj = document.getElementById('hideMenuBodyId');

    circleBtObj.style['display'] = "block";
    leftMenuObj.removeAttribute("style");
}


var nav = $("#nav ul li");
var cont = $("#contents > div");

nav.click(function(e){
  e.preventDefault();
  var target = $(this);
  var index = target.index();
  //alert(index);
  var section = cont.eq(index);
  var offset = section.offset().top;
  //alert(offset);
  $("html,body").animate({ scrollTop:offset },600,"easeInOutBack");
});

$(window).scroll(function(){
  var wScroll = $(this).scrollTop();
  
  
  if(wScroll >= cont.eq(0).offset().top){
    nav.removeClass("active");
    nav.eq(0).addClass("active");
  }
  if(wScroll >= cont.eq(1).offset().top){
    nav.removeClass("active");
    nav.eq(1).addClass("active");
  }
  if(wScroll >= cont.eq(2).offset().top){
    nav.removeClass("active");
    nav.eq(2).addClass("active");
  }
  if(wScroll >= cont.eq(3).offset().top){
    nav.removeClass("active");
    nav.eq(3).addClass("active");
  }
  if(wScroll >= cont.eq(4).offset().top){
    nav.removeClass("active");
    nav.eq(4).addClass("active");
  }
  if(wScroll >= cont.eq(5).offset().top){
    nav.removeClass("active");
    nav.eq(5).addClass("active");
  }
});

$(".ham").click(function(){
  //메뉴를 보여주는 방법
  // $(".menu").css("display","block");
  // $(".menu").show();
  // $(".menu").fadeIn();
  // $(".menu").slideDown();
  // $(".menu").toggle();
  // $(".menu").fadeToggle();
  $(".menu").slideToggle();
});

$(".ham").click(function(){
  $(this).toggleClass("active")
});

$(window).resize(function(){
  var wWidth = $(window).width();
  //화면 크기가 830 이상일 때
  if(wWitdh > 830 && $(".menu").is(";hidden")){
    $(".menu").removeAttr("style");
  }
});


$(":checkbox[name='freeChk']").on({
  click: function(e) {
    alert("clicked");
  },
  change: function(e) {
    alert("chaged");
  }
});

$(function(){
  $('.tabcontent > div').hide();
  $('.tabnav a').click(function () {
    $('.tabcontent > div').hide().filter(this.hash).fadeIn();
    $('.tabnav a').removeClass('active');
    $(this).addClass('active');
    return false;
  }).filter(':eq(0)').click();
  });