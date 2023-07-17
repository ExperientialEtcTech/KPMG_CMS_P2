<?php 
//include_once('../../jwt/jwtAccess.php');
include('../db.php');
 
 if (isset($_POST["bookingId"]) && $_POST["bookingId"]!="") {

	$BookingId = $_POST['bookingId']; 
	
	$sqlQuery="SELECT * FROM BookingDetails WHERE BookingId = ? AND StatusId = ?";
	$status = 1;
	$params1 = array(&$BookingId, &$status);

	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_prepare( $conn, $sqlQuery, $params1, $options);

	if($stmt){
		if(sqlsrv_execute($stmt))
		{
			if(sqlsrv_num_rows($stmt)>0){  

				while($row = sqlsrv_fetch_array($stmt)){
					$data =  ["title"=>$row['Title'],
                                 "bookingdatetime"=> $row["BookingDateTime"],
                                 "industryId"=> $row["IndustryId"],
                                 "otherIndustry"=> $row["OtherIndustry"],
                                 "isExistingClient"=> $row["IsExistingClient"],
                                 "organizationName"=> $row["OrganizationName"],
                                 "statusId"=> $row["StatusId"],
                                 "isActive"=> $row["IsActive"],
                                 "createdBy"=> $row["CreatedBy"],
                                 "createdOn"=> $row["CreatedOn"],
                                 "modifiedBy"=> $row["ModifiedBy"],
                                 "modifiedOn"=> $row["ModifiedOn"],
                                 "approvedRejectBy"=> $row["ApprovedRejectBy"],
                                 "approvedrejectOn"=> $row["ApprovedRejectOn"],
                                 "adminComments"=> $row["AdminComments"]];
					
                 }
				response("success","successfull",$data);
            }else{
                $data ="";
                 response("failed","No Data Found",$data);
            }
        }else{
            $data ="";
            response("failed","Something goes wrong during query execution",$data); 
        }
    }else{
        $data ="";
        response("failed","Something goes wrong",$data);
    }
}

function response($status,$message,$data){
      $item["status"] = $status;
      $item["message"] = $message;
      $item["data"] = $data;
      echo json_encode($item);
}








?>