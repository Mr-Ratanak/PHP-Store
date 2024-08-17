
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
    <title>
    <?php 
        $title = basename($_SERVER['PHP_SELF'],'.php'); 
        $title = explode('-',$title);
        $title = ucwords($title[0]);
    ?>
    </title>
</head>
<body>


<div class="container-fluid">
        <div class="row">
            <div class="admin-nav p-0">
                <div class="text-light text-center p-2 fs-5" style="pointer-events: none; user-select: none;"> Admin Panel </div>
                
                <div class="list-group list-group-flush">
                    <a href="dashboard.php" class="list-group-item text-light admin-link "><i class="fas fa-chart-pie"></i> &nbsp;  Dashboard</a>
                    <a href="admin-product.php" class="list-group-item text-light admin-link"><i class="fas fa-chalkboard-user"></i> &nbsp;  Products</a>
                    <a href="admin-category.php" class="list-group-item text-light admin-link"><i class="fas fa-tags"></i> &nbsp;  Categories</a>
                    <a href="admin-order.php" class="list-group-item text-light admin-link"><i class="fas fa-shop"></i> &nbsp;  Orders</a>
                    <a href="admin-message.php" class="list-group-item text-light admin-link"><i class="fas fa-message"></i> &nbsp;  Messages</a>
                    
                    <a href="admin-users.php" class="list-group-item text-light admin-link"><i class="fas fa-user-friends"></i> &nbsp;  Users</a>
                    <a href="admin-account.php" class="list-group-item text-light admin-link"><i class="fas fa-sticky-note"></i> &nbsp;  Admin Account</a>
                    <a href="admin-feedback.php" class="list-group-item text-light admin-link"><i class="fas fa-comment"></i> &nbsp;  Feedback</a> 
                    <a href="admin-notification.php" class="list-group-item text-light admin-link"><i class="fas fa-user-slash"></i> &nbsp; Deleted User</a>
                    <a href="package/admin-action.php?export=excel" class="list-group-item text-light admin-link "><i class="fas fa-table"></i> &nbsp; Export User</a>
                    <a href="admin-profile.php" class="list-group-item text-light admin-link "><i class="fas fa-id-card"></i> &nbsp; Profile</a>
                    <a href="admin-setting.php" class="list-group-item text-light admin-link "><i class="fas fa-cog"></i> &nbsp; Setting</a>
    
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="pt-1 col-lg-12 bg-primary d-flex justify-content-between resNav">
                        <!-- <a href="#" id="open-nav"><h3 class="text-white"><i class="fas fa-bars"></i></h3></a> -->
                        <div id="open-nav" style="cursor: pointer;"><h3 class="text-white"><i class="fas fa-bars"></i></h3></div>
                        <h4 class="text-white"><?= $title; ?></h4>
                        <a onclick="return(confirm('Are you sure you want to logout!'));" href="../components/admin_logout.php" class="text-light text-decoration-none mt-1">
                            <i class="fas fa-sign-out-alt"></i> &nbsp; Logout
                        </a>
                    </div>
                </div>    
        

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="../js/admin_script.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
           $("#open-nav").click(function(){
            $(".admin-nav").toggleClass("animate");
           });
        });

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
  
        function drawChart() {
  
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work',     11],
            ['Eat',      2],
            ['Commute',  2],
            ['Watch TV', 2],
            ['Sleep',    7]
          ]);
  
          var options = {
            title: 'My Daily Activities'
          };
  
          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  
          chart.draw(data, options);
        }

        
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 66],
          ['Sleep',    99]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
</script>
</body>
</html>