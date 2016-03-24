<!DOCTYPE html>
<html>
<head>
	<title>Products Listing</title>
</head>
	<style type="text/css">
	*{
		font-family: helvetica;
	}
		#container{
			margin:5% auto;
			width:800px;
			height:600px;
		}
		#top{
			width:800px;
			height:50px;
			border:1px solid silver;
			padding:2%;
		}
		#cont{
			width:800px;
			height:500px;
			border:1px solid silver;
			padding:2%;
		}
		#cart{
			display:inline-block;
			margin-left:500px;
		}
		h3{
			display: inline-block;
		}
		#contTable{
			margin:5%;
		}
		.green{
			color:green;
		}
	</style>
<body>
	<div id="container">
		<div id="top">
		<h3>Products</h3><span id="cart"><a href="/products/cart">Your Cart (<?php echo $this->session->userdata('count'); ?>)</a></span>
		</div>
		<div id="cont">
			<div id="contTable">
			<table>
				<th>
					<tr>
						<td>Description</td>
						<td>Price</td>
						<td>Qty</td>
					</tr>
				</th>
				<?php foreach($products as $value){
					echo "<tr>";
					echo "<form method='post' action='/products/" . str_replace(' ', '', $value['description']) . "'>";
					echo "<td>" . $value['description'] . "</td>";
					echo "<td>" . $value['price'] . "</td>";
					echo "<td><select name='qty'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";
					echo "<td><input type='submit' value='Buy!'></td>";
					echo "</form>";
					echo "</tr>";
				}
				?>
			</table>
			<?php echo "<span class='green'>" . $this->session->userdata('submitted') . "</span>"; ?>
			</div>
		</div>
	</div>
</body>
</html>