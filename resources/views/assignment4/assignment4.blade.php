<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <title>Assignment 4</title>
</head>
<body>
<h1>Name : Somnath Jadhav
    <br>
    Student Id: 1001967009
</h1>

 <div id="chartContainer" style="height: 370px; width:100%;"></div>

 <script>
     $( document ).ready(function() {
         console.log('in here')
         $.ajax({
             url: "/getData",
             type: 'GET',
             // dataType: 'json', // added data type
             success: function(res) {
                 console.log(res);
                 let result = JSON.parse(res);
                 console.log(result);
                 var chart = new CanvasJS.Chart("chartContainer", {
                     animationEnabled: true,
                     exportEnabled: true,
                     theme: "light1", // "light1", "light2", "dark1", "dark2"
                     title:{
                         text: "Total Earthquakes According to Magnitude"
                     },
                     axisY: {
                         includeZero: true
                     },
                     data: [{
                         indexLabelFontColor: "#5A5757",
                         indexLabelFontSize: 18,
                         indexLabelPlacement: "outside",
                         type: "column",
                         dataPoints: [
                             { label : result[0]['mag'].toUpperCase() , y: parseInt(result[0]['count'], 10) },
                             { label : result[1]['mag'].toUpperCase(), y: parseInt(result[1]['count'], 10)},
                             { label : result[2]['mag'].toUpperCase(), y: parseInt(result[2]['count'], 10)},
                             { label : result[3]['mag'].toUpperCase(), y: parseInt(result[3]['count'], 10)},
                         ]
                     }]
                 });
                 chart.render();
                 // alert(res);
             }
         });
     });
 </script>

{{-- <svg width="600" height="500"></svg>--}}
{{-- <script>--}}

{{--     var svg = d3.select("svg"),--}}
{{--         margin = 200,--}}
{{--         width = svg.attr("width") - margin,--}}
{{--         height = svg.attr("height") - margin;--}}


{{--     var xScale = d3.scaleBand().range ([0, width]).padding(0.4),--}}
{{--         yScale = d3.scaleLinear().range ([height, 0]);--}}

{{--     var g = svg.append("g")--}}
{{--         .attr("transform", "translate(" + 100 + "," + 100 + ")");--}}

{{--     d3.data("XYZ.csv", function(error, data) {--}}
{{--         if (error) {--}}
{{--             throw error;--}}
{{--         }--}}

{{--         xScale.domain(data.map(function(d) { return d.year; }));--}}
{{--         yScale.domain([0, d3.max(data, function(d) { return d.value; })]);--}}

{{--         g.append("g")--}}
{{--             .attr("transform", "translate(0," + height + ")")--}}
{{--             .call(d3.axisBottom(xScale));--}}

{{--         g.append("g")--}}
{{--             .call(d3.axisLeft(yScale).tickFormat(function(d){--}}
{{--                 return "$" + d;--}}
{{--             }).ticks(10))--}}
{{--             .append("text")--}}
{{--             .attr("y", 6)--}}
{{--             .attr("dy", "0.71em")--}}
{{--             .attr("text-anchor", "end")--}}
{{--             .text("value");--}}
{{--     });--}}
{{-- </script>--}}

</body>
</html>
