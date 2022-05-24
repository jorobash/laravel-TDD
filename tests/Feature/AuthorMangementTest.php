<?php

namespace Tests\Feature;

use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorMangementTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function an_author_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/author',[
           'name' => 'Author Name',
           'dob' => '05/14/1988'
        ]);

        $authors = Author::all();
        $this->assertCount(1,$authors);
        $this->assertInstanceOf(Carbon::class,$authors->first()->dob);
        $this->assertEquals('1988/05/14',Carbon::parse($authors->first()->dob)->format('Y/m/d'));
    }
}
