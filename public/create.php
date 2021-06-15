<?php

/**
 * Creating new entries in each of the tables 
 * Insertion into associative tables is done automically through
 * related table insertion 
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) { // submit button selected 
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
  // attempt to make a connection 
  try  {
    $connection = new PDO($dsn, $username, $password);
    $new = null; // array that will hold values 

    /* ********** INSERT INTO VOLUNTEER TABLE ********** */ 
    if (isset($_POST['volunteerfname'])) { // volunteer information has been entered 
      // retrieving corresponding program ID 
      $progqry = "SELECT PROGRAMID AS pid FROM PROGRAM WHERE PROGRAMNAME = '{$_POST['programname']}'"; 
      $progresult = $connection->query($progqry); 
      $progrow = $progresult->fetch(PDO::FETCH_ASSOC); 
      $programid = $progrow['pid']; 
      // retrieving corresponding site ID 
      $siteqry = "SELECT SITEID AS sid FROM SITE WHERE SITENAME = '{$_POST['sitename']}'";
      $siteresult = $connection->query($siteqry); 
      $siterow = $siteresult->fetch(PDO::FETCH_ASSOC); 
      $siteid = $siterow['sid']; 
      // values that were entered into the form 
      $new = array(
        "volunteerfname" => $_POST['volunteerfname'],
        "volunteerlname" => $_POST['volunteerlname'],
        "volunteeryear" => $_POST['volunteeryear'],
        "volunteerphone" => $_POST['volunteerphone'], 
        "volunteeremail" => $_POST['volunteeremail'],
        "programid" => $programid, // derived value
        "siteid" => $siteid // derived value 
      ); 
      // inserting into the table 
      $sql = sprintf("INSERT IGNORE INTO %s (%s) values (%s)", "volunteer", implode(", ", array_keys($new)), ":" . implode(", :", array_keys($new)));
      $statement = $connection->prepare($sql);
      $statement->execute($new); // executing the script 
    } 

    /* ********** INSERT INTO DIRECTOR TABLE ********** */ 
    else if (isset($_POST['directorfname'])) { // director information has been entered 
      // retrieving corresponding program ID 
      $progqry = "SELECT PROGRAMID AS pid FROM PROGRAM WHERE PROGRAMNAME = '{$_POST['programname']}'"; 
      $progresult = $connection->query($progqry); 
      $progrow = $progresult->fetch(PDO::FETCH_ASSOC); 
      $programid = $progrow['pid']; 
      // retrieving corresponding site ID 
      $siteqry = "SELECT SITEID AS sid FROM SITE WHERE SITENAME = '{$_POST['sitename']}'";
      $siteresult = $connection->query($siteqry); 
      $siterow = $siteresult->fetch(PDO::FETCH_ASSOC); 
      $siteid = $siterow['sid']; 
      // retrieving corresponding administrator ID 
      $adminqry = "SELECT ADMINISTRATORID AS adminid FROM ADMINISTRATOR WHERE ADMINISTRATORNAME = '{$_POST['administratorname']}'"; 
      $adminresult = $connection->query($adminqry); 
      $adminrow = $adminresult->fetch(PDO::FETCH_ASSOC); 
      $administratorid = $adminrow['adminid']; 
      // values that were entered into the form 
      $new = array(
        "directorfname" => $_POST['directorfname'],
        "directorlname" => $_POST['directorlname'],
        "directorphone" => $_POST['directorphone'],
        "directoryear" => $_POST['directoryear'], 
        "directoremail" => $_POST['directoremail'],
        "programid" => $programid, 
        "siteid" => $siteid, 
        "administratorid" => $administratorid
      ); 
      // inserting into the table
      $sql = sprintf("INSERT IGNORE INTO %s (%s) values (%s)", "director", implode(", ", array_keys($new)), ":" . implode(", :", array_keys($new)));
      $statement = $connection->prepare($sql);
      $statement->execute($new); // executing the script
      /* 
      REQUIRED FOR ASSOCIATIVE TABLE 
      */ 
      // retrieving the corresponding director ID 
      $directqry = "SELECT DIRECTORID AS directid FROM DIRECTOR WHERE DIRECTOREMAIL = '{$_POST['directoremail']}'"; 
      $directresult = $connection->query($directqry); 
      $directrow = $directresult->fetch(PDO::FETCH_ASSOC); 
      $directorid = $directrow['directid']; 
      // corresponding IDs for associative table 
      $assoc = array(
        "directorid" => $directorid, 
        "administratorid" => $administratorid
      ); 
      // inserting into the associative table       
      $sqlassoc = sprintf("INSERT IGNORE INTO %s (%s) values (%s)", "administration", implode(", ", array_keys($assoc)), ":" . implode(", :", array_keys($assoc))); 
      $statementassoc = $connection->prepare($sqlassoc);
      $statementassoc->execute($assoc); // executing the script 
    } 

    /* ********** INSERT INTO THE INSTRUCTOR TABLE ********** */ 
    else if (isset($_POST['instructorname'])) { 
      $siteqry = "SELECT SITEID AS sid FROM SITE WHERE SITENAME = '{$_POST['sitename']}'";
      $siteresult = $connection->query($siteqry); 
      $siterow = $siteresult->fetch(PDO::FETCH_ASSOC); 
      $siteid = $siterow['sid']; 
      // values that were entered into the form
      $new = array(
        "instructorname" => $_POST['instructorname'],
        "instructorphone" => $_POST['instructorphone'],
        "instructoremail" => $_POST['instructoremail'],
        "siteid" => $siteid
      ); 
      // inserting into the table
      $sql = sprintf("INSERT IGNORE INTO %s (%s) values (%s)", "instructor", implode(", ", array_keys($new)), ":" . implode(", :", array_keys($new)));
      $statement = $connection->prepare($sql);
      $statement->execute($new); // executing the script
    } 

    /* ********** INSERT INTO THE MANAGER TABLE ********** */ 
    else if (isset($_POST['managerfname'])) { 
      $progqry = "SELECT PROGRAMID AS pid FROM PROGRAM WHERE PROGRAMNAME = '{$_POST['programname']}'"; 
      $progresult = $connection->query($progqry); 
      $progrow = $progresult->fetch(PDO::FETCH_ASSOC); 
      $programid = $progrow['pid']; 

      $adminqry = "SELECT ADMINISTRATORID AS adminid FROM ADMINISTRATOR WHERE ADMINISTRATORNAME = '{$_POST['administratorname']}'"; 
      $adminresult = $connection->query($adminqry); 
      $adminrow = $adminresult->fetch(PDO::FETCH_ASSOC); 
      $administratorid = $adminrow['adminid']; 
      // values that were entered into the form
      $new = array(
        "managerfname" => $_POST['managerfname'],
        "managerlname" => $_POST['managerlname'],
        "managerphone" => $_POST['managerphone'],
        "manageremail" => $_POST['manageremail'],
        "programid" => $programid,
        "administratorid" => $administratorid
      ); 
      // inserting into the table
      $sql = sprintf("INSERT IGNORE INTO %s (%s) values (%s)", "manager", implode(", ", array_keys($new)), ":" . implode(", :", array_keys($new)));
      $statement = $connection->prepare($sql);
      $statement->execute($new); // executing the script
      /* 
      REQUIRED FOR ASSOCIATIVE TABLE 
      */ 
      // retrieving the corresponding manager ID 
      $managerqry = "SELECT MANAGERID AS managid FROM MANAGER WHERE MANAGEREMAIL = '{$_POST['manageremail']}'"; 
      $managresult = $connection->query($managerqry); 
      $managrow = $managresult->fetch(PDO::FETCH_ASSOC); 
      $managerid = $managrow['managid']; 
      // corresponding IDs for associative table 
      $assoc = array(
        "managerid" => $managerid, 
        "administratorid" => $administratorid
      ); 
      // inserting into the associative table       
      $sqlassoc = sprintf("INSERT IGNORE INTO %s (%s) values (%s)", "management", implode(", ", array_keys($assoc)), ":" . implode(", :", array_keys($assoc))); 
      $statementassoc = $connection->prepare($sqlassoc);
      $statementassoc->execute($assoc); // executing the script
    } 

    /* ********** INSERT INTO THE ADMINISTRATOR TABLE ********** */ 
    else if (isset($_POST['administratorname'])) { 
      // values that were entered into the form
      $new = array(
        "administratorname" => $_POST['administratorname'],
        "administratoremail" => $_POST['administratoremail'],
        "administratorphone" => $_POST['administratorphone']
      ); 
      // inserting into the table
      $sql = sprintf("INSERT IGNORE INTO %s (%s) values (%s)", "administrator", implode(", ", array_keys($new)), ":" . implode(", :", array_keys($new)));
      $statement = $connection->prepare($sql);
      $statement->execute($new); // executing the script
    } 

    /* ********** INSERT INTO THE SITE TABLE ********** */ 
    else if (isset($_POST['sitename'])) { 
      // values that were entered into the form
      $new = array(
        "sitename" => $_POST['sitename'],
        "sitestreet" => $_POST['sitestreet'],
        "sitecity" => $_POST['sitecity'],
        "sitestate" => $_POST['sitestate'], 
        "sitezip" => $_POST['sitezip'],
        "sitephone" => $_POST['sitephone']
      );
      // inserting into the table
      $sql = sprintf("INSERT IGNORE INTO %s (%s) values (%s)", "site", implode(", ", array_keys($new)), ":" . implode(", :", array_keys($new)));
      $statement = $connection->prepare($sql);
      $statement->execute($new); // executing the script
    } 

    /* ********** INSERT INTO THE PROGRAM TABLE ********** */ 
    else if (isset($_POST['programname'])) { 
      // values that were entered into the form
      $new = array(
        "programname" => $_POST['programname'],
      );
      // inserting into the table
      $sql = sprintf("INSERT IGNORE INTO %s (%s) values (%s)", "program", implode(", ", array_keys($new)), ":" . implode(", :", array_keys($new)));
      $statement = $connection->prepare($sql);
      $statement->execute($new); // executing the script
    } 

    echo "<script>alert('Successfully registered!');</script>"; 
  } 
  catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
    echo "<script>alert('There was an error with your registration. Please check your input values!');</script>";
  }
}
?>
<?php require "templates/header.php"; ?>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script type="text/JavaScript"> 
  /*
  This function handles the radio buttons.
  Specifically, how the buttons display content when selected.
  */
    $(document).ready(function(){
      $('input[type="radio"]').click(function(){
          var inputValue = $(this).attr("value");
          var targetBox = $("." + inputValue);
          $(".box").not(targetBox).hide();
          $(targetBox).show();
      });
    });
  </script> 

  <div class="radio-toolbar" style="text-align:center"> 
    <input type="radio" name="select" id="siteselect" value="Site" checked="checked"/>
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

  <div class="Site box"> 
    <form method="post" id="mysite">
      <h2>Register a Site</h2>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
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
      <input type="text" name="sitephone" id="sitephone"> <br>
      <input class="standardbutton" type="submit" name="submit" value="Submit">
    </form>
  </div> 

  <div class="Program box" style="display:none"> 
    <form method="post" id="myprogram">
      <h2>Register a Program</h2>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="programname">Program Name</label>
      <input type="text" name="programname" id="programname"> <br>
      <input class="standardbutton" type="submit" name="submit" value="Submit">
    </form>
  </div> 

  <div class="Volunteer box" style="display:none"> 
    <form method="post" id="myvolunteer">
      <h2>Register a Volunteer</h2>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
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
      <input type="text" name="sitename" id="sitename"> <br>
      <input class="standardbutton" type="submit" name="submit" value="Submit">
    </form>
  </div> 

  <div class="Director box" style="display:none"> 
    <form method="post" id="mydirector">
      <h2>Register a Director</h2>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="directorfname">First Name</label>
      <input type="text" name="directorfname" id="directorfname">
      <label for="directorlname">Last Name</label>
      <input type="text" name="directorlname" id="directorlname">
      <label for="directorphone">Phone</label>
      <input type="text" name="directorphone" id="directorphone">
      <label for="directoryear">Year</label>
      <input type="text" name="directoryear" id="directoryear">
      <label for="directoremail">Email</label>
      <input type="text" name="directoremail" id="directoremail">
      <label for="programname">Program Name</label>
      <input type="text" name="programname" id="programname">
      <label for="sitename">Site Name</label>
      <input type="text" name="sitename" id="sitename"> 
      <label for="administratorname">Administrator Name</label>
      <input type="text" name="administratorname" id="administratorname"> <br> 
      <input class="standardbutton" type="submit" name="submit" value="Submit">
    </form>
  </div> 

  <div class="Instructor box" style="display:none"> 
    <form method="post" id="myinstructor">
      <h2>Register an Instructor</h2>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="instructorname">Name</label>
      <input type="text" name="instructorname" id="instructorname">
      <label for="instructorphone">Phone</label>
      <input type="text" name="instructorphone" id="instructorphone">
      <label for="instructoremail">Email</label>
      <input type="text" name="instructoremail" id="instructoremail">
      <label for="sitename">Site Name</label>
      <input type="text" name="sitename" id="sitename"> <br>
      <input class="standardbutton" type="submit" name="submit" value="Submit">
    </form>
  </div> 

  <div class="Administrator box" style="display:none"> 
    <form method="post" id="myadministrator">
      <h2>Register an Administrator</h2>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="administratorname">Name</label>
      <input type="text" name="administratorname" id="administratorname">
      <label for="administratoremail">Email</label>
      <input type="text" name="administratoremail" id="administratoremail">
      <label for="administratorphone">Phone</label>
      <input type="text" name="administratorphone" id="administratorphone"> <br>
      <input class="standardbutton" type="submit" name="submit" value="Submit">
    </form>
  </div> 
  
  <div class="Manager box" style="display:none"> 
    <form method="post" id="mymanager">
      <h2>Register a Manager</h2>
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="managerfname">First Name</label>
      <input type="text" name="managerfname" id="managerfname">
      <label for="managerlname">Last Name</label>
      <input type="text" name="managerlname" id="managerlname">
      <label for="manageremail">Email</label>
      <input type="text" name="manageremail" id="manageremail">
      <label for="managerphone">Phone</label>
      <input type="text" name="managerphone" id="managerphone">
      <label for="programname">Program Name</label>
      <input type="text" name="programname" id="programname"> 
      <label for="administratorname">Administrator Name</label>
      <input type="text" name="administratorname" id="administratorname"> <br> 
      <input class="standardbutton" type="submit" name="submit" value="Submit">
    </form>
  </div> 

<a href="index.php" style="font-family: 'Helvetica'">Back to home</a>

<?php require "templates/footer.php"; ?>

