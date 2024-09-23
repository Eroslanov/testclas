<?php

require_once 'Library.php';

use PHPUnit\Framework\TestCase;

class LibraryTest extends TestCase {
    public function testAddBook() {
        $library = new Library();
        $book = new Book("Книга 1", "Автор 1", 2021, "Жанр 1");
        $library->addBook($book);
        
        $allBooks = $library->listAllBooks();
        $this->assertCount(1, $allBooks);
        $this->assertContains("Название: Книга 1\nАвтор: Автор 1\nГод публикации: 2021\nЖанр: Жанр 1", $allBooks);
    }
    
    public function testRemoveBookByTitle() {
        $library = new Library();
        $book1 = new Book("Книга 1", "Автор 1", 2021, "Жанр 1");
        $book2 = new Book("Книга 2", "Автор 2", 2022, "Жанр 2");
        $library->addBook($book1);
        $library->addBook($book2);
        
        $library->removeBookByTitle("Книга 1");
        
        $allBooks = $library->listAllBooks();
        $this->assertCount(1, $allBooks);
        $this->assertContains("Название: Книга 2\nАвтор: Автор 2\nГод публикации: 2022\nЖанр: Жанр 2", $allBooks);
    }
    
    public function testFindBooksByAuthor() {
        $library = new Library();
        $book1 = new Book("Книга 1", "Автор 1", 2021, "Жанр 1");
        $book2 = new Book("Книга 2", "Автор 2", 2022, "Жанр 2");
        $book3 = new Book("Книга 3", "Автор 1", 2023, "Жанр 3");
        $library->addBook($book1);
        $library->addBook($book2);
        $library->addBook($book3);
        
        $foundBooks = $library->findBooksByAuthor("Автор 1");
        
        $this->assertCount(2, $foundBooks);
        $this->assertEquals("Книга 1", $foundBooks[0]->title);
        $this->assertEquals("Книга 3", $foundBooks[1]->title);
    }
}