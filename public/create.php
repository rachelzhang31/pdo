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
    
    $statement = $connection->prepare($sql);
    $statement->execute($new);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>


  <script type="text/JavaScript"> 
    function displaySite() { 
      document.getElementById("mysite").style.display = "block"; 
    } 
    function displayProgram() { 
      document.getElementById("myprogram").style.display = "block"; 
    } 
  </script> 



  
  <input type="submit" name="site"
    class="button" value="Site" onclick="displaySite()" />
  <form method="post" style="display:none" id="mysite">
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

  <input type="submit" name="program"
    class="button" value="Program" onclick="displayProgram()" />
  <form method="post" style="display:none" id="myprogram">
    <h2>Add a Program</h2>
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="programid">Program ID</label>
    <input type="text" name="programid" id="programid">
    <label for="programname">Program Name</label>
    <input type="text" name="programname" id="programname">
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>

