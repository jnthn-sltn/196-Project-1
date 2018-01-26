<?php
if (isset($_POST['set_default'])) {
	$color_data->insert($_POST['color']);
   }
   /* BEGIN LED CODE */
   /********************************************************
   * Use the LED schematic in Challenge 2, LED Circuit
   * to complete these constructor lines.
   ********************************************************/
   $red = new GPIO(22, "out",4);
   $green = new GPIO(27, "out",3);
   $blue = new GPIO(17, "out",1);
   $colorArray = $color.str_split();
   /*********************************************************
   * Our colors are in hexadecimal - that is, come in the
   * form #------ where each dash is a character in the set
   * {0 1 2 3 4 5 6 7 8 9 a b c d e f}, which is the number
   * system in base 16. The RGB LED accepts values 0-255 for
   * each of the three colors. Conveniently, 255 is the
   * largest decimal value of two hexademical digits. That
   * is, #FF = (15 * 16^1) + (15 * 16^0) = 255. Thus, in a
   * hex color such as #BAD94D, the red PWM value is
   * respresented by #BA, green by #D9, and blue by #4D.
   * The str_split() function above turns our color string
   * into an array of characters (e.g. [B, A, D, 9, 4, D])
   * and we pwm_write() red with the decimal value of #BA in
   * the line below. Follow this reasoning to complete the
   * pwm_write()inputs for green and blue.
   ********************************************************/
   $red->pwm_write(hexdec($colorArray[0].$colorArray[1]));
   $green->pwm_write(hexdec($colorArray[2].$colorArray[3]));
   $blue->pwm_write(hexdec($colorArray[4].$colorArray[5]));
   /* END LED CODE */
?>
<!DOCTYPE html>
<html>
	<head>
		<title>AmbiLamp - Home</title>
		<link rel="stylesheet" type="text/css" href="assets/css/index.css">
		<script src="assets/js/jscolor.js"></script>		
	</head>
	<body>
		<?php
			include "GPIO.php";
			include "header.php";

			$color = "EFFFC9";
			if (isset($_POST['set_color'])){
				$color = $_POST['color'];
			}
		?>
		<!-- JSCOLOR PICKER -->
		<input type="button" class="jscolor" id="picker" onchange="update(this.jscolor)" onfocusout="apply()" value=<?php echo "'" . $color . "'"; ?>>
		<form method="POST">
			<input type="text" id="color" name="color">
			<input type="submit" id="smt" name="set_color" hidden>
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
		<script type="text/javascript" src="assets/js/index.js"></script>
	</body>
</html>
