<nav id="controlsNavigation" class="buttons">
	<a href="#show" class="button left active">
<!--		<span class="icon icon19"></span>-->
		<span class="label">Просмотр маршрута</span>
	</a>
    <a href="#search" class="button middle">
<!--		<span class="icon icon198"></span>-->
		<span class="label">Поиcк маршрута</span>
	</a>
<!--		<a href="#stops" class="button right">-->
<!--		<span class="icon icon108"></span>-->
<!--		<span class="label">Остановки</span>-->
<!--	</a>-->
</nav>

	<div id="routes_controls">

		<div class="tab show">

			<div class="dropdown">
				<a class="button" href="#">
					<span class="label">Тип маршрута</span>
					<span class="toggle"></span>
				</a>

				<div class="dropdown-slider typeSelect">
					<?php foreach ($allRoutes as $type) :?>
						<a href="#" class="ddm" data-type-id="<?php echo $type->id ?>"><span class="label"><?php echo $type->name ?></span></a>
					<?php endforeach ?>
				</div>
			</div>

			<div class="dropdown">
				<a class="button" href="#">
					<span class="label">Маршрут</span>
					<span class="toggle"></span>
				</a>
				<div class="dropdown-slider routeOptions"></div>
			</div>

			<div class="showStopsCheck">
                <label><input type="checkbox" checked="checked" class="showStopsCheckbox">Показывать остановки</label>
            </div>
		</div>

		<div class="tab search">
			<div class="one-half" style="width: 265px; margin-right: 3%;">
				<label style="float: left;margin: 4px;">От
					<input type="text" id="dirFrom">
				</label>
				<button class="selectFromOnMap"><span class="icon icon10"></span></button>
			</div>

			<div class="one-half" style="width: 265px; margin-right: 3%;">
				<label style="float: left;margin: 4px;">До
					<input type="text" id="dirTo">
				</label>
				<button class="selectToOnMap"><span class="icon icon7"></span></button>
			</div>

			<label style="position: relative;top: 10px;"><input type="checkbox" checked="checked" class="showStopsCheckbox">Показывать остановки</label>
		</div>

		<div class="tab stops">

			<div class="dropdown">
				<a class="button" href="#">
					<span class="label">Тип маршрута</span>
					<span class="toggle"></span>
				</a>

				<div class="dropdown-slider typeSelect">
					<?php foreach ($allRoutes as $type) :?>
						<a href="#" class="ddm" data-type-id="<?php echo $type->id ?>"><span class="label"><?php echo $type->name ?></span></a>
					<?php endforeach ?>
				</div>
			</div>

			<div class="dropdown">
				<a class="button" href="#">
					<span class="label">Маршрут</span>
					<span class="toggle"></span>
				</a>
				<div class="dropdown-slider routeOptions"></div>
			</div>

			<div class="dropdown">
				<a class="button" href="#">
					<span class="label">Остановки</span>
					<span class="toggle"></span>
				</a>
				<div class="dropdown-slider stopOptions"></div>
			</div>

			<div class="" ><label style="position: relative;top: 10px;"><input type="checkbox" checked="checked" class="showStopsCheckbox">Показывать остановки</label></div>

		</div>

	</div>



<script type="text/javascript">

	$(document).ready(function() {
		// Toggle the dropdown menu's
		$(".dropdown .button, .dropdown button").click(function () {
			$(this).parent().find('.dropdown-slider').slideToggle('fast');
			$(this).find('span.toggle').toggleClass('active');
			return false;
		});
	}); // END document.ready

	// Close open dropdown slider/s by clicking elsewhwere on page
	$(document).bind('click', function (e) {
		if (e.target.id != $('.dropdown').attr('class')) {
			$('.dropdown-slider').slideUp();
			$('span.toggle').removeClass('active');
		}
	}); // END document.bind

</script>
