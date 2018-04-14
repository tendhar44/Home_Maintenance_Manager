<?php

class GroupManagement {
    private $conn;
    private $valid;

    public function __construct($db_con, $valid) {
        $this->valid = $valid;
        $this->conn = $db_con;
    }

    public function getUser($username){
        //attempt select query execution
        $sql_data = "SELECT userid, usertypeid, username, password, firstname, lastname, email, logdelete FROM users WHERE username = '$username'";

        $userData = $this->conn->query($sql_data);
        //var_dump($userData['username']);

        return $userData->fetch_assoc();
    }

    public function getProperty($propertyname){
        //attempt select query execution
        $sql_data = "SELECT propertyid, ownerid, propertyname, description, address, logdelete FROM properties WHERE propertyname = '$propertyname'";

        $userData = $this->conn->query($sql_data);
        //var_dump($userData['username']);

        return $userData->fetch_assoc();
    }

    public function getUersGroupId(){

        $userid = $_SESSION['userid']; 

        $stmt = "SELECT groupid FROM usergroupbridge 
        WHERE userid = '$userid'";        

        $data = $this->conn->query($stmt);

        while ($row = $data->fetch_assoc()) {
            $counter++;        

    }

    public function setUserGroupProperty($userid){        

        //attempt select query execution
        $sql_data = "SELECT p.propertyid FROM propertygroupbridge pgb 
        INNER JOIN properties p ON p.propertyid = pgb.propertyid 
        INNER JOIN groups
        WHERE p.logDelete != 1 AND pgb.groupid = '$groupId'";

        

        $userData = $this->conn->query($sql_data);

        $counter = 0;
        while ($row = $userData->fetch_assoc()) {
            $counter++;

            $_SESSION['propertyid' . $row['propertyid']] =
            array (
                'id' => $row['propertyid'],
                'groupid' => $row['groupid'],
                'propertyname' => $row['propertyname'],
                'description' => $row['description'],
                'address' => $row['address']
            );


        }

        public function getGroupIdByOwner($ownerid){
            $username = $_SESSION['username'];
            $def = 'default';
            $userdef = $username . $def;
        //attempt select query execution
            $sql_data = "SELECT groupid, groupownerid, groupname FROM groups WHERE groupownerid = '$ownerid' AND groupname = '$userdef'";

            $userData = $this->conn->query($sql_data);
        //var_dump($userData['username']);

            return $userData->fetch_assoc();
        }

        public function addMember() {
            $ownerid = $_SESSION['userid'];
            $user_name = (isset($_POST['username'])) ? $_POST['username'] : '';
        //$group_id = (isset($_POST['groupid'])) ? $_POST['groupid'] : '';

        //$un = mysqli_real_escape_string($this->conn, $user_name);

            $row = $this->getUser($user_name);
            $row2 = $this->getGroupIdByOwner($ownerid);

        //$username = $row['username'];
            $userid = $row['userid'];
            $group_id = $row2['groupid'];

            $sql_data = "INSERT INTO usergroupbridge (userid, groupid) VALUES ('$userid', '$group_id')";

            if ($this->conn->query($sql_data) === true) {
                echo "Successfully added a member!";
            } else {
                echo "We weren't able to add the member. Please try again.";
            }
        }

        public function addNonDefaultMember() {
            $ownerid = $_SESSION['userid'];
            $user_name = (isset($_POST['username'])) ? $_POST['username'] : '';
            $group_id = (isset($_POST['groupid'])) ? $_POST['groupid'] : '';

        //$un = mysqli_real_escape_string($this->conn, $user_name);

            $row = $this->getUser($user_name);
        //$row2 = $this->getGroupIdByOwner($ownerid);

        //$username = $row['username'];
            $userid = $row['userid'];
        //$group_id = $row2['groupid'];

            $sql_data = "INSERT INTO usergroupbridge (userid, groupid) VALUES ('$userid', '$group_id')";

            if ($this->conn->query($sql_data) === true) {
                echo "Successfully added a member!";
            } else {
                echo "We weren't able to add the member. Please try again.";
            }
        }

        public function addProperty() {
            $ownerid = $_SESSION['userid'];
            $property_name = (isset($_POST['propertyname'])) ? $_POST['propertyname'] : '';
            $group_id = (isset($_POST['groupid'])) ? $_POST['groupid'] : '';

            $row = $this->getProperty($property_name);
            $propertyid = $row['propertyid'];
            $userid = $row['userid'];

            $sql_data = "INSERT INTO propertygroupbridge (propertyid, groupid) VALUES ('$propertyid', '$group_id')";

            if ($this->conn->query($sql_data) === true) {
                echo "Successfully added a member!";
            } else {
                echo "We weren't able to add the member. Please try again.";
            }
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
                <a href="/home_maintenance_manager/public/groupcontroller/groupproperties/'. $row['groupownerid'] .'/'. $row['groupid']  .'">
                <button>
                View Properties
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

                <a href="/home_maintenance_manager/public/groupcontroller/update/'. $row['groupid']  .'"><button class="stand-bttn-size">
                Update
                </button></a>
                </div> 

                <div class="col-1">    
                <a href="/home_maintenance_manager/public/groupcontroller/delete/'. $row['groupid']  .'"><button class="stand-bttn-size">
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
    $sql_data = "SELECT u.userid, u.usertypeid, u.username, u.password, u.firstname, u.lastname, u.email, u.logdelete, ugb.groupid, ugb.userid FROM users u INNER JOIN usergroupbridge ugb ON u.userid = ugb.userid WHERE u.logDelete != 1 AND ugb.groupid = '$groupId'";

    $userData = $this->conn->query($sql_data);

    ob_start();
    $counter = 0;
    while ($row = $userData->fetch_assoc()) {
        $counter++;

        $_SESSION['userid' . $row['userid']] =
        array (
            'id' => $row['userid'],
            'groupid' => $row['groupid'],
            'usertype' => $row['usertypeid'],
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
        User ID#: 
        <span style="font-weight:600">
        '
        . $row['userid'] .

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



function getListOfProperties($ownerid, $groupId) {

        //attempt select query execution
    $sql_data = "SELECT p.propertyid, p.ownerid, p.propertyname, p.description, p.address, pgb.groupid, pgb.propertyid FROM properties p INNER JOIN propertygroupbridge pgb ON p.propertyid = pgb.propertyid WHERE p.logDelete != 1 AND pgb.groupid = '$groupId'";

    $userData = $this->conn->query($sql_data);

    ob_start();
    $counter = 0;
    while ($row = $userData->fetch_assoc()) {
        $counter++;

        $_SESSION['propertyid' . $row['propertyid']] =
        array (
            'id' => $row['propertyid'],
            'groupid' => $row['groupid'],
            'ownerid' => $row['ownerid'],
            'propertyname' => $row['propertyname'],
            'description' => $row['description'],
            'address' => $row['address']
        );

        echo '
        <div class="card">
        <div class="card-header" id="headingOne">
        <h5 class="mb-0">
        <!--<a class="collapsed" data-toggle="collapse" data-target="#collapseOne'. $counter .'" aria-expanded="true" aria-controls="collapseOne">-->
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'. $counter .'" aria-expanded="false" aria-controls="collapseTwo">
        ' . $row['propertyname'] . '             
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
        Property ID#: 
        <span style="font-weight:600">
        '
        . $row['propertyid'] .

        '
        </span>
        </div><!-- close col-7 -->

        <div class="col-7">
        Owner ID#: 
        <span style="font-weight:600">
        '
        . $row['ownerid'] .

        '
        </span>
        </div><!-- close col-7 -->

        <div class="col-7">
        Property Name: 
        <span style="font-weight:600">
        '
        . $row['propertyname'] .

        '
        </span>
        </div><!-- close col-7 -->

        <div class="col-7">
        Description: 
        <span style="font-weight:600">
        '
        . $row['description'] .

        '
        </span>
        </div><!-- close col-7 -->

        <div class="col-7">
        Address: 
        <span style="font-weight:600">
        '
        . $row['address'] .

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