<meta charset="utf-8">
<link rel="stylesheet" href="./css.css">
<title>home</title>
			<?php $page="productForm";include 'navbar.php'; include 'functionsIsaac.php';?>
<body>
    
<form action="productForm.php" method="POST" enctype="multipart/form-data">
<p> Name: <input type="text" name="name" value='' id='name'></p>
<p> Description: <input type="text" name="description" ></p>
<p> Price: <input type="text" name="price" ></p>
<p> Image: <input type="file"  name="fileToUpload" id="fileToUpload"> </p>
<p> Category: 
<?php
	$connection = new mysqli("localhost", "cst170","381953","ICS199Group07_dev");
	
	if($connection -> connect_error){
		die("Connection failed: ". $connection ->connect_error);
	}
	$query =$connection->query("SELECT * FROM CATEGORIES");
	while($dataCat = $query->fetch_assoc()){ 
		
		echo "<input type='checkbox' name=".$dataCat["cat_id"].">".$dataCat["cat_name"]." </input>";

		}
?>
</p>
<input type="submit" value="submit" id="submit1" />
</form>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="productForm.js"></script>

<?php

//getting input
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_POST['fileToUpload'];
$errors[] = array();

//checking for input. Size will be zero if the submit button HASNT been clicked
if (sizeOf($_POST) > 0){
	
	//Checking name
        $validName = checkNameProdEntry($name);
	if ( gettype($validName) === "string"){
		//name is invalid
                
		array_push ($errors, 'Invalid Name '.$validName);
	}

	//Checking description
	if ( ! checkDescripProdEntry($description)){
		//description is invalid
		array_push ($errors, 'Description too long');
	}

	//Checking price
        $validPrice = checkPriceProdEntry($price);
	if ( gettype($validPrice) === "string"){
		//price is invalid
		array_push ($errors, 'Invalid Price: '.$validPrice);
	}
	
	if ( $_FILES['fileToUpload']['error']== 0) {
            
		$imageValid = checkImage();
               
		if (!empty($imageValid)){
			
			foreach($imageValid as $imageError){
                            array_push($errors, $imageError);
                        }
		}
                
		
	} else {
                //no picture was uploaded
		array_push($errors, 'Please select an image ');
		
	}
        
        if(!checkCategories()){
            array_push ($errors, 'Please select a category');
        }

    if (sizeOf($errors) > 1){
        //errorHandler returns a js alert
            echo errorHandler($errors);
    }
    else{
        
        addProduct();
    }
}


?>
</body>
<?php include 'footer.php';?>
</html>
