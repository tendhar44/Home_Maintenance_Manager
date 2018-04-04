
<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>

    <br><br>
    <h3>Update Property</h3>
    <hr>
    <br>
    <form action="" method="post">
        Property Name:<br> <input type="text" name="propertyname" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['name'] ?>"><br><br>
        Address:<br> <input type="text" name="address" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['address'] ?>"><br><br>
        Description:<br> <input type="text" name="propertydes" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['description'] ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</div>
