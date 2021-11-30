<?php

$loader = new Twig\Loader\FilesystemLoader(__DIR__."/templates");
$twig = new Twig\Environment($loader);

include dirname(__FILE__).'/functions.php';

$twig->addGlobal('title', "Repositories - WebServer");

$function_stylesheets = new Twig\TwigFunction('stylesheets', function () {
    echo get_stylesheets(['normalize', 'master']);
});
$function_javascripts = new Twig\TwigFunction('javascripts', function () {
    echo get_javascripts(['master']);
});
$function_svg = new Twig\TwigFunction('svg', function (string $name) {
    echo get_svg($name);
});

$twig->addFunction($function_stylesheets);
$twig->addFunction($function_javascripts);
$twig->addFunction($function_svg);

$html = $twig->render("dashboard.html.twig", ['versions' => get_versions(), 'repositories' => get_repositories()]);

echo $html;