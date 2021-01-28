<?php
$http = ($_SERVER['HTTPS'] === "on")?'https':'http';
define('LANG', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
define('ABSPATH', $_SERVER['DOCUMENT_ROOT']."repositories/");
define('URIPATH', $http."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);

function get_folder_path(string $path): string
{
    return ABSPATH.'.index/'.$path;
}

function get_folder_uri_path(string $path): string
{
    return URIPATH.'.index/'.$path;
}

function stylesheets(array $files)
{
    if($files):
    ob_start();
    foreach ($files as $file): ?>
        <link rel="stylesheet" href="<?php echo get_folder_uri_path("assets/stylesheets/$file.css"); ?>">
    <?php
    endforeach;
    $html = ob_get_clean();
    echo $html;
    endif;
}

function javascripts(array $files)
{
    if($files):
        ob_start();
        foreach ($files as $file): ?>
            <script defer="defer" src="<?php echo get_folder_uri_path("assets/javascripts/$file.js"); ?>"></script>
        <?php
        endforeach;
        $html = ob_get_clean();
        echo $html;
    endif;
}

function get_svg(string $name)
{
  return file_get_contents(get_folder_path("assets/icons/".$name.".svg"));
}


function get_repositories(): array
{
    $repositories = [];
    $directories = new DirectoryIterator(ABSPATH);
    foreach ($directories as $directory) {
        if($directory->isDot() || !$directory->isDir() || $directory->getBasename() === ".index") continue;


        $repositories[] = [
            'name' => strtolower($directory->getBasename()),
            'path' => $directory->getPathname(),
            'url' => URIPATH.$directory->getBasename(),
            #'size' => get_folder_size($repository)
            'last_update_at' => $directory->getATime(),
            'type' => get_type($directory->getPathname())
        ];
    }

    return $repositories;
}

function sizeFilter($bytes)
{
    $label = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');

    for ($i = 0; $bytes >= 1024 && $i < (count($label) - 1); $bytes /= 1024, $i++);

    return (round($bytes, 2) . " " . $label[$i]);
}

function get_type($path)
{
    $type = ['class' => "other", 'name' => "Other"];

    if (file_exists($path.'/Movefile')){
        $type = ['class' => "wordpress", 'name' => "Wordpress"];
    } elseif (is_dir($path.'/app')){
        $type = ['class' => "prestashop", 'name' => "Prestashop"];
    }elseif (is_dir($path.'/web')){
        $type = ['class' => "api", 'name' => "API"];
    }elseif (is_dir($path.'/keystore') || is_dir($path.'/src-cordova')){
        $type = ['class' => "app", 'name' => "Application"];
    }

    return $type;
}
