<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>
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
	</style>
<body>
	<div id="container">
		<div id="top">
		<h3>Check Out</h3><span id="cart"><a href="/products/cart">Your Cart (<?php echo $this->session->userdata('count'); ?>)</a></span>
		</div>
		<div id="cont">
			<div id="contTable">
			<table>
				<th>
					<tr>
						<td>Quantity</td>
						<td>Price</td>
						<td>Description</td>
					</tr>
				</th>
				<?php
				$total = 0;
				$cartArr = $this->session->userdata('cart');
				foreach ($cartArr as $value){
					echo "<tr><td>" . $value['qty'] . "</td>";
					echo "<td>" . $value['price'] . "</td>";
					$total += $value['price'];
					echo "<td>" . $value['description'] . "</td>";
					echo "<td><form method='post' action='/products/CartDel'><input type='submit' value='Delete'></form></td></tr>";
				}
				$cartArrB = $this->session->userdata('cartB');
				foreach ($cartArrB as $value){
					echo "<tr><td>" . $value['qty'] . "</td>";
					echo "<td>" . $value['price'] . "</td>";
					$total += $value['price'];
					echo "<td>" . $value['description'] . "</td>";
					echo "<td><form method='post' action='/products/CartDelB'><input type='submit' value='Delete'></form></td></tr>";
				}
				?>
			<?php echo "<tr><td>Total: </td><td>" . $total . "</td></tr>"; ?>
			</div>
			</table>
			<a href="/products/index">Products</a>
			<form method="post" action="/products/ordered">
			<h3>Billing Info</h3>
			<p>Name:<input type="text"></p>
			<p>Address:<input type="address"></p>
			<p>Card #:<input type="card"></p>
			<input type="submit" value="Order!">
			<?php echo "<p>" . $this->session->userdata('ordered') . "</p>"; ?>
			</form>
			</div>
		</div>
	</div>
</body>
</html>