<?php

class Book {
    public $title;
    public $author;
    public $publishedYear;
    public $genre;

    public function __construct($title, $author, $publishedYear, $genre) {
        $this->title = $title;
        $this->author = $author;
        $this->publishedYear = $publishedYear;
        $this->genre = $genre;
    }

    public function getBookInfo() {
        return "Название: " . $this->title . "\n" .
               "Автор: " . $this->author . "\n" .
               "Год публикации: " . $this->publishedYear . "\n" .
               "Жанр: " . $this->genre;
    }
}

class Library {
    private $books;

    public function __construct() {
        $this->books = [];
    }

    public function addBook(Book $book) {
        $this->books[] = $book;
    }

    public function removeBookByTitle($title) {
        foreach ($this->books as $key => $book) {
            if ($book->title === $title) {
                unset($this->books[$key]);
                return;
            }
        }
        echo "Книга с таким названием не найдена.\n";
    }

    public function findBooksByAuthor($author) {
        $foundBooks = [];
        foreach ($this->books as $book) {
            if ($book->author === $author) {
                $foundBooks[] = $book;
            }
        }
        return $foundBooks;
    }

    public function listAllBooks() {
        $booksInfo = [];
        foreach ($this->books as $book) {
            $booksInfo[] = $book->getBookInfo();
        }
        return $booksInfo;
    }
}


$library = new Library();


while (true) {
    echo "Выберите действие:\n";
    echo "1. Добавить книгу\n";
    echo "2. Показать все книги\n";
    echo "3. Поиск по автору\n";
    echo "4. Выход\n";

    $choice = readline("Введите номер действия: ");

    switch ($choice) {
        case '1':
            $title = readline("Введите название книги: ");
            $author = readline("Введите автора: ");
            $publishedYear = readline("Введите год публикации: ");
            $genre = readline("Введите жанр: ");
            $book = new Book($title, $author, $publishedYear, $genre);
            $library->addBook($book);
            echo "Книга добавлена.\n";
            break;
        case '2':
            $allBooksInfo = $library->listAllBooks();
            if (!empty($allBooksInfo)) {
                echo "Список всех книг в библиотеке:\n";
                foreach ($allBooksInfo as $bookInfo) {
                    echo $bookInfo . "\n\n";
                }
            } else {
                echo "Библиотека пуста.\n";
            }
            break;
        case '3':
            $author = readline("Введите автора: ");
            $foundBooks = $library->findBooksByAuthor($author);
            if (!empty($foundBooks)) {
                echo "Информация о книгах автора:\n";
                foreach ($foundBooks as $book) {
                    echo $book->getBookInfo() . "\n\n";
                }
            } else {
                echo "Книги автора не найдены.\n";
            }
            break;
        case '4':
            echo "Выход.\n";
            exit(0);
        default:
            echo "Неверный выбор.\n";
    }
}