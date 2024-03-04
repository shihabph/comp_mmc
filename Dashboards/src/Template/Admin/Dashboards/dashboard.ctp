<?= $this->Form->unlockField('search_year_month'); ?>

<!-- Varient TOP Starts -->
<div class="row">
	<div class="col-12">
		<div class="row">
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-9">
				<div class="card db-card">
					<div class="stat_title text-center">
						<span>Students Statistics</span>
					</div>
					<div class="card-body dbc-body">
						<canvas id="pie-chart" aria-level="chart" role="img"></canvas>
					</div>
					<div class="card-body text-center details-btn">
						<a href="javascript:void(0);" onclick="openPopup()" class="btn btn-dark">View Details</a>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-9">
				<div class="card db-card">
					<div class="stat_title text-center">
						<span>Statistics by Religion</span>
					</div>
					<div class="card-body dbc-body">
						<div class="chart-point">
							<div class="check-point-area">
								<canvas id="doughnut_chart1"></canvas>
							</div>
						</div>
					</div>
					<div class="card-body text-center">
						<a href="javascript:void(0);" onclick="openPopup1()" class="btn btn-dark">View Details</a>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-9">
				<div class="card db-card">
					<div class="stat_title text-center">
						<span>Statistics by Group</span>
					</div>
					<div class="card-body dbc-body">
						<canvas id="polar_chart"></canvas>
					</div>
					<div class="card-body text-center">
						<a href="javascript:void(0);" onclick="openPopup2()" class="btn btn-dark">View Details</a>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-12 col-sm-12 col-9">
				<div class="card db-card">
					<div class="stat_title text-center">
						<span>Statistics by Quota</span>
					</div>
					<div class="card-body dbc-body">
						<canvas id="pie-chart2" aria-level="chart" role="img"></canvas>
					</div>
					<div class="card-body text-center">
						<a href="javascript:void(0);" onclick="openPopup3()" class="btn btn-dark">View Details</a>
					</div>
				</div>
			</div>
			<div id="popup">
				<div id="popup-content">
					<div><?= $this->element('admin/details'); ?></div>
					<div class="text-right">
						<button onclick="closePopup()" class="btn btn-danger">Close</button>
					</div>
				</div>
			</div>
			<div id="popup1">
				<div id="popup-content">
					<div><?= $this->element('admin/religion'); ?></div>
					<div class="text-right">
						<button onclick="closePopup1()" class="btn btn-danger">Close</button>
					</div>
				</div>
			</div>
			<div id="popup2">
				<div id="popup-content">
					<div><?= $this->element('admin/group'); ?></div>
					<div class="text-right">
						<button onclick="closePopup2()" class="btn btn-danger">Close</button>
					</div>
				</div>
			</div>
			<div id="popup3">
				<div id="popup-content">
					<div><?= $this->element('admin/quota'); ?></div>
					<div class="text-right">
						<button onclick="closePopup3()" class="btn btn-danger">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Varient TOP Ends -->


<!-- Quick-Link Area Starts-->
<legend class="mt-3 dbc-card"> Quick Links
	<div class="row p-3">
		<?php foreach ($buttons as $button) { ?>
			<div class="col-md-2 my-2">
				<button class="btn quicklinks" style="background-color:<?= $button['button_color'] ?>; color:<?= $button['button_text_color'] ?>;">
					<a href="<?= $button['button_link'] ?>"> <?= $button['button_title'] ?></a>
				</button>
			</div>
		<?php } ?>
	</div>
</legend>
<!-- Quick-Link Area Ends-->


<!-- Attendance Statistics Starts-->
<div class="row">
	<div class="col-xl-12 col-lg-12 col-sm-12 mt-3">
		<div class="card db-card">
			<div class="card-header">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" data-target-canvas="canvas1" href="#">Daily Attendance</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-target-canvas="canvas2" href="#">Attendance Report</a>
					</li>
				</ul>
			</div>
			<div class="card-body dbc-body">
				<div class="canvas-container" id="canvas1">
					<canvas class="full_height" id="barChart"></canvas>
				</div>
				<div class="canvas-container" id="canvas2">
					<div class="text-right" id="dashboard-search">
						<?php echo $this->Form->create(); ?>
						<input name="search_year_month" id="search_month" type="month" value="<?= date('Y-m'); ?>">
						<?php echo $this->Form->end(); ?>
					</div>
					<canvas class="full_height" id="lineChart"></canvas>
				</div>
			</div>

		</div>
	</div>


</div>
<!-- Attendance Statistics Start-->

<!-- < ?php $this->element('admin/stats'); ?> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
	function openPopup() {
		var popup = document.getElementById("popup");
		var popupContent = document.getElementById("popup-content");
		popupContent.scrollTop = 0;
		popup.style.display = "block";
	}

	function openPopup1() {
		var popup = document.getElementById("popup1");
		var popupContent = document.getElementById("popup-content");
		popupContent.scrollTop = 0;
		popup.style.display = "block";
	}

	function openPopup2() {
		var popup = document.getElementById("popup2");
		var popupContent = document.getElementById("popup-content");
		popupContent.scrollTop = 0;
		popup.style.display = "block";
	}

	function openPopup3() {
		var popup = document.getElementById("popup3");
		var popupContent = document.getElementById("popup-content");
		popupContent.scrollTop = 0;
		popup.style.display = "block";
	}

	function closePopup() {
		var popup = document.getElementById("popup");
		var popupContent = document.getElementById("popup-content");
		popupContent.scrollTop = 0;
		popup.style.display = "none";
	}

	function closePopup1() {
		var popup = document.getElementById("popup1");
		var popupContent = document.getElementById("popup-content");
		popupContent.scrollTop = 0;
		popup.style.display = "none";
	}

	function closePopup2() {
		var popup = document.getElementById("popup2");
		var popupContent = document.getElementById("popup-content");
		popupContent.scrollTop = 0;
		popup.style.display = "none";
	}

	function closePopup3() {
		var popup = document.getElementById("popup3");
		var popupContent = document.getElementById("popup-content");
		popupContent.scrollTop = 0;
		popup.style.display = "none";
	}
</script>

<script>
	// TOP MOST 4 CHARTS SUMMARY
	let chart2;
	// Gender-Summary
	const genPie = document.getElementById('pie-chart');
	var genData = <?= $genderStats; ?>;
	var dataValues = Object.values(genData);
	var dataLabels = Object.keys(genData);

	// Combine labels with values
	var combinedLabels = dataLabels.map(function(label, index) {
		return `${label}: ${dataValues[index]}`;
	});

	new Chart(genPie, {
		type: 'pie',
		data: {
			defaultFontFamily: 'Poppins',
			datasets: [{
				data: dataValues,
				borderWidth: 2,
			}],
			labels: combinedLabels, // Use the combined labels
		},
		options: {
			plugins: {
				legend: {
					position: 'left',
					labels: {
						usePointStyle: true,
						font: {
							size: 10 // Adjust the font size as needed
						}
					}
				}
			},
			maintainAspectRatio: false
		}
	});


	// Religion-Summary
	const relDonut = document.getElementById('doughnut_chart1');
	var relData = <?= $religionCounts; ?>;
	var dataValues = Object.values(relData);
	var dataLabels = Object.keys(relData);

	// Combine labels with values
	var combinedLabels = dataLabels.map(function(label, index) {
		return `${label}: ${dataValues[index]}`;
	});

	new Chart(relDonut, {
		type: 'doughnut',
		data: {
			defaultFontFamily: 'Poppins',
			datasets: [{
				data: dataValues,
				borderWidth: 2,
			}],
			labels: combinedLabels, // Use the combined labels
		},
		options: {
			plugins: {
				legend: {
					position: 'left',
					labels: {
						usePointStyle: true,
						font: {
							size: 10 // Adjust the font size as needed
						}
					}
				}
			},
			maintainAspectRatio: false,
			tooltips: {
				callbacks: {
					label: function(tooltipItem, data) {
						return data.labels[tooltipItem.index]; // Display the combined label
					}
				}
			}
		}
	});




	// Group-Summary
	const grpPol = document.getElementById('polar_chart');
	var polData = <?= $groupCounts; ?>;
	var dataValues = Object.values(polData);
	var dataLabels = Object.keys(polData);

	// Combine labels with values
	var combinedLabels = dataLabels.map(function(label, index) {
		return `${label}: ${dataValues[index]}`;
	});

	new Chart(grpPol, {
		type: 'polarArea',
		data: {
			defaultFontFamily: 'Poppins',
			datasets: [{
				data: dataValues,
				borderWidth: 2,
			}],
			labels: combinedLabels, // Use the combined labels
		},
		options: {
			plugins: {
				legend: {
					position: 'right',
					labels: {
						usePointStyle: true,
						font: {
							size: 10 // Adjust the font size as needed
						}
					}
				}
			},
			maintainAspectRatio: false,
			tooltips: {
				callbacks: {
					label: function(tooltipItem, data) {
						return data.labels[tooltipItem.index]; // Display the combined label
					}
				}
			}
		}
	});




	// Quota-Summary
	const quotPie = document.getElementById('pie-chart2');
	var quotData = <?= $quotaCounts; ?>;
	var dataValues = Object.values(quotData);
	var dataLabels = Object.keys(quotData);

	// Combine labels with values
	var combinedLabels = dataLabels.map(function(label, index) {
		return `${label}: ${dataValues[index]}`;
	});

	new Chart(quotPie, {
		type: 'pie',
		data: {
			defaultFontFamily: 'Poppins',
			datasets: [{
				data: dataValues,
				borderWidth: 2,
			}],
			labels: combinedLabels, // Use the combined labels
		},
		options: {
			plugins: {
				legend: {
					position: 'right',
					labels: {
						usePointStyle: true,
						font: {
							size: 10 // Adjust the font size as needed
						}
					}
				}
			},
			maintainAspectRatio: false,
			tooltips: {
				callbacks: {
					label: function(tooltipItem, data) {
						return data.labels[tooltipItem.index]; // Display the combined label
					}
				}
			}
		}
	});
</script>

<script>
	// TAB SWITCHING and ATTENDANCE SCRIPT
	var ctx2 = document.getElementById('lineChart').getContext('2d');
	var myFunction = function(allDate, ctx2) {
		if (chart2) {
			chart2.destroy(); // Clear previous chart if it exists
		}
		chart2 = new Chart(ctx2, {
			type: 'line',
			data: {
				labels: Object.keys(allDate),
				datasets: [{
					label: 'Monthly Attendance Report',
					data: Object.values(allDate),
					fill: true,
					borderColor: 'rgb(75, 192, 192)',
					tension: 0
				}]
			},
		});
		myFunction(allDate, ctx2);
	};
	$(document).ready(function() {
		$('.canvas-container:not(:first)').hide();
		$('.nav-link').on('click', function(e) {
			e.preventDefault();
			const targetCanvas = $(this).attr('data-target-canvas');
			$('.canvas-container').hide();
			$('#' + targetCanvas).show();

			$('.nav-link').removeClass('active');
			$(this).addClass('active');
		});

		var ctx1 = document.getElementById('barChart').getContext('2d');
		var ctx2 = document.getElementById('lineChart').getContext('2d');

		var clsWise = <?= $classWiseTotal; ?>;
		var clsPresent = <?= $presentPerClass; ?>;

		var data = {
			labels: Object.keys(clsWise),
			datasets: [{
					label: 'Total',
					borderWidth: 2,
					fill: true,
					backgroundColor: '#005069',
					data: Object.values(clsWise),
				},
				{
					label: 'Present',
					borderWidth: 2,
					fill: true,
					backgroundColor: '#4f0036',
					data: Object.values(clsPresent)
				}
			]
		};
		var options = {
			scales: {
				x: {
					beginAtZero: true
				},
				y: {
					beginAtZero: true
				}
			}
		};
		var chart1 = new Chart(ctx1, {
			type: 'bar',
			data: data,
			options: options
		});


		var allDate = <?= $monthlyAttendance; ?>;
		var ctx2 = document.getElementById('lineChart').getContext('2d');
		chart2 = new Chart(ctx2, {
			type: 'line',
			data: {
				labels: Object.keys(allDate),
				datasets: [{
					label: 'Total Present',
					data: Object.values(allDate),
					fill: true,
					borderColor: 'rgb(75, 192, 192)',
					tension: 0
				}]
			},
		});


		$("#search_month").change(function() {

			var search_month = $("#search_month").val();
			$.ajax({
				url: 'admin/getSearchMonth',
				cache: false,
				type: 'GET',
				dataType: 'HTML',
				data: {
					"search_month": search_month,
				},
				success: function(data) {

					var ctx2 = document.getElementById('lineChart').getContext('2d');
					var allDate = data;
					if (chart2) {
						chart2.destroy(); // Clear previous chart if it exists
					}

					var jsonObj = JSON.parse(allDate);
					var datas = Object.values(jsonObj);
					var labels = Object.keys(jsonObj);

					chart2 = new Chart(ctx2, {
						type: 'line',
						data: {
							labels: labels,
							datasets: [{
								label: 'Total Present',
								data: datas,
								fill: true,
								borderColor: 'rgb(75, 192, 192)',
								tension: 0
							}]
						},
					});
				}
			});
		});
	});
</script>
