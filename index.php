<?php
    if (isset($_POST['action'])) {
        $text = $_POST['text'];
        $file = $_POST['file'];

        file_put_contents($file, $text);

        echo '<script>alert("File saved successfully!")</script>';
    }
?>

<!DOCTYPE html>

<html lang="pt-br">

	<head>
		<title>Projeto</title>

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0" />
		
		<!--Tags para seo-->
		<meta name="description" content="Projeto" />
		<meta name="keyword" content="projeto, web, design, site" />
		<meta name="author" content="João G. Bortoletto" />
		<!----------------->

		<!--Compatibilidade-->
		<meta http-equiv="X-AU-Compatible" content="IE-Edge" />
		<!------------------->

		<!--Estilização-->
		<link href="css/style.css" type="text/css" rel="stylesheet" />
		<!--------------->

        <!--Icone-->
        <link rel="apple-touch-icon" sizes="180x180" href="assets/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/icons/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <!--------->

	</head>

	<body>

        <header>
            <div class="container">
                <div class="left">
                    <a class="logo" href="#">File.Editor</a>
                </div><!--left-->

                <div class="right">
                    <ul>
                        <li><a href="#">Home</a></li>
                    </ul><!--ul-->
                </div><!--right-->
            </div><!--container-->
        </header><!--header-->

        <section class="list-files">
            <div class="container title">
                <div class="line"></div><!--line-->
                <h2>Choose a file</h2>
            </div><!--container-->

            <div class="buttons">
                <?php
                    $files = scandir('files');

                    for ($i = 0; $i < count($files); $i++) {
                        if (is_dir($files[$i]))
                            continue;

                        $file_extension = explode('.', $files[$i]);
                        if (@$file_extension[1] == 'php' || @$file_extension[1] == 'html' || @$file_extension[1] == 'js') {
                ?>
                            <div class="list-files-single">
                                <a href="?file=<?= $files[$i]; ?>"><?= $files[$i]; ?></a>
                            </div><!--list-files-single-->
                <?php
                        }
                    }

                    if (isset($_GET['file']) && file_exists('files/'.$_GET['file'])) {
                ?>
                        <div id="area" class="container">
                            
                            <form method="post">
                                <h2>Chosen File: <span><?php $chosen_file = explode('.', $_GET['file']); echo @$chosen_file[0]; ?></span></h2>
                                <textarea name="text"><?php echo file_get_contents('files/'.$_GET['file']) ?></textarea>
                                <input type="hidden" name="file" value="files/<?= $_GET['file']; ?>" />
                                <input type="submit" name="action" value="Save!" />
                            </form><!--form-->
                        </div><!--container-->
                <?php
                    }
                ?>
            </div><!--buttons-->
        </section><!--list-files-->

		<!--Externos-->
        <script>
            if (window.history.replaceState) { 
                window.history.replaceState(null, null, window.location.href); 
            }
        </script>
		<!------------>

	</body>
</html>
