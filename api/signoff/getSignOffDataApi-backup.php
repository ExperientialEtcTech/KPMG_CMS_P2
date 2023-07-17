<?php

include_once('../../jwt/jwtAccess.php');
include('../db.php');
date_default_timezone_set("Asia/Kolkata");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods: POST");

$base_dir = "../../uploads";
$res_dir = "https://kpmg.experientialetc.com/uploads";

if(!(empty($_POST['event_id']))){
	
    $event_id = $_POST['event_id'];  
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	
	$sqlOrg = "SELECT OrganizationName FROM BookingDetails WHERE BookingId = ?";
	$params = array(&$event_id);
	$stmt = sqlsrv_prepare($conn, $sqlOrg, $params, $options);
	if($stmt){
		if(sqlsrv_execute($stmt)){
			if(sqlsrv_num_rows($stmt)>0){
				$rows = sqlsrv_fetch_array($stmt);
				$OrganizationName = $rows['OrganizationName'];
				//print_r($OrganizationName);
			}else{
				$OrganizationName = "";
			}
		}else{
			$OrganizationName = "";
		}
	}
	
	$signoffMessage['signoffMessage'] = "";
	$signoffMessage['organizationName'] = $OrganizationName;
	$signoffMessage['signoffFooter'] = "";
	
	$sql = "SELECT SignOffText, Signofffooter FROM SignOffTemplate WHERE Status = ?";
	
	$status = 1;

	$params1 = array(&$status);
	$stmt1 = sqlsrv_prepare( $conn, $sql, $params1, $options);
    //Returns - SignOff Msg 
    if($stmt1){
    	if(sqlsrv_execute($stmt1)){
            if(sqlsrv_num_rows($stmt1)>0){
              	while ($row = sqlsrv_fetch_array( $stmt1) ) {
					$signoffMessage['signoffMessage'] = $row['SignOffText'];
					$signoffMessage['organizationName'] = $OrganizationName;
					$signoffMessage['signoffFooter'] = $row['Signofffooter'];
					}
            }
        }
			
    }
	

    //Returns - event Img's url.
    $file_dir = $base_dir."/".$event_id."/media";
	$res_file_dir = $res_dir."/".$event_id."/media";
	$url_list = array();
	
    if(file_exists($file_dir)){
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
		if(empty($url_list)){
			$url_list['status'] = "Failed";
       		$url_list['msg'] = "No event images present";
			//$url_list = "No event images present";
		}
    }else{
        $url_list['status'] = "Failed";
       	$url_list['msg'] = "No event images present";
		//print_r($url_list);
    }

    //Returns -whiteboard scribble and participant Img's url.
    $whiteboard_dir = $file_dir."/"."whiteboard";
	$res_whiteboard_dir = $res_dir."/"."whiteboard";
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
			$temp = 'https://kpmg.experientialetc.com/assets/IdleState/kaleidoscope_2.jpg';
            array_push($whiteboard_imgs, $temp);
		}
    }else{
       	//$whiteboard_imgs = "No whiteboard images present";
		$temp = 'https://kpmg.experientialetc.com/assets/IdleState/kaleidoscope_2.jpg';
        array_push($whiteboard_imgs, $temp); 
    }
	
	//Returnsparticipant Images
	$img_list =array();
	$imgql = "SELECT ParticipantImageUrl FROM VisitorDetails WHERE BookingId=?";
	$params2 = array(&$event_id);
	$stmt3 = sqlsrv_prepare( $conn, $imgql, $params2, $options);
	if($stmt3){
		if(sqlsrv_execute($stmt3)){
			if(sqlsrv_num_rows($stmt3)>0){
				while($row = sqlsrv_fetch_array( $stmt3)){
				$temp = $row['ParticipantImageUrl'];
				array_push($img_list, $temp);
				//print_r($avgValue);	
				}
			}else{
				$img_list['status'] = "Failed";
        		$img_list['msg'] = "No images available";
			}
	
		}
	}else{
        $img_list['status'] = "Failed";
        $img_list['msg'] = "Failed to get images";
    }
	
	
	//Returns avg Feedback
    $feedback_master=array();
	$avgsql = "SELECT ROUND((SUM(CAST(Response AS DECIMAL(10,2)))/COUNT(*)), 2) as avgVal FROM FeedbackResponse WHERE QuestionType=2 AND BookingId=?";
	
	$stmt2 = sqlsrv_prepare( $conn, $avgsql, $params2, $options);
	
	if($stmt2){
		if(sqlsrv_execute($stmt2)){
			if(sqlsrv_num_rows($stmt2)>0){
				$row = sqlsrv_fetch_array( $stmt2);
				// $temp=array("avgValue"=>$avgValue);
				// array_push($feedback_master, $temp);
				$avgValue = $row['avgVal'];
				$feedback_master = round($avgValue,2);
				//print_r($avgValue);	
			}else{
				$feedback_master['status'] = "Failed";
        		$feedback_master['msg'] = "No feedback available";
    		}
			
			if($avgValue == 0){
				$feedback_master['status'] = "Failed";
        		$feedback_master['msg'] = "No feedback available";
			}
		}
	}else{
        $feedback_master['status'] = "Failed";
       	$feedback_master['msg'] = "Failed to get feedback";
    }


	response($signoffMessage, $url_list, $whiteboard_imgs, $img_list, $feedback_master);
	
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