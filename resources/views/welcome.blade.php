<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VitroLib - Marketplace Vitrage Automobile</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: Inter, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #F8FAFC;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            text-align: center;
            padding: 2rem;
        }
        .logo {
            font-size: 3rem;
            font-weight: 700;
            color: #2563EB;
            margin-bottom: 1rem;
        }
        .tagline {
            color: #475569;
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        .status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #10B981;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 500;
        }
        .status::before {
            content: '✓';
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">VitroLib</div>
        <p class="tagline">Le Doctolib du vitrage automobile</p>
        <span class="status">Laravel 11 + DDD Ready</span>
    </div>
</body>
</html>
