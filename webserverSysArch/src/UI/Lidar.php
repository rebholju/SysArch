<?php

class Lidar extends View
{
    protected function generateContent()
    {
        $refVehicleDataController = new VehicleDataController();
        $data = $refVehicleDataController->getCurrentData();
        //$lidararray = array();
        $lidarvalues = array();
        $user = new UserController();

        for($i=0;$i<sizeof($data);$i++)
        {
            if(strcmp($data[$i]['sensor'], "LidarDistances") == 0) {
                $lidararray = explode(";",$data[$i]['value']);
                for($j=0;$j<36;$j++)
                {
                    if($j==0) {$k=0;}
                    if($k==10) {$k-=1;}
                        $lidarvalues[$j] = $lidararray[$k];
                        $k+=10;
                }

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
			<button onclick="updateDataset(this)">Update Dataset</button>
			<button onclick="addDataset(this)">Add dummy Dataset</button>
			<button onclick="removeDataset(this)">Remove Dataset</button>
		</div>
	</div>';

?>            
<script type="text/javascript">
        var lidardata=<?php echo json_encode($lidarvalues); ?>;	

    	var DATA_COUNT = 36;

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
			return v < 50 ? 2
				: v < 200 ? 3
				: v < 500 ? 4
				: v < 1000 ? 5
				: v < 2000 ? 6
				: v < 3000 ? 7
				: v < 4000 ? 8
				: v < 5000 ? 9
				: 10;
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
                backgroundColor: Chart.helpers.color('#537bc4').alpha(0.2).rgbString(),
				borderColor: '#537bc4',
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
		function updateDataset() {
			dataset.data = lidardata;
			
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