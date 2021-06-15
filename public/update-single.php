<?php

/**
 * Use an HTML form to edit an entry in one of the tables.
 */

require "../config.php";
require "../common.php";
$table = $_GET['table'];
$table = preg_replace('/[0-9]+/', '', $table);
$tablelc = strtolower($table);
$tablelc = preg_replace('/[0-9]+/', '', $tablelc);
if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    if ($table=="ADMINISTRATOR"){
      $connection = new PDO($dsn, $username, $password);
      $administrator =[
        "ADMINISTRATORID"        => $_POST['ADMINISTRATORID'],
        "ADMINISTRATORNAME" => $_POST['ADMINISTRATORNAME'],
        "ADMINISTRATOREMAIL"  => $_POST['ADMINISTRATOREMAIL'],
        "ADMINISTRATORPHONE"     => $_POST['ADMINISTRATORPHONE']
      ];
  
      $sql = "SET FOREIGN_KEY_CHECKS = 0;
              UPDATE ADMINISTRATOR 
              SET ADMINISTRATORID = :ADMINISTRATORID, 
                ADMINISTRATORNAME = :ADMINISTRATORNAME, 
                ADMINISTRATOREMAIL = :ADMINISTRATOREMAIL, 
                ADMINISTRATORPHONE = :ADMINISTRATORPHONE
              WHERE ADMINISTRATORID = :ADMINISTRATORID";
    
      $statement = $connection->prepare($sql);
      $statement->execute($administrator);
    }
    else if ($table=="SITE"){
      $connection = new PDO($dsn, $username, $password);
      $site =[
        "SITEID"        => $_POST['SITEID'],
        "SITENAME" => $_POST['SITENAME'],
        "SITESTREET"  => $_POST['SITESTREET'],
        "SITECITY"  => $_POST['SITECITY'],
        "SITESTATE"  => $_POST['SITESTATE'],
        "SITEZIP"  => $_POST['SITEZIP'],
        "SITEPHONE"  => $_POST['SITEPHONE']
      ];
  
      $sql = "UPDATE SITE
              SET SITEID = :SITEID, 
              SITENAME = :SITENAME, 
              SITESTREET = :SITESTREET, 
              SITECITY = :SITECITY,
              SITESTATE = :SITESTATE,
              SITEZIP = :SITEZIP,
              SITEPHONE = :SITEPHONE
              WHERE SITEID = :SITEID";
    
      $statement = $connection->prepare($sql);
      $statement->execute($site);
    }
    else if ($table == "PROGRAM"){
      $connection = new PDO($dsn, $username, $password);
      $program =[
        "PROGRAMID"        => $_POST['PROGRAMID'],
        "PROGRAMNAME" => $_POST['PROGRAMNAME']
      ];
  
      $sql = "UPDATE PROGRAM 
              SET PROGRAMID = :PROGRAMID, 
                PROGRAMNAME = :PROGRAMNAME
              WHERE PROGRAMID = :PROGRAMID";
    
      $statement = $connection->prepare($sql);
      $statement->execute($program);
    }
    else if ($table == "VOLUNTEER"){
      $connection = new PDO($dsn, $username, $password);
      $volunteer =[
        "VOLUNTEERID"        => $_POST['VOLUNTEERID'],
        "VOLUNTEERFNAME" => $_POST['VOLUNTEERFNAME'],
        "VOLUNTEERLNAME"  => $_POST['VOLUNTEERLNAME'],
        "VOLUNTEERYEAR" => $_POST['VOLUNTEERYEAR'],
        "VOLUNTEERPHONE" => $_POST['VOLUNTEERPHONE'],
        "VOLUNTEEREMAIL" => $_POST['VOLUNTEEREMAIL'],
        "PROGRAMID" => $_POST['PROGRAMID'],
        "SITEID" => $_POST['SITEID']
      ];
  
      $sql = "SET FOREIGN_KEY_CHECKS = 0;
              UPDATE VOLUNTEER
              SET VOLUNTEERID = :VOLUNTEERID, 
              VOLUNTEERFNAME = :VOLUNTEERFNAME, 
              VOLUNTEERLNAME = :VOLUNTEERLNAME, 
              VOLUNTEERYEAR = :VOLUNTEERYEAR,
              VOLUNTEERPHONE = :VOLUNTEERPHONE,
              VOLUNTEEREMAIL = :VOLUNTEEREMAIL,
              PROGRAMID = :PROGRAMID,
              SITEID = :SITEID
              WHERE VOLUNTEERID = :VOLUNTEERID";
    
      $statement = $connection->prepare($sql);
      $statement->execute($volunteer);
    }
    else if ($table == "DIRECTOR"){
      $connection = new PDO($dsn, $username, $password);
      $director =[
        "DIRECTORID"        => $_POST['DIRECTORID'],
        "DIRECTORFNAME" => $_POST['DIRECTORFNAME'],
        "DIRECTORLNAME"  => $_POST['DIRECTORLNAME'],
        "DIRECTORPHONE" => $_POST['DIRECTORPHONE'],
        "DIRECTORYEAR" => $_POST['DIRECTORYEAR'],
        "DIRECTOREMAIL" => $_POST['DIRECTOREMAIL'],
        "PROGRAMID" => $_POST['PROGRAMID'],
        "SITEID" => $_POST['SITEID'],
        "ADMINISTRATORID" => $_POST['ADMINISTRATORID']
      ];
  
      $sql = "SET FOREIGN_KEY_CHECKS = 0;
              UPDATE DIRECTOR
              SET DIRECTORID = :DIRECTORID, 
              DIRECTORFNAME = :DIRECTORFNAME, 
              DIRECTORLNAME = :DIRECTORLNAME, 
              DIRECTORPHONE = :DIRECTORPHONE,
              DIRECTORYEAR = :DIRECTORYEAR,
              DIRECTOREMAIL = :DIRECTOREMAIL,
              PROGRAMID = :PROGRAMID,
              SITEID = :SITEID,
              ADMINISTRATORID = :ADMINISTRATORID
              WHERE DIRECTORID = :DIRECTORID";
    
      $statement = $connection->prepare($sql);
      $statement->execute($director);
    }
    else if ($table == "MANAGER"){
      $connection = new PDO($dsn, $username, $password);
      $manager =[
        "MANAGERID"        => $_POST['MANAGERID'],
        "MANAGERFNAME" => $_POST['MANAGERFNAME'],
        "MANAGERLNAME"  => $_POST['MANAGERLNAME'],
        "MANAGERPHONE" => $_POST['MANAGERPHONE'],
        "MANAGEREMAIL" => $_POST['MANAGEREMAIL'],
        "PROGRAMID" => $_POST['PROGRAMID'],
        "ADMINISTRATORID" => $_POST['ADMINISTRATORID']
      ];
  
      $sql = "SET FOREIGN_KEY_CHECKS = 0;
              UPDATE MANAGER    
              SET MANAGERID = :MANAGERID, 
              MANAGERFNAME = :MANAGERFNAME, 
              MANAGERLNAME = :MANAGERLNAME, 
              MANAGERPHONE = :MANAGERPHONE,
              MANAGEREMAIL = :MANAGEREMAIL,
              PROGRAMID = :PROGRAMID,
              ADMINISTRATORID = :ADMINISTRATORID
              WHERE MANAGERID = :MANAGERID;";
    
      $statement = $connection->prepare($sql);
      $statement->execute($manager);
    }
    else{ //instructor
      $connection = new PDO($dsn, $username, $password);
      $instructor =[
        "INSTRUCTORID"        => $_POST['INSTRUCTORID'],
        "INSTRUCTORNAME" => $_POST['INSTRUCTORNAME'],
        "INSTRUCTORPHONE" => $_POST['INSTRUCTORPHONE'],
        "INSTRUCTOREMAIL" => $_POST['INSTRUCTOREMAIL'],
        "SITEID" => $_POST['SITEID']
      ];
  
      $sql = "SET FOREIGN_KEY_CHECKS = 0;
              UPDATE INSTRUCTOR
              SET INSTRUCTORID = :INSTRUCTORID, 
              INSTRUCTORNAME = :INSTRUCTORNAME,
              INSTRUCTORPHONE = :INSTRUCTORPHONE,
              INSTRUCTOREMAIL = :INSTRUCTOREMAIL,
              SITEID = :SITEID
              WHERE INSTRUCTORID = :INSTRUCTORID";
    
      $statement = $connection->prepare($sql);
      $statement->execute($instructor);
    }
  }
   catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['ADMINISTRATORID'])) {
  try {
    $connection = new PDO($dsn, $username, $password);
    $ADMINISTRATORID = $_GET['ADMINISTRATORID'];
    $sql = "SELECT * FROM ADMINISTRATOR WHERE ADMINISTRATORID = :ADMINISTRATORID";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':ADMINISTRATORID', $ADMINISTRATORID);
    $statement->execute();
    $administrator = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} 

else if (isset($_GET['MANAGERID'])) {
  try {
    $connection = new PDO($dsn, $username, $password);
    $MANAGERID = $_GET['MANAGERID'];

    $sql = "SELECT * FROM MANAGER WHERE MANAGERID = :MANAGERID";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':MANAGERID', $MANAGERID);
    $statement->execute();
    
    $manager = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} 
else if (isset($_GET['SITEID'])) {
  try {
    $connection = new PDO($dsn, $username, $password);
    $SITEID = $_GET['SITEID'];

    $sql = "SELECT * FROM SITE WHERE SITEID = :SITEID";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':SITEID', $SITEID);
    $statement->execute();
    
    $site = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} 
else if (isset($_GET['PROGRAMID'])) {
  try {
    $connection = new PDO($dsn, $username, $password);
    $PROGRAMID = $_GET['PROGRAMID'];

    $sql = "SELECT * FROM PROGRAM WHERE PROGRAMID = :PROGRAMID";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':PROGRAMID', $PROGRAMID);
    $statement->execute();
    
    $program = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} 
else if (isset($_GET['VOLUNTEERID'])) {
  try {
    $connection = new PDO($dsn, $username, $password);
    $VOLUNTEERID = $_GET['VOLUNTEERID'];

    $sql = "SELECT * FROM VOLUNTEER WHERE VOLUNTEERID = :VOLUNTEERID";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':VOLUNTEERID', $VOLUNTEERID);
    $statement->execute();
    
    $volunteer = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} 
else if (isset($_GET['DIRECTORID'])) {
  try {
    $connection = new PDO($dsn, $username, $password);
    $DIRECTORID = $_GET['DIRECTORID'];

    $sql = "SELECT * FROM DIRECTOR WHERE DIRECTORID = :DIRECTORID";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':DIRECTORID', $DIRECTORID);
    $statement->execute();
    
    $director = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} 
else if (isset($_GET['INSTRUCTORID'])) {
  try {
    $connection = new PDO($dsn, $username, $password);
    $INSTRUCTORID = $_GET['INSTRUCTORID'];

    $sql = "SELECT * FROM INSTRUCTOR WHERE INSTRUCTORID = :INSTRUCTORID";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':INSTRUCTORID', $INSTRUCTORID);
    $statement->execute();
    
    $instructor = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} 
else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote style="font-family: Helvetica; font-weight:100;">Entry successfully updated.</blockquote>
<?php endif; ?>

<?php
if($table=="SITE"){ ?>
<h2>Edit a user</h2>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($site as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" SITEID="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === ('SITEID') ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>
<?php
}
?>
<?php
if($table=="PROGRAM"){ ?>
<h2>Edit a user</h2>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($program as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" PROGRAMID="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === ('PROGRAMID') ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>
<?php
}
?>
<?php
if($table=="VOLUNTEER"){ ?>
<h2>Edit a user</h2>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($volunteer as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" VOLUNTEERID="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === ('VOLUNTEERID') ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>
<?php
}
?>
<?php
if($table=="DIRECTOR"){ ?>
<h2>Edit a user</h2>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($director as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" DIRECTORID="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === ('DIRECTORID') ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>
<?php
}
?>
<?php
if($table=="MANAGER"){ ?>
<h2>Edit a user</h2>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($manager as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" MANAGERID="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === ('MANAGERID') ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>
<?php
}
?>
<?php
if($table=="INSTRUCTOR"){ ?>
<h2>Edit a user</h2>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($instructor as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" INSTRUCTORID="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === ('INSTRUCTORID') ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>
<?php
}
?>
<?php
if($table=="ADMINISTRATOR"){ ?>
<h2>Edit a user</h2>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <?php foreach ($administrator as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" SITEID="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === ('SITEID') ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>
<?php
}
?>


<a href="index.php" style="font-family: 'Helvetica'">Back to home</a>

<?php require "templates/footer.php"; ?>
