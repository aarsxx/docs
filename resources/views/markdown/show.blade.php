<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown Viewer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/4.0.0/github-markdown.min.css">
     <style>
            .markdown-container {
                margin: 50px;
            }
     </style>
</head>
<body class="p-8">
       <div class="markdown-body">
           {!! $html !!}
       </div>
</body>
</html>
