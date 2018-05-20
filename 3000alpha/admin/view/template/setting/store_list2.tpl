{{ header }}{{ column_left }}

<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
		<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

		<div class="heading-elements">
			<div class="heading-btn-group">
				<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
				<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
				<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
			</div>
		</div>
	</div>

	<div class="breadcrumb-line"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
		<ul class="breadcrumb">
			<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ul>

		<ul class="breadcrumb-elements">
			<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-gear position-left"></i>
					Settings
					<span class="caret"></span>
				</a>

				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
					<li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
					<li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
					<li class="divider"></li>
					<li><a href="#"><i class="icon-gear"></i> All settings</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>

<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Flot Chart</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item"><a href="#">Charts</a></li>
							<li class="breadcrumb-item active">Flot Chart</li>
						</ol>
						<div class="box box-block bg-white">
							<div class="row">
								<div class="col-md-6 mb-1 mb-md-0">
									<h5 class="mb-1">Realtime chart</h5>
									<div class="chart-container">
										<div id="realtime" class="chart-placeholder"></div>
									</div>
								</div>
								<div class="col-md-6">
									<h5 class="mb-1">Line chart</h5>
									<div class="chart-container">
										<div id="line" class="chart-placeholder"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="box box-block bg-white">
							<div class="row">
								<div class="col-md-6 mb-1 mb-md-0">
									<h5 class="mb-1">Donut chart</h5>
									<div class="chart-container">
										<div id="donut" class="chart-placeholder"></div>
									</div>
								</div>
								<div class="col-md-6">
									<h5 class="mb-1">Pie chart</h5>
									<div class="chart-container">
										<div id="pie" class="chart-placeholder"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="box box-block bg-white">
							<h5 class="mb-1">Stacked bar chart</h5>
							<div class="chart-container">
								<div id="stacked-bar" class="chart-placeholder"></div>
							</div>
						</div>
					</div>
				</div>
{{ footer }} 