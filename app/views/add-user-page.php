<div class="container">
    <h3>Create A User for <?php echo $_SESSION['username']; ?></h3>
    <hr>
    <br>
    <form id="addUserForm" action="" method="post">
        <table>
            <tr>
                <td>User Type:&nbsp;<span class="reqAsk">*</span></td>
                <td>
                    <select name="usertype">
                        <option value="2">Manager</option>
                        <option value="3">Limited User</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Username:&nbsp;<span class="reqAsk">*</span></td>
                <td><input type="text" name="username" required></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>First Name:&nbsp;</td>
                <td><input type="text" name="firstname"></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Last Name:&nbsp;</td>
                <td><input type="text" name="lastname"></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Email:&nbsp;<span class="reqAsk">*</span></td>
                <td><input type="text" name="email" required></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Password:&nbsp;<span class="reqAsk">*</span></td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>Confirm Password:&nbsp;<span class="reqAsk">*</span></td>
                <td><input type="password" name="passwordConfirm" required></td>
            </tr>
            <tr>
                <td><input type="hidden" name="ownerid" value="<?php echo $data['useId']; ?>"></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td><input type="submit" value="Submit"></td>
            </tr>
        </table>
    </form>

    <div>
        <br><br><br><br>
        <span class="reqAsk">*</span> = required
    </div>
</div>