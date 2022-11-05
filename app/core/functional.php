<?php
function getBaseUrl()
{
    $hostName = $_SERVER['HTTP_HOST'];
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
    return $protocol . '://' . $hostName . BASE_DIR;
}
function View($file, $data = [])
{
    $theme = new SimpleTemplateEngine\Environment('views');
    echo $theme->render($file . '.php', $data);
}
function CetakInit($file)
{
    $modelna = new Index();
    $modelna->set($file);
    $theme = new SimpleTemplateEngine\Environment('views');
    $data['data'] = $modelna;
    $data['old']  = Oldata::get();
    echo $theme->render($file . '.php', $data);
}
function CetakInitf($file, $folder, $p1 = null, $p2 = null, $p3 = null)
{
    $modelna = new Index();
    $modelna->set($folder);
    $theme = new SimpleTemplateEngine\Environment('views');
    $data['data'] = $modelna;
    $data['p1'] = $p1;
    $data['p2'] = $p2;
    $data['p3'] = $p3;
    $data['get']  = $_GET;
    $data['old']  = Oldata::get();
    echo $theme->render($folder . '/' . $file . '.php', $data);
}
