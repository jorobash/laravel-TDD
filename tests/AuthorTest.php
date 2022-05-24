<?php

namespace Tests;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class AuthorTest extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;

    /** @test */
    public function only_author_name_is_required()
    {
        Author::firstOrCreate([
           'name' => 'John doe'
        ]);

        $this->assertCount(1,Author::all());
    }
}
