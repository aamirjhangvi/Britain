<?php 
$currentDate = date('Y-m-d');

	
$oneMonthBefore = date('Y-m-d', strtotime('-1 month', strtotime($currentDate)));
$oneMonthAfter = date('Y-m-d', strtotime('+1 month', strtotime($currentDate)));
  if (isset($_POST['submit'])) {
	$selected_date_json=$_POST['selected_dates'];
	$select_date = json_decode($selected_date_json);
	
	$conf->delete( HOLIDAYMARK, " compete_date BETWEEN '".$oneMonthBefore."' AND '".$oneMonthAfter."'" );
	// print_r($select_date);
	
	foreach ($select_date as $key => $data) {
		$dateconvert=explode('/',$data);
		
		$db_format_date = date("Y-m-d", strtotime($data));
		$data_post = array(
			'date' => $dateconvert[1], 'month' => $dateconvert[0], 'year' => $dateconvert[2],  'compete_date' => $db_format_date,  'user_id' => $_SESSION['user_reg'], 'created_at' => $cDateTime
		  );
		  $recodes = $conf->insert($data_post, HOLIDAYMARK);
		# code...
	}
	if ($recodes == true) {
		$success = "Data <strong>Insert</strong> Successfully";
		//$gen->redirecttime( 'class', '2000' );
  
	  }
	
  }
  
  $sql = "SELECT compete_date FROM ".HOLIDAYMARK." WHERE compete_date BETWEEN '".$oneMonthBefore."' AND '".$oneMonthAfter."'";
  $results = $conf->QueryRun($sql);
 $dates=array();
 if(!empty($results)){
	foreach($results as $res){
		$dates[]=$res->compete_date;
	}
	
 }

 $holiday_mark_json = json_encode($dates);





?>


<div class="content">

<div class="container">

  <div class="row">
	<div class="col-lg-12"><?php include('includes/messages.php') ?>

	  <div class="card card-primary card-outline">
		<div class="card-body">
		 

			<div class="card-body">
			<div id="mdp-demo"></div>
			<form method="post" action="">
				<div class="text-center mt-2 p-3">
				<input type="hidden" name="selected_dates" id="selected-dates-input" value="">
				<input type="submit" name="submit" value="Save" class="btn btn-warning " >

				
				</div>
			</form>
				
		</div>
	  </div>
	</div>
  </div>
</div><!-- /.container-fluid -->

</div>