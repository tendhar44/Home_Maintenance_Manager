<div class="container">
    <br><br>
    <h3>Add New Member</h3>
    <hr>
    <br>
    <form action="" method="post">
        User Name:<span class="reqAsk">*</span><br> <input type="text" name="username" required><br><br>
        <input type="hidden" name="groupid" value="<?php echo $data['gId']; ?>">
        <input type="submit" value="ADD">
    </form>

    <div>
        <br><br><br><br>
        <span class="reqAsk">*</span> = required
    </div>
</div>