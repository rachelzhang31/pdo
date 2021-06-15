<?php

/**
 * This page allows a user to update an entry 
 * Users are able to update any registereted entity 
 * Identification keys are handled automatically 
 */

require "../config.php";
require "../common.php";

?>
<?php require "templates/header.php"; ?>
        
<h2>Update members</h2>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script type="text/JavaScript"> 
    $(document).ready(function(){
      $('input[type="radio"]').click(function(){
          var inputValue = $(this).attr("value");
          var targetBox = $("." + inputValue);
          localStorage.setItem("storageName",inputValue);
          $(".box").not(targetBox).hide();
          $(targetBox).show();
      });
    });
  </script> 

  <div class="radio-toolbar" style="text-align:center"> 
    <input type="radio" name="select" id="siteselect" value="SITE" checked="checked"/>
      <label for="siteselect">Site</label> 
    <input type="radio" name="select" id="programselect" value="PROGRAM" />
      <label for="programselect">Program</label> 
    <input type="radio" name="select" id="volunteerselect" value="VOLUNTEER" />
      <label for="volunteerselect">Volunteer</label> 
    <input type="radio" name="select" id="directorselect" value="DIRECTOR" />
      <label for="directorselect">Program Director</label> 
    <input type="radio" name="select" id="managerselect" value="MANAGER" />
      <label for="managerselect">Manager</label> 
    <input type="radio" name="select" id="instructorselect" value="INSTRUCTOR" />
      <label for="instructorselect">Instructor</label> 
    <input type="radio" name="select" id="adminselect" value="ADMINISTRATOR" />
      <label for="adminselect">Administrator</label> 
  </div> 

  <div class="SITE box"> 
    <form method="post" id="mysite">
      <h2>Update a Site</h2>
        <table>
        <thead>
            <tr>
                <th>Site ID</th>
                <th>Site Name</th>
                <th>Site Street</th>
                <th>Site City</th>
                <th>Site State</th>
                <th>Site ZIP</th>
                <th>Site Phone</th>
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
                <td><?php echo escape($row["SITEID"]); ?></td>
                <td><?php echo escape($row["SITENAME"]); ?></td>
                <td><?php echo escape($row["SITESTREET"]); ?></td>
                <td><?php echo escape($row["SITECITY"]); ?></td>
                <td><?php echo escape($row["SITESTATE"]); ?></td>
                <td><?php echo escape($row["SITEZIP"]); ?></td>
                <td><?php echo escape($row["SITEPHONE"]); ?></td>
                <td><a href="update-single.php?table=SITE&SITEID=<?php echo escape($row["SITEID"]); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </form>
  </div> 

  <div class="PROGRAM box" style="display:none"> 
  <form method="post" id="mysite">
      <h2>Update a Program</h2>
        <table>
        <thead>
            <tr>
                <th>Program ID</th>
                <th>Program Name</th>
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
                <td><?php echo escape($row["PROGRAMID"]); ?></td>
                <td><?php echo escape($row["PROGRAMNAME"]); ?></td>
                <td><a href="update-single.php?table=PROGRAM&PROGRAMID=<?php echo escape($row["PROGRAMID"]); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </form>
  </div> 

  <div class="VOLUNTEER box" style="display:none"> 
  <form method="post" id="mysite">
      <h2>Update a Volunteer</h2>
        <table>
        <thead>
            <tr>
                <th>Volunteer ID</th>
                <th>Volunteer First Name</th>
                <th>Volunteer Last Name</th>
                <th>Volunteer Year</th>
                <th>Volunteer Phone</th>
                <th>Volunteer Email</th>
                <th>Program ID</th>
                <th>Site ID</th>
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
                <td><?php echo escape($row["VOLUNTEERID"]); ?></td>
                <td><?php echo escape($row["VOLUNTEERFNAME"]); ?></td>
                <td><?php echo escape($row["VOLUNTEERLNAME"]); ?></td>
                <td><?php echo escape($row["VOLUNTEERYEAR"]); ?></td>
                <td><?php echo escape($row["VOLUNTEERPHONE"]); ?></td>
                <td><?php echo escape($row["VOLUNTEEREMAIL"]); ?></td>
                <td><?php echo escape($row["PROGRAMID"]); ?></td>
                <td><?php echo escape($row["SITEID"]); ?></td>
                <td><a href="update-single.php?table=VOLUNTEER&VOLUNTEERID=<?php echo escape($row["VOLUNTEERID"]); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </form>
  </div> 

  <div class="DIRECTOR box" style="display:none"> 
  <form method="post" id="mysite">
      <h2>Update a Director</h2>
        <table>
        <thead>
            <tr>
                <th>Director ID</th>
                <th>Director First Name</th>
                <th>Director Last Name</th>
                <th>Director Phone</th>
                <th>Director Year</th>
                <th>Director Email</th>
                <th>Program ID</th>
                <th>Site ID</th>
                <th>Administrator ID</th>
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
                <td><?php echo escape($row["DIRECTORID"]); ?></td>
                <td><?php echo escape($row["DIRECTORFNAME"]); ?></td>
                <td><?php echo escape($row["DIRECTORFNAME"]); ?></td>
                <td><?php echo escape($row["DIRECTORLNAME"]); ?></td>
                <td><?php echo escape($row["DIRECTORPHONE"]); ?></td>
                <td><?php echo escape($row["DIRECTORYEAR"]); ?></td>
                <td><?php echo escape($row["DIRECTOREMAIL"]); ?></td>
                <td><?php echo escape($row["PROGRAMID"]); ?></td>
                <td><?php echo escape($row["SITEID"]); ?></td>
                <td><?php echo escape($row["ADMINISTRATORID"]); ?></td>
                <td><a href="update-single.php?table=DIRECTOR&DIRECTORID=<?php echo escape($row["DIRECTORID"]); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </form>
  </div> 

  <div class="INSTRUCTOR box" style="display:none"> 
  <form method="post" id="mysite">
      <h2>Update an Instructor</h2>
        <table>
        <thead>
            <tr>
                <th>Instructor ID</th>
                <th>Instructor Name</th>
                <th>Instructor Phone</th>
                <th>Instructor Email</th>
                <th>Site ID</th>
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
                <td><?php echo escape($row["INSTRUCTORID"]); ?></td>
                <td><?php echo escape($row["INSTRUCTORNAME"]); ?></td>
                <td><?php echo escape($row["INSTRUCTORPHONE"]); ?></td>
                <td><?php echo escape($row["INSTRUCTOREMAIL"]); ?></td>
                <td><?php echo escape($row["SITEID"]); ?></td>
                <td><a href="update-single.php?table=INSTRUCTOR&INSTRUCTORID=<?php echo escape($row["INSTRUCTORID"]); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </form>
  </div> 

  <div class="ADMINISTRATOR box" style="display:none"> 
    <form method="post" id="mysite">
      <h2>Update an Administrator</h2>
        <table>
        <thead>
            <tr>
                <th>Administrator ID</th>
                <th>Administrator Name</th>
                <th>Administrator Email</th>
                <th>Administrator Phone</th>
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
                <td><?php echo escape($row["ADMINISTRATORID"]); ?></td>
                <td><?php echo escape($row["ADMINISTRATORNAME"]); ?></td>
                <td><?php echo escape($row["ADMINISTRATOREMAIL"]); ?></td>
                <td><?php echo escape($row["ADMINISTRATORPHONE"]); ?></td>
                <td><a href="update-single.php?table=ADMINISTRATOR&ADMINISTRATORID=<?php echo escape($row["ADMINISTRATORID"]); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </form>
  </div> 

  <div class="MANAGER box" style="display:none"> 
  <form method="post" id="mysite">
      <h2>Update a Manager</h2>
        <table>
        <thead>
            <tr>
                <th>Manager ID</th>
                <th>Manager First Name</th>
                <th>Manager Last Name</th>
                <th>Manager Phone</th>
                <th>Manager Email</th>
                <th>Program ID</th>
                <th>Administrator ID</th>
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
                <td><?php echo escape($row["MANAGERID"]); ?></td>
                <td><?php echo escape($row["MANAGERFNAME"]); ?></td>
                <td><?php echo escape($row["MANAGERLNAME"]); ?></td>
                <td><?php echo escape($row["MANAGERPHONE"]); ?></td>
                <td><?php echo escape($row["MANAGEREMAIL"]); ?></td>
                <td><?php echo escape($row["PROGRAMID"]); ?></td>
                <td><?php echo escape($row["ADMINISTRATORID"]); ?></td>
                <td><a href="update-single.php?table=MANAGER&MANAGERID=<?php echo escape($row["MANAGERID"]); ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </form>
  </div> 

<a href="index.php" style="font-family: 'Helvetica'">Back to home</a>

<?php require "templates/footer.php"; ?>