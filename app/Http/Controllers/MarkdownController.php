<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Http\Request;

class MarkdownController extends Controller
{
    public function show()
    {
        // Load the Markdown file content
        $markdown = File::get(base_path('README.md'));

        // Convert Markdown to HTML
        $converter = new CommonMarkConverter();
        $html = $converter->convertToHtml($markdown);

        // Return a view with the rendered HTML
        return view('markdown.show', ['html' => $html]);
    }
}
