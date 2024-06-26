<!-- 
 * File: homePage.php SWE381 - Project
 * EDIT DATE: 5/16/2024 
 * AUTHORS: 
 * Saleh AlGhaith(Leader)		(443101007)
 * Fahad Alohali                (443101023)
 * Mshari Alaeena               (443101459)
-->
<?php
include "functions.php";
if (!isset($_SESSION['username']))  //In case of unauthorized access to this page!.
{
    header("Location:index.php");
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>&lt;Question me/&gt;</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdown = document.querySelector('.dropdown');
            var dropdownContent = document.querySelector('.dropdown-content');

            dropdown.addEventListener('click', function(event) {

                var isDisplayed = dropdownContent.style.display === 'block';
                dropdownContent.style.display = isDisplayed ? 'none' : 'block';


                event.stopPropagation();
            });


            document.addEventListener('click', function(event) {
                if (!dropdown.contains(event.target)) {
                    dropdownContent.style.display = 'none';
                }

            });
            dropdownContent.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>
    <style>
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            display: inline-block;

            padding: 1px 4px;

            background-color: #ddd;

            border-radius: 5px;

            margin: 0 5px;
        }

        .pagination a:hover {
            background-color: #bbb;
        }
    </style>
</head>

<body>
<div class="container">
        <nav class="border-t-2 border-t-orange-500 border-b-gray-300 w-screen flex justify-between" style="border-bottom-width: 0.1mm;">
            <div class="flex items-center mx-24 py-2">
                <a href="loggedInIndex.php" class="text-lg">
                    <h1 class="font-bold text-xl">
                        <code>
                            &ltQuestion me/>
                        </code>
                    </h1>
                </a>
                <div class="dropdown ml-2 mr-10" id="askDropdown">
                    <button type="button" id='dropbtn' class="text-blue-500 hover:bg-blue-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-blue-500 focus:outline-none dark:focus:ring-blue-800">
                        Ask a question?</button>
                    <div class="dropdown-content">
                        <form style="text-align: center" action="functions.php" method="post">
                            <input type="hidden" name="toFun" value="addQuestion">
                            <div class="form-group">
                                <label for="question_title" style='font-weight:bold'>Question Title:</label>
                                <input type="text" id="question_title" class="border border-gray-300" name="question_title" style="width:90%" required maxlength="40">
                            </div>
                            <div class="form-group">
                                <label for="description" style='font-weight:bold'>Description:</label>
                                <textarea id="description" class="border border-gray-300" name="description" style="width:95%; " required maxlength="235"></textarea>
                            </div>
                            <button type="submit" class="mb-1 text-blue-500 hover:bg-blue-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-blue-500 focus:outline-none dark:focus:ring-blue-800">
                                Ask a question</button>
                        </form>
                    </div>
                </div>


                <form class="mx-3" style="width: 30rem;">
                    <div class="flex items-center"> 
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-600 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>                                     
                            <input type="search" id="default-search" class="block w-[530px] p-2 pl-10 pr-3 text-sm border border-gray-500 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search..." />
                        </div>
                        <select id="search-scope" class="ml-2 p-1 border border-gray-500 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                            <option value="questions" selected>Questions</option>
                            <option value="answers" >Answers</option>
                        </select>
                    </div>
                </form>
            </div>
                

                <div class="flex items-center mr-24 py-2">
                    <a href="loggedInIndex.php"><button type="button" class="text-blue-500 hover:bg-blue-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-blue-500 focus:outline-none dark:focus:ring-blue-800">Home
                        </button></a>
                    <a href="logOut.php"><button type="button" class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Log
                            out</button></a>
                </div>
        </nav>
    </div>
        <!-- Profile icon -->
        <div class="bg-gray-200 mx-8 mt-4 rounded-lg p-4 flex flex-col items-center justify-center w-auto">
            <svg fill="#000000" height="80px" width="80px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 402.161 402.161">
                <g>
                    <g>
                        <g>
                            <path d="M201.08,49.778c-38.794,0-70.355,31.561-70.355,70.355c0,18.828,7.425,40.193,19.862,57.151
                                c14.067,19.181,32,29.745,50.493,29.745c18.494,0,36.426-10.563,50.494-29.745c12.437-16.958,19.862-38.323,19.862-57.151
                                C271.436,81.339,239.874,49.778,201.08,49.778z M201.08,192.029c-13.396,0-27.391-8.607-38.397-23.616
                                c-10.46-14.262-16.958-32.762-16.958-48.28c0-30.523,24.832-55.355,55.355-55.355s55.355,24.832,55.355,55.355
                                C256.436,151.824,230.372,192.029,201.08,192.029z" />
                            <path d="M201.08,0C109.387,0,34.788,74.598,34.788,166.292c0,91.693,74.598,166.292,166.292,166.292
                                s166.292-74.598,166.292-166.292C367.372,74.598,292.773,0,201.08,0z M201.08,317.584c-30.099-0.001-58.171-8.839-81.763-24.052
                                c0.82-22.969,11.218-44.503,28.824-59.454c6.996-5.941,17.212-6.59,25.422-1.615c8.868,5.374,18.127,8.099,27.52,8.099
                                c9.391,0,18.647-2.724,27.511-8.095c8.201-4.97,18.39-4.345,25.353,1.555c17.619,14.93,28.076,36.526,28.895,59.512
                                C259.25,308.746,231.178,317.584,201.08,317.584z M296.981,283.218c-3.239-23.483-15.011-45.111-33.337-60.64
                                c-11.89-10.074-29.1-11.256-42.824-2.939c-12.974,7.861-26.506,7.86-39.483-0.004c-13.74-8.327-30.981-7.116-42.906,3.01
                                c-18.31,15.549-30.035,37.115-33.265,60.563c-33.789-27.77-55.378-69.868-55.378-116.915C49.788,82.869,117.658,15,201.08,15
                                c83.423,0,151.292,67.869,151.292,151.292C352.372,213.345,330.778,255.448,296.981,283.218z" />
                            <path d="M302.806,352.372H99.354c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h203.452c4.142,0,7.5-3.358,7.5-7.5
                                C310.307,355.73,306.948,352.372,302.806,352.372z" />
                            <path d="M302.806,387.161H99.354c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h203.452c4.142,0,7.5-3.358,7.5-7.5
                                C310.307,390.519,306.948,387.161,302.806,387.161z" />
                        </g>
                    </g>
                </g>
            </svg>
            <div class="mt-4">
                <p class="text-lg font-semibold">Username: <?php echo $_SESSION['username']; ?></p>
                <p class="text-lg font-semibold">Email: <?php echo $_SESSION['email']; ?></p>
            </div>
        </div>
        <!-- Profile icon ends -->

        <div id="searchresult" class="inline body mt-6 ml-20  grid grid-cols-3 gap-2"></div>

        <main class="py-10 grid grid-cols-2 gap-4">
            <div class="questions-col ml-8">
                <?php 
                    $currentUser = $_SESSION['username'];
                    $total = $conn->query("SELECT COUNT(id) as total FROM question WHERE user_name = '$currentUser'")->fetch_assoc()['total']; // Number of questions
                ?>
                <h1 class="text-2xl font-bold text-gray-900 mb-4">My Questions(<?php echo $total?>)</h1>

                <?php

                $page = isset($_GET['page']) ? $_GET['page'] : 1; 
                $start = ($page - 1) * 10;

                
                $sql = "SELECT * FROM question WHERE user_name = '$currentUser' LIMIT $start, 10";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $questionId = $row["id"];
                    echo "
                <div class='p-4 my-4 bg-white shadow rounded-lg relative'>
                    <p class='text-lg font-bold'>" . $row["title"] . "</p>
                    <p style='width:90%'>" . $row["descriptionText"] . "</p>  
                    <div class='absolute bottom-2 right-2 flex items-center space-x-2'>
                        <form action='editPage.php' method='post'><input type='hidden' name='toFun' value='editQuestion'><input type='hidden' name='editedQuestionId' value='" . $questionId . "'>
                            <button style='width:100%'>
                                <svg class='svg-icon' style='width: 20px; height: 20px; fill: currentColor;' viewBox='0 0 1024 1024'>
                                    <path d='M287.9 734.92l11.82-136.27 481.14-481.14L905.31 242 424.17 723.11zM346 620.23l-5.37 61.94 61.94-5.37L837.43 242l-56.57-56.6z' />
                                    <path d='M666.115 266.207l33.94-33.94 90.51 90.509-33.94 33.941z' />
                                </svg>
                            </button>
                        </form>
                        <form action='functions.php' method='post' class='confirm'><input type='hidden' name='toFun' value='deleteQuestion'><input type='hidden' name='deletedQuestionId' value='" . $questionId . "'>
                            <button style='width:100%'>
                                <svg class='svg-icon' style='width: 20px; height: 20px; fill: currentColor;' viewBox='0 0 1024 1024'>
                                    <path d='M173.942611 173.061544l677.733649 0 0 35.670407L173.942611 208.731952 173.942611 173.061544zM691.160449 957.805392 334.458421 957.805392c-19.318998 0-35.670407-6.315846-49.043996-18.957771-13.383822-12.58462-20.812001-29.306466-22.295795-50.157353l-53.505611-695.568852 35.670407-4.461615 53.505611 695.568852c2.967588 25.311479 14.857383 37.905308 35.670407 37.905308l356.702028 0c20.802792 0 32.692586-12.593829 35.670407-37.905308l53.504588-695.568852 35.670407 4.461615-53.504588 695.568852c-1.483794 19.318998-9.293667 35.670407-23.409153 49.043996C724.975603 951.108876 708.995653 957.805392 691.160449 957.805392zM673.325245 190.896748l-35.670407 0 0-53.505611c0-23.741727-11.889795-35.670407-35.670407-35.670407L423.63444 101.720729c-23.780613 0-35.670407 11.927657-35.670407 35.670407l0 53.505611-35.670407 0 0-53.505611c0-20.812001 6.687306-37.905308 20.060895-51.27992 13.383822-13.373589 30.466895-20.060895 51.27992-20.060895l178.351014 0c20.802792 0 37.896098 6.687306 51.27992 20.060895 13.373589 13.373589 20.060895 30.466895 20.060895 51.27992L673.326269 190.896748zM405.799236 280.071743l17.835204 570.72345-35.670407 0L370.128829 280.071743 405.799236 280.071743zM494.974231 280.071743l35.670407 0 0 570.72345-35.670407 0L494.974231 280.071743zM619.820658 280.071743l35.670407 0-17.835204 570.72345-35.670407 0L619.820658 280.071743z' />
                                </svg>
                            </button>
                        </form>
                        <form action='answers.php' method='post'><input type='hidden' name='questionId' value='" . $questionId . "'>
                        <button style='width:100%'>
                            <svg class='svg-icon' style='width: 1em; height: 1em;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M512 0C229.216 0 0 229.216 0 512c0 282.752 229.216 512 512 512s511.968-229.248 511.968-512c0-282.784-229.184-512-511.968-512z m-0.032 960c-247.392 0-448-200.608-448-448 0-247.424 200.608-448 448-448 247.456 0 448 200.576 448 448 0 247.392-200.544 448-448 448z' />
                                <path d='M704 800.448h-91.872l-25.888-126.624h-149.376l-26.176 126.624H320l152.384-640h78.112l153.504 640z m-130.432-191.424l-62.016-303.648h-2.304l-58.624 303.648h122.944z' />
                            </svg>
                        </button>
                    </form>
                    </div>
                </div>
                ";
                }

                $pages = ceil($total / 10);
                $prev = $page - 1;
                $next = $page + 1;

                echo "<div class='pagination' style='text-align:right'>";
                if ($page > 1) {
                    echo "<a href='?page=$prev'>&laquo; Previous</a>";
                }

                for ($i = 1; $i <= $pages; $i++) {
                    echo "<a href='?page=$i'";
                    if ($i == $page) echo "class='active'";
                    echo ">" . $i . "</a>";
                }

                if ($page < $pages) {
                    echo "<a href='?page=$next'>Next &raquo;</a>";
                }
                echo "</div>";
                ?>
            </div>




            <div class="answers-col mr-8">
                <?php 
                    $total2 = $conn->query("SELECT COUNT(id) as total FROM answers WHERE user_name = '$currentUser'")->fetch_assoc()['total']; // Number of answers
                ?>
                <h1 class="text-2xl font-bold text-gray-900 mb-4">My Answers(<?php echo $total2?>)</h1>
                <!-- Answer Cards here -->
                <?php

                $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1
                $start = ($page - 1) * 10;

                $currentUser = $_SESSION['username'];
                $sql = "SELECT * FROM answers WHERE user_name = '$currentUser' LIMIT $start, 10";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $questionId = $row["questionId"];
                    $answerId = $row["id"];

                    $sqlRate = "SELECT AVG(rate) FROM rating WHERE answerId = '$answerId'";
                    $avg = $conn->query($sqlRate)->fetch_assoc()['AVG(rate)'];
                    if ($avg == intval($avg))
                        $avg=intval($avg);
                    else
                        $avg=sprintf("%.2f", $avg);

                    $sql2 = "SELECT title FROM question, answers WHERE question.id='$questionId'";
                    $title = $conn->query($sql2)->fetch_assoc()['title'];

                    echo "
                    <div class='p-4 my-4 bg-white shadow rounded-lg relative'>
                    <div class='absolute right-2 top-2 flex items-center'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' class='w-6 h-6 fill-current text-yellow-500'>
                            <path d='M17.56 21a1 1 0 0 1-.46-.11L12 18.22l-5.1 2.67a1 1 0 0 1-1.45-1.06l1-5.63-4.12-4a1 1 0 0 1-.25-1 1 1 0 0 1 .81-.68l5.7-.83 2.51-5.13a1 1 0 0 1 1.8 0l2.54 5.12 5.7.83a1 1 0 0 1 .81.68 1 1 0 0 1-.25 1l-4.12 4 1 5.63a1 1 0 0 1-.4 1 1 1 0 0 1-.62.18z'></path>
                        </svg>
                        <span class='text-lg ml-2 text-gray-800'>".$avg."</span>
                             
                                 </div>";
                    echo "
                    <p class='text-lg font-bold' style='width:90%'>" . $row["answerText"] . "</p>
                    <p>For question: " . $title . "</p>
                    <!-- Edit/Delete SVGs at bottom left -->
                    <div class='absolute bottom-2 right-2 flex items-center space-x-2'>
                        <form action='editPage.php' method='post'><input type='hidden' name='toFun' value='editAnswer'><input type='hidden' name='editedAnswerId' value='" . $answerId . "'>
                            <button style='width:100%'>
                        <svg class='svg-icon' style='width: 20px; height: 20px; fill: currentColor;' viewBox='0 0 1024 1024'>
                            <path d='M287.9 734.92l11.82-136.27 481.14-481.14L905.31 242 424.17 723.11zM346 620.23l-5.37 61.94 61.94-5.37L837.43 242l-56.57-56.6z' />
                            <path d='M666.115 266.207l33.94-33.94 90.51 90.509-33.94 33.941z' />
                        </svg>
                        </button>
                        </form>
                        <form action='functions.php' method='post' class='confirm'><input type='hidden' name='toFun' value='deleteAnswer'><input type='hidden' name='deletedAnswerId' value='" . $answerId . "'>
                            <button style='width:100%'>
                        <svg class='svg-icon' style='width: 20px; height: 20px; fill: currentColor;' viewBox='0 0 1024 1024'>
                            <path d='M173.942611 173.061544l677.733649 0 0 35.670407L173.942611 208.731952 173.942611 173.061544zM691.160449 957.805392 334.458421 957.805392c-19.318998 0-35.670407-6.315846-49.043996-18.957771-13.383822-12.58462-20.812001-29.306466-22.295795-50.157353l-53.505611-695.568852 35.670407-4.461615 53.505611 695.568852c2.967588 25.311479 14.857383 37.905308 35.670407 37.905308l356.702028 0c20.802792 0 32.692586-12.593829 35.670407-37.905308l53.504588-695.568852 35.670407 4.461615-53.504588 695.568852c-1.483794 19.318998-9.293667 35.670407-23.409153 49.043996C724.975603 951.108876 708.995653 957.805392 691.160449 957.805392zM673.325245 190.896748l-35.670407 0 0-53.505611c0-23.741727-11.889795-35.670407-35.670407-35.670407L423.63444 101.720729c-23.780613 0-35.670407 11.927657-35.670407 35.670407l0 53.505611-35.670407 0 0-53.505611c0-20.812001 6.687306-37.905308 20.060895-51.27992 13.383822-13.373589 30.466895-20.060895 51.27992-20.060895l178.351014 0c20.802792 0 37.896098 6.687306 51.27992 20.060895 13.373589 13.373589 20.060895 30.466895 20.060895 51.27992L673.326269 190.896748zM405.799236 280.071743l17.835204 570.72345-35.670407 0L370.128829 280.071743 405.799236 280.071743zM494.974231 280.071743l35.670407 0 0 570.72345-35.670407 0L494.974231 280.071743zM619.820658 280.071743l35.670407 0-17.835204 570.72345-35.670407 0L619.820658 280.071743z' />
                        </svg>
                        </button>
                        </form>
                    </div>
                </div>";
                }
                
                ?>
            </div>

        </main>
</body>
</html>
<script>

    var forms = document.getElementsByClassName("confirm");

    for (var i = 0; i < forms.length; i++) 
    {
        forms[i].addEventListener("submit", function(event) 
        {

            event.preventDefault();

            var result = confirm("Are you sure you want to proceed?");


            if (result) 
            {
                this.submit(); 
            }
            
        });
    }
</script>

<script>
    $(document).ready(function() 
    {
        $("#default-search").keyup(function() 
        {
            let input = $(this).val();
            let scope = $("#search-scope").val();
            if (input != "") 
            {
                $.ajax(
                    {
                    url: "searchUser.php",
                    method: "POST",
                    data: 
                    {
                        input: input,
                        scope: scope
                    },
                    success: function(data) 
                    {
                        $("#searchresult").html(data);
                        $('#searchresult').css(
                            {
                            display: ''
                        });
                    }
                })
            } else 
            {
                $("#searchresult").css("display", "none");
            }
        });
    });
</script>