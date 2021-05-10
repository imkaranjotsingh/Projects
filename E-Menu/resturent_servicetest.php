<?php
error_reporting(0);

$con = mysql_connect('localhost','root','');
mysql_select_db('restrauntdb',$con);

// Insert Query For Send Value To Data Base

if($_REQUEST['act'] == 'Insert_Items') { 
    $Request_id = $_REQUEST['Request_id'];
    $Request_name = $_REQUEST['Request_name'];
    $Request_cuisine = $_REQUEST['Request_cuisine'];
    $Request_category = $_REQUEST['Request_category'];
    $Request_type = $_REQUEST['Request_type'];
    $Request_price = $_REQUEST['Request_price'];

    
$result= mysql_query("INSERT INTO  itemdetails (id, name, cuisine, category, type, price) VALUES ('".$Request_id."','".$Request_name."','".$Request_cuisine."','".$Request_category."','".$Request_type."','".$Request_price."')   ");
    
    if($result){
     $sendvale['AccountCreated'] = "DatasubmittedSuccessfully";
     
        echo json_encode($sendvale);
    }else{
     $sendvale['AccountCreated'] = "DatasubmittedUnSuccessfully";
        echo json_encode($sendvale);
    }

}

if($_REQUEST['act'] == 'Send_Order') { 
    $Request_tableNumber= $_REQUEST['Request_tableNumber'];
    $Request_orderDetails= $_REQUEST['Request_orderDetails'];
    $Request_orderAmount= $_REQUEST['Request_orderAmount'];
    $Request_orderTime= $_REQUEST['Request_orderTime'];
    
    
$result= mysql_query("INSERT INTO `orderspending` (`tableNumber`, `orderDetails`, `orderAmount`, `orderTime`) VALUES('".$Request_tableNumber."','".$Request_orderDetails."','".$Request_orderAmount."','".$Request_orderTime."')   ");
    
    if($result){
     $sendvale['AccountCreated'] = "DatasubmittedSuccessfully";
        echo json_encode($sendvale);
		     		echo json_encode($result);

    }else{
     $sendvale['AccountCreated'] = "DatasubmittedUnSuccessfully";
        echo json_encode($sendvale);
     		echo json_encode($result);
			

    }

}

if($_REQUEST['act'] == 'Delete_Items') { 
    $Request_id = $_REQUEST['Request_id'];
    
$result= mysql_query("DELETE FROM itemdetails WHERE id='$Request_id'");
    echo json_encode($result);
    if($result){
     $sendvale['isDeleted'] = "Yes";  
        echo json_encode($sendvale);
    }else{
     $sendvale['isDeleted'] = "No";
        echo json_encode($sendvale);
    }

}

if($_REQUEST['act'] == 'Delete_Items_Order') { 

    $Request_id = $_REQUEST['Request_id'];
    
$result= mysql_query("DELETE FROM orderspending WHERE orderid='$Request_id'");
    echo json_encode($result);
    if($result){
     $sendvale['isDeleted'] = "Yes";  
        echo json_encode($sendvale);
    }else{
     $sendvale['isDeleted'] = "No";
        echo json_encode($sendvale);
    }

}

if($_REQUEST['act'] == 'Search_Items') { 
    //echo json_encode($result);
	   $Request_id = $_REQUEST['Request_id'];
    
$result= mysql_query("Select * FROM itemdetails WHERE id='$Request_id'");
    //echo json_encode($result);
    if($result){
     $sendvale['isFound'] = "Yes"; 
			$row=mysql_fetch_array($result); 
	     $result=array("id"=>$row['id'],"name"=>$row['name'],"cuisine"=>$row['cuisine'],"category"=>$row['category'],"type"=>$row['type'],"price"=>$row['price']);
        echo json_encode($sendvale+$result);
		//echo json_encode();
    }else{
     $sendvale['isFound'] = "No";
        echo json_encode($sendvale);
    }

}

if($_REQUEST['act'] == 'Get_Order_Lis11t') {
      $flag=0;
    
    $result = mysql_query("Select * from `orderspending`");
    
    if(mysql_num_rows($result) > 0){
         $row = mysql_fetch_array($result);
$result=array("tableNumber"=>$row['tableNumber'],"orderDetails"=>$row['orderDetails'],"orderAmount"=>$row['orderAmount'],"orderTime"=>$row['orderTime']);
    echo json_encode($result);
if($result)
{   echo json_encode(array("result"=>"success","data"=>$arr));
        $result=array("result"=>"failure");
        echo json_encode($result);
}
else
{
    echo json_encode(array("result"=>"success","data"=>$arr));
}

}
}

if($_REQUEST['act'] == 'Get_Order_List') {
    $flag=0;
    $result = mysql_query("Select * from orderspending");
    if(mysql_num_rows($result) > 0){
		$i=0;
		while($row = mysql_fetch_assoc($result)){
		$row=array("orderid"=>$row['orderid'],"tableNumber"=>$row['tableNumber'],"orderDetails"=>$row['orderDetails'],"orderAmount"=>$row['orderAmount'],"orderTime"=>$row['orderTime']);
		$json[$i] = $row;
		$i++;
	 }
echo json_encode($json);
   /* $row = mysql_fetch_array($result);
         
$arr=array();
$i=0;

foreach($row as $i => $arr)
{
	$result=array("id"=>$row['id'],"name"=>$row['name'],"cuisine"=>$row['cuisine'],"category"=>$row['category'],"type"=>$row['type'],"price"=>$row['price']);
	//echo json_encode($result);
	$arr[$i]=$result;
	$flag=1;
}/*
$rows = array();
while($row = mysql_fetch_array($result)) {
$rows[] = $row;
echo json_encode(array("result"=>"success","data"=>$rows));*/

/*if($flag==0)
{
        $result=array("result"=>"failure");
        echo json_encode($arr);
}
else
{
    echo json_encode(array("result"=>"success","data"=>$arr));
}
*/
}

	}
	
if($_REQUEST['act'] == 'View_data') {
    $result = mysql_query("Select * from itemdetails");
    if(mysql_num_rows($result) > 0){
		$i=0;
		while($row = mysql_fetch_assoc($result)){
		$row = array("id"=>$row['id'],"name"=>$row['name'],"cuisine"=>$row['cuisine'],"category"=>$row['category'],"type"=>$row['type'],"price"=>$row['price']);
		$json[$i] = $row;
		$i++;
	 }
	echo json_encode($json);}
	}
	
if($_REQUEST['act'] == 'Data_Selection') {
    $flag=0;
    $category   = $_REQUEST['Request_category'];
    $result = mysql_query("Select * from itemdetails where category='".$category."' ");
    if(mysql_num_rows($result) > 0){
		$i=0;
		while($row = mysql_fetch_assoc($result)){
		$row = array("id"=>$row['id'],"name"=>$row['name'],"cuisine"=>$row['cuisine'],"category"=>$row['category'],"type"=>$row['type'],"price"=>$row['price']);
		$json[$i] = $row;
		$i++;
	 }
echo json_encode($json);

   /* $row = mysql_fetch_array($result);
         
$arr=array();
$i=0;

foreach($row as $i => $arr)
{
	$result=array("id"=>$row['id'],"name"=>$row['name'],"cuisine"=>$row['cuisine'],"category"=>$row['category'],"type"=>$row['type'],"price"=>$row['price']);
	//echo json_encode($result);
	$arr[$i]=$result;
	$flag=1;
}/*
$rows = array();
while($row = mysql_fetch_array($result)) {
$rows[] = $row;
echo json_encode(array("result"=>"success","data"=>$rows));*/

/*if($flag==0)
{
        $result=array("result"=>"failure");
        echo json_encode($arr);
}
else
{
    echo json_encode(array("result"=>"success","data"=>$arr));
}
*/
}

	}

if($_REQUEST['act'] == 'Select_UserName'){
    $Request_Adharcardno = $_REQUEST['Request_Adharcardno'];
    $Request_Password = $_REQUEST['Request_Password']; 
    $query="Select * from mytable where Adharcardno='$Request_Adharcardno' and Password='$Request_Password'";
    $chk=mysql_query($query);
        
    while($row=mysql_fetch_array($chk))
    {
		
        $res=array("result"=>"Valid Username and Password");
        echo json_encode($res);
    }
    if($flag==0)
    {
        $res=array("result"=>"InValid Username and Password");
        echo json_encode($res);
    }
}

if($_REQUEST['act'] == 'Update_Item') {
    $flag=0;

    $Request_id= $_REQUEST['Request_id'];   
    $Request_name = $_REQUEST['Request_name'];
    $Request_cuisine = $_REQUEST['Request_cuisine'];
    $Request_category = $_REQUEST['Request_category'];
    $Request_type = $_REQUEST['Request_type'];
    $Request_price = $_REQUEST['Request_price'];
    $result = mysql_query("Select * from itemdetails where id='".$Request_id."'");
    
    if(mysql_num_rows($result) > 0){
         //$row = mysql_fetch_array($result);
         
$arr=array();
$i=0;
while($row=mysql_fetch_array($result))
{
    $result=array("id"=>$row['id'],"name"=>$row['name'],"cuisine"=>$row['cuisine'],"category"=>$row['category'],"type"=>$row['type'],"price"=>$row['price']);
    //echo json_encode($result);
    $arr[$i]=$result;
    $i++;
    $flag=1;
}
}
if($flag==0)
{
        $result=array("result"=>"failure");
        echo json_encode($result);
}
else
{
    echo json_encode(array("result"=>"success","data"=>$arr));
    $result=null;
    $result = mysql_query("UPDATE itemdetails SET name='".$Request_name."',cuisine='".$Request_cuisine."',category='".$Request_category."',type='".$Request_type."',price='".$Request_price."'  WHERE id='".$Request_id."'");
    if($result){
    $sendval['isDataUpdated']="YES";
    echo json_encode($sendval);
}
else
{
   $sendval['isDataUpdated']="NO";
    echo json_encode($sendval);
}
}
}

if($_REQUEST['act'] == 'User_ChangePassword') {
    
    $Request_OldPassword= $_REQUEST['Request_Password'];
    $Request_NewPassword= $_REQUEST['Request_NewPassword'];
    $result = mysql_query("UPDATE mytable SET Password='$Request_NewPassword' WHERE Password='$Request_OldPassword'");
    if($result){
     $sendvale['ChangePassword'] = "Changed";
     
        echo json_encode($sendvale);
    }else{
     $sendvale['ChangePassword'] = "NotChanged";
        echo json_encode($sendvale);
    }
}

if($_REQUEST['act'] == 'User_InsertComplaint') { 
    $Request_Complaintno = $_REQUEST['Request_Complaintno'];
    $Request_Name = $_REQUEST['Request_Name'];
    $Request_Adharcardno = $_REQUEST['Request_Adharcardno'];
    $Request_Contactno = $_REQUEST['Request_Contactno'];
    $Request_Issue = $_REQUEST['Request_Issue'];
    $Request_Address = $_REQUEST['Request_Address'];
    $Request_Pincode = $_REQUEST['Request_Pincode'];
    $Request_Nps = $_REQUEST['Request_Nps'];


    
$result= mysql_query("INSERT INTO  complaint_tb (Complaintno,Name,Adharcardno,Contactno,Issue,Address,Pincode,Nps) VALUES ('".$Request_Complaintno."','".$Request_Name."','".$Request_Adharcardno."','".$Request_Contactno."','".$Request_Issue."','".$Request_Address."','".$Request_Pincode."','".$Request_Nps."')");
    if($result){
     $sendvale['AccountCreated'] = "ComplaintsubmittedSuccessfully";
        echo json_encode($sendvale);
    }else{
     $sendvale['AccountCreated'] = "ComplaintsubmittedUnSuccessfully";
        echo json_encode($sendvale);
    }

}

if($_REQUEST['act'] == 'Complaint_Info_Selection') {
    $flag=0;

    $Request_Adharcardno= $_REQUEST['Request_Adharcardno'];
    $Request_Complaintno=$_REQUEST['Request_Complaintno']; 
    
    $result = mysql_query("Select * from  complaint_tb where Adharcardno='".$Request_Adharcardno."' and  Complaintno='".$Request_Complaintno."' ");
    
    if(mysql_num_rows($result) > 0){
        // $row = mysql_fetch_array($result);
     
$arr=array();
$i=0;
while($row=mysql_fetch_array($result))
{
    $result=array("Complaintno"=>$row['Complaintno'],"Name"=>$row['Name'],"Adharcardno"=>$row['Adharcardno'],"Contactno "=>$row['Contactno'],"Issue"=>$row['Issue'],"Address"=>$row['Address'],"Pincode"=>$row['Pincode'],"Nps"=>$row['Nps'],"Status"=>$row['Status']);
    //echo json_encode($result);5
    $arr[$i]=$result;
    $i++;
    $flag=1;
}
}
if($flag==0)
{
        $result=array("result"=>"failure");
        echo json_encode($result);
}
else
{
    echo json_encode(array("result"=>"success","data"=>$arr));
}
}

if($_REQUEST['act'] == 'checkConnection') {
    $result = mysql_query("Select * from itemdetails");
   
	if($result){
		
        $res["result"]="connected";
        echo json_encode($res);
	}
		else{
			
        $res["result"]="failed";
        echo json_encode($res);
	 }
}

?>