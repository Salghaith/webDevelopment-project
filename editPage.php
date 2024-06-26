<!-- 
 * File: editPage.php SWE381 - Project
 * EDIT DATE: 5/16/2024 
 * AUTHORS: 
 * Saleh AlGhaith(Leader)		(443101007)
 * Fahad Alohali                (443101023)
 * Mshari Alaeena               (443101459)
-->
<?php

    include "functions.php";
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
                <ol class="flex ml-4" style="font-size: 0.8rem;">
                    <li class="mx-2 nav-btns px-1"> <a href="">
                            <h2>About</h2>
                        </a></li>
                    <li class="mx-2 nav-btns px-1"><a href="">
                            <h2>Products</h2>
                        </a></li>
                    <li class="mx-2 nav-btns px-1"><a href="">
                            <h2>For Teams</h2>
                        </a></li>
                </ol>
            </div>
            <div class="flex items-center mr-24 py-2">
                <a href='homePage.php'>
                    <button type='button' class='text-blue-500 hover:bg-blue-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-blue-500 focus:outline-none dark:focus:ring-blue-800'>
                        Profile
                    </button>
                </a>
                <a href='loggedInIndex.php'>
                    <button type='button' class='ml-2 text-blue-500 hover:bg-blue-100 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 border border-blue-500 focus:outline-none dark:focus:ring-blue-800'>
                        Home
                    </button>
                </a>
            </div>
        </nav>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['toFun'])) //To check whether to edit a question or an answer.
    {
        if ($_POST['toFun'] == "editQuestion") 
        {
            $type = "Question";
            $Id = $_POST["editedQuestionId"];
            $sql = "SELECT * FROM question WHERE id = '$Id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $title = $row["title"];
            $text = $row["descriptionText"];
        } else if ($_POST['toFun'] == "editAnswer") 
        {
            $Id = $_POST["editedAnswerId"];
            $type = "Answer";
            $sql = "SELECT * FROM answers WHERE id = '$Id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $questionId = $row["questionId"];
            $text = $row["answerText"];
            $sql2 = "SELECT title FROM question, answers WHERE question.id='$questionId'";
            $title = $conn->query($sql2)->fetch_assoc()['title'];
        }
    }
    ?>
    <main class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Answer Card -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Edit <?php echo $type ?></h1>
                <div class="p-4 bg-white shadow rounded-lg relative">
                    
                    <p class="text-lg font-bold">Question: <?php echo $title ?></p>
                </div>
                <!-- Edit Form -->
                <form class="mt-4" method='post' action="functions.php"><input type='hidden' name='toFun' value='edit<?php echo $type ?>DB'><input type='hidden' name='edited<?php echo $type ?>Id' value='<?php echo $Id ?>'>
                <?php
                    if ($type === "Question")
                        echo "<input type='text' required class='block w-full mt-1 p-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500' name='newQuestionTitle' value='" . $title . "'>";
                    ?>
                    <textarea maxlength="235" required name="new<?php echo $type ?>" class="block w-full mt-1 p-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" rows="4"><?php echo $text ?></textarea>
                    <button type="submit" class="mt-4 w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update Your <?php echo $type ?></button>
                </form>
            </div>
        </div>
    </main>

</body>

</html>


