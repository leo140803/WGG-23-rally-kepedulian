<?php


namespace App\Controllers;
use CodeIgniter\Controller;

class Assets extends Controller 
{

    public function index()
    {
        $permalink  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $exp        = @explode('/assets/', $permalink)[1];
        $permalink  = isset($exp) ? $exp : '';

        if (!empty($permalink))
        {
            $getfile = basename($permalink);
            $ext     = explode('.', $getfile);

            if (isset($ext[1]))
            {
                $ext = $ext[count($ext)-1];
                $ext = strtolower($ext);

                $array_mime     = [
                    'css'   => 'text/css',
                    'sccs'  => 'text/less',
                    'js'    => 'text/javascript',
                    'json'  => 'application/json',
                    'pdf'   => 'application/pdf',
                    'png'   => 'image/png',
                    'jpg'   => 'image/jpeg',
                    'jpeg'  => 'image/jpeg',
                    'gif'   => 'image/gif',
                    'ico'   => 'image/x-icon',
                    'map'   => 'application/octet-stream',
                    'eot'   => 'application/vnd.ms-fontobject',
                    'svg'   => 'image/svg+xml',
                    'svgz'  => 'image/svg+xml',
                    'bmp'   => 'image/x-bmp',
                    'webp'   => 'image/webp',
                    'ttf'   => 'font/ttf',
                    'woff'  => 'font/woff',
                    'woff2' => 'font/woff2',
                    'otf'   => 'font/opentype',
                    'avi'   => 'video/avi',
                    'mp4'   => 'video/mp4',
                    '3gp'   => 'video/3gpp',
                    'webm'  => 'video/webm',
                    'webmanifest' => 'application/manifest+json',
                    'txt' => 'text/plain'
                ];


                if (array_key_exists($ext, $array_mime))
                {
                    $cek_file = '../assets/'.$permalink;
                    if (file_exists($cek_file))
                    {
                        $expiration = 86400 * 7; // 7 hari
                        $currentTimestamp = time();

                        if (filesize($cek_file) > 25600) {
                            header("Cache-control: public");
                            header("Expires: ".gmdate('D, d M Y H:i:s \G\M\T', $currentTimestamp + $expiration) . "GMT");
                            header("Last-Modified: ".gmdate('D, d M Y H:i:s \G\M\T', $currentTimestamp) . "GMT");
                        }
                        else {
                            header("Cache-Control: no-cache, must-revalidate");
                            header("Pragma: no-cache");
                        }

                        header('Content-Type: '.$array_mime[$ext]);
                        echo file_get_contents($cek_file);
                        exit;
                    }
                }
            }
        }

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    
}