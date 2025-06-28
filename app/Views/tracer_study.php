<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Tracer Study POLBAN' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #0056b3;
            margin-bottom: 20px;
        }
        h2 {
            color: #007bff;
            margin-top: 30px;
            padding-bottom: 5px;
            border-bottom: 2px solid #eee;
        }
        h3 {
            color: #0069d9;
            margin-top: 25px;
        }
        strong {
            font-weight: 600;
        }
        .contact-person {
            margin-bottom: 15px;
        }
        .address {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($about)): ?>
            <!-- Halaman Tentang -->
            <div class="about-section">
                <?= $about['content'] ?>
            </div>
        <?php endif; ?>

        <?php if (isset($contact)): ?>
            <!-- Halaman Kontak -->
            <div class="contact-section">
                <?= $contact['address']['content'] ?>
                
                <?php if (!empty($contact['surveyors'])): ?>
                    <div class="surveyors-section mt-4">
                        <?= $contact['surveyors']['content'] ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>