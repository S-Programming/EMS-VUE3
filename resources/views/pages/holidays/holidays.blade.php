<x-backend-layout>
	<!-- Hero -->
	<div class="bg-body-light">
		<div class="content content-full">
			<div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
				<h1 class="flex-sm-fill h3 my-2">
					Holidays
				</h1>
				<nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
					<ol class="breadcrumb breadcrumb-alt">
						<li class="breadcrumb-item">Holidays</li>
						<li class="breadcrumb-item" aria-current="page">
							<a class="link-fx" href="">DataTables</a>
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
	<!-- END Hero -->

	<!-- Page Content -->
	<div class="content">
		<div class="bg-light clearfix">
			<a href="{{route('pdf.attendance.history',['download'=>'pdf'])}}" class="btn btn-success float-right">Download PDF</a>
		</div>
		<!-- Dynamic Table Full Pagination -->
		<div id="holidaylist-section" class="block block-rounded">

			@include('pages.admin._partial._holidays_list_html',['holidays' => $holidays])
		</div>
		<!-- END Dynamic Table Full Pagination -->
	</div>
</x-backend-layout>