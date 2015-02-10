<?php

namespace Anax\Comment;

/**
 * Model for Comment.
 *
 */
class Comment extends \Anax\MVC\CDatabaseModel {
    public function pageType($key) {
        
        return $this->query()
                    ->where("pageType = ?")
                    ->execute([$key]); 
    } 
}  