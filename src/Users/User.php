<?php

namespace Anax\Users;
 
/**
 * Model for Users.
 *
 */
class User extends \Anax\MVC\CDatabaseModel
{       
    
  public function getQuestions($acronym) {
    $sql = "SELECT * FROM kmom07_user
              JOIN kmom07_question
                  ON kmom07_question.name=kmom07_user.acronym";
    $questions =  $this->db->executeFetchAll($sql);
    $res = array();
    foreach($questions as $question) {
      if ($question->acronym == $acronym) {
        array_push($res, $question);
      }
    }
    return $res;
  }
    
    
    
  public function getAnswers($acronym) {
    $sql = "SELECT * FROM kmom07_user
    JOIN kmom07_answer
    ON kmom07_answer.user=kmom07_user.acronym";
    $answers =  $this->db->executeFetchAll($sql);
    $res = array();
    foreach($answers as $answer) {
      if ($answer->acronym == $acronym) {
        array_push($res, $answer);
      }
    }
    return $res;
  }
    
    
    
  public function linkAnswerToQuestion($acronym) {
    $sql = "SELECT * FROM kmom07_question
              JOIN kmom07_answer
                ON kmom07_answer.questionID=kmom07_question.id";
    $answers =  $this->db->executeFetchAll($sql);
    $res = array();
    foreach($answers as $answer) {
      if ($answer->user == $acronym) {
        array_push($res, $answer);
      }
    }
    return $res;
  }
    
    
    
  public function incrementTimesLoggedOn($acronym) {
    $sql = "SELECT timesLoggedOn FROM kmom07_user WHERE acronym = ?";
    $params = array($acronym);
    $timesLoggedOn = $this->db->executeFetchAll($sql, $params);
    $val = $timesLoggedOn[0]->timesLoggedOn;
    $val++;
    $update = "UPDATE kmom07_user SET timesLoggedOn=? WHERE acronym=?;";
    $params2 = array($val, $acronym);
    $this->db->execute($update, $params2);
  }
    
    
    
  public function getMostLoggedOn() {
    $sql = "SELECT * FROM kmom07_user
    ORDER BY timesLoggedOn DESC LIMIT 3;";
    $mostLoggedOn =  $this->db->executeFetchAll($sql);
    return $mostLoggedOn;
  }
    
    
    
  public function checkLogin() {
    if (isset($_SESSION['user'])) {
        return true;
      }else{
        return false;
      }
  }
    
}