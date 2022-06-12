	<div class="card-4 mb-3" >
		@section('plugins')
			<link rel="stylesheet" href="{{ asset('css/fullcalendar-main.min.css') }}" />
			<script type="text/javascript" src="{{ asset('js/fullcalendar-main.min.js') }}"></script>
		@endsection
		<?php
			$events = [];
		?>
		<script>
			var calendar;
			document.addEventListener('DOMContentLoaded', function() {
				var calendarEl = document.getElementById('calendar');
				calendar = new FullCalendar.Calendar(calendarEl, {
					initialView: 'dayGridMonth',
					headerToolbar: {
						center: 'timeGridWeek,dayGridMonth,listWeek',
						right: 'today,prev,next',
					},
					height: "80vh",
					selectable: true,
					events: <?php echo json_encode($events); ?>,
					eventClick: function(info) {
						var pageUrl = "/sales_tb/view/" + info.event.id;
						var modal = $('#main-page-modal');
						modal.modal({show:true});
						modal.find('.modal-body').html(loadingIndicator).load(pageUrl, function(responseText, status, req){
							if(status == 'error'){
								$(this).html(responseText);
							}
							initPlugins();
						});
					},
				});
				calendar.render();
			});
		</script>
		<div id="calendar"></div>
	</div>
