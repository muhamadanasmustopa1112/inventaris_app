<script>
	window.onload = function() {

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			theme: "light1", // "light1", "light2", "dark1", "dark2"
			title: {
				text: "Data Aplikasi Kominfo Majelengka"
			},

			data: [{
				type: "column",
				dataPoints: [{
						label: "Aplikasi On Process",
						y: <?= $aplikasi_on_process ?>
					},
					{
						label: "Aplikasi Di Tolak",
						y: <?= $aplikasi_not_verify ?>
					},
					{
						label: "Aplikasi Terverifikasi",
						y: <?= $aplikasi_terverifikasi ?>
					}


				]
			}]
		});
		chart.render();

		var chart = new CanvasJS.Chart("chartContainer2", {
			animationEnabled: true,
			title: {
				text: "Executive Summary"
			},
			data: [{
				type: "pie",
				startAngle: 240,
				indexLabel: "{label} {y}",
				dataPoints: [{
						y: <?= $data_application ?>,
						label: "Data Application"
					},
					{
						y: <?= $data_hardwere ?>,
						label: "Data Hardwere"
					},
					{
						y: <?= $data_ticket ?>,
						label: "Ticket"
					}
				]
			}]
		});
		chart.render();

	}
</script>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<div class="mt-4" id="chartContainer2" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
