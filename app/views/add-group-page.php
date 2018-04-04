<div class="container">
    <br><br>
    <h3>Create A Group</h3>
    <hr>
    <br>
    <form action="/Home_Maintenance_Manager/public/groupcontroller/<?php echo $data['uId']; ?>" method="post">
        Group Name:<span class="reqAsk">*</span><br> <input type="text" name="groupname" required><br><br>
        <input type="hidden" name="ownerid" value="<?php echo $data['uId']; ?>">
        <input type="submit" value="Submit">
    </form>

    <div>
        <br><br><br><br>
        <span class="reqAsk">*</span> = required
    </div>
</div>