<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #f8f9fa; */
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
            color: #333;
            margin-bottom: 20px;
        }
        
        a{
            display: block;
            margin-top: 20px;
            margin-bottom: 10px;
            text-align: center;
            text-decoration: none !important;
            width: 752px;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        input[type="text"],
        input[type="submit"],
        input[type="reset"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: calc(100% - 22px); /* Subtracting padding and border */
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="reset"] {
            cursor: pointer;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px #007bff;
        }

        .message {
            margin-top: 10px;
            color: #28a745;
        }

        .error {
            color: #dc3545;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"] {
            width: 100%;
        }

        .form-group input[type="submit"],
        .form-group input[type="reset"] {
            width: 48%;
            margin-right: 4%;
        }

        @media (max-width: 600px) {
            .form-group input[type="submit"],
            .form-group input[type="reset"] {
                width: 100%;
                margin-right: 0;
            }
        }


    </style>
</head>
<body>

<?php
// Kết nối đến cơ sở dữ liệu
$db = new PDO('mysql:host=127.0.0.1;dbname=demo', 'root', '');

// Xử lý yêu cầu thêm sinh viên
if (isset($_POST['btnAdd'])) 
{
    // Lấy dữ liệu từ form
    $rollno = $_POST['rollno'];
    $sname = $_POST['sname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
  
    // Thêm sinh viên vào bảng 'students'
    $sql = "INSERT INTO students (rollno, sname, address, email) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$rollno, $sname, $address, $email]);

    // Thông báo thành công
    echo '<script>alert("Add student successful");</script>';
}


// Lấy danh sách sinh viên
$sql = "SELECT * FROM students";
$stmt = $db->query($sql);
$students = $stmt->fetchAll();
?>
<div class="container">
<h1>Add Students</h1>
<form method="post">
    <table >
        <tr>
            <td >Student ID</td>
            <td><input type="text" name="rollno" required/></td>
        </tr>
        <tr>
            <td>Student Name</td>
            <td><input type="text" name="sname" required/></td>
        </tr>
        <tr>
            <td>Student Address</td>
            <td><input type="text" name="address" required/></td>
        </tr>
        <tr>
            <td>Student Email</td>
            <td><input type="text" name="email" required/></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="btnAdd" value="Add" />
                <input type="reset" name="btnCancel" value="Cancel" />
                <a href="Student-List.php">Back to List</a>
            </td>
        </tr>
    </table>
</form>
</div>

</body>
</html>