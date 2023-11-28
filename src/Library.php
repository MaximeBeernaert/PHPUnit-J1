<?php
require_once('Book.php');
class Library
{
    private $books = array();

    public function addBook($title, $author, $availableCopies)
    {
        $book = new Book($title, $author, $availableCopies);

        foreach($this->books as $key => $book){
            if($book->getTitle() == $title){
                $this->returnBook($title, $availableCopies);
            }
        }

        if($title == '') {
            throw new InvalidArgumentException('Title cannot be empty');
        }else if(!is_string($title) ) {
            throw new InvalidArgumentException('Title must be a string');
        }else if($author == '') {
            throw new InvalidArgumentException('Author cannot be empty');
        }else if(!is_string($author) ) {
            throw new InvalidArgumentException('Author must be a string');
        }else if($availableCopies == '') {
            throw new InvalidArgumentException('AvailableCopies cannot be empty');
        }else if(!is_int($availableCopies) ) {
            throw new InvalidArgumentException('AvailableCopies must be a integer');
        }else if($availableCopies < 0) {
            throw new InvalidArgumentException('AvailableCopies must be a positive integer');
        }

        array_push($this->books, $book);
        return true;
    }

    public function borrowBook($title, $numberOfCopies)
    {
        $index = 0;
        if($title == '') {
            throw new InvalidArgumentException('Title cannot be empty');
        }else if(!is_string($title) ) {
            throw new InvalidArgumentException('Title must be a string');
        }else if(!is_int($numberOfCopies) ) {
            throw new InvalidArgumentException('NumberOfCopies must be a integer');
        }else if($numberOfCopies < 1) {
            throw new InvalidArgumentException('NumberOfCopies must be a positive integer');
        }else if($this->getAvailableCopies($title) < $numberOfCopies) {
            throw new InvalidArgumentException('NumberOfCopies must be less than available copies');
        }

        foreach($this->books as $key => $book){
            if($book->getTitle() == $title){
                $book->setAvailableCopies($book->getAvailableCopies() - $numberOfCopies);
                $index = 1;
            }
        }

        if($index == 0){
            throw new InvalidArgumentException('Book not found');
        }

        return true;
    }

    public function returnBook($title, $numberOfCopies)
    {
        $index = 0;
        if($title == '') {
            throw new InvalidArgumentException('Title cannot be empty');
        }else if(!is_string($title) ) {
            throw new InvalidArgumentException('Title must be a string');
        }else if(!is_int($numberOfCopies) ) {
            throw new InvalidArgumentException('NumberOfCopies must be a integer');
        }else if($numberOfCopies < 1) {
            throw new InvalidArgumentException('NumberOfCopies must be a positive integer');
        }



        foreach($this->books as $key => $book){
            if($book->getTitle() == $title){
                $book->setAvailableCopies($book->getAvailableCopies() + $numberOfCopies);
                $index = 1;
            }
        }

        if($index == 0){
            throw new InvalidArgumentException('Book not found');
        }

        return true;
    }

    public function getAvailableCopies($title)
    {
        foreach($this->books as $key => $book){
            if($book->getTitle() == $title){
                return $book->getAvailableCopies();
            }
        }
        return true;
    }

    public function getBooks()
    {
        return $this->books;
    }

    public function searchByTitle($title)
    {
        $result = array();
        
        if($title == '') {
            throw new InvalidArgumentException('Title cannot be empty');
        }else if(!is_string($title) ) {
            throw new InvalidArgumentException('Title must be a string');
        }

        foreach($this->books as $key => $book){
            if($book->getTitle() == $title){
                // array_push($result, $book);
                return true;
            }
        }

        if($result == []) {
            throw new OutOfRangeException('Book not found');
        }

        // return $result;
    }


}
?>