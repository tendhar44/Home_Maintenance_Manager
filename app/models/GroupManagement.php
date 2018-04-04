<?php

class GroupManagement {
    private $conn;
    private $valid;

    public function __construct($db_con, $valid) {
        $this->valid = $valid;
        $this->conn = $db_con;
    }

    public function addGroup() {
        $owner_id = (isset($_POST['ownerid'])) ? $_POST['ownerid'] : '';
        $group_name = (isset($_POST['groupname'])) ? $_POST['groupname'] : '';

        $gn = mysqli_real_escape_string($this->conn, $group_name);
        $oid = mysqli_real_escape_string($this->conn, $owner_id);

        if($this->valid->checkGroupName($gn)) {
            $sql_data = "INSERT INTO groups (groupownerid, groupname) VALUES ('$oid', '$gn')";

            if ($this->conn->query($sql_data) === true) {
                echo "Successfully added a group!";
            } else {
                echo "We weren't able to add the group. Please try again.";
            }
        }else {
            echo "The group name should be unique.";
        }
    }


    public function getGroup($name) {
        //attempt select query execution
        $sql_data = "SELECT * FROM groups WHERE groupname = '$name'";

        $userData = $this->conn->query($sql_data);

        return $userData->fetch_assoc();
    }

    public function updateGroup($id, $originalGroName) {
        $groupName = (isset($_POST['groupname'])) ? $_POST['groupname'] : '';

        $gn = mysqli_real_escape_string($this->conn, $groupName);
        $groNameFlag = false;

        //if name is altered, check if name is unique
        if($originalGroName != $gn){
            //if name is unique, precede to update, if not don't update.
            if($this->valid->checkGroupName($gn)) {
                $groNameFlag = true;
            }
            //name wasn't altered, so precede to update.
        }else {
            $groNameFlag = true;
        }

        //if flag is true, precede with update
        if($groNameFlag){
            // attempt insert query execution
            $sql_data = "UPDATE groups SET groupname='$gn' WHERE groupid = '$id'";

            if ($this->conn->query($sql_data) === true) {
                $_SESSION[$groupName] = $groupName;
                echo "Successfully updated the group!";
            } else {
                echo "We weren't able to update the group. Please try again.";
            }
        }else {
            echo "The group name should be unique.";
        }
    }

    public function deleteGroup($id) {
        // attempt insert query execution
        //$sql_data = "DELETE FROM properties WHERE propertyid = '$id'";
        $sql_data = "UPDATE groups SET logDelete = '1' WHERE groupid = '$id'";

        if($this->conn->query($sql_data) === true) {
            echo "Successfully deleted the group!";
        } else {
            echo "We weren't able to delete the group. Please try again.";
        }
    }



    public function getListOfGroups($userid) {
        $this->ownerid = $userid;

        //attempt select query execution
        $sql_data = "SELECT groupid, groupownerid, groupname FROM groups WHERE groupownerid = '$userid' AND logDelete != 1";

        $userData = $this->conn->query($sql_data);

        ob_start();
        $counter = 0;
        while ($row = $userData->fetch_assoc()) {
            $counter++;

            //creating a session for listed property
            $_SESSION['groupid' . $row['groupid']] =
                array (
                    'id' => $row['groupid'],
                    'ownerid' => $row['groupownerid'],
                    'name' => $row['groupname']
                );

            // var_dump($_SESSION['propertyid' . $row['propertyid']]);

            //display list of properties that can be collapse and un-collapse.
            echo '
      <div class="card">
      <div class="card-header" id="headingOne">
      <h5 class="mb-0">
      <!--<a class="collapsed" data-toggle="collapse" data-target="#collapseOne'. $counter .'" aria-expanded="true" aria-controls="collapseOne">-->
      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $counter .'" aria-expanded="false" aria-controls="collapseTwo">
      ' . $row['groupname'] . '             
      </span></a>
      </h5>
      </div><!-- close card-header -->

      <!--<div id="collapseOne'. $counter .'" class="collapse show" aria-labelledby="headingOne" data-parent="#list-appliance">-->
      <div id="collapseTwo'. $counter .'" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="card-body">
      <div class="container-fluid">

      <div class="col-3">

      </div><!-- close col-3 -->

      <div class="col-7">
      Group ID#: 
      <span style="font-weight:600">
      '
                . $row['groupid'] .

                '
      </span>
      </div><!-- close col-7 -->

      <br>

      <div class="row">
      <div class="col-1">
      <a href="/home_maintenance_manager/public/groupcontroller/groupmembers/'. $row['groupownerid'] .'/'. $row['groupid']  .'">
      <button>
      View Members
      </button></a>
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">

      <a href="/home_maintenance_manager/public/propertycontroller/update/'. $row['groupid']  .'"><button class="stand-bttn-size">
      Update
      </button></a>
      </div> 

      <div class="col-1">    
      <a href="/home_maintenance_manager/public/propertycontroller/delete/'. $row['groupid']  .'"><button class="stand-bttn-size">
      Delete
      </button></a>
      </div>



      </div><!-- close col-6 -->

      </div><!-- close container fluid -->
      </div><!-- close card body -->
      </div><!-- close collapseOne -->
      </div><!-- close card -->
    ';//end echo
        }
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    function getListOfMembers($ownerid, $groupId) {

        //attempt select query execution
        $sql_data = "SELECT m.mluid, m.ownerid, m.usertypeid, m.username, m.password, m.firstname, m.lastname, m.email, m.logdelete, g.groupownerid, g.groupname FROM managerlimitedusers m INNER JOIN groups g ON m.ownerid = g.groupownerid WHERE m.ownerid = '$ownerid' AND m.logDelete != 1 AND g.groupownerid = '$ownerid'";

        $userData = $this->conn->query($sql_data);

        ob_start();
        $counter = 0;
        while ($row = $userData->fetch_assoc()) {
            $counter++;

            $_SESSION['mulid' . $row['mulid']] =
                array (
                    'id' => $row['mulid'],
                    'ownerid' => $row['ownerid'],
                    'usertype' => $row['usertypeid'],
                    'groupname' => $row['groupname'],
                    'username' => $row['username'],
                    'first' => $row['firstname'],
                    'last' => $row['lastname'],
                    'email' => $row['email']
                );

            echo '
      <div class="card">
      <div class="card-header" id="headingOne">
      <h5 class="mb-0">
      <!--<a class="collapsed" data-toggle="collapse" data-target="#collapseOne'. $counter .'" aria-expanded="true" aria-controls="collapseOne">-->
      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $counter .'" aria-expanded="false" aria-controls="collapseTwo">
      ' . $row['username'] . '             
      </span></a>
      </h5>
      </div><!-- close card-header -->

      <!--<div id="collapseOne'. $counter .'" class="collapse show" aria-labelledby="headingOne" data-parent="#list-appliance">-->
      <div id="collapseTwo'. $counter .'" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="card-body">
      <div class="container-fluid">

      <div class="col-3">

      </div><!-- close col-3 -->

      <div class="col-7">
      Property Owner ID#: 
      <span style="font-weight:600">
      '
                . $row['ownerid'] .

                '
      </span>
      </div><!-- close col-7 -->
      
      <div class="col-7">
      User Type ID#: 
      <span style="font-weight:600">
      '
                . $row['usertypeid'] .

                '
      </span>
      </div><!-- close col-7 -->
      
      <div class="col-7">
      Group Name: 
      <span style="font-weight:600">
      '
                . $row['groupname'] .

                '
      </span>
      </div><!-- close col-7 -->
      
      <div class="col-7">
      Username: 
      <span style="font-weight:600">
      '
                . $row['username'] .

                '
      </span>
      </div><!-- close col-7 -->
      
      <div class="col-7">
      First Name: 
      <span style="font-weight:600">
      '
                . $row['firstname'] .

                '
      </span>
      </div><!-- close col-7 -->
      
      <div class="col-7">
      Last Name: 
      <span style="font-weight:600">
      '
                . $row['lastname'] .

                '
      </span>
      </div><!-- close col-7 -->
      
      <div class="col-7">
      Email: 
      <span style="font-weight:600">
      '
                . $row['email'] .

                '
      </span>
      </div><!-- close col-7 -->

      <br>

      <div class="row">

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">
      </div>

      <div class="col-1">

      </div><!-- close col-6 -->

      </div><!-- close container fluid -->
      </div><!-- close card body -->
      </div><!-- close collapseOne -->
      </div><!-- close card -->
    ';//end echo
        }
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

}