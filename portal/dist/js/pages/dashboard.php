 <?php 
$sql1 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."'";
$game_all_query = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
					while($row1 = mysqli_fetch_array($game_all_query)){ 
					 $gameallCount = $row1[0];
					}
$sql2 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.result = 'won'";
$game_won_query = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
					while($row2 = mysqli_fetch_array($game_won_query)){ 
					 $gamewonCount = $row2[0];
					}
$sql3 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.result = 'lost'";
$game_lost_query = mysqli_query($conn,$sql3) or die(mysqli_error($conn));
					while($row3 = mysqli_fetch_array($game_lost_query)){ 
					 $gamelostCount = $row3[0];
					}
$sql4 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.game_status = 'pending'";
$game_pending_query = mysqli_query($conn,$sql4) or die(mysqli_error($conn));
					while($row4 = mysqli_fetch_array($game_pending_query)){ 
					 $gamependingCount = $row4[0];
					}
$sql5 = "select count(*) from games join game_play on game_play.game_id = games.id where game_play.username = '".$user."' and game_play.game_status = 'active'";
$game_ongoing_query = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
					while($row5 = mysqli_fetch_array($game_ongoing_query)){ 
					 $gameongoingCount = $row5[0];
					}

$wongames = ($gamewonCount / $gameallCount) * 100;
$lostgames = ($gamelostCount / $gameallCount) * 100;
$pendinggames = ($gamependingCount / $gameallCount) * 100;
$ongoinggames = ($gameongoingCount / $gameallCount) * 100;			
?>
	<script>
	
$(function () {

  'use strict';

  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.


  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------

  //-------------
  //- PIE CHART -
  //-------------
  			
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
  var pieChart = new Chart(pieChartCanvas);
  var PieData = [
    {
      value: <?php echo $gamelostCount; ?>,
      color: "#f56954",
      highlight: "#f56954",
      label: "Games Lost"
    },
    {
      value: <?php echo $gamewonCount; ?>,
      color: "#00a65a",
      highlight: "#00a65a",
      label: "Games Won"
    },
    {
      value: <?php echo $gamependingCount; ?>,
      color: "#f39c12",
      highlight: "#f39c12",
      label: "Pending Games"
    }
	{
      value: <?php echo $gameongoingCount; ?>,
      color: "#1E90FF",
      highlight: "#1E90FF",
      label: "Ongoing Games"
    }
  ];
  var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
    //String - A tooltip template
    tooltipTemplate: "<%=value %> <%=label%>"
  };
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  //-----------------
  //- END PIE CHART -
  //-----------------

  /* jVector Maps
   * ------------
   * Create a world map with markers
   */
  $('#world-map-markers').vectorMap({
    map: 'world_mill_en',
    normalizeFunction: 'polynomial',
    hoverOpacity: 0.7,
    hoverColor: false,
    backgroundColor: 'transparent',
    regionStyle: {
      initial: {
        fill: 'rgba(210, 214, 222, 1)',
        "fill-opacity": 1,
        stroke: 'none',
        "stroke-width": 0,
        "stroke-opacity": 1
      },
      hover: {
        "fill-opacity": 0.7,
        cursor: 'pointer'
      },
      selected: {
        fill: 'yellow'
      },
      selectedHover: {
      }
    },
    markerStyle: {
      initial: {
        fill: '#00a65a',
        stroke: '#111'
      }
    },
    markers: [
      {latLng: [41.90, 12.45], name: 'Vatican City'},
      {latLng: [43.73, 7.41], name: 'Monaco'},
      {latLng: [-0.52, 166.93], name: 'Nauru'},
      {latLng: [-8.51, 179.21], name: 'Tuvalu'},
      {latLng: [43.93, 12.46], name: 'San Marino'},
      {latLng: [47.14, 9.52], name: 'Liechtenstein'},
      {latLng: [7.11, 171.06], name: 'Marshall Islands'},
      {latLng: [17.3, -62.73], name: 'Saint Kitts and Nevis'},
      {latLng: [3.2, 73.22], name: 'Maldives'},
      {latLng: [35.88, 14.5], name: 'Malta'},
      {latLng: [12.05, -61.75], name: 'Grenada'},
      {latLng: [13.16, -61.23], name: 'Saint Vincent and the Grenadines'},
      {latLng: [13.16, -59.55], name: 'Barbados'},
      {latLng: [17.11, -61.85], name: 'Antigua and Barbuda'},
      {latLng: [-4.61, 55.45], name: 'Seychelles'},
      {latLng: [7.35, 134.46], name: 'Palau'},
      {latLng: [42.5, 1.51], name: 'Andorra'},
      {latLng: [14.01, -60.98], name: 'Saint Lucia'},
      {latLng: [6.91, 158.18], name: 'Federated States of Micronesia'},
      {latLng: [1.3, 103.8], name: 'Singapore'},
      {latLng: [1.46, 173.03], name: 'Kiribati'},
      {latLng: [-21.13, -175.2], name: 'Tonga'},
      {latLng: [15.3, -61.38], name: 'Dominica'},
      {latLng: [-20.2, 57.5], name: 'Mauritius'},
      {latLng: [26.02, 50.55], name: 'Bahrain'},
      {latLng: [0.33, 6.73], name: 'São Tomé and Príncipe'}
    ]
  });

  /* SPARKLINE CHARTS
   * ----------------
   * Create a inline charts with spark line
   */

  //-----------------
  //- SPARKLINE BAR -
  //-----------------
  $('.sparkbar').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type: 'bar',
      height: $this.data('height') ? $this.data('height') : '30',
      barColor: $this.data('color')
    });
  });

  //-----------------
  //- SPARKLINE PIE -
  //-----------------
  $('.sparkpie').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type: 'pie',
      height: $this.data('height') ? $this.data('height') : '90',
      sliceColors: $this.data('color')
    });
  });

  //------------------
  //- SPARKLINE LINE -
  //------------------
  $('.sparkline').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type: 'line',
      height: $this.data('height') ? $this.data('height') : '90',
      width: '100%',
      lineColor: $this.data('linecolor'),
      fillColor: $this.data('fillcolor'),
      spotColor: $this.data('spotcolor')
    });
  });
});

	</script>