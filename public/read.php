<?php

/**
 * This page allows a user to submit queries 
 * The user can search for summary statements by volunteer and program director attributes 
 * Alternatively, the user can retrieve a master-detail report 
 */

require "../config.php";
require "../common.php";

try  {
  // connectinng to the database 
  $connection = new PDO($dsn, $username, $password);
  /**
   * VOLUNTEER PROGRAM NAME SUMMARY QUERY 
   */
  if (isset($_POST['submit1'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    // retrieving prgoram ID 
    $progqry = "SELECT PROGRAMID AS pid FROM PROGRAM WHERE PROGRAMNAME = '{$_POST['programname']}'"; 
    $progresult = $connection->query($progqry); 
    $progrow = $progresult->fetch(PDO::FETCH_ASSOC); 
    $programid = $progrow['pid']; 
    // program name query 
    $sql = "SELECT VOLUNTEERID, VOLUNTEERFNAME, VOLUNTEERLNAME, VOLUNTEERYEAR, VOLUNTEERPHONE, VOLUNTEEREMAIL 
            FROM VOLUNTEER
            WHERE programid = $programid";
    $programname = $_POST['programname'];
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
  }
  /**
   * VOLUNTEER SITE NAME SUMMARY QUERY 
   */
  else if (isset($_POST['submit2'])) { 
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    // retrieving site ID 
    $siteqry = "SELECT SITEID AS sid FROM SITE WHERE SITENAME = '{$_POST['sitename']}'"; 
    $siteresult = $connection->query($siteqry); 
    $siterow = $siteresult->fetch(PDO::FETCH_ASSOC); 
    $siteid = $siterow['sid']; 
    // site name query 
    $sql = "SELECT VOLUNTEERID, VOLUNTEERFNAME, VOLUNTEERLNAME, VOLUNTEERYEAR, VOLUNTEERPHONE, VOLUNTEEREMAIL 
            FROM VOLUNTEER
            WHERE siteid = $siteid";
    $sitename = $_POST['sitename'];
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
  }
  /**
   * VOLUNTEER YEAR SUMMARY QUERY 
   */
  else if (isset($_POST['submit3'])) { 
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    // volunteer year query 
    $sql = "SELECT VOLUNTEERID, VOLUNTEERFNAME, VOLUNTEERLNAME, VOLUNTEERYEAR, VOLUNTEERPHONE, VOLUNTEEREMAIL 
            FROM VOLUNTEER
            WHERE volunteeryear = :volunteeryear";
    $volunteeryear = $_POST['volunteeryear'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':volunteeryear', $volunteeryear, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll();
  }
  /**
   * MASTER DETAIL REPORT QUERY 
   */
  else if (isset($_POST['submit4'])) { // selected the master detail report button 
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    // queries for master detail report 
    $sqlvol = "SELECT * FROM VOLUNTEER";
    $sqlsite = "SELECT * FROM SITE"; 
    $sqlprog = "SELECT * FROM PROGRAM"; 
    $sqladmin = "SELECT * FROM ADMINISTRATOR"; 
    $sqldirector = "SELECT * FROM DIRECTOR"; 
    $sqlinstruct = "SELECT * FROM INSTRUCTOR"; 
    $sqlmanage = "SELECT * FROM MANAGER"; 
    // VOLUNTEER 
    $statement1 = $connection->prepare($sqlvol); 
    $statement1->execute(); 
    $result1 = $statement1->fetchAll(); 
    // SITE 
    $statement2 = $connection->prepare($sqlsite); 
    $statement2->execute(); 
    $result2 = $statement2->fetchAll(); 
    // PROGRAM 
    $statement3 = $connection->prepare($sqlprog); 
    $statement3->execute(); 
    $result3 = $statement3->fetchAll(); 
    // ADMINISTRATOR 
    $statement4 = $connection->prepare($sqladmin); 
    $statement4->execute(); 
    $result4 = $statement4->fetchAll(); 
    // DIRECTOR 
    $statement5 = $connection->prepare($sqldirector); 
    $statement5->execute(); 
    $result5 = $statement5->fetchAll(); 
    // INSTRUCTOR 
    $statement6 = $connection->prepare($sqlinstruct); 
    $statement6->execute(); 
    $result6 = $statement6->fetchAll(); 
    // MANAGER 
    $statement7 = $connection->prepare($sqlmanage); 
    $statement7->execute(); 
    $result7 = $statement7->fetchAll(); 
  }
  /**
   * DIRECTOR PROGRAM NAME SUMMARY QUERY 
   */
  else if (isset($_POST['submit5'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    // retrieving prgoram ID 
    $progqry = "SELECT PROGRAMID AS pid FROM PROGRAM WHERE PROGRAMNAME = '{$_POST['directorprogramname']}'"; 
    $progresult = $connection->query($progqry); 
    $progrow = $progresult->fetch(PDO::FETCH_ASSOC); 
    $programid = $progrow['pid']; 
    // program name query 
    $sql = "SELECT DIRECTORID, DIRECTORFNAME, DIRECTORLNAME, DIRECTORPHONE, DIRECTORYEAR, DIRECTOREMAIL 
            FROM DIRECTOR
            WHERE programid = $programid";
    $programname = $_POST['directorprogramname'];
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
  }
  /**
   * DIRECTOR SITE NAME SUMMARY QUERY 
   */
  else if (isset($_POST['submit6'])) { 
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    // retrieving site ID 
    $siteqry = "SELECT SITEID AS sid FROM SITE WHERE SITENAME = '{$_POST['directorsitename']}'"; 
    $siteresult = $connection->query($siteqry); 
    $siterow = $siteresult->fetch(PDO::FETCH_ASSOC); 
    $siteid = $siterow['sid']; 
    // site name query 
    $sql = "SELECT DIRECTORID, DIRECTORFNAME, DIRECTORLNAME, DIRECTORPHONE, DIRECTORYEAR, DIRECTOREMAIL 
            FROM DIRECTOR
            WHERE siteid = $siteid";
    $sitename = $_POST['directorsitename'];
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
  }
  /**
   * DIRECTOR YEAR SUMMARY QUERY 
   */
  else if (isset($_POST['submit7'])) { 
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    // director year query 
    $sql = "SELECT DIRECTORID, DIRECTORFNAME, DIRECTORLNAME, DIRECTORPHONE, DIRECTORYEAR, DIRECTOREMAIL 
            FROM DIRECTOR
            WHERE directoryear = :directoryear";
    $directoryear = $_POST['directoryear'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':directoryear', $directoryear, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetchAll();
  }
} 
catch(PDOException $error) {
  echo "<script><p style='font-family: Helvetica; font-weight:100;'>No results found!</p></script>";
}
?>

<?php 
/**
 * DISPLAY FEATURES (BUTTONS, HEADERS)
 */
require "templates/header.php"; ?>
<h2>Search Based on Criterion</h2>
<div class="grid-container1"> 
  <!-- volunteer program name -->
  <div class="item8"> 
    <label style="display: flex; justify-content: center;">Search for a Volunteer By the Following</label> 
  </div> 
  <div class="item1" style="display: flex; justify-content: center;"> 
    <form method="post">
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="programname">Volunteer Program Name</label>
      <input type="text" id="programname" name="programname">
      <input type="submit" name="submit1" value="View Results">
    </form>
  </div> 
  <!-- volunteer site name -->
  <div class="item3" style="display: flex; justify-content: center;"> 
    <form method="post">
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="sitename">Volunteer Site Name</label>
      <input type="text" id="sitename" name="sitename">
      <input type="submit" name="submit2" value="View Results">
    </form>
  </div> 
  <!-- volunteer year -->
  <div class="item4" style="display: flex; justify-content: center;"> 
    <form method="post">
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="volunteeryear">Volunteer Year</label>
      <input type="text" id="volunteeryear" name="volunteeryear">
      <input type="submit" name="submit3" value="View Results">
    </form>
  </div> 
  <!-- master detail report -->
  <div class="item2" style="display: flex; justify-content: center;"> 
    <form method="post">
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <!-- <label for="masterdetail">Master Detail Report</label> --> 
      <input class="query" type="submit" name="submit4" value="View Master Detail Report" style="background-color: #ffc82eff; color: black">
    </form>
  </div> 
  <div class="item9"> 
    <label style="display: flex; justify-content: center;">Search for a Program Director By the Following</label> 
  </div> 
  <!-- director program name -->
  <div class="item5" style="display: flex; justify-content: center;"> 
    <form method="post">
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="directorprogramname">Program Director Program Name</label>
      <input type="text" id="directorprogramname" name="directorprogramname">
      <input type="submit" name="submit5" value="View Results">
    </form>
  </div> 
  <!-- director site name -->
  <div class="item6" style="display: flex; justify-content: center;"> 
    <form method="post">
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="directorsitename">Program Director Site Name</label>
      <input type="text" id="directorsitename" name="directorsitename">
      <input type="submit" name="submit6" value="View Results">
    </form>
  </div> 
  <!-- director year -->
  <div class="item7" style="display: flex; justify-content: center;"> 
    <form method="post">
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <label for="directoryear">Program Director Year</label>
      <input type="text" id="directoryear" name="directoryear">
      <input type="submit" name="submit7" value="View Results">
    </form>
  </div> 
</div> 

<?php 
// determining which button was clicked 
// All summary queries FOR VOLUNTEER -- only need one form because they all relate volunteer 
if (isset($_POST['submit1']) || isset($_POST['submit2']) || isset($_POST['submit3'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Year</th>
          <th>Phone</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row[0]); ?></td>
          <td><?php echo escape($row[1]); ?></td>
          <td><?php echo escape($row[2]); ?></td>
          <td><?php echo escape($row[3]); ?></td>
          <td><?php echo escape($row[4]); ?></td>
          <td><?php echo escape($row[5]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote style="font-family: Helvetica; font-weight:100;"> No results found! </blockquote>
    <?php } 
} ?> 

<?php 
// determining which button was clicked 
// All summary queries FOR DIRECTOR -- only need one form because they all relate volunteer 
if (isset($_POST['submit5']) || isset($_POST['submit6']) || isset($_POST['submit7'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Phone</th>
          <th>Year</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row[0]); ?></td>
          <td><?php echo escape($row[1]); ?></td>
          <td><?php echo escape($row[2]); ?></td>
          <td><?php echo escape($row[3]); ?></td>
          <td><?php echo escape($row[4]); ?></td>
          <td><?php echo escape($row[5]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>
      <blockquote style="font-family: Helvetica; font-weight:100;"> No results found! </blockquote>
    <?php } 
} ?> 

<?php 
// Following is required for the master detail report 
if (isset($_POST['submit4'])) { // master detail report button was clicked 
  // volunteer 
  if ($result1 && $statement1->rowCount() > 0) { ?> 
    <h2>Results</h2>
    <table>
      <thead>
        <tr>
          <th>Volunteer ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Year</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Program ID</th>
          <th>Site ID</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result1 as $row) : ?>
        <tr>
          <td><?php echo escape($row[0]); ?></td>
          <td><?php echo escape($row[1]); ?></td>
          <td><?php echo escape($row[2]); ?></td>
          <td><?php echo escape($row[3]); ?></td>
          <td><?php echo escape($row[4]); ?></td>
          <td><?php echo escape($row[5]); ?></td>
          <td><?php echo escape($row[6]); ?></td>
          <td><?php echo escape($row[7]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php } 
  // site 
  if ($result2 && $statement2->rowCount() > 0) { ?>
    <table>
      <thead>
        <tr>
          <th>Site ID</th>
          <th>Name</th>
          <th>Street</th>
          <th>City</th>
          <th>State</th>
          <th>Zip</th>
          <th>Phone</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result2 as $row) : ?>
        <tr>
          <td><?php echo escape($row[0]); ?></td>
          <td><?php echo escape($row[1]); ?></td>
          <td><?php echo escape($row[2]); ?></td>
          <td><?php echo escape($row[3]); ?></td>
          <td><?php echo escape($row[4]); ?></td>
          <td><?php echo escape($row[5]); ?></td>
          <td><?php echo escape($row[6]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php } 
  // program 
  if ($result3 && $statement3->rowCount() > 0) { ?>
    <table>
      <thead>
        <tr>
          <th>Program ID</th>
          <th>Program Name</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result3 as $row) : ?>
        <tr>
          <td><?php echo escape($row[0]); ?></td>
          <td><?php echo escape($row[1]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php } 
  // administrator
  if ($result4 && $statement4->rowCount() > 0) { ?>
    <table>
      <thead>
        <tr>
          <th>Administrator ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result4 as $row) : ?>
        <tr>
          <td><?php echo escape($row[0]); ?></td>
          <td><?php echo escape($row[1]); ?></td>
          <td><?php echo escape($row[2]); ?></td>
          <td><?php echo escape($row[3]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php } 
  // director 
  if ($result5 && $statement5->rowCount() > 0) { ?>
    <table>
      <thead>
        <tr>
          <th>Director ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Phone</th>
          <th>Year</th>
          <th>Email</th>
          <th>Program ID</th>
          <th>Site ID</th>
          <th>Administrator ID</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result5 as $row) : ?>
        <tr>
          <td><?php echo escape($row[0]); ?></td>
          <td><?php echo escape($row[1]); ?></td>
          <td><?php echo escape($row[2]); ?></td>
          <td><?php echo escape($row[3]); ?></td>
          <td><?php echo escape($row[4]); ?></td>
          <td><?php echo escape($row[5]); ?></td>
          <td><?php echo escape($row[6]); ?></td>
          <td><?php echo escape($row[7]); ?></td>
          <td><?php echo escape($row[8]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php } 
  // instructor 
  if ($result6 && $statement6->rowCount() > 0) { ?>
    <table>
      <thead>
        <tr>
          <th>Instructor ID</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result6 as $row) : ?>
        <tr>
          <td><?php echo escape($row[0]); ?></td>
          <td><?php echo escape($row[1]); ?></td>
          <td><?php echo escape($row[2]); ?></td>
          <td><?php echo escape($row[3]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php } 
  // manager 
  if ($result7 && $statement7->rowCount() > 0) { ?>
    <table>
      <thead>
        <tr>
          <th>Manager ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Phone</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($result7 as $row) : ?>
        <tr>
          <td><?php echo escape($row[0]); ?></td>
          <td><?php echo escape($row[1]); ?></td>
          <td><?php echo escape($row[2]); ?></td>
          <td><?php echo escape($row[3]); ?></td>
          <td><?php echo escape($row[4]); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php } else { ?>
      <p style="font-family: 'Helvetica'; font-weight: 100;">No results found!</p>
  <?php } 
} ?> 

<a href="index.php" style="font-family: 'Helvetica'">Back to home</a>

<?php require "templates/footer.php"; ?>