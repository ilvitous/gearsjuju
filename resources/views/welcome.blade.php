<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GearsJuJu</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    
   <link rel="stylesheet" href="{{ URL::to('/css/app.css') }}">
   

    
    
    <link rel="stylesheet" href="https://use.typekit.net/dtq4agk.css">
    
    

</head>
<body>
    <div class="container">
        <div id="app"></div>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>