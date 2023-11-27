<?php

class BookManager 
{
    private $books = array();

    public function getBooks()
    {
        return $this->books;
    }
    public function addBook($title, $author, $price)
    {
        $temp = [
            'title' => $title,
            'author' => $author,
            'price' => $price
        ];

        array_push($this->books, $temp);
    }
    public function removeBook($title)
    {
        foreach($this->books as $key => $book){
            if($book['title'] == $title){
                array_splice($this->books, $key, 1);
            }
        }
        reset ($this->books);
    }
}
?>