<?php
	session_start();
	require 'php/config.php';
	include "Email.php";

	// Add products into the cart table
	if (isset($_POST['pid'])) {
		$pid = $_POST['pid'];
		$pname = $_POST['pname'];
		$pprice = $_POST['pprice'];
		$pimage = $_POST['pimage'];
		$pqty = $_POST['pqty'];
		$psize = $_POST['psize'];
		$total_price = $pprice * $pqty;

	  $stmt = $link->prepare('SELECT id FROM cartcust WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $id = $r['id'] ?? '';

	  if (!$id) {
	    $query = $link->prepare('INSERT INTO cartcust (itemName,itemPrice,itemImg,itemQtty, size,total_price) VALUES (?,?,?,?,?,?)');
	    $query->bind_param('sssiss',$pname,$pprice,$pimage,$pqty,$psize,$total_price);
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
	  $stmt = $link->prepare('SELECT * FROM cartcust');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $link->prepare('DELETE FROM cartcust WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $link->prepare('DELETE FROM cartcust');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
		var_dump($_POST);
		$qty = $_POST['qty'];
		$pid = $_POST['prodid'];
		$pprice = $_POST['pprice'];
  
		$tprice = $qty * $pprice;
  
		$stmt = $link->prepare('UPDATE cartcust SET itemQtty=?, total_price=? WHERE id=?');
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
	  $size = $_POST['size'];
	  $data = '';

	  $stmt = $link->prepare('INSERT INTO `order` (name,email,phone,address,pmode,products,amount_paid,size)VALUES(?,?,?,?,?,?,?,?)');
	  $stmt->bind_param('ssssssss',$name,$email,$phone,$address,$pmode,$products,$grand_total,$size);
	  $stmt->execute();
	  $stmt2 = $link->prepare('DELETE FROM cartcust');
	  $stmt2->execute();

	 
	  $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
								<h4 class="bg-danger text-light rounded p-2">Items Size : ' . $size . '</h4>
								<h4>Customer Name : ' . $name . '</h4>
								<h4>Customer E-mail : ' . $email . '</h4>
								<h4>Customer Phone : ' . $phone . '</h4>
								<h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
				
								<h4>Payment Mode : ' . $pmode . '</h4>
								<button onclick="window.print()">Print this page</button> <br>
								<a  href="list-Order.php"  Value="List of Orders"> Upload the receipt </a>
						  </div>';
	  echo $data;
	  $emailer = new Email();
	  $subject = "Order Confirmation Customer";
	  $body = $data;
	  $emailer->send($email, $name, $subject, $body);

	}
	
?>