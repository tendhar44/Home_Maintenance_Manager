<div class="container">
    <br><br>
    <h3>Add New Member</h3>
    <hr>
    <br>
    <form action="" method="post">


        <div class="form-group">
            <label class="control-label col-sm-4" for="memberSelector">User Name</label>
            <div class="col-sm-12">
                <select class="form-control" name="username" id="memberSelector" required=>
                    <?php 
                    if ($data["member"] == null){                        
                        echo '<option value="" disabled selected>There is no member created</option>';
                    }

                    foreach ($data["member"] as $member) {
                        # code...
                    echo '

                    <option value="'. $member .'" selected>'. $member .'</option>

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
