<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>KasKu<?= isset($title) ? ' - ' . $title : ''; ?></title>
    
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .card-custom {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary-custom:hover {
            opacity: 0.9;
            color: white;
        }

        /* PERBAIKAN UX MOBILE */
        input, select, textarea {
            font-size: 16px !important; 
        }

        /* CUSTOM SCROLLBAR TABEL */
        /* Untuk Firefox */
        .table-responsive {
            scrollbar-width: thin;
            scrollbar-color: #667eea #f1f1f1; 
        }
        /* Untuk Chrome, Edge, Safari */
        .table-responsive::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1; 
            border-radius: 4px;
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background: #aaa; 
            border-radius: 4px;
        }
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #667eea; 
        }


        @media (max-width: 768px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            .card-custom {
                margin-top: 20px; 
            }

            .dropdown-menu-end {
                right: -30px !important;
                left: auto !important;
                width: 270px !important;
                max-width: 90vw !important;
                position: absolute !important;
            }
            
            .dropdown-item {
                white-space: normal;
            }
            
            .navbar .d-flex.align-items-center {
                margin-left: auto;
            }
        }

        
    </style>
</head>
<body>

    <?= $this->renderSection('content'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>