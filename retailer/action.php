<?php
	session_start();
	require 'php/config.php';

	// Add products into the cart table
	if (isset($_POST['pid'])) {
		$pid = $_POST['pid'];
		$pname = $_POST['pname'];
		$pprice = $_POST['pprice'];
		$pimage = $_POST['pimage'];
		$pqty = $_POST['pqty'];
		$total_price = $pprice * $pqty;

	  $stmt = $link->prepare('SELECT id FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $id = $r['id'] ?? '';

	  if (!$id) {
	    $query = $link->prepare('INSERT INTO cart (itemBulkName,itemBulkPrice,itemBulkImg,itemBulkQtty,total_price) VALUES (?,?,?,?,?)');
	    $query->bind_param('sssis',$pname,$pprice,$pimage,$pqty,$total_price);
	    $query->execute();

	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	  } else {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	  }
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $link->prepare('SELECT * FROM cart');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $link->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $link->prepare('DELETE FROM cart');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
		$qty = $_POST['qty'];
		$pid = $_POST['proid'];
		$pprice = $_POST['pprice'];
  
		$tprice = $qty * $pprice;
  
		$stmt = $link->prepare('UPDATE cart SET itemBulkQtty=?, total_price=? WHERE id=?');
		$stmt->bind_param('isi',$qty,$tprice,$pid);
		$stmt->execute();
	  }

	 //Checkout and save customer info in the orders table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {

	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $address = $_POST['address'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];

	
	  $pmode = $_POST['pmode'];
	  $data = '';

	  $stmt = $link->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)VALUES(?,?,?,?,?,?,?)');
	  $stmt->bind_param('sssssss',$name,$email,$phone,$address,$pmode,$products,$grand_total);
	  $stmt->execute();
	  $stmt2 = $link->prepare('DELETE FROM cart');
	  $stmt2->execute();

	  $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
								<h4>Retailer Name : ' . $name . '</h4>
								<h4>Retailer E-mail : ' . $email . '</h4>
								<h4>Retailer Phone : ' . $phone . '</h4>
								<h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
								<h4>Payment Mode : ' . $pmode . '</h4>
								<button onclick="window.print()">Print this page</button> <br>
								<a  href="list-bulk-order.php"  Value="List of Orders"> Upload the receipt </a>
						  </div>';
	  echo $data;
	

	}
	
?>