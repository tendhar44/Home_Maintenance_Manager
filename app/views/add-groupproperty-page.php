<div class="container">
    <br><br>
    <h3>Add New Property</h3>
    <hr>
    <br>
    <form action="" method="post">


        <div class="form-group">
            <label class="control-label col-sm-4" for="propertySelector">Property Name</label>
            <div class="col-sm-12">
                <select class="form-control" name="propertyname" id="propertySelector" required=>
                    <?php 
                    if ($data["propertiesName"] == null){                        
                        echo '<option value="" disabled selected>There is no property created</option>';
                    }

                    foreach ($data["propertiesName"] as $property) {
                        # code...
                        echo '

                        <option value="'. $property .'" selected>'. $property .'</option>

                        ';

                    }

                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <input type="hidden" name="groupid" value="<?php echo $data['gId']; ?>">
            <input class="btn btn-md btn-secondary" type="submit" value="ADD">
        </div>
    </form>
</div>