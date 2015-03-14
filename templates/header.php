<!DOCTYPE html>

<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

        <!-- homebrew-launchpad.com custom css -->
        <link href="/css/custom.css" rel="stylesheet"/>

        <?php 
            if (isset($title)) {
            print("<title>Homebrew Launchpad: " . htmlspecialchars($title) . "</title>");
            }
            else {
            print("<title>Homebrew Launchpad</title>");
            }
        ?>

        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <?php
            if (isset($title) && $title == "Recipe Calculator") {
                print('<script src="/js/calculator.js"></script>
                       <script src="/js/formulas.js"></script>
                       <script src="/js/library.js"></script>
                       <script src="/js/recipes.js"></script>
                       <script src="/js/variables.js"></script>
                       <script src="/js/write.js"></script>');
            }
        ?>
    </head>

    <body>
        <div class="container page">
            <div class="row">
                <div class="col-xs-12" id="top">
                    <a href="/"><img alt="Homebrew Launchpad" src="/img/logo.png"/></a>
                    <ul class="nav nav-pills">
                        <li class="active"><a href="recipe.php"><strong>Recipe Calculator</strong></a></li>
                        <li><a href="style_guidelines.php"><strong>Styles</strong></a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <strong>Ingredients Database</strong> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="malt_extracts.php"><strong>Malt Extracts</strong></a></li>
                                <li><a href="specialty_grains.php"><strong>Specialty Grains</strong></a></li>
                                <li><a href="hops.php"><strong>Hops</strong></a></li>
                                <li><a href="yeast.php"><strong>Yeast</strong></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="row">