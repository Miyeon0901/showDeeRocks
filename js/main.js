
function showDetail(con_id) {
    $('#siteContents').hide();
    $('#detailContents').show();
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

// var mapOptions = {
//     zoom: 20,
//     mapTypeControl: true
// };
// var markerOptions = {
//     map: map,
//     icon: 'img/tick.png'
// }
// var infoWindow = new naver.maps.InfoWindow({
//     anchorSkew: true
// });
var map;
var marker;

function showSite(siteId) {
    $('#siteContents').show();
    $('#detailContents').hide();
    $.ajax({
        url: "showSite.php",
        type: "post",
        data: {
            siteId: siteId
        },
        success: function (res) {
            if (res) {
                data = JSON.parse(res);
                var mapOptions = {
                    zoom: 20,
                    mapTypeControl: true
                };
                map = new naver.maps.Map('map', mapOptions);
                var markerOptions = {
                    map: map,
                    //icon: 'img/tick.png'
                }
                
                marker = new naver.maps.Marker(markerOptions);
                searchAddressToCoordinate(data.map);
            }
        }
    });
}

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
      
    $.ajax({
          url : "showArtist.php",
          type : "post",
          data : {
             artistId : art_id,
          },
          success : function(res) {
             if(res) {
                data = JSON.parse(res);
                $("#artistIntro").text(data.ART_INTRO); //소개
                $("#artLink").attr("href",data.ART_LINK); //링크
             }
          }
       
    });
    
 }