<!-- 
 * File: answers.php SWE381 - Project
 * EDIT DATE: 5/16/2024 
 * AUTHORS: 
 * Saleh AlGhaith(Leader)		(443101007)
 * Fahad Alohali                (443101023)
 * Mshari Alaeena               (443101459)
-->
<?php

    include "functions.php";

    if (!isset($_SESSION['username']))  //1.0:Which bar to show.
    {
        $bar = "
        <a href='index.php'>
            <button type='button' class='text-blue-500 hover:bg-blue-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-blue-500 focus:outline-none dark:focus:ring-blue-800'>
            Home
            </button>
        </a>
        <a href='logIn.php'>
            <button type='button' class='ml-2 text-blue-500 hover:bg-blue-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-blue-500 focus:outline-none dark:focus:ring-blue-800'>
            Login
            </button>
        </a>
        <a href='signUp.php'>
            <button type='button' class='ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>
            Signup
            </button>
        </a>";
    } else   //1.1:LoggedIn
    {
        $bar = "
        <a href='homePage.php'>
            <button type='button' class='mr-2 text-blue-500 hover:bg-blue-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-blue-500 focus:outline-none dark:focus:ring-blue-800'>
            Profile
            </button>
        </a>
        <a href='loggedInIndex.php'>
            <button type='button' class='text-blue-500 hover:bg-blue-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-blue-500 focus:outline-none dark:focus:ring-blue-800'>
            Home
            </button>
        </a>";
    }       //End 1.
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        < Question me />
    </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script>                            //2.0: Script for adding Comment.
        document.addEventListener('DOMContentLoaded', function() 
        {
            const addCommentButtons = document.querySelectorAll('.add-comment-btn');

            addCommentButtons.forEach(button => 
            {
                button.addEventListener('click', function() 
                {
                    const AQId = this.getAttribute('data-answer-id');
                    const type = this.getAttribute('type');
                    const container = this.parentNode;
                    if (!container.querySelector('.comment-form')) 
                    {
                        addCommentForm(container, AQId, type);
                    }
                });
            });
        });

        function addCommentForm(container, AQId, type) 
        {
            const form = document.createElement('form');
            form.className = 'comment-form';
            form.method = 'post';
            form.action = 'functions.php';
            form.innerHTML = `
            <textarea name='textField' rows='2' placeholder='Write a comment...' class='textarea'></textarea>
            <input type="hidden" name="toFun" value="addComment">
            <input type="hidden" name="AQId" value='` + AQId + `'>
            <input type="hidden" name="type" value='` + type + `'>
            <button type='submit' class='button'>Submit</button>
            `;
            
            container.appendChild(form);
        }
    </script>           <!--End 2. -->

    <style>
        .button 
        {
            width: 100%;
            padding: 8px 16px;
            background-color: #007BFF;
            color: white;
            text-align: center;
            border: 1px solid #006fe6;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            display: block;
        }

        .textarea 
        {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .button:hover 
        {
            background-color: #0056b3;
        }

        .pagination 
        {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a 
        {
            display: inline-block;

            padding: 1px 4px;

            background-color: #ddd;

            border-radius: 5px;

            margin: 0 5px;
        }

        .pagination a:hover 
        {
            background-color: #bbb;
        }

        .star-widge input 
        {
            display: none;
        }

        .star-widge label 
        {
            font-size: 15px;
            color: #444;
            padding: 2px;
            float: right;
            transition: all 0.2s ease;

        }

        .star-widge input:not(:checked)~label:hover,
        input:not(:checked)~label:hover~label 
        {
            color: #fd4;
        }

        .star-widge input:checked~label 
        {
            color: #fd4
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
            </div>
                <div class="flex items-center mr-24 py-2">
                    <?php echo $bar; ?>   
                </div>
        </nav>
    </div>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['questionId'])) //3.0: Check If this page is requested.
        {
            $_SESSION['qId'] = $_POST['questionId'];                            //3.1: Save the question ID.
        }
        $questionId = $_SESSION['qId'];
        $sql = "SELECT * FROM question WHERE id='$questionId' ";               //3.2: Retrieve question information.

        $result = $conn->query($sql)->fetch_assoc();

        $title = $result["title"];
        $description = $result["descriptionText"];
        $name = $result["user_name"];                                       //End 3.
    ?> 

    <main class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="p-4 bg-white  shadow rounded-lg relative">
                    <h5 class="text-xl font-semibold" id='<?php echo $questionId; ?>'>
                        <?php echo $name . ": " . $title; ?>  <!--Printing The Question -->  
                    </h5>
                    <p class="pt-2">
                        <?php echo $description; ?>
                    </p>
                    <hr class='my-2'>
                    <?php 
                    $sql2 = "SELECT * FROM questionComments WHERE questionId = '$questionId'";  
                    $comments = $conn->query($sql2);                                           
                    if ($comments->num_rows > 0)            //Retrieveing the comments.                                            
                    {                                                                           
                        while ($comment = $comments->fetch_assoc())                             
                        {
                            echo "
                <p class='text-[14px]'>
                    [" . $comment['user_name'] . "]: " . $comment['textField'] . "
                </p>";
                        }
                    } else 
                    {
                        echo "No comments";
                    }

                    //Button for adding new comment.
                    if (isset($_SESSION['username'])) 
                    {
                        echo "
                <button class='add-comment-btn' data-answer-id='$questionId' type='question'>
                    <div class='absolute bottom-0 right-0 mb-[10px] mr-[10px]'>
                        <svg xmlns='http://www.w3.org/2000/svg' shape-rendering='geometricPrecision'
                            text-rendering='geometricPrecision' image-rendering='optimizeQuality'
                            fill-rule='evenodd' clip-rule='evenodd' viewBox='0 0 512 451.41' class='w-[22px] h-[22px] fill-current text-black'>
                            <path d='M215.05 391.35c53.62 51.73 129.47 67.36 205.31 35.04l63.65 25.02-21.09-50.15c70.72-56.64 58.06-134.5 6-187.56-3.48 20.4-10.39 39.73-20.23 57.61-13.98 25.43-34 48.02-58.52 66.63-23.76 18.04-51.5 32.18-81.73 41.32-28.8 8.72-60.35 13.06-93.38 12.09h-.01zM107.18 164.74l83.8 84.56v-42.18c13.23-2.65 25.78-3.93 37.63-3.77 11.87.18 23.09 1.93 33.62 5.27 10.53 3.39 20.42 8.35 29.58 14.95 9.21 6.59 17.81 14.94 25.87 24.96-1.33-20.56-5.7-38.58-13.06-54.08-7.37-15.46-16.75-28.39-28.22-38.75-11.43-10.36-24.49-18.24-39.14-23.6-14.64-5.34-30.05-8.34-46.28-9.03v-42.9l-83.8 84.57zM278.32 6.61c39.61 8.97 74.76 26.62 102.21 50.15 39.68 34.02 63.47 80.32 61.98 130.88v.11c-.82 27.28-8.94 52.92-22.79 75.74-14.25 23.47-34.48 43.88-58.99 59.94-32.34 21.19-72.82 34.3-114.06 38.2-38.57 3.64-77.97-.77-112.17-14.13L5.4 401.86l53.89-98.52c-17.84-15.85-32.3-34.24-42.46-54.37C5.3 226.12-.72 201.02.07 174.8c1.53-50.62 28.09-95.52 69.8-127.17 25.44-19.3 56.56-33.68 91.03-41.34 38.31-8.52 79.12-8.35 117.42.32zM169.34 32.95c-31.45 6.63-59.74 19.47-82.65 36.85-35.14 26.67-57.51 64.04-58.77 105.76-.65 21.44 4.32 42.03 13.82 60.85 10.02 19.86 25.06 37.78 43.88 52.69l9.22 7.31-26.7 48.81 66.36-27.94 5.4 2.3c31.12 13.27 67.94 17.72 104.15 14.3 36.8-3.48 72.79-15.09 101.39-33.83 21.16-13.86 38.48-31.23 50.47-50.98 11.4-18.78 18.07-39.81 18.75-62.08v-.12c1.23-41.69-18.83-80.26-52.26-108.91-23.1-19.81-52.5-34.89-85.71-43.11-34.76-8.61-72.33-9.28-107.35-1.9z' />
                        </svg>
                    </div>
                </button>";
                    }
                    ?>
                </div>
                <?php 
                    $total = $conn->query("SELECT COUNT(id) as total FROM answers WHERE questionId = '$questionId'")->fetch_assoc()['total']; // Number of answers
                ?>
                <h1 class="text-2xl mt-6 font-bold text-gray-900">
                    Answers(<?php echo $total?>)
                </h1>
                <div class="mt-6 space-y-4">
                    <!-- Answer Card Start -->
                    <?php

                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $start = ($page - 1) * 10;

                        $sql = "SELECT * FROM answers WHERE questionId = '$questionId' LIMIT $start,10";
                        $answer = $conn->query($sql);
                        $i = 0;
                        while ($row = $answer->fetch_assoc())       //Retrieving the answers.
                        {
                            $i++;
                            $answerId = $row['id'];
                            $answerName = $row['user_name'];
                            echo "
                    <div class='p-4 bg-white shadow rounded-lg relative'>
                        <div class='absolute right-2 top-2 flex items-center'>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'
                                class='w-6 h-6 fill-current text-yellow-500'>
                                <path d='M17.56 21a1 1 0 0 1-.46-.11L12 18.22l-5.1 2.67a1 1 0 0 1-1.45-1.06l1-5.63-4.12-4a1 1 0 0 1-.25-1 1 1 0 0 1 .81-.68l5.7-.83 2.51-5.13a1 1 0 0 1 1.8 0l2.54 5.12 5.7.83a1 1 0 0 1 .81.68 1 1 0 0 1-.25 1l-4.12 4 1 5.63a1 1 0 0 1-.4 1 1 1 0 0 1-.62.18z' />
                            </svg>
                            <span class='text-lg ml-2 text-gray-800 mx-3'>";
                            $sql2 = "SELECT AVG(rate) FROM rating WHERE answerId = '$answerId'";    //Get the rate.
                            $avg = $conn->query($sql2)->fetch_assoc()['AVG(rate)'];
                            if ($avg == intval($avg))
                                echo intval($avg);
                            else
                                echo sprintf("%.2f", $avg);

                            echo "
                            </span>
                        </div>";
                            if (isset($_SESSION['username'])) 
                            {
                                $name = $_SESSION['username'];
                                $sql3 = "SELECT * FROM rating WHERE answerId = '$answerId' AND user_name = '$name'";
                                $check = $conn->query($sql3);
                                if(!$check->num_rows > 0)   //To check if user rated this answer already.
                                {
                                echo "
                        <div class='star-widge flex justify-start'>
                            <form action='functions.php' method='post' id='ratingForm_" . $answerId . "'>
                                <input type='radio' name='rate' value=5 id='rate-5_" . $answerId . "'>
                                <label for='rate-5_" . $answerId . "' class='fas fa-star'></label>
                                <input type='radio' name='rate' value=4 id='rate-4_" . $answerId . "'>
                                <label for='rate-4_" . $answerId . "' class='fas fa-star'></label>
                                <input type='radio' name='rate' value=3 id='rate-3_" . $answerId . "'>
                                <label for='rate-3_" . $answerId . "' class='fas fa-star'></label>
                                <input type='radio' name='rate' value=2 id='rate-2_" . $answerId . "'>
                                <label for='rate-2_" . $answerId . "' class='fas fa-star'></label>
                                <input type='radio' name='rate' value=1 id='rate-1_" . $answerId . "'>
                                <label for='rate-1_" . $answerId . "' class='fas fa-star'></label>
                                <input type='hidden' name='toFun' value='rateAnswer'>
                                <input type='hidden' name='answerId' value='$answerId'>
                                <input type='hidden' name='user_name' value='$name'>
                            </form>
                        </div>";

                                }else   //To print the user rate.
                                {
                                    $myRate = $check->fetch_assoc()['rate'];
                                    for($j = 1 ; $j<=5 ; $j++)
                                    {
                                        if($j <=$myRate)
                                            echo "<label class='fas fa-star' style='color: #fd4'></label>";
                                        else
                                            echo "<label class='fas fa-star'></label>";
                                    }
                                    
                                }
                            } 
                        ?>
                        <script>
                            document.querySelectorAll('form[id^="ratingForm"]').forEach(form => //When user click on star for rating sumbit.
                            {
                                let radios = form.querySelectorAll('input[type="radio"]');
                                radios.forEach(radio => 
                                {
                                    radio.addEventListener('change', function() 
                                    {
                                        form.submit();
                                    });
                                });
                            });
                        </script>
                        <?php

                            echo "
                        <p class='text-lg font-bold' style='width:90%'>"
                             . $answerName . ": " . $row['answerText'] . "
                        </p>
                        <hr class='my-2'>";

                            $sql2 = "SELECT * FROM comments WHERE answerId = '$answerId'";
                            $comments = $conn->query($sql2);                                   //Retrieving the comments.
                            if ($comments->num_rows > 0) 
                            {
                                while ($comment = $comments->fetch_assoc()) 
                                {
                                    echo "
                        <p class='text-[14px]'>
                            [" . $comment['user_name'] . "]: " . $comment['textField'] . "
                        </p>";
                                }
                            } else 
                            {
                                echo "No comments";
                            }

                            // Button for adding new comment 
                            if (isset($_SESSION['username'])) 
                            {
                                echo "
                        <button class='add-comment-btn' data-answer-id='$answerId' type='answer'>
                            <div class='absolute bottom-0 right-0 mb-[10px] mr-[10px]'>
                                <svg xmlns='http://www.w3.org/2000/svg' shape-rendering='geometricPrecision'
                                    text-rendering='geometricPrecision' image-rendering='optimizeQuality'
                                    fill-rule='evenodd' clip-rule='evenodd' viewBox='0 0 512 451.41' class='w-[22px] h-[22px] fill-current text-black'>
                                    <path d='M215.05 391.35c53.62 51.73 129.47 67.36 205.31 35.04l63.65 25.02-21.09-50.15c70.72-56.64 58.06-134.5 6-187.56-3.48 20.4-10.39 39.73-20.23 57.61-13.98 25.43-34 48.02-58.52 66.63-23.76 18.04-51.5 32.18-81.73 41.32-28.8 8.72-60.35 13.06-93.38 12.09h-.01zM107.18 164.74l83.8 84.56v-42.18c13.23-2.65 25.78-3.93 37.63-3.77 11.87.18 23.09 1.93 33.62 5.27 10.53 3.39 20.42 8.35 29.58 14.95 9.21 6.59 17.81 14.94 25.87 24.96-1.33-20.56-5.7-38.58-13.06-54.08-7.37-15.46-16.75-28.39-28.22-38.75-11.43-10.36-24.49-18.24-39.14-23.6-14.64-5.34-30.05-8.34-46.28-9.03v-42.9l-83.8 84.57zM278.32 6.61c39.61 8.97 74.76 26.62 102.21 50.15 39.68 34.02 63.47 80.32 61.98 130.88v.11c-.82 27.28-8.94 52.92-22.79 75.74-14.25 23.47-34.48 43.88-58.99 59.94-32.34 21.19-72.82 34.3-114.06 38.2-38.57 3.64-77.97-.77-112.17-14.13L5.4 401.86l53.89-98.52c-17.84-15.85-32.3-34.24-42.46-54.37C5.3 226.12-.72 201.02.07 174.8c1.53-50.62 28.09-95.52 69.8-127.17 25.44-19.3 56.56-33.68 91.03-41.34 38.31-8.52 79.12-8.35 117.42.32zM169.34 32.95c-31.45 6.63-59.74 19.47-82.65 36.85-35.14 26.67-57.51 64.04-58.77 105.76-.65 21.44 4.32 42.03 13.82 60.85 10.02 19.86 25.06 37.78 43.88 52.69l9.22 7.31-26.7 48.81 66.36-27.94 5.4 2.3c31.12 13.27 67.94 17.72 104.15 14.3 36.8-3.48 72.79-15.09 101.39-33.83 21.16-13.86 38.48-31.23 50.47-50.98 11.4-18.78 18.07-39.81 18.75-62.08v-.12c1.23-41.69-18.83-80.26-52.26-108.91-23.1-19.81-52.5-34.89-85.71-43.11-34.76-8.61-72.33-9.28-107.35-1.9z' />
                                </svg>
                            </div>
                        </button>";
                            }
                            echo "
                    </div>"; //Close the answer container
                        }

                        if ($i == 0) echo "
                    No Answers available<br>";

                        $pages = ceil($total / 10); //Pagination.
                        $prev = $page - 1;
                        $next = $page + 1;

                        echo "
                    <div class='pagination'>";
                        if ($page > 1) 
                        {
                            echo "
                        <a href='?page=$prev'>
                            &laquo; Previous
                        </a>";
                        }

                        for ($i = 1; $i <= $pages; $i++) 
                        {
                            echo "
                        <a href='?page=$i'";
                            if ($i == $page) echo "class='active'";
                            echo ">" . $i . "
                        </a>";
                        }

                        if ($page < $pages) 
                        {
                            echo "
                        <a href='?page=$next'>
                            Next &raquo;
                        </a>";
                        }
                        echo "
                    </div>";
                        ?>
                </div>
            </div>
            <div class="mb-8">
                <?php

                if (isset($_SESSION['username']))   //If logged In he can answer.
                {
                    echo "
                <h1 class='text-2xl font-bold text-gray-900'>
                    Answer the Question
                </h1>

                <form class='mt-4' action='functions.php' method='post'>
                    <textarea class='block w-full mt-1 p-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500'
                        rows='4' name='answer' required maxlength='235' placeholder='Type your answer here...'></textarea>
                    <button type='submit'
                        class='mt-4 w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center'>
                        Post Your Answer
                    </button>
                    <input type='hidden' name='toFun' value='addAnswer'>
                    <input type='hidden' name='questionId' value='$questionId'>
                </form>";
                }
                ?>
            </div>
        </div>
    </main>
</body>
</html>