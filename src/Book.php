<?php

class Book 
{
    private $title;
    private $author;
    private $availableCopies;

    public function __construct($title, $author, $availableCopies)
    {
        $this->title = $title;
        $this->author = $author;
        $this->availableCopies = $availableCopies;
    }

    //GETTERS 
    
    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getAvailableCopies()
    {
        return $this->availableCopies;
    }
    
    // SETTERS

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    } 

    public function setAvailableCopies($availableCopies)
    {
        $this->availableCopies = $availableCopies;
    }

}


?>