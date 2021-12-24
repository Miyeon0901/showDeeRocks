
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
    } else {
        $('#tab01').removeClass('hidden');
        $('#tab02').addClass('hidden');
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
            if (res) {
                data = JSON.parse(res);
                $("#artistIntro").text(data.ART_INTRO); 
                $("#artLink").attr("href", data.ART_LINK); 
            }
        }
    });
 }