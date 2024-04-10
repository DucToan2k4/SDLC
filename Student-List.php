<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Student</title>
    <style>
        body{
          background-color: beige;
        }

        a{
          text-decoration: none !important;
        }

        .nut{
          display: inline-block;
          padding: 10px 20px;
          background-color: #4CAF50;
          color: white;
          text-align: center;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          transition: background-color 0.3s ease;
          margin-top: 8px
        }

        .nut:hover{
          background-color: green;
          color: white;
        }

        h1{
          margin-left: -40px
        }

        .btn{
          width: 71px;
        }

        .btn-danger{
          margin-left: 10px
        }

        ul{
          display: flex;
          justify-content: space-between;
        }

        li{
          list-style-type: none;
        }

        .top{
          display: flex;
          justify-content: space-between;
          height: 60px; 
          margin-top: 10px;
          margin-bottom: -25px;
        }

         .input-group-sm{
          display: flex !important;
         }

         #tim{
          height: 31px;
         }



    </style>
</head>
<body>
<div class="container">
<div class="top">
    <a href="index.php">Log out</a>
    <div class="input-group-sm mb-3">
        <input type="text" class="form-control" id="searchInput" placeholder="Search Student ID" aria-label="Search Student">
        <div class="input-group-append">
            <button id="tim" class="btn btn-primary" type="button" onclick="search()">Search</button>
        </div>
    </div>
</div>


  <div class="main">
  <ul>
    <li><h1>Student List</h1></li>
    <li><a class="nut" href="Student-Add.php">Add student</a></li>
  </ul>


  
    <table class="table" id="studentTable">
      <thead class="thead-dark">      
          <tr>
            <th>STT</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Student Address</th>
            <th>Student Email</th>
            <th>Operation</th>
          </tr>
          
          <?php
          include "db_conn.php";

          if(isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            $sql = "DELETE FROM students WHERE Rollno='$delete_id'";
            if(mysqli_query($conn, $sql)) {
                // Nếu xóa thành công, chuyển hướng trở lại trang danh sách sinh viên
                header("Location: Student-List.php");
                exit();
            } else {
                // Nếu có lỗi xảy ra trong quá trình xóa, hiển thị thông báo lỗi
                echo "Error deleting record: " . mysqli_error($conn);
            }
          }
          
          $sql = "SELECT * FROM students";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
              $index = 1;
              while($row = mysqli_fetch_assoc($result)) {
          ?>
                  <tr>
                      <td><?php echo $index; ?></td>
                      <td><?php echo $row['Rollno']; ?></td>
                      <td><?php echo $row['Sname']; ?></td>
                      <td><?php echo $row['Address']; ?></td>
                      <td><?php echo $row['Email']; ?></td>
                      <td>
                          <!-- Chỉnh sửa -->
                          <a class="btn btn-primary" href="Student-Edit.php?id=<?php echo $row['Rollno']; ?>">Edit</a>
                          <!-- Xóa -->
                          <a class="btn btn-danger" href="?delete_id=<?php echo $row['Rollno']; ?>">Delete</a>
                      </td>
                  </tr>
                  <?php
                  $index++;
              }
          }
          ?>
      </thead>
  </table>
  </div>
</div>

<script>
    function search() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("studentTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Thay đổi số 1 để tìm kiếm theo cột khác
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

</body>
</html>
