<?php
session_start();
include_once '../helpers/session_helper.php';
if(!isset($_SESSION['username'])){
  redirect("../views/login_admin.php");
}
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Administrator</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <!-- <link rel="icon" href="../material/images/LOGO.png" type="image/gif" sizes="5x5"> -->
        <script src="https://kit.fontawesome.com/e33a9afea3.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body class="candHome" >

        <div class="logoBackAdminHome">
            <div> <img id="logoAdmin" src="../material/images/LOGO.png" alt="JoBBooth"> </div>
        </div>

        <div class="adminHomeRow1">
            <div class="welcomeMsgAdminHome">
                <h1>Welcome, Admin</h1>
            </div>
        </div>
        
        <div class="functionsOrg">

          <div class="orgNavBar">
            <a href="../views/usersAdmin.php"><i class="fas fa-users"></i>  Users</a>
            <a href="../controllers/userController.php?q=logout"><i class="fas fa-sign-out-alt"></i>  Log Out</a>
            
        </div>
  
       </div>
       

<div class="adminMyChart">

  <!-- No of users chart -->

<canvas id="myChart" width="20" height="16" ></canvas>

<script> 

let ctx = document.getElementById('myChart').getContext('2d');
let delayed;
var orgCount = <?php echo (int)$_SESSION['adminNoOfUsers'][0]->userCount;?>;
var candCount = <?php echo (int)$_SESSION['adminNoOfUsers'][1]->userCount;?>;
var recCount = <?php echo (int)$_SESSION['adminNoOfUsers'][2]->userCount;?>;
var intCount = <?php echo (int)$_SESSION['adminNoOfUsers'][3]->userCount;?>;

let myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Organizations', 'Candidates', 'Recruiters', 'Interviewers'],
        datasets: [{
            label: 'NO OF USERS',
            data: [orgCount,candCount,recCount,intCount],
            backgroundColor: [
                '#99ff66',
                '#aaff80',
                '#66ff66',
                '#80ff80'
            ],
            borderColor: [
             'teal'
            ],
            borderWidth: 2,
            hoverBorderWidth: 2,
            hoverBorderColor: '#ffcc00'
        }]
    },
    options: {
        animations: {
      tension: {
        duration: 10000,
        easing: 'linear',
        from: 1,
        to: 0,
        loop: true
      }
     },
        scales: {
            y: {
                beginAtZero: true
            }
        },

        legend:{display:true,position: 'right',labels:{fontColor:'teal'}
        },

          layout:{
            padding:{left: 50,right:0,bottom:0,top:20}
          },
                    
    }
});
</script>
</div>  

<!-- <div class="adminUserCount">
<canvas id="userProgress" width="20" height="30"></canvas>
<script>

// user progress chart 
let ctx2 = document.getElementById('userProgress').getContext('2d');
let delayed;

let userProgress = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May',  'June',  'July',  'August',  'September', 
         'October',  'November',  'December'],
        datasets: [{
            label: 'USER PROGRESS',

            
            backgroundColor: [
                '#99ff66','#aaff80','#66ff66', '#66ff66','#66ff66','#66ff66','#66ff66','#66ff66','#66ff66','#66ff66','#66ff66','#66ff66',
            ],

            borderColor: [
             'teal'
            ],
            borderWidth: 2,
            hoverBorderWidth: 2,
            hoverBorderColor: '#ffcc00'
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },

        legend:{display:true,position: 'right',labels:{fontColor:'teal'}
        },

          layout:{
            padding:{left: 50,right:0,bottom:0,top:20}
          },
                    
    }
});
</script>  -->
</div>


  </body> 
</html>