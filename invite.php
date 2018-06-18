<?php
include($_SERVER['DOCUMENT_ROOT'] . '/efs/session.php');
$login_user   = $_SESSION['login_user'];
$actionPath="http://".$_SERVER['SERVER_NAME'].'/efs/resources/api/invitefriend.php';
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <h2 align="center">Invite Form</h2>
        <div class="panel-body">
        <form action=<?php echo "$actionPath";?> method="post" style="width: 50%;margin-left: 27%">

            <div class="input-group control-group after-add-more">
                  <input type="text" name="name[]" class="form-control" placeholder="Enter Name Here" required><br><br>
                  <input type="text" name="phone[]" class="form-control" placeholder="Enter Mobile Number" required>&nbsp
                  <div class="input-group-btn"> 
                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                  </div>
            </div><br>
            <input type="hidden" name="userId" value = "<?= $login_user ?>">
<input type="submit" name="sub" class="form-control" value="Submit" style="width: 50%;margin-left: 20%">
        </form>
        

        <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input,-->
        <div class="copy-fields hide">
            <div class="control-group input-group" style="margin-top:10px;margin-left: 0%">

                <input type="text" name="name[]" class="form-control" placeholder="Enter Name Here" required><br><br>
                <input type="text" name="phone[]" class="form-control" placeholder="Enter Phone Here" required>
                <div class="input-group-btn"> 
                  <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">

    $(document).ready(function() {

    //here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
      $(".add-more").click(function(){ 
          var html = $(".copy-fields").html();
          $(".after-add-more").after(html);
      });
    //here it will remove the current value of the remove button which has been pressed
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>