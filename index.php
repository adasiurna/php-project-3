<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Navigation.php';
require_once 'Page.php';

// $page = Page::findOne(1);
// $page->setHeading('New heading 123');
// $page->save();

require_once 'functions.php';
require_once 'config.php';

include 'header.php';

?>

<div class="container">
    Minimalistinė turinio valdymo sistema
</div>

<div class="container">
    Neprisijungęs vartotojas čia matys: 1. sugeneruotą meniu, kuris buvo nurodytas administratoriaus, kiekviename puslapyje 2. Paspaudus ant meniu nueina į puslapio peržiūrą. 3. Puslapio peržiūroje mato puslapio antraštę ir turinį
</div>


<?php include 'includes/footer.php'?>