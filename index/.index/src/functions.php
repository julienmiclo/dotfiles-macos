<?php
$http = (isset($_SERVER['HTTPS']))?'https':'http';
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

function get_stylesheets(array $files): string
{
    $stylesheets = "";
    if($files){
        foreach ($files as $file){
            $stylesheets .= '<link rel="stylesheet" type="text/css" href="'.get_folder_uri_path('assets/stylesheets/'.$file.'.css').'">';
        }
    }
    return $stylesheets;
}

function get_javascripts(array $files): string
{
    $javascripts = "";
    if($files){
        foreach ($files as $file){
            $javascripts .= '<script type="text/javascript" src="'.get_folder_uri_path('assets/javascripts/'.$file.'.js').'"></script>';
        }
    }
    return $javascripts;
}

function get_svg(string $name)
{
  return file_get_contents(get_folder_path("assets/icons/".$name.".svg"));
}

function get_versions(): array
{
  $versions = [];

  $versions['php'] = [
      'name' => "php",
      'number' => phpversion()
  ];
  $versions['composer'] = [
      'name' => "composer",
      'number' => shell_exec('composer -V')
  ];
  $versions['ruby'] = [
      'name' => "ruby",
      'number' => shell_exec('ruby -v')
  ];
  $versions['node'] = [
      'name' => "node",
      'number' => shell_exec('node -v')
  ];
  $versions['npm'] = [
      'name' => "npm",
      'number' => shell_exec('npm -v')
  ];
  $versions['yarn'] = [
      'name' => "yarn",
      'number' => shell_exec('yarn -v')
  ];
  $versions['brew'] = [
      'name' => "brew",
      'number' => shell_exec('brew -v | head -n 1'),
      'update' => !empty(shell_exec('brew outdated'))
  ];

  return $versions;
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

    usort($repositories, function($a, $b) {
        return $b['last_update_at'] - $a['last_update_at'];
    });

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