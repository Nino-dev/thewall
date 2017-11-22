 <?php
		include 'db/dbconnect.php';
		include 'views/heading.php';
    include 'views/header.php';

    include 'views/'.$_GET['page'].'.php';
    include 'views/footer.php';
