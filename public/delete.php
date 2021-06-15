<?php

/**
 * This page allows a user to delete a Madison House entity 
 * Ensures integrity through reassigning foreign keys 
 * Maintains parent-child relationships when a parent is deleted 
 */

require "../config.php";
require "../common.php";

$success = null;

if (isset($_POST["submit"])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    $connection = new PDO($dsn, $username, $password);
  
    $id = $_POST["submit"];
    $name = $_POST["entityName"];

    if ($name == "PROGRAM") {
      $sql = "UPDATE DIRECTOR SET PROGRAMID = NULL WHERE PROGRAMID = :id;
              UPDATE VOLUNTEER SET PROGRAMID = NULL WHERE PROGRAMID = :id;
              UPDATE MANAGER SET PROGRAMID = NULL WHERE PROGRAMID = :id;
              DELETE FROM PROGRAM WHERE PROGRAMID = :id;";
    }

    else if ($name == "DIRECTOR") {
      $sql = "DELETE FROM ADMINISTRATION WHERE DIRECTORID = :id;
              DELETE FROM DIRECTOR WHERE DIRECTORID = :id;";
    }

    else if ($name == "INSTRUCTOR") {
      $sql = "DELETE FROM INSTRUCTOR WHERE INSTRUCTORID = :id;";
    }

    else if ($name == "VOLUNTEER") {
      $sql = "DELETE FROM VOLUNTEER WHERE VOLUNTEERID = :id;";
    }

    else if ($name == "ADMINISTRATOR") {
      $sql = "DELETE FROM ADMINISTRATION WHERE ADMINISTRATORID = :id;
              DELETE FROM MANAGEMENT WHERE ADMINISTRATORID = :id;
              DELETE FROM ADMINISTRATOR WHERE ADMINISTRATORID = :id;";
    }

    else if ($name == "MANAGER") {
      $sql = "DELETE FROM MANAGEMENT WHERE MANAGERID = :id;
              DELETE FROM MANAGER WHERE MANAGERID = :id;";
    }

    else {
      if ($name == "SITE") {
        $sql = "UPDATE INSTRUCTOR SET SITEID = NULL WHERE SITEID = :id;
                UPDATE VOLUNTEER SET SITEID = NULL WHERE SITEID = :id;
                UPDATE DIRECTOR SET SITEID = NULL WHERE SITEID = :id;
                DELETE FROM SITE WHERE SITEID = :id;";
      }
    }

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "$name successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>

<?php require "templates/header.php"; ?>
<h2>Delete a Member of Madison House</h2>

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

<div class="radio-toolbar" style="text-align:center"> 
<form action ="" method="post">
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
  </form>
</div> 

<div class="Site box">
<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Street</th>
        <th>City</th>
        <th>State</th>
        <th>Zip Code</th>
        <th>Phone</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $connection = new PDO($dsn, $username, $password);
    $sql = "SELECT * FROM SITE";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["SITENAME"]); ?></td>
        <td><?php echo escape($row["SITESTREET"]); ?></td>
        <td><?php echo escape($row["SITECITY"]); ?></td>
        <td><?php echo escape($row["SITESTATE"]); ?></td>
        <td><?php echo escape($row["SITEZIP"]); ?></td>
        <td><?php echo escape($row["SITEPHONE"]); ?> </td>
        <input type=hidden name=entityName value="SITE">
        <td><button type="submit" name="submit" value="<?php echo escape($row["SITEID"]); ?>">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>
</div>

<div class="Program box" style="display:none">
<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <table>
    <thead>
      <tr>
        <th>Name</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $connection = new PDO($dsn, $username, $password);
    $sql = "SELECT * FROM PROGRAM";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["PROGRAMNAME"]); ?></td>
        <input type=hidden name=entityName value="PROGRAM">
        <td><button type="submit" name="submit" value="<?php echo escape($row["PROGRAMID"]); ?>">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>
</div>

<div class="Volunteer box" style="display:none">
<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <table>
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Year</th>
        <th>Phone</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $connection = new PDO($dsn, $username, $password);
    $sql = "SELECT * FROM VOLUNTEER";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["VOLUNTEERFNAME"]); ?></td>
        <td><?php echo escape($row["VOLUNTEERLNAME"]); ?></td>
        <td><?php echo escape($row["VOLUNTEERYEAR"]); ?></td>
        <td><?php echo escape($row["VOLUNTEERPHONE"]); ?></td>
        <td><?php echo escape($row["VOLUNTEEREMAIL"]); ?></td>
        <input type=hidden name=entityName value="VOLUNTEER">
        <td><button type="submit" name="submit" value="<?php echo escape($row["VOLUNTEERID"]); ?>">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>
</div>

<div class="Director box" style="display:none">
<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <table>
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th>Year</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $connection = new PDO($dsn, $username, $password);
    $sql = "SELECT * FROM DIRECTOR";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["DIRECTORFNAME"]); ?></td>
        <td><?php echo escape($row["DIRECTORLNAME"]); ?></td>
        <td><?php echo escape($row["DIRECTORPHONE"]); ?></td>
        <td><?php echo escape($row["DIRECTORYEAR"]); ?></td>
        <td><?php echo escape($row["DIRECTOREMAIL"]); ?></td>
        <input type=hidden name=entityName value="DIRECTOR">
        <td><button type="submit" name="submit" value="<?php echo escape($row["DIRECTORID"]); ?>">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>
</div>

<div class="Instructor box" style="display:none">
<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $connection = new PDO($dsn, $username, $password);
    $sql = "SELECT * FROM INSTRUCTOR";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["INSTRUCTORNAME"]); ?></td>
        <td><?php echo escape($row["INSTRUCTORPHONE"]); ?></td>
        <td><?php echo escape($row["INSTRUCTOREMAIL"]); ?></td>
        <input type=hidden name=entityName value="INSTRUCTOR">
        <td><button type="submit" name="submit" value="<?php echo escape($row["INSTRUCTORID"]); ?>">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>
</div>

<div class="Administrator box" style="display:none">
<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $connection = new PDO($dsn, $username, $password);
    $sql = "SELECT * FROM ADMINISTRATOR";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["ADMINISTRATORNAME"]); ?></td>
        <td><?php echo escape($row["ADMINISTRATORPHONE"]); ?></td>
        <td><?php echo escape($row["ADMINISTRATOREMAIL"]); ?></td>
        <input type=hidden name=entityName value="ADMINISTRATOR">
        <td><button type="submit" name="submit" value="<?php echo escape($row["ADMINISTRATORID"]); ?>">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>
</div>

<div class="Manager box" style="display:none">
<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <table>
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $connection = new PDO($dsn, $username, $password);
    $sql = "SELECT * FROM MANAGER";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["MANAGERFNAME"]); ?></td>
        <td><?php echo escape($row["MANAGERLNAME"]); ?></td>
        <td><?php echo escape($row["MANAGERPHONE"]); ?></td>
        <td><?php echo escape($row["MANAGEREMAIL"]); ?></td>
        <input type=hidden name=entityName value="MANAGER">
        <td><button type="submit" name="submit" value="<?php echo escape($row["MANAGERID"]); ?>">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>
</div>

<?php if ($success) echo "<div style='font-family:Helvetica; font-weight:100;'> $success </div>"; ?>

<a href="index.php" style="font-family: 'Helvetica'">Back to home</a>

<?php require "templates/footer.php"; ?>
