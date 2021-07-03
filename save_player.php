<?php
    //connect to database
    require_once 'database2.php';
    $conn = db_connect();
?>

<?php
//save form inputs to variables

$firstname = trim(filter_var($_POST['firstname'],FILTER_SANITIZE_STRING));
$lastname = trim(filter_var($_POST['lastname'],FILTER_SANITIZE_STRING));
$Jerseynumber = trim(filter_var($_POST['Jerseynumber'],FILTER_SANITIZE_NUMBER_INT));
$position = trim($_POST['position']);

$is_form_valid = true;

//checking if all inputs are valid or not
if(empty($firstname))
{
    echo "Please enter a valid first name";
    $is_form_valid = false;

}

if(empty($lastname))
{
    echo "Please enter a valid last name";
    $is_form_valid = false;
    
}

if(empty($Jerseynumber))
{
    echo "Please enter a valid Jersey number ";
    $is_form_valid = false;
    
}

if(empty($position))
{
    echo "Please enter a valid position";
    $is_form_valid = false;
    
}

$jerseynumber_regex = "/[0-9]{2}/";

if($Jerseynumber<0 || strlen($Jerseynumber)!=2 || !preg_match($jerseynumber_regex,$Jerseynumber))
{
    echo "Please enter a valid Jersey number";
    $is_form_valid = false;
}

//setup the sql insert command
if($is_form_valid)
{
    try
    {
        $sql = "INSERT INTO player (firstname,lastname,Jerseynumber,position) VALUES ( :firstname, :lastname, :Jerseynumber, :position)";
        
        //create a command object and fill the parameter with the form values

        $cmd = $conn->prepare($sql);
        $cmd-> bindParam(':firstname', $firstname, PDO::PARAM_STR, 50);
        $cmd-> bindParam(':lastname', $lastname, PDO::PARAM_STR, 50);
        $cmd-> bindParam(':Jerseynumber', $Jerseynumber, PDO::PARAM_INT);
        $cmd-> bindParam(':position', $position, PDO::PARAM_STR, 100);

        //execute the command

        $cmd-> execute();

        //disconnect form db

        $conn = null;

        //show a message 

        echo 'Player Saved ?';
    } catch (Exception $e)
    {
        header("Location: error2.php");
    }
}
?>