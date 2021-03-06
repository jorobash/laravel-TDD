<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationsTest extends TestCase
{
    /** @test */

    use RefreshDatabase;

    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books',[
            'title' => 'Tittle Book',
            'author' => 'Joro'
        ]);

        $book = Book::first();

//        $response->assertOk();

        $this->assertCount(1, Book::all());

        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_title_is_required()
    {
//        $this->withoutExceptionHandling();

        $response = $this->post('/books',[
           'title' => '',
           'author' => 'Joro'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {
//        $this->withoutExceptionHandling();
        $response = $this->post('/books',[
           'title' => 'Title',
           'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {

        $this->withoutExceptionHandling();

        $this->post('/books',[
            'title' => 'Cool title',
            'author' => 'Joro'
        ]);

        $book = Book::first();

        $response = $this->patch('/books/'.$book->id,[
            'title' => 'New Title',
            'author' => 'Joro'
        ]);

        $this->assertEquals('New Title',Book::first()->title);
        $this->assertEquals('Joro',Book::first()->author);

        $response->assertRedirect($book->fresh()->path());
    }

    /** @test */
    public function a_book_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/books',[
           'title' => 'Title',
           'author' => 'Joro'
        ]);

        $book = Book::first();
        $this->assertCount(1,Book::all());

        $response = $this->delete('/books/'.$book->id);

        $this->assertCount(0,Book::all());

        $response->assertRedirect('/books');
    }
}
