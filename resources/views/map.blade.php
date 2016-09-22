<!doctype html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <title>Hello, World</title>
    <style type="text/css">
        html{height:100%}
        body{height:100%;margin:0px;padding:0px}
        #container{height:100%}
    </style>
    <script src="http://api.map.baidu.com/api?v=2.0&ak=oqbdHc16AGQAKDRG18wTad6LPbz4W9oU"></script></head>
<body>
<div id="container"></div>
<script type="text/javascript">
    var map = new BMap.Map("container"); // 创建地图实例
    var point = new BMap.Point(116.404, 39.915); // 创建点坐标 map.centerAndZoom(point, 15); // 初始化地图,设置中心点坐标和地图级别
    map.centerAndZoom(point, 15);

//
    map.addControl(new BMap.NavigationControl()); //添加平移缩放控件
    map.addControl(new BMap.ScaleControl()); //添加比例尺

    var myGeo = new BMap.Geocoder();  // 创建地址解析器实例

    // 将地址解析结果显示在地图上,并调整地图视野
    myGeo.getPoint("吉林大学珠海学院", function(point){

        if (point) {
            map.centerAndZoom(point, 15);
            map.addOverlay(new BMap.Marker(point)); //在地图上标注地理位置
        }else{
            alert("您选择地址没有解析到结果!");
        }
    }, "珠海市");


    var geoc = new BMap.Geocoder();
    map.addEventListener("click", function(e){
        var pt = e.point; //点击位置的坐标点
        geoc.getLocation(pt, function(rs){
            var addComp = rs.addressComponents;
            console.log(addComp.province + ", " + addComp.city + ", " + addComp.district + ", " + addComp.street + ", " + addComp.streetNumber);
        });
    });


</script>


</body>
</html>