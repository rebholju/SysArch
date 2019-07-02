<?php

class Lidar extends View
{
    protected function generateContent()
    {
        $refVehicleDataController = new VehicleDataController();
        $data = $refVehicleDataController->getCurrentData();
        //$lidarstring;
        $lidarvalues = array();
        $user = new UserController();

        for($i=0;$i<sizeof($data);$i++)
        {
            if(strcmp($data[$i]['sensor'], "LidarDistances") == 0) {
                $lidararray = explode(", ",$data[$i]['value']);
                /* TODO: Simikolon anpassen + auswahl 36 Werte
                 * for($i=0;$i<sizeof($lidararray);$i+10)
                {
                    $j = 0;
                    $lidarvalues[$j] = $lidararray[$i];
                    $j++;
                }*/
                break;
            }
        }
        
        /*$lidararray = explode(", ", $lidarstring);
        
        for($i=0;$i<sizeof($lidararray);$i++)
        {
            $j = 0;
            $lidarvalues[$j] = $lidararray[$i];
            $j++;
        }*/
        //$lidarvalues = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37);
  
echo'

    

	<div class="content">
		<div class="wrapper"><canvas id="chart-0"></canvas></div>
		<div class="toolbar">
			<button onclick="randomize(this)">Randomize</button>
			<button onclick="addDataset(this)">Add Dataset</button>
			<button onclick="removeDataset(this)">Remove Dataset</button>
		</div>
	</div>';

?>            
<script type="text/javascript">
        var lidardata=<?php echo json_encode($lidararray); ?>;	// bei 36 Werten Variable ändern

    	var DATA_COUNT = 7;

		var utils = Samples.utils;

		utils.srand(110);

		function alternatePointStyles(ctx) {
			var index = ctx.dataIndex;
			return index % 2 === 0 ? 'circle' : 'rect';
		}

		function makeHalfAsOpaque(ctx) {
			var c = ctx.dataset.backgroundColor;
			return utils.transparentize(c);
		}

		function adjustRadiusBasedOnData(ctx) {
			var v = ctx.dataset.data[ctx.dataIndex];
			return v < 10 ? 5
				: v < 25 ? 7
				: v < 50 ? 9
				: v < 75 ? 11
				: 15;
		}

		function generateData() {
			return utils.numbers({
				count: DATA_COUNT,
				min: 1,
				max: 100
			});
		}

		var data = {
			labels: ['0', '10', '20', '30', '40', '50', '60', '70', '80', '90', '100', '110', '120', '130', '140', '150', '160', '170', '180', '190', '200', '210', '220', '230', '240', '250', '260', '270', '280', '290', '300', '310', '320', '330', '340', '350'],
			datasets: [{
				data: lidardata,          
				label: 'Vehicle 1 Lidar Sensor [radius-axis: mm | degree-axis: grad]',
                backgroundColor: Chart.helpers.color('#4dc9f6').alpha(0.2).rgbString(),
				borderColor: '#4dc9f6',
			}]
		};

		var options = {
			legend: {
					position: 'top',
				},
				title: {
					display: true,
					text: 'Lidar Chart'
				},
				scale: {
					ticks: {
						beginAtZero: true
					}},
			tooltips: true,
			elements: {
				point: {
					hoverBackgroundColor: makeHalfAsOpaque,
					radius: adjustRadiusBasedOnData,
					pointStyle: alternatePointStyles,
					hoverRadius: 15,
				}
			}
		};

		var chart = new Chart('chart-0', {
			type: 'radar',
			data: data,
			options: options
		});


		// eslint-disable-next-line no-unused-vars
		function addDataset() {
			var newColor = utils.color(chart.data.datasets.length);

			chart.data.datasets.push({
				data: generateData(),
				backgroundColor: Chart.helpers.color(newColor).alpha(0.2).rgbString(),
				borderColor: newColor
			});
			chart.update();
		}

		// eslint-disable-next-line no-unused-vars
		function randomize() {
			chart.data.datasets.forEach(function(dataset) {
				dataset.data = generateData();
			});
			chart.update();
		}

		// eslint-disable-next-line no-unused-vars
		function removeDataset() {
			chart.data.datasets.shift();
			chart.update();
		}
	</script>
<?php
echo"
</body>
<br>";

    }
}   
?>