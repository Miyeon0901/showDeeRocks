function getYoil(date) {
    var week = new Array('일', '월', '화', '수', '목', '금', '토');
    
    var inDate = new Date(date).getDay();
    var todayLabel = week[inDate];
    
    return todayLabel;
}
function showConcert(filter){
    var before;
    if ($("#newConcert").attr("class") == "pressed" && filter == "new")
        filter = "all";
    else if ($("#freeConcert").attr("class") == "pressed" && filter == "free")
        filter = "all";
    else if ($("#hdConcert").attr("class") == "pressed" && filter == "hd")
        filter = "all";
        
    if(filter == "all") {
        $("#newConcert").removeClass("pressed");
        $("#freeConcert").removeClass("pressed");
        $("#hdConcert").removeClass("pressed");
    } else {
        if (filter == "new") {
            $("#newConcert").addClass("pressed");
            $("#freeConcert").removeClass("pressed");
            $("#hdConcert").removeClass("pressed");
        } else if (filter == "free") {
            $("#newConcert").removeClass("pressed");
            $("#freeConcert").addClass("pressed");
            $("#hdConcert").removeClass("pressed");
        } else if (filter == "hd") {
            $("#newConcert").removeClass("pressed");
            $("#freeConcert").removeClass("pressed");
            $("#hdConcert").addClass("pressed");
        }
    }

    $.ajax({
        url: "showAll.php",
        type: "post",
        data: {
            filter: filter,
        },
        success: function (res) {
            $("#conAll").html("");
            if (res) {
                
                data = jQuery.parseJSON(res);
                var prevDate = 0;
                var count = 0;
                for (let i = 0; i < data.length; i++) {
                    if (prevDate == data[i].CON_DATE) {
                        count++;
                        if (count % 5 == 0)
                            $("#conAll").append("<br>");
                        $("#conAll").append("<br>");
                    } else {
                        var yoil = getYoil(data[i].CON_DATE);
                        var dateTxt = "<br><br><div";
                        if (yoil == '토')
                            dateTxt +=" class='blue'>";
                        else if(yoil == '일')
                            dateTxt +=" class='red'>";
                        else 
                            dateTxt += ">";
                        dateTxt += ("<b>" + data[i].CON_DATE + " (" + yoil + ")</b></div><br>");
                        $("#conAll").append(dateTxt);
                        count = 0;
                    }
                    var artStr = data[i].artist;
                    var artIdStr = data[i].artId;
                    var artists = artStr.split(",");
                    var artIds = artIdStr.split(",");
                    for (let j = 0; j < artists.length; j++) {
                        var txt = "<a href='javascript:showArtist(" + artIds[j] + ");'>" + artists[j] + "</a>"
                        $("#conAll").append(txt);
                        if (j != artists.length - 1)
                            $("#conAll").append(", ");
                    }
                    
                    $("#conAll").append("-<b><a href='javascript:showSite(" + data[i].SITE + ");'>" + data[i].place + "</a></b>");
                    $("#conAll").append(" <b>" + data[i].CON_TIME + " </b>");
                    $("#conAll").append("<b> <a href='javascript:showDetail(" + data[i].CON_ID + ");'>[" + data[i].ENTRYTYPE + "]</a></b>");
                    prevDate = data[i].CON_DATE;
                }
                 
            }
        }
    });
}

function priceToString(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function showDetail(con_id) {
    $("#defaultContents").hide();
    $('#siteContents').hide();
    $("#artistContents").hide();
    $.ajax({
        url: "showDetail.php",
        type: "post",
        data: {
            conId: con_id,
        },
        success: function (res) {
            if (res) {
                data = JSON.parse(res); 
                $("#conImg").attr("src",data.CON_IMG);
                $("#explainTitle").text("[" + data.CON_NAME + "]"); //공연명
                var artStr = data.artist;
                var artIdStr = data.artId;
                var artists = artStr.split(",");
                var artIds = artIdStr.split(",");
                $("#explainArtist").html("");
                for (let j = 0; j < artists.length; j++) {
                    var txt = "<a href='javascript:showArtist(" + artIds[j] + ");'>" + artists[j] + "</a>"
                    $("#explainArtist").append(txt);
                    if (j != artists.length - 1)
                       $("#explainArtist").append(", ");
                }
                $("#explainPnC").html("<a href='javascript:showSite(" + data.SITE +");'>" + data.place + "</a>"); //장소
                $("#explainTime").text(data.CON_TIME); //시간
                var price = data.CON_PRICE;
                $("#explainPrice").text(priceToString(price)); //가격
                $("#conLink").attr("href", data.CON_LINK); //예매링크
            }
            $('#detailContents').show();
        }
    });
}

function showCalendar() {
    var display = $('#tab02').attr('class');

    if (display == "hidden") { // 리스트뷰
        $('#tab02').removeClass('hidden');
        $('#tab01').addClass('hidden');
        $('#cal1').addClass('hidden');
        $('#cal2').removeClass('hidden');
        $('#filter').addClass('hidden');
    } else { // 달력뷰
        $('#tab01').removeClass('hidden');
        $('#tab02').addClass('hidden');
        $('#cal2').addClass('hidden');
        $('#cal1').removeClass('hidden');
        $('#filter').removeClass('hidden');
    }
}

/* 공연장 정보 관련 함수 */
var map;
var marker;

function showSite(siteId) {
    
    $('#detailContents').hide();
    $("#artistContents").hide();
    $("#defaultContents").hide();
    $.ajax({
        url: "showSite.php",
        type: "post",
        data: {
            siteId: siteId
        },
        success: function (res) {
            if (res) {
                data = JSON.parse(res);
                $('#siteNm').text("["+data.SITE_NAME+"]");
                $('#siteImgtag').attr("src", data.SITE_IMG);
                $('#siteAddr').text(data.map);
                var mapOptions = {
                    zoom: 20,
                    mapTypeControl: true
                };
                map = new naver.maps.Map('map', mapOptions);
                var markerOptions = {
                    map: map,
                }
                
                marker = new naver.maps.Marker(markerOptions);
                searchAddressToCoordinate(data.map);
            }
            $('#siteContents').show();
        }
    });
}

/* 주소를 좌표로 변경해주는 함수 */
function searchAddressToCoordinate(address) {
    naver.maps.Service.geocode({
        query: address
    }, function (status, response) {
        if (status === naver.maps.Service.Status.ERROR) {
            if (!address) {
                return alert('Geocode Error, Please check address');
            }
            return alert('Geocode Error, address:' + address);
        }
        if (response.v2.meta.totalCount === 0) {
            return alert('No result.');
        }
        var item = response.v2.addresses[0];
        var point = new naver.maps.Point(item.x, item.y);
        // infoWindow.setContent([
        //     address
        // ].join('\n'));
        marker.setPosition(point);
        map.setCenter(point);
        
        //infoWindow.open(map, point);
    });
}

// naver.maps.Event.addListener(map, 'click', function(e) {
//     marker.setPosition(e.latlng);
// });

function showArtist(art_id) {
    $('#siteContents').hide();
    $('#detailContents').hide();
    
    $("#defaultContents").hide();
    $.ajax({
        url: "showArtist.php",
        type: "post",
        data: {
            artId: art_id,
        },
        success: function (res) {
            if (res) {
                data = JSON.parse(res);
                $('#artistNm').text("[" + data.ART_NM + "]");
                $("#artistImgtag").attr("src",data.ART_IMG);
                $("#artistIntro").text(data.ART_INTRO); 
                $("#artLink").attr("href", data.ART_LINK); 
                if(data.ART_HPG===null || data.ART_HPG===""){
                    $('#divLinkHpg').hide();
                }
                else{
                    $('#divLinkHpg').show();
                    $("#artLinkHpg").attr("href",data.ART_HPG);
                }
                if(data.ART_TW===null || data.ART_TW==""){
                    $('#divLinkTw').hide();
                }
                else {
                    $('#divLinkTw').show();
                    $("#artLinkTw").attr("href",data.ART_TW);
                }
                if(data.ART_YOUT===null || data.ART_YOUT==""){
                    $('#divLinkYout').hide();
                }
                else{
                    $("#divLinkYout").show();
                    $("#artLinkYout").attr("href",data.ART_YOUT);
                }
                if(data.ART_INSTA===null || data.ART_INSTA==""){
                    $('#divLinkInsta').hide();
                }
                else{
                    $('#divLinkInsta').show();
                    $("#artLinkInsta").attr("href",data.ART_INSTA);
                }
                $("#artistContents").show();
            }
        }
    });
 }
 
 function openPopup()
{
        
    if($('#contact').css('display')=='none'){
            $('#contact').show();
    }
    else{
        $('#contact').hide();
    }

}
function closePopup()
 {  
            $('#contact').hide();
        
    }