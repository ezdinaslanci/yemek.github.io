<?php include("includes/a_config.php");?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>
	<script type="text/javascript">
		function anchorClicked(txt) {
			$("#selected").append('<li><a name="'+txt+'" href=\"#\" class=\"selected-list\" onclick="$(this).parent().remove();">'+txt+' <i style="color:red" class=\"fa fa-minus-circle\"></i></a></li>');
		}
		function checkIfExist(txt){
			var list = document.getElementsByClassName("selected-list");
			for(var i = 0; i < list.length; i++)
			{
				if(list[i].getAttribute('name') == txt)
					return true;
			}
			return false;
		}
		function showHint(str) {
			document.getElementById("txtHint").innerHTML = "";
			if (str.length == 0) { 
				document.getElementById("txtHint").innerHTML = "";
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200 && this.responseText != "") {
						var arr = this.responseText.split(',');
						var maxItem = Math.min(5, arr.length);
						for(var i = 0; i < maxItem; i++){
							if(! checkIfExist(arr[i]))
								$("#txtHint").append('<a style="margin:5px;" href=\"#\" class=\"food-list\" onclick="anchorClicked(\''+arr[i]+'\');$(this).remove();">'+arr[i]+' <i style="color:green" class=\"fa fa-plus-circle\"></i></a>');
						}
						if(arr.length > 5)
							$("#txtHint").append("...")
							
					}
				};
				xmlhttp.open("GET", "gethint.php?q=" + str, true);
				xmlhttp.send();
			}
		}
		$(document).ready(function(){
			var element = document.getElementsByClassName('food-list');
			
			
		});
	</script>
	
	
</head>
<body>

<?php include("includes/header.php");?>

<div class="container" id="main-content">
	<h2>Welcome to my website!</h2>
	<form> 
		<div class="row">
			<div class="col-xs-2"><span class="center-span">Ara:</span></div>
			<div class="col-xs-2"><input type="text" onkeyup="showHint(this.value)"></div>
		</div>
		<div class="row">
			<div class="col-xs-2"></div>
			<div class="col-xs-10"><span id="txtHint"></span></p></div>
		</div>
		<div class="row">
			<div class="col-xs-2"></div>
			<div class="col-xs-10"><ul id="selected"></ul></p></div>
		</div>
	</form>
</div>

<?php include("includes/footer.php");?>

</body>
</html>