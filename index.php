<!-- 
 * File: index.php SWE381 - Project
 * EDIT DATE: 5/16/2024 
 * AUTHORS: 
 * Saleh AlGhaith(Leader)		(443101007)
 * Fahad Alohali                (443101023)
 * Mshari Alaeena               (443101459)
-->
<?php
include "functions.php";
unset($_SESSION['username']);
$path = "M819.788835 800.976554l0 158.697395-156.846521-96.562243c-21.750241 3.551896-44.07458 5.628184-67.000649 5.628184-107.742184 0-204.254146-41.231053-270.859782-106.344027 10.971315 0.62831 21.874066 1.421372 33.022421 1.421372 15.629596 0 31.041219-0.765433 46.288082-1.994424 52.58679 36.20355 119.082928 57.953923 191.548256 57.953923 24.974811 0 49.130944-2.841721 72.41109-7.705496l54.486124 36.341696c-0.055261 0.026606-0.108475 0.054235-0.163736 0.081864L763.827042 875.735212l0-43.089377 0-56.041364c84.16015-47.434336 139.903969-129.35102 139.903969-222.63459 0-58.992579-22.515705-113.311719-60.1698-157.413146 2.486736-17.214057 4.208007-34.632775 4.208007-52.435233 0-8.142447-0.873939-16.080234-1.421431-24.099884 69.678751 57.981553 113.343992 139.665946 113.343992 230.449579C959.692804 652.307559 904.823947 742.722802 819.788835 800.976554zM428.057311 700.862415c-22.925045 0-45.263711-2.076288-67.000649-5.629207l-156.845497 96.562243L204.211165 633.126708C119.176053 574.845327 64.307196 484.430084 64.307196 382.593721c0-175.774329 162.857668-318.268694 363.750115-318.268694 200.894494 0 363.750115 142.494365 363.750115 318.268694C791.807427 558.36805 628.951806 700.862415 428.057311 700.862415zM428.057311 120.284527c-169.988357 0-307.789346 119.023814-307.789346 265.806855 0 93.270267 55.743819 175.173648 139.903969 222.63459l0 56.041364 0 43.089377 41.150875-27.241434c-0.068564-0.026606-0.122802-0.055259-0.177039-0.081864l54.513755-36.340673c23.266843 4.863774 47.421952 7.704472 72.397787 7.704472 169.988357 0 307.789346-118.995161 307.789346-265.806855C735.846658 239.307318 598.045669 120.284527 428.057311 120.284527zM609.932881 428.061262c-23.171672 0-41.9716-18.784832-41.9716-41.96988 0-23.170722 18.799928-41.96988 41.9716-41.96988 23.172695 0 41.9716 18.799158 41.9716 41.96988C651.903457 409.275407 633.104552 428.061262 609.932881 428.061262zM442.047504 428.061262c-23.184975 0-41.9716-18.784832-41.9716-41.96988 0-23.170722 18.785602-41.96988 41.9716-41.96988s41.9716 18.799158 41.9716 41.96988C484.019104 409.275407 465.233502 428.061262 442.047504 428.061262zM274.16315 428.061262c-23.184975 0-41.970577-18.784832-41.970577-41.96988 0-23.170722 18.785602-41.96988 41.970577-41.96988s41.9716 18.799158 41.9716 41.96988C316.133727 409.275407 297.348125 428.061262 274.16315 428.061262z";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>
        < Question me />
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
                <ol class="flex" style="font-size: 0.8rem;">
                    <li class="mx-2 nav-btns px-1"> <a href="">
                            <h2></h2>
                        </a></li>
                    <li class="mx-2 nav-btns px-1"><a href="">
                            <h2></h2>
                        </a></li>
                    <li class="mx-2 nav-btns px-1"><a href="">
                            <h2></h2>
                        </a></li>
                </ol>

                <div class="mx-3" style="width: 30rem;">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-600 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-[630px] p-2 ps-10 text-sm border border-gray-500 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search..." />
                    </div>
                </div>
            </div>

                <div class="flex items-center mr-24 py-2">
                    <a href="logIn.php"><button type="button" class="text-blue-500 hover:bg-blue-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-blue-500 focus:outline-none dark:focus:ring-blue-800">Log
                            in</button></a>
                    <a href="signUp.php"><button type="button" class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Sign
                            up</button></a>
                </div>
            </div>
        </nav>
    </div>

    <div id="searchresult" class="inline body mt-6 ml-20  grid grid-cols-3 gap-2"></div>


    <div class="body mt-6 ml-20 grid grid-cols-3 gap-2">
        <div class="col">
            <h1 class="mb-2 font-bold text-black text-[25px]">Most answered Questions</h1>

            <?php
            $sql = "SELECT * FROM question ORDER BY num_ans DESC limit 10";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $questionId = $row["id"];
                echo "
                <div class='block mb-5 bg-[#393e46] w-[450px] p-3 border  text-white border-gray-200 rounded-lg shadow hover:bg-gray-500'>
                    <div>
                        
                            <input type='hidden' name='questionId' value='" . $questionId . "'>
                            <h5 class='ext-xl font-semibold'>" . $row["title"] . "</h5>
                            <p class='pt-2'>" . $row["descriptionText"] . "</p>
                            <p class='text-blue-400'>";

                $answer = $conn->query("SELECT * FROM answers WHERE questionId = '$questionId' LIMIT 1")->fetch_assoc();

                if ($answer === null)       //To check if there's an answer for the Q.
                {
                    echo "No Answers available";
                } else {
                    $answer = $answer["answerText"];
                    echo $answer;
                }
                echo "
                        
                    </div>
                    <div class='flex justify-end space-x-2'>
                        <form action='answers.php' method='post'><input type='hidden' name='questionId' value='" . $questionId . "'>
                            <button style='width:100%'>
                                <svg class='svg-icon' style='width: 1em; height: 1em;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'>
                                    <path d='M512 0C229.216 0 0 229.216 0 512c0 282.752 229.216 512 512 512s511.968-229.248 511.968-512c0-282.784-229.184-512-511.968-512z m-0.032 960c-247.392 0-448-200.608-448-448 0-247.424 200.608-448 448-448 247.456 0 448 200.576 448 448 0 247.392-200.544 448-448 448z' />
                                    <path d='M704 800.448h-91.872l-25.888-126.624h-149.376l-26.176 126.624H320l152.384-640h78.112l153.504 640z m-130.432-191.424l-62.016-303.648h-2.304l-58.624 303.648h122.944z' />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>";
            }
            ?>
        </div>

        <div class="col">
            <h1 class="mb-2 font-bold text-black text-[25px]">Most Recent Questions</h1>
            <?php

            $sql = "SELECT * FROM question ORDER BY qDate DESC LIMIT 10";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $questionId = $row["id"];
                echo "
                <div class='block mb-5 bg-[#393e46] w-[450px] p-3 border  text-white border-gray-200 rounded-lg shadow hover:bg-gray-500'>
                    <div>
                        
                            <input type='hidden' name='questionId' value='" . $questionId . "'>
                            <h5 class='ext-xl font-semibold'>" . $row["title"] . "</h5>
                            <p class='pt-2'>" . $row["descriptionText"] . "</p>
                            <p class='text-blue-400'>";

                $answer = $conn->query("SELECT * FROM answers WHERE questionId = '$questionId' LIMIT 1")->fetch_assoc();

                if ($answer === null)       //To check if there's an answer for the Q.
                {
                    echo "No Answers available";
                } else {
                    $answer = $answer["answerText"];
                    echo $answer;
                }
                echo "
                        
                    </div>
                    <div class='flex justify-end space-x-2'>
                        <form action='answers.php' method='post'><input type='hidden' name='questionId' value='" . $questionId . "'>
                            <button style='width:100%'>
                                <svg class='svg-icon' style='width: 1em; height: 1em;fill: currentColor;overflow: hidden;' viewBox='0 0 1024 1024' version='1.1' xmlns='http://www.w3.org/2000/svg'>
                                    <path d='M512 0C229.216 0 0 229.216 0 512c0 282.752 229.216 512 512 512s511.968-229.248 511.968-512c0-282.784-229.184-512-511.968-512z m-0.032 960c-247.392 0-448-200.608-448-448 0-247.424 200.608-448 448-448 247.456 0 448 200.576 448 448 0 247.392-200.544 448-448 448z' />
                                    <path d='M704 800.448h-91.872l-25.888-126.624h-149.376l-26.176 126.624H320l152.384-640h78.112l153.504 640z m-130.432-191.424l-62.016-303.648h-2.304l-58.624 303.648h122.944z' />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>";
            }

            ?>
        </div>
        <div class="col">
            <img src="img/11436094_4707122.jpg" alt="Developer at Work" class="my-14">
            <img src="img/30576698_7718868.jpg" alt="Questioning Brain" class="my-14">
        </div>
    </div>

</body>

</html>
<script>
    $(document).ready(function() 
    {
        $("#default-search").keyup(function() 
        {
            let input = $(this).val();
            if (input != "") 
            {
                $.ajax(
                    {
                    url: "search.php",
                    method: "POST",
                    data: 
                    {
                        input: input
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