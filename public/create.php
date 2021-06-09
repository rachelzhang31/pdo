<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $new = null; 

    if (!empty($_POST['siteid'])) { 
      $new = array(
        "siteid" => $_POST['siteid'],
        "sitename" => $_POST['sitename'],
        "sitestreet" => $_POST['sitestreet'],
        "sitecity" => $_POST['sitecity'],
        "sitestate" => $_POST['sitestate'], 
        "sitezip" => $_POST['sitezip'],
        "sitephone" => $_POST['sitephone']
      );
      $sql = sprintf("INSERT INTO %s (%s) values (%s)", "site", implode(", ", array_keys($new)), ":" . implode(", :", array_keys($new)));
    } 
    else if (!empty($_POST['programid'])) { 
      $new = array(
        "programid" => $_POST['programid'],
        "programname" => $_POST['programname'],
      );
      $sql = sprintf("INSERT INTO %s (%s) values (%s)", "program", implode(", ", array_keys($new)), ":" . implode(", :", array_keys($new)));
    } 
    else if (!empty($_POST['volunteerid'])) { 

      $progqry = "SELECT PROGRAMID AS pid FROM PROGRAM WHERE PROGRAMNAME = '{$_POST['programname']}'"; 
      $progresult = $connection->query($progqry); 
      $progrow = $progresult->fetch(PDO::FETCH_ASSOC); 
      $programid = $progrow['pid']; 

      $siteqry = "SELECT SITEID AS sid FROM SITE WHERE SITENAME = '{$_POST['sitename']}'";
      $siteresult = $connection->query($siteqry); 
      $siterow = $siteresult->fetch(PDO::FETCH_ASSOC); 
      $siteid = $siterow['sid']; 

      $new = array(
        "volunteerid" => $_POST['volunteerid'],
        "volunteerfname" => $_POST['volunteerfname'],
        "volunteerlname" => $_POST['volunteerlname'],
        "volunteeryear" => $_POST['volunteeryear'],
        "volunteerphone" => $_POST['volunteerphone'], 
        "volunteeremail" => $_POST['volunteeremail'],
        "programid" => $programid, 
        "siteid" => $siteid
      ); 
      $sql = sprintf("INSERT INTO %s (%s) values (%s)", "volunteer", implode(", ", array_keys($new)), ":" . implode(", :", array_keys($new)));
    } 

    $statement = $connection->prepare($sql);
    $statement->execute($new);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>


  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script type="text/JavaScript"> 
    $(document).ready(function(){
      $('input[type="radio"]').click(function(){
          var inputValue = $(this).attr("value");
          var targetBox = $("." + inputValue);
          $(".box").not(targetBox).hide();
          $(targetBox).show();
      });
    });
  </script> 

  <div class="radio-toolbar"> 
    <input type="radio" name="select" id="siteselect" value="Site" />
      <label for="siteselect">Site</label> 
    <input type="radio" name="select" id="programselect" value="Program" />
      <label for="programselect">Program</label> 
    <input type="radio" name="select" id="volunteerselect" value="Volunteer" />
      <label for="volunteerselect">Volunteer</label> 
    <input type="radio" name="select" id="directorselect" value="Director" />
      <label for="directorselect">Program Director</label> 
    <input type="radio" name="select" id="managerselect" value="Manager" />
      <label for="managerselect">Manager</label> 
    <input type="radio" name="select" id="instructorselect" value="Instructor" />
      <label for="instructorselect">Instructor</label> 
    <input type="radio" name="select" id="adminselect" value="Administrator" />
      <label for="adminselect">Administrator</label> 
  </div> 

  <div class="Site box" style="display:none"> 
    <form method="post" id="mysite">
      <h2>Add a Site</h2>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="siteid">Site ID</label>
      <input type="text" name="siteid" id="siteid">
      <label for="sitename">Site Name</label>
      <input type="text" name="sitename" id="sitename">
      <label for="sitestreet">Site Street</label>
      <input type="text" name="sitestreet" id="sitestreet">
      <label for="sitecity">Site City</label>
      <input type="text" name="sitecity" id="sitecity">
      <label for="sitestate">Site State</label>
      <input type="text" name="sitestate" id="sitestate">
      <label for="sitezip">Site Zip</label>
      <input type="text" name="sitezip" id="sitezip">
      <label for="sitephone">Site Phone</label>
      <input type="text" name="sitephone" id="sitephone">
      <input type="submit" name="submit" value="Submit">
    </form>
  </div> 

  <div class="Program box" style="display:none"> 
    <form method="post" id="myprogram">
      <h2>Add a Program</h2>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="programid">Program ID</label>
      <input type="text" name="programid" id="programid">
      <label for="programname">Program Name</label>
      <input type="text" name="programname" id="programname">
      <input type="submit" name="submit" value="Submit">
    </form>
  </div> 

  <div class="Volunteer box" style="display:none"> 
    <form method="post" id="myvolunteer">
      <h2>Add a Volunteer</h2>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="volunteerid">Volunteer ID</label>
      <input type="text" name="volunteerid" id="volunteerid">
      <label for="volunteerfname">First Name</label>
      <input type="text" name="volunteerfname" id="volunteerfname">
      <label for="volunteerlname">Last Name</label>
      <input type="text" name="volunteerlname" id="volunteerlname">
      <label for="volunteeryear">Year</label>
      <input type="text" name="volunteeryear" id="volunteeryear">
      <label for="volunteerphone">Phone</label>
      <input type="text" name="volunteerphone" id="volunteerphone">
      <label for="volunteeremail">Email</label>
      <input type="text" name="volunteeremail" id="volunteeremail">
      <label for="programname">Program Name</label>
      <input type="text" name="programname" id="programname">
      <label for="sitename">Site Name</label>
      <input type="text" name="sitename" id="sitename">
      <input type="submit" name="submit" value="Submit">
    </form>
  </div> 

  <a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

