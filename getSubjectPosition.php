        <?php
        //your data base connection
		$host='localhost';
		$user='root';
		$password='';
		$dbName='exam_results';
        $conn = mysql_connect($host, $user, $password);
        $db=  mysql_select_db($dbName);
        
        //replace or pick this variables dynamically
        //then pass them to the function
        $admno=$_POST['admno'];       //the exact admision number
        $subject=$_POST['subject']; //the exact column name for the subject
           
        $rank=  getSubJectPosition($admno, $subject);
        //display in the subject  cell in the pdf>> or wherever you want.
        
        //delete below line>> was just for testing
        echo $rank;
        
       
        #function to get the position
        function getSubJectPosition($admno,$subject){
	//we are picking all the values of the $subject column
	$query="SELECT admno, $subject FROM std_exam";
        
	$result= mysql_query($query) or die(mysql_error());
	$subject_array=array();
	//create the associative array
	while($row=mysql_fetch_assoc($result)){
            $subject_array[$row['admno']]=$row[$subject];
	}
	//now sort the associative array in descending order
	arsort($subject_array);
	//print_r($subject_array);
        //rank according to array keys
        $rankedArr = array_keys($subject_array);
        
        //final ranks with only admission number positions
        $finalRanks = array_flip($rankedArr);
        //get the position now
        $subject_position=$finalRanks[$admno]+1;
	//return subject position
	return $subject_position;
	}
        
        
        ?>
