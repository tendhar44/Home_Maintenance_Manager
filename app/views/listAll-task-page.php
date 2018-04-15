<?php 

$display = 'none';

if(isset($_SESSION['owner']) && $_SESSION['owner']){
	$display = 'block';
}

?>

<div class="container" id="info">
	<h3>All Tasks</h3>
	<br>
	<div id="listAll-property">    	
		<button id="createTaskButton" type="button" class="btn btn-primary"  style="display:<?php echo $display ?>">Create Task</button>

		<form id="taskForm" class="form-horizontal" action="/home_maintenance_manager/public/taskcontroller/listAll/<?php echo $_SESSION['userid']; ?>" method="post"">

			<div class="form-group">
				<label class="control-label col-sm-4" for="propertyList">Select Property:</label>
				<div class="col-sm-12">
					<select class="form-control" id="propertySelector" required=>
						<option value="" disabled selected>Select Property</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" for="applianceSelector">Select Appliance:</label>
				<div class="col-sm-12">
					<select class="form-control" name="appId" id="applianceSelector" disabled required>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" for="taskName">Task Name:</label>
				<div class="col-sm-12">
					<input class="form-control" name="taskName" id="taskName" placeholder="Enter Task Name" required>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" for="taskDue">Task Due Date:</label>
				<div class="col-sm-12">
					<input type="date" class="form-control" name="taskDue" id="taskDue" required>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4">Repeat Task:</label>
				<div class="col-sm-12">
					<input type="radio" name="repeatTask" value="1">&nbsp; Yes &nbsp; &nbsp;
					<input type="radio" name="repeatTask" value="0" checked="checked">&nbsp; No
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" for="intervalDay">Interval Days:</label>
				<div class="col-sm-12">
					<input type="number" class="form-control" name="intervalDay" id="intervalDay">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" for="taskReminder">Reminder Date:</label>
				<div class="col-sm-12">
					<input type="date" class="form-control" name="taskReminder" id="taskReminder">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" for="reminderInterval">Reminder Interval Days:</label>
				<div class="col-sm-12">
					<input type="number" class="form-control" name="reminderInterval" id="reminderInterval">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-4" for="taskDes">Description:</label>
				<div class="col-sm-12">
					<textarea name="taskDes" class="form-control" id="taskDes"></textarea>
				</div>
			</div>

			<input type="hidden" name="taskComplete" value="0">
			
			<div class="form-group"> 
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name="addTask" value="AddTask" class="btn btn-default">Submit</button>
				</div>
			</div>
		</form> 



		<?php

		$counter = 0;

		if ($data['taskList'] == null){
			echo '
			<div class="row">
			<div class="col-sm-12">
			<p>
			There is currently no task available 
			</p>
			</div>
			</div>
			';

			return;
		}

		foreach ($data['taskList'] as $task) {
			$counter++;

			echo '
			<div class="card">
			<div class="card-header" id="headingOne">
			<h5 class="mb-0">
			<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $counter .'" aria-expanded="false" aria-controls="collapseTwo">
			' . $task['name'] . '             
			</a>
			</h5>
			</div><!-- close card-header -->
			<div id="collapseTwo'. $counter .'" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
			<div class="card-body">

			<div class="container-fluid">
			<div class="row">
			<div class="col-sm-6">
			<div class="row">

			<p>
			Description: &nbsp;
			<span style="font-weight:600">
			'
			. $task['description'] .
			'
			</span>
			</p>
			</div><!-- close row -->

			<div class="row">
			<p>
			Due Date: &nbsp;
			<span style="font-weight:600">
			'
			. $task['duedate'] .
			'
			</span>
			</p>
			</div><!-- close row -->
			</div><!-- close col -->
			<div class="col-sm-6">';


			if($task['imgs'] != null){
                    // var_dump($data["img"]);

				foreach ($$task['imgs'] as $image) {
					echo '
					<img id="myImg" class="imgPreview" src="/home_maintenance_manager/public/img/' . $image['name'] . '" alt="'. explode( '_', $image["name"] )[1] .'" width="150" height="150">
					';
				}
			}

			echo '
			<!-- The Modal -->
			<div id="myModal" class="modal">

			<!-- The Close Button -->
			<span class="close">&times;</span>

			<!-- Modal Content (The Image) -->
			<img class="modal-content" id="imgEnlarge">

			<!-- Modal Caption (Image Text) -->
			<div id="caption"></div>
			</div>


			</div>
			</div><!-- close row -->


			<div class="row">
			<div class="col">
			<div class="btn-group float-left mt-2">
			<a class="btn btn-secondary btn-md" href="/home_maintenance_manager/public/taskcontroller/task/'. $task['id'] .'">
			<i class="fa fa-flag" aria-hidden="true"></i>Details</a>
			</div>
			</div>';

			if(isset($_SESSION['owner']) && $_SESSION['owner']){

				echo '

				<div class="col">
				<div class="btn-group float-md-right mt-2">

				<form action="#" method="post">
				<input type="hidden" name="taskid" value="'.$task['id'].'">
				<input type="hidden" name="completeStatus" value="1">
				<input type="submit" name="updtateTaskStatus" value="Complete" class="btn btn-md btn-secondary" aria-hidden="true">

				</form>

				<a class="btn btn-md btn-secondary" href="/home_maintenance_manager/public/taskcontroller/update/'. $task['id'] .'">
				<i class="fa fa-flag" aria-hidden="true"></i> Update</a>
				<a class="btn btn-md btn-secondary" href="/home_maintenance_manager/public/taskcontroller/delete/'. $task['id'] .'">
				<i class="fa fa-flag" aria-hidden="true"></i> Delete</a>
				</div>
				</div>


				';
			}
			
			echo '
			</div><!-- close row -->

			</div><!-- close container fluid -->
			</div><!-- close card body -->
			</div><!-- close collapseOne -->
			</div><!-- close card -->
			';
		}

		?>

		<!-- The Modal -->
		<div id="myModal" class="modal">

			<!-- The Close Button -->
			<span class="close">&times;</span>

			<!-- Modal Content (The Image) -->
			<img class="modal-content" id="imgEnlarge">

			<!-- Modal Caption (Image Text) -->
			<div id="caption"></div>
		</div>
		
	</div><!-- close list-property -->
</div><!-- close container -->


<script>
	$(function() {

		var properties = <?= json_encode($data["dropDownData"]) ?>;

		console.log(properties);	
		var $propertySelector = $('#propertySelector');
		var $applianceSelector = $('#applianceSelector');

	// populate property selector.
	for (key in properties) {
		console.log(key);
		$propertySelector.append('<option>' + key + '</option>');
	}

	$('#createTaskButton').on('click', function(){
		$('.form-horizontal').fadeToggle(200);
	});

	// update appliance selector on change value from property selector
	$('#propertySelector').on('change', function(event, value) {
		console.log($(this).val());

		var selectedValue = $(this).val();

		if (selectedValue === 'Select Property') {
			// clear value
			// disable the appliance select
			$applianceSelector.val('select property first').prop('disabled', true);
			return;
		}
		// clear options in appliance selector
		$applianceSelector.empty();

		for (key in properties[selectedValue]) {
			$applianceSelector.append('<option value="' + properties[selectedValue][key] + '">' + key + '</option>');
		}

		$applianceSelector.prop('disabled', false);
	});

});

</script>
