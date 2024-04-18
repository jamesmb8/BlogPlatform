<?php


include_once("insertUser.php");


$errorfname = $errorlname = $erroruname = $erroremail = $errorpwd = "";
$allFields = "yes";

if (isset($_POST['submit'])) {
    if ($_POST['fname'] == "") {
        $errorfname = "First name is mandatory";
        $allFields = "no";
    }
    if ($_POST['lname'] == null) {
        $errorlname = "Last name is mandatory";
        $allFields = "no";
    }
    if ($_POST['uname'] == "") {
        $erroruname = "Username is mandatory";
        $allFields = "no";
    }
    if ($_POST['email'] == "") {
        $erroruid = "User ID is mandatory";
        $allFields = "no";
    }
    if ($_POST['pwd'] == "") {
        $errorpwd = "Default password mandatory";
        $allFields = "no";
    }

    
}
?>
<div class="container bgColor">
    <main role="main" class="pb-3">
        <h2>Create New User</h2>
        <div class="row">
            <div class="container>
                <form method="post">
                    <div class="form-group col-md-6">
                        <label class="control-label labelFont">First Name</label>
                        <input class="form-control" type="text" name="fname">
                        <span class="text-danger">
                            <?php echo $errorfname; ?>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label labelFont">Last Name</label>
                        <input class="form-control" type="text" name="lname">
                        <span class="text-danger">
                            <?php echo $errorfname; ?>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label labelFont">User Name</label>
                        <input class="form-control" type="text" name="uname">
                        <span class="text-danger">
                            <?php echo $erroruname; ?>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label labelFont">E-Mail</label>
                        <input class="form-control" type="text" name="email">
                        <span class="text-danger">
                            <?php echo $erroremail; ?>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label labelFont">password</label>
                        <input class="form-control" type="password" name="pwd">
                        <span class="text-danger">
                            <?php echo $errorpwd; ?>
                        </span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label labelFont">Confirm Password</label>
                        <input class="form-control" type="password" name="pwd">
                        <span class="text-danger">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label labelFont">Phone</label>
                        <input class="form-control" type="text" name="phone">
                        <span class="text-danger">
                            <?php echo $errorphone; ?>
                        </span>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <input class="btn btn-pria as2w//asas ary" type="submit" value="Create User" name="submit">
                    </div>
                </form>
            </div>
        </div>
       
    </main>
</div>
<?php include("Footer.php"); ?>