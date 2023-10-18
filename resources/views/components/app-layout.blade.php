 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="https://laravel.com/img/logomark.min.svg" type="image/x-icon">
     <title>{{ config('app.name') }}</title>
     @vite(['resources/css/app.css', 'resource s/app/app.js'])
 </head>

 <body>
     <div class="max-w-2xl mt-32 mx-auto">
         {{ $slot }}
     </div>
 </body>

 </html>
