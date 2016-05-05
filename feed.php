<?php 
	$con = mysqli_connect("mysql8.000webhost.com", "a6414938_CS330", "COSC330", "a6414938_Movies"); 
	//Getting the page number which is to be displayed  
	$page = $_GET['page'];	
	
	//Initially we show the data from 1st row that means the 0th row 
	$start = 0; 
	
	//Limit is 3 that means we will show 3 items at once
	$limit = 3; 
	


	//Counting the total item available in the database 
	$total = mysqli_num_rows(mysqli_query($con, "SELECT movie_id from all_movies "));
	
	//We can go atmost to page number total/limit
	$page_limit = $total/$limit; 
	
	//If the page number is more than the limit we cannot show anything 
	if($page<=$page_limit){
		
		//Calculating start for every given page number 
		$start = ($page - 1) * $limit; 
		
		//SQL query to fetch data of a range 
		$sql = "SELECT * from movies limit $start, $limit";

		//Getting result 
		$result = mysqli_query($con,$sql); 
		
		//Adding results to an array 
		$res = array(); 

		while($row = mysqli_fetch_array($result)){
			array_push($res, array(
				"title"=>$row['title'],
				"year"=>$row['year'],
				"image"=>$row['image'])
				);
		}
		//Displaying the array in json format 
		echo json_encode($res);
	}else{
            echo "over";
    }