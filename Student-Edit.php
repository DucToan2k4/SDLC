<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit student</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: beige;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin: 30px auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ccc;
    }

    input[type="text"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        width: calc(100% - 22px); /* Subtracting padding and border */
        box-sizing: border-box;
    }

    input[type="submit"],
    input[type="reset"] {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        width:760px;
        margin-right: 4%;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-bottom: 10px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
    }

    input[type="reset"] {
        background-color: #007bff;
        color: #fff;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    input[type="reset"]:hover {
        background-color: #495057;
    }

    td[colspan="2"] {
        text-align: center;
    }

    @media (max-width: 600px) {
        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            margin-right: 0;
        }
    }

    a{
        display: block;
        margin-top: 10px;
        margin-bottom: 10px;
        text-align: center;
        text-decoration: none !important;
        width: 752px;
        color: #007bff;
    }
</style>



    
</head>
<body>
<?php
    include "db_conn.php";
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM students WHERE Rollno='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Invalid request.";
        exit();
    }


    if(isset($_POST['btnEdit'])) {
        $rollno = $_POST['Rollno'];
        $sname = $_POST['Sname'];
        $address = $_POST['Address'];
        $email = $_POST['Email'];
        if($rollno=="" || $sname=="" || $address=="" || $email=="") {
            echo "(*) Fields cannot be empty";
        } else {
            $sql = "UPDATE students SET Sname='$sname', Address='$address', Email='$email' WHERE Rollno='$rollno'";
            if(mysqli_query($conn, $sql)) {
                header("Location: Student-List.php");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }
?>
<div class="container">
<h1>Edit Students</h1>
<form method="post">
    <table>
            <input type="hidden" name="Rollno" value="<?php echo $row['Rollno']; ?>">
            <tr>
                <td>Student ID</td>
                <td><input type="text" name="Rollno" value="<?php echo $row['Rollno']; ?>" disabled/> </td>
            </tr>
            <tr>
                <td>Student Name</td>
                <td><input type="text" name="Sname" value="<?php echo $row['Sname']; ?>"/> </td>
            </tr>
            <tr>
                <td>Student Address</td>
                <td><input type="text" name="Address" value="<?php echo $row['Address']; ?>"/> </td>
            </tr>
            <tr>
                <td>Student Email</td>
                <td><input type="text" name="Email" value="<?php echo $row['Email']; ?>"/></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="btnEdit" value="Add" />
                    <input type="reset" name="btnCancel" value="Cancel" />
                    <a href="Student-List.php">Back to List</a>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>