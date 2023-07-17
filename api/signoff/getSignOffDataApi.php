<?php
include_once('../../jwt/jwtAccess.php');
include('../db.php');
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

date_default_timezone_set("Asia/Kolkata");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

$base_dir = "../../uploads";
$res_dir = "http://10.188.7.135/uploads";

if(!(empty($_POST['event_id']))){


	
    $event_id = $_POST['event_id']; 

	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	
	//$sqlOrg = "SELECT OrganizationName FROM BookingDetails WHERE BookingId = ?";VisitorWelcomeDetails
	$sqlOrg = "SELECT OrganizationName FROM VisitorWelcomeDetails WHERE BookingId = ?";
	$params = array(&$event_id);
	$stmt = sqlsrv_prepare($conn, $sqlOrg, $params, $options);
	if($stmt){
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				$rows = sqlsrv_fetch_array($stmt);
				$OrganizationName = $rows['OrganizationName'];
				
			}else{
				$OrganizationName = "";
			}
		}else{
			$OrganizationName = "";
		}
	}
	//print_r($OrganizationName);
	$sql = "SELECT SignOffText, Signofffooter FROM SignOffTemplate WHERE Status = ?";
	
	$status = 1;
	$signoffMessage = array();
	$params1 = array(&$status);
	$stmt1 = sqlsrv_prepare( $conn, $sql, $params1, $options);
    //Returns - SignOff Msg 
    if($stmt1){
    	if(sqlsrv_execute($stmt1)){
            if(sqlsrv_num_rows($stmt1)>0){
            
              	while ($row = sqlsrv_fetch_array( $stmt1) ) {
					$signoffMessage['signoffMessage'] = $row['SignOffText'];
					//Added by shubham, to align thank you msg in one line - 10/1
					$signofftext = $row['SignOffText'];
					$signoffMessage['signoffMessage'] = str_replace('orgplaceholder', $OrganizationName, $signofftext);
					//commented and Added by shubham, to align thank you msg in one line - 10/1
					//$signoffMessage['organizationName'] = $OrganizationName;
					$signoffMessage['organizationName'] = "";
					$signoffMessage['signoffFooter'] = $row['Signofffooter'];
					//print_r($row['SignOffText'] );
					if(!strpos($row['SignOffText'], "orgplaceholder")){
						$signoffMessage['organizationName'] = "";
					}

				}
				
            }else{
                //response("False","No entries", NULL);
				$signoffMessage['status'] = "Failed";
       			$signoffMessage['msg'] = "No signoff message present";
            }
        }else{
            //response("False","Failed", NULL);
			$signoffMessage['status'] = "Failed";
       	    $signoffMessage['msg'] = "Failed to get signoff message";
        }
			
    }else{
        response("False","Failed", NULL);
		$signoffMessage['status'] = "Failed";
       	$signoffMessage['msg'] = "Failed to get signoff message";
    }


    //Returns - event Img's url.
    $file_dir = $base_dir."/".$event_id."/media";
	$res_file_dir = $res_dir."/".$event_id."/media";
	$url_list = array();
	
    if(file_exists($file_dir)){
		/*
        $dir = scandir($file_dir);
        foreach($dir as $index => &$item)
        {
            if(is_dir($file_dir. '/' . $item)){
                unset($dir[$index]);
            }else{
				//print_r($dir[$index]);
                //$temp = $file_dir."/".$dir[$index];
				$temp = $res_file_dir."/".$dir[$index];
				array_push($url_list, $temp);
            }
        }
		*/
		//START
		$ignored = array('.', '..', '.svn', '.htaccess');
		$files = array();    
		foreach (scandir($file_dir) as $file ) {
			if (in_array($file, $ignored)) continue;
			$temp = $res_file_dir."/".$file;
			$files[$temp] = filemtime($file_dir . '/' . $file);
		}
		arsort($files);
		$files = array_keys($files);
		$url_list = array_reverse($files);
		//END 
    }

    //Returns -whiteboard scribble and participant Img's url.
    $whiteboard_dir = $base_dir."/".$event_id."/whiteboard";
	$res_whiteboard_dir = $res_dir."/".$event_id."/"."whiteboard";
	//print_r($whiteboard_dir);
    $whiteboard_imgs = array();
    if(file_exists($whiteboard_dir)){
        
        $whiteboard_list = scandir($whiteboard_dir);

        foreach($whiteboard_list as $index => &$item)
        {
            if(is_dir($whiteboard_dir. '/' . $item)){
                unset($whiteboard_list[$index]);
            // }elseif(){

                        
            }else{
                //$temp = $whiteboard_dir."/".$whiteboard_list[$index];
				$temp = $res_whiteboard_dir."/".$whiteboard_list[$index];
                array_push($whiteboard_imgs, $temp);
            }
        }
        // print_r($url_list);
		
		if(empty($whiteboard_imgs)){
			$temp = 'http://10.188.7.135/assets/IdleState/kaleidoscope_2.jpg';
            array_push($whiteboard_imgs, $temp);
		}
    }else{
       	//$whiteboard_imgs = "No whiteboard images present";
		$temp = 'http://10.188.7.135/assets/IdleState/kaleidoscope_2.jpg';
        array_push($whiteboard_imgs, $temp); 
    }
	
	//Returnsparticipant Images
	$img_list =array();

	//$imgql = "SELECT ParticipantImageUrl FROM VisitorWelcomeDetails WHERE BookingId=?";
	$imgql = "SELECT VisitorImage FROM VisitorWelcomeDetails WHERE BookingId=?";

	$params2 = array(&$event_id);
	$stmt3 = sqlsrv_prepare( $conn, $imgql, $params2, $options);

	if($stmt3){	
		if(sqlsrv_execute($stmt3)){
			if(sqlsrv_num_rows($stmt3)>0){
				while($row = sqlsrv_fetch_array( $stmt3)){
				$temp = $row['VisitorImage'];
				array_push($img_list, $temp);
				
				}
			}
	
		}

	}
	//Returns avg Feedback
    $feedback_master=array();
	$avgValue = 0;
	$avgsql = "SELECT CAST(SUM(CAST(Response AS decimal(10, 2)))/COUNT(*) AS decimal(10, 2)) as avgVal FROM FeedbackResponse WHERE QuestionType=2 AND BookingId= ?";
	
	$stmt2 = sqlsrv_prepare( $conn, $avgsql, $params2, $options);
	
	if($stmt2){
		if(sqlsrv_execute($stmt2)){	
			if(sqlsrv_num_rows($stmt2)>0){
				$row = sqlsrv_fetch_array( $stmt2);
				// $temp=array("avgValue"=>$avgValue);
				// array_push($feedback_master, $temp);
				$avgValue = number_format(round($row['avgVal']), 2);
				$feedback_master = $avgValue;
				//print_r($avgValue);	
			}else{
				$feedback_master = $avgValue;
    		}
			/*
			if($avgValue == 0){
				$feedback_master = $avgValue;
			}
			*/
		}
	}else{
      $feedback_master = $avgValue;
    }


	response($signoffMessage, $url_list, $whiteboard_imgs, $img_list, $feedback_master);

	//response($feedback_master);
	
}else{
    response("Failed", "", "", "","missing paramater");
}




function response($signoffMessage, $url_list, $whiteboard_imgs, $img_list,  $feedback_master)
{

	$response['res'] = $signoffMessage;
	$response['file_imgs'] = $url_list;
    $response['whiteboard_imgs'] = $whiteboard_imgs;
	$response['participant_imgs'] = $img_list;
    $response['avgValue'] = $feedback_master;
	$json_response = json_encode($response);
	echo $json_response;
}
?>