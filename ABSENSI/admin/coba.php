<!DOCTYPE html>
<html>
	<head>
		<title>Box Shadow</title>
		
		<style>
			.box {
				height: 150px;
				width: 300px;
				margin: 20px;
				border: 1px solid #ccc;
			}
			
			.top {
				box-shadow: 0 -5px 5px -5px #333;
			}
			
			.right {
				box-shadow: -5px 0 5px -5px #333;
			}
			
			.bottom {
				box-shadow: 0 5px 5px -5px #333;
			}
			
			.left {
				box-shadow: 5px 0 5px -5px #333;
			}
			
			.all {
				box-shadow: 0 0 5px #333;
			}
		</style>
	</head>
	<body>
		<div class="box top"></div>
		<div class="box right"></div>
		<div class="box bottom"></div>
		<div class="box left"></div>
		<div class="box all"></div>
	</body>
</html>