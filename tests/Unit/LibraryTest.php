<?php

use PHPUnit\Framework\TestCase;

require_once('./src/Library.php');

class LibraryTest extends TestCase
{
    /**
     * @dataProvider libraryDataProvider
     */
    public function testLibrary($operation, $title, $author, $availableCopies, $expected) {
        
        $library = new Library();

        if($operation == 'addBook'){

            if($title == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Title cannot be empty');

            }else if(!is_string($title) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Title must be a string');
            }else if($author == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Author cannot be empty');
            }else if(!is_string($author) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Author must be a string');
            }else if($availableCopies == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('AvailableCopies cannot be empty');
            }else if(!is_int($availableCopies) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('AvailableCopies must be a integer');
            }else if($availableCopies < 0) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('AvailableCopies must be a positive integer');
            }

            $result = $library->addBook($title, $author, $availableCopies);

        }else if($operation == 'borrowBook'){

            $index = 0;

            $library->addBook('Harry Potter', 'J.K. Rowling', 1);

            foreach($library->getBooks() as $key => $book){
                if($book->getTitle() == $title){
                    $index = 1;
                }
            }

            if($title == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Title cannot be empty');
            }else if(!is_string($title) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Title must be a string');
            }else if(!is_int($availableCopies) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('NumberOfCopies must be a integer');
            }else if($availableCopies < 1) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('NumberOfCopies must be a positive integer');
            }else if($library->getAvailableCopies($title) < $availableCopies) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('NumberOfCopies must be less than available copies');
            }else if($index == 0){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Book not found');
            }

            $result = $library->borrowBook($title, $availableCopies);

        }else if($operation == 'returnBook'){

            $library->addBook('Harry Potter', 'J.K. Rowling', 3);

            $index = 0;

            foreach($library->getBooks() as $key => $book){
                if($book->getTitle() == $title){
                    $index = 1;
                }
            }

            if($title == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Title cannot be empty');
            }else if(!is_string($title) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Title must be a string');
            }else if(!is_int($availableCopies) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('NumberOfCopies must be a integer');
            }else if($availableCopies < 1) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('NumberOfCopies must be a positive integer');
            }else if($index == 0){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Book not found');
            }

            $result = $library->borrowBook($title, $availableCopies);



        }else if($operation == 'searchByTitle'){
            $library->addBook('Harry Potter', 'J.K. Rowling', 3);

            $index = 0;

            foreach($library->getBooks() as $key => $book){
                if($book->getTitle() == $title){
                    $index = 1;
                }
            }

            if($title == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Title cannot be empty');
            }else if(!is_string($title) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Title must be a string');
            }else if($index == 0){
                $this->expectException(OutOfRangeException::class);
                $this->expectExceptionMessage('Book not found');
            }

            $result = $library->searchByTitle($title);
        }

        $this->assertEquals($expected, $result);
    }
    
    public function libraryDataProvider() {
        return [
            ['addBook', 'Harry Potter', 'J.K. Rowling', 5, true],
            ['addBook', 'Harry Potter', 'J.K. Rowling', 0, false],
            ['addBook', 'Harry Potter', 'J.K. Rowling', -1, false],
            ['addBook', '', 'J.K. Rowling', 5, false],
            ['addBook', 'Harry Potter', '', 5, false],
            ['addBook', '', '', 5, false],
            ['addBook', 'Harry Potter', 'J.K. Rowling', '', false],
            ['addBook', 'Harry Potter', 'J.K. Rowling', '5', false],
            ['addBook', 'Harry Potter', 'J.K. Rowling', 'five', false],
            ['addBook', 'Harry Potter', 'J.K. Rowling', '0', false],

            ['borrowBook', 'Harry Potter', '', 2, true],
            ['borrowBook', 'Harry Potter', '', 0, false],
            ['borrowBook', 'Harry Potter', '', -1, false],
            ['borrowBook', '', '', 2, false],
            ['borrowBook', 'Harry Potter', '', '', false],
            ['borrowBook', '', '', '', false],
            ['borrowBook', 'Harry Potter', '', '2', false],
            ['borrowBook', 'Harry Potter', '', 'two', false],

            ['returnBook', 'Harry Potter', '', 2, true],
            ['returnBook', 'Harry Potter', '', 0, false],
            ['returnBook', 'Harry Potter', '', -1, false],
            ['returnBook', '', '', 2, false],
            ['returnBook', 'Harry Potter', '', '', false],
            ['returnBook', '', '', '', false],
            ['returnBook', 'Harry Potter', '', '2', false],
            ['returnBook', 'Harry Potter', '', 'two', false],

            ['searchByTitle', 'Harry Potter', '', '', true],
            ['searchByTitle', '', '', '', false],
            ['searchByTitle', 'Sherahazade', '', '', true],
            ['searchByTitle', 1984, '', '', true],
        ] ;
    }
}


?>