// var map = new BMap.Map("allmap");
// var point = new BMap.Point(116.36040445073916, 39.76831336919768); // 需要标注的位置的经纬度
// map.centerAndZoom(point, 15); // 中心位置和缩放倍数
// map.enableScrollWheelZoom(); // 添加滚动轴
// map.addControl(new BMap.NavigationControl()); // 添加左上角的标尺工具
// map.addControl(new BMap.NavigationControl());
// map.addControl(new BMap.ScaleControl());
// map.addControl(new BMap.OverviewMapControl());
// map.addControl(new BMap.MapTypeControl());
// var opts = {
//     width: 200, // 信息窗口宽度
//     height: 20, // 信息窗口高度
//     title: "北京市大兴区金星路18号" // 信息窗口标题
// }
// var infoWindow = new BMap.InfoWindow("圣多斯", opts); // 创建信息窗口对象
// map.openInfoWindow(infoWindow, map.getCenter());    // 打开信息窗口
// var marker = new BMap.Marker(point);                // 创建标注,即地图上的小红点
// map.addOverlay(marker);
//发起ajax请求 返回相应的信息  Detailedmap  reg_name

function Detailedmap(id) {
    var address = $("#address" + id).html();
    var reg_name = $("#reg_name" + id).html();
    $.ajax({
        url: "/Home/Businessschool/Course/Detailedmap",
        type: "post",
        data: {id: id, address: address, reg_name: reg_name},
        dataType: 'json',
        success: function (data) {
            var str = strp(data);
            $("#api").html(str);
            $("#allmap").show();
            console.log(str);
        }

    });
}




function strp(data) {
    var str = '';
    str += '<script>';
    str += 'var map = new BMap.Map("allmap");';
    str += 'var point = new BMap.Point('+data['x']+','+data['y']+');';
    str += 'map.centerAndZoom(point, 15);';
    str += 'map.enableScrollWheelZoom();';
    str += 'map.addControl(new BMap.NavigationControl());';
    str += 'map.addControl(new BMap.NavigationControl());';
    str += 'map.addControl(new BMap.ScaleControl());';
    str += 'map.addControl(new BMap.OverviewMapControl());';
    str += 'map.addControl(new BMap.MapTypeControl());';
    str += 'var opts = {width: 200,height: 20,title:"'+data['address']+'"};';
    str += 'var infoWindow = new BMap.InfoWindow("'+data['address']+'",opts);';
    str += 'map.openInfoWindow(infoWindow, map.getCenter());';
    str += 'var marker = new BMap.Marker(point);';
    str += 'map.addOverlay(marker);';
    str += '</script>';
    return str;
}
