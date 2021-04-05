<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface BookInterface
{
    public function getBooks(Request $request);
    public function createBook(Request $request);
}
