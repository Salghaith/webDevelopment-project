<!-- 
 * File: functions.php SWE381 - Project
 * EDIT DATE: 5/15/2024 
 * AUTHORS: 
 * Saleh AlGhaith(Leader)		  (443101007)
 * Fahad Alohali                (443101023)
 * Mshari Alaeena               (443101459)
-->
<?php
include "databaseCon.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['toFun'])) 
{
   $currentUser = $_SESSION['username'];
   if ($_POST['toFun'] == "addQuestion")     //To add a question.
   {
      $title = htmlspecialchars(addslashes($_POST['question_title']));
      $question = htmlspecialchars(addslashes($_POST['description']));
      askQuestion($currentUser, $title, $question, $conn);             
   } else if ($_POST['toFun'] == "addAnswer") //To add an answer.
   {
      $questionId = $_POST['questionId'];
      $answer = htmlspecialchars(addslashes($_POST['answer']));
      addAnswer($currentUser, $questionId, $answer, $conn);
   } else if ($_POST['toFun'] == "addComment") //To add a comment.
   {
      $AQId = $_POST['AQId'];
      $type = $_POST['type'];
      $textField = htmlspecialchars(addslashes($_POST['textField']));
      addComment($currentUser, $AQId, $textField, $conn, $type);
   } else if ($_POST['toFun'] == "deleteQuestion") //To delete question.
   {
      $questionId = $_POST['deletedQuestionId'];

      deleteQuestion($questionId, $conn);
   } else if ($_POST['toFun'] == "editQuestionDB") //To edit question
   {

      $questionId = $_POST['editedQuestionId'];
      $title = htmlspecialchars(addslashes($_POST["newQuestionTitle"]));
      $text = htmlspecialchars(addslashes($_POST['newQuestion']));
      editQuestion($questionId, $title, $text, $conn);

   } else if ($_POST['toFun'] == "deleteAnswer")     //To delete an answer.
   {
      $answerId = $_POST['deletedAnswerId'];
      deleteAnswer($answerId, $conn);



   } else if ($_POST['toFun'] == "editAnswerDB")   //To edit an answer.
   {

      $answerId = $_POST['editedAnswerId'];
      $text = htmlspecialchars(addslashes($_POST['newAnswer']));
      editAnswer($answerId,$text,$conn);

   } else if ($_POST['toFun'] == "rateAnswer")  //To rate an answer.
   {
      $answerId = $_POST['answerId'];
      $rate = $_POST['rate'];
      $user_name = $_POST['user_name'];
      rateAnswer($answerId, $conn, $rate, $user_name);

   } else if ($_POST['toFun'] == "deleteComment")  
   {
      
      $commentId = $_POST['deletedCommentId'];
      deleteComment($commentId, $conn);
   }
}


function askQuestion($currentUser, $title, $question, $conn)
{
   $currentDate = date("Y-m-d");

   $sql = "INSERT INTO question (user_name, title, descriptionText, qDate, num_ans) VALUES ('$currentUser','$title','$question','$currentDate', 0)";
   $conn->query($sql);
   header("Location:homePage.php");
   exit();
}

function addAnswer($currentUser, $questionId, $answer, $conn)
{
   $sql = "INSERT INTO answers (answerText, user_name, questionId) VALUES ('$answer','$currentUser','$questionId')";
   $conn->query($sql);
   $sql = "UPDATE question SET num_ans = num_ans + 1 WHERE id = '$questionId'";
   $conn->query($sql);
   header("Location:answers.php?questionId=$questionId");
   exit();
}

function addComment($currentUser, $AQId, $textField, $conn, $type)
{
   if($type == 'question')
   {
      $sql = "INSERT INTO questionComments (user_name, questionId, textField) VALUES ('$currentUser','$AQId','$textField')";
      $conn->query($sql);
   }else 
   {
      $sql = "INSERT INTO comments (user_name, answerId, textField) VALUES ('$currentUser','$AQId','$textField')";
      $conn->query($sql);
   }
   header("Location:answers.php");
   exit();
}

function deleteQuestion($questionId, $conn)
{
   $sql = "DELETE FROM question WHERE id = '$questionId'";
   $conn->query($sql);
   header("Location:homePage.php");
   exit();
}

function deleteAnswer($answerId, $conn)
{
   $sql = "DELETE FROM answers WHERE id = '$answerId'";
   $conn->query($sql);
   header("Location:homePage.php");
   exit();
}

function rateAnswer($answerId, $conn, $rate, $user_name)
{
   $sql = "INSERT INTO rating (answerId, user_name, rate) VALUES ('$answerId', '$user_name', '$rate')";
   $conn->query($sql);
   header("Location:answers.php");
   exit();
}

function editAnswer($answerId,$text,$conn)
{
   $sql = "UPDATE answers SET answerText = '$text' WHERE id = '$answerId'";
   $conn->query($sql);
   header("Location:homePage.php");

}

function editQuestion($questionId, $title, $text, $conn)
{
   $sql = "UPDATE question SET title = '$title' WHERE id = '$questionId'";
   $conn->query($sql);
   $sql = "UPDATE question SET descriptionText = '$text' WHERE id = '$questionId'";
   $conn->query($sql);
   header("Location:homePage.php");
}

function deleteComment($commentId, $conn)
{
   $sql = "DELETE FROM comments WHERE id = '$commentId'";
   $conn->query($sql);
   header("Location:homePage.php");
   exit();
}
