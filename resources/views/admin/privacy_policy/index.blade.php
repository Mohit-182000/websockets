<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Privacy Policy</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    
    <nav class="navbar navbar-light bg-light">
        <a href="" class="brand-link">
            <img src="{{ $setting->logo_image ?? null }}" alt="{{ $settings->store_name }}" height="50px" width="50px">
            <span class="brand-text font-weight-light">{{ $settings->store_name ?? ''}}</span>
        </a>
    </nav>

    <div class="container-fluid bg-dark text-white d-flex justify-content-center" style="height: 230px">
        <div style="margin-top:90px;">
            <h2>Privacy Policy</h2>
        </div>
    </div>

    <div class="container">
        {!! $settings->privacy_policy ?? null !!}
    </div>

</body>
</html>