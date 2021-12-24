function showAll(){
    $.ajax({
        url: "showAll.php",
        type: "post",
        success: function (res) {
            if (res) {
                data = jQuery.parseJSON(res);
                for (let i = 0; i < data.length; i++) {
                    //$("#conAll").append(i);
                    $("#conAll").append("[" + data[i].ART_NM + "]<br>");
                    $("#conAll").append("[" + data[i].CON_NAME + "]<br>");
                    $("#conAll").append("[" + data[i].SITE_NAME + "]<br>");
                    $("#conAll").append("[" + data[i].ENTRYTYPE + "]<br>");
                }
                 
            }
        }
    });
}
function showDetail(con_id) {
    $('#siteContents').hide();
    $('#detailContents').show();
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
                $("#explainTitle").text(data.CON_NAME); //공연명
                $("#explainArtist").text(data.artist); //출연진
                $("#explainPnC").text(data.place); //장소
                $("#explainTime").text(data.CON_TIME); //시간
                $("#explainPrice").text(data.CON_PRICE); //가격
                $("#conLink").attr("href", data.CON_LINK); //예매링크
            }
        }
    });
}

function showCalendar() {
    var display = $('#tab02').attr('class');

    if (display == "hidden") {
        $('#tab02').removeClass('hidden');
        $('#tab01').addClass('hidden');
        $('#cal1').addClass('hidden');
        $('#cal2').removeClass('hidden');
    } else {
        $('#tab01').removeClass('hidden');
        $('#tab02').addClass('hidden');
        $('#cal2').addClass('hidden');
        $('#cal1').removeClass('hidden');
    }
}

/* 공연장 정보 관련 함수 */
var map;
var marker;

function showSite(siteId) {
    $('#siteContents').show();
    $('#detailContents').hide();
    $("#artistContents").hide();
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
                $('#siteImg').attr("src", data.SITE_IMG);
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
    $("#artistContents").show();
    $.ajax({
        url: "showArtist.php",
        type: "post",
        data: {
            artId: art_id,
        },
        success: function (res) {
            // alert("빡친다");
            if (res) {
                data = JSON.parse(res);
                $("#artistImg").attr("src",data.ART_IMG);
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
            }
        }
    });
 }