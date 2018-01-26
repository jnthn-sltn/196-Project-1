<?php

?>
<!DOCTYPE html>
<html>
	<head>
		<title>AmbiLamp</title>
		<link rel="stylesheet" type="text/css" href="index.css">
		<script src="jscolor.js"></script>		
	</head>
	<body>
		<?php
			include "header.php";
		?>
		<!-- JSCOLOR PICKER -->
		<input type="button" class="jscolor" id="picker" value="EFFFC9">
		<form>
			<input type="text" id="color">
			<input type="submit" value="Set as Default" id="set_default">		
		</form>
		<!-- CHARTS -->
		<div id="charts-container">
			<canvas id="temp-chart" class="chart" height="350" width="550"></canvas>
			<canvas id="sound-chart" class="chart" height="350" width="550"></canvas>
		</div>

		<!-- ABOUT -->
		<div id="about">
			<h1>About</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed purus ipsum, gravida non nulla ac, scelerisque efficitur lectus. Vivamus pellentesque neque ut leo dictum facilisis. Etiam eu nisi turpis. Nulla nisl neque, pharetra ut nisl vel, vehicula cursus risus. Integer dictum semper elit, a dictum lorem varius in. Sed ut ornare dolor. Aliquam porta gravida pellentesque. Vivamus maximus erat neque. Curabitur sit amet hendrerit mauris. Vestibulum pretium, sem eu condimentum auctor, enim ex vulputate nibh, id pretium nunc massa a augue. Suspendisse potenti. Etiam sit amet orci tellus. Donec consectetur mauris at pretium tincidunt.
			</p>
			<p>Praesent et nibh ex. Duis interdum pellentesque ultrices. Sed scelerisque felis imperdiet eros ultricies, facilisis posuere arcu finibus. Nullam accumsan ullamcorper urna. Ut in lorem at sapien tempor facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus at consectetur dolor, id tincidunt eros. Nam mattis ac arcu vitae vehicula.
			</p>
			<p>Cras ornare, quam eget fermentum maximus, ipsum mauris maximus lorem, porta tempus metus ligula a felis. Sed sed vestibulum libero, eget eleifend purus. Aliquam aliquet felis vitae mauris facilisis finibus. Donec lacus ligula, placerat sed ex vitae, condimentum placerat erat. Nam porttitor dolor sit amet mi facilisis porta. Ut ullamcorper accumsan neque, in condimentum eros iaculis accumsan. Donec metus massa, volutpat at arcu non, accumsan bibendum quam. Cras vitae congue nibh. Cras porttitor ante risus, ut faucibus justo accumsan et. Sed porta dui nulla, eget tempus nulla ultrices in. Aenean vel lectus est. Vivamus libero urna, facilisis sed ultrices vel, hendrerit hendrerit ante. Pellentesque eu interdum massa.
			</p>
			<p>Vestibulum blandit euismod libero, sed vulputate magna auctor ut. Fusce libero nisl, sollicitudin nec lectus cursus, luctus porttitor tortor. Nulla ac venenatis neque. Donec iaculis ultrices finibus. Ut posuere ipsum in mi blandit dictum. Fusce et sem sit amet massa venenatis mattis eu ac turpis. Etiam blandit vitae sapien eget scelerisque. In sed tincidunt eros. Curabitur a turpis ante. Maecenas imperdiet velit mauris, vel lacinia nibh interdum ut.
			</p>
			<p>Fusce suscipit venenatis nunc, a egestas nunc cursus at. Vivamus aliquet tempor mauris, sed consectetur leo blandit sed. Praesent nec massa in purus bibendum faucibus. Suspendisse leo ante, consequat ac odio et, aliquam lobortis justo. Vestibulum cursus purus urna, ut imperdiet urna molestie vitae. Quisque imperdiet eget tellus nec posuere. Donec consectetur fringilla nisi quis tincidunt. Pellentesque bibendum, diam volutpat interdum consequat, tellus massa ullamcorper augue, at gravida est velit a neque. Praesent posuere ipsum id nisl varius, eu sagittis orci fermentum. Nulla porta quam diam, et hendrerit enim dictum sit amet. Nullam ornare, turpis vitae feugiat tristique, nibh massa efficitur nulla, vitae tincidunt ligula diam vel quam. Etiam feugiat pulvinar nulla, nec fermentum lacus porta et. Fusce porta sit amet odio sed pretium. Duis accumsan convallis orci ac tempus. Nunc lobortis rhoncus velit, eget fringilla nulla viverra nec. Ut et arcu metus.
			</p>
		</div>
		<script type="text/javascript" src="index.js"></script>
	</body>
</html>
