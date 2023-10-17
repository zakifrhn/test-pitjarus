<!DOCTYPE html>
<html>
<head>
	<title>MEMBUAT GRAFIK DARI DATABASE MYSQL DENGAN PHP DAN CHART.JS - www.malasngoding.com</title>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1>My View</h1>

    <!-- Form untuk mengirimkan nilai 'area' ke controller -->
    <form action="<?= base_url('Pages/fetchData'); ?>" method="post" id="myForm" style="inline-block;">


        <input type="checkbox" id="area" name="area[]" value="DKI Jakarta">
        <label for="vehicle1"> DKI Jakarta</label><br>
        <input type="checkbox" id="area" name="area[]" value="Kalimantan">
        <label for="vehicle2"> Kalimantan</label><br>
        <input type="checkbox" id="area" name="area[]" value="Jawa Barat">
        <label for="vehicle3"> Jawa Barat</label><br>
        <input type="checkbox" id="area" name="area[]" value="Jawa Tengah">
        <label for="vehicle3"> Jawa Tengah</label><br>
        <input type="checkbox" id="area" name="area[]" value="Bali">
        <label for="vehicle3"> Bali</label><br><br>

        <label for="birthday">Start Date:</label>
        <input type="date" id="early_date" name="early_date">


        <label for="birthday">To date:</label>
        <input type="date" id="last_date" name="last_date"><br><br>
 
        <input type="submit" value="view">
    </form>

    <div style="width: 800px;  margin: 0px auto; margin-bottom:100px;">
		<canvas id="myChart">

        </canvas>
	</div>

    <table border="1" style="margin: 0 auto;">
		<thead>
			<tr>
				<th>Brand</th>
                <?php
                foreach ($label as $p) {
                    echo"<th>$p</th>";
                }
                ?>
			</tr>
            
            <?php
                foreach($brand_name as $op){
                    echo "<tr>";
                    echo "<td>$op</td>";

                    foreach ($data_brand as $db) {
                        foreach ($label as $p) {
                            
                            if($db->area_name == $p && $db->brand_name == $op){
                                echo"<th>".ceil($db->Nilai)."% </th>";
                            }
                        }
                    }

                    echo "</tr>";
                }
            ?>
		</thead>
		<tbody>
		</tbody>
	</table>
    <script>
function submitForm() {
    // Mendapatkan semua checkbox
    var checkboxes = document.querySelectorAll('input[name="area[]"]:checked');

    // Membuat array untuk menyimpan nilai checkbox yang dicentang
    var selectedAreas = [];

    // Menyimpan nilai checkbox ke dalam array
    checkboxes.forEach(function(checkbox) {
        selectedAreas.push(checkbox.value);
    });

    // Mengisi nilai array ke dalam input yang sesuai sebelum submit
    document.getElementById('myForm').submit();
}

var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
            labels: [<?php 
            foreach($label as $l){
                echo '"'.$l.'",';
            }
            ?>],
			datasets: [{
				label: 'Nilai',
				data: [
                <?php 
                    echo join(',', $nilai)

                ?>
            ],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)'
				],
				borderColor: [
				'rgba(255,99,132,1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
</script>
</body>
</html>