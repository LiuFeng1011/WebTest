<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>test</title>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	</head>

	<style>
		div{
			border : 1px solid black;
			margin : 10px 20px 30px 40px;
		}
	</style>

	<script type="text/javascript">  
	function test(){
	    $.post("view.php", {},function(data)
	    {
	        $("#value").html(data);
	    });
	}

	</script>

	<body>
		<div>
			div1
		</div>

		<div>
			<p id="value"></p>
		</div><!-- /.main-content -->

		<div>
			div2
		</div>

		<div>
			<button type="button" onclick="javascript:test();"> show </button>
		</div>
	</body>
</html>

