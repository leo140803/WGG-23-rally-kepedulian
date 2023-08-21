<?php


namespace App\Controllers;

use CodeIgniter\Controller;


class Uploads extends Controller
{

   public function index()
   {
      $permalink = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $exp = @explode('/uploads/', $permalink)[1];
      $permalink = isset($exp) ? $exp : '';

      if (!empty($permalink)) {
         $getfile = basename($permalink);
         $ext = explode('.', $getfile);

         if (isset($ext[1])) {
            $ext = $ext[count($ext) - 1];
            $ext = strtolower($ext);

            // Extensi yang berbahaya
            $array_mime = [
               'bak',
               'dist',
               'htaccess',
               'htpasswd',
               'ini',
               'fla',
               'psd',
               'log',
               'exe',
               'jsp',
               'asp',
               'htm',
               'html',
               'sh',
               'cgi',
               'py',
               'php',
               'phar',
               'phtml',
               'pht',
               'php3',
               'php4',
               'php5',
               'php7',
               'php8',
               'phps',
               'php-srar',
               'sql',
               'sw[op]',
               'xml',
               'xhtml',
               'bat',
               'bin',
               'config',
               'db',
               'env'
            ];

            $path = WRITEPATH.'uploads/'.$permalink;
            if (!in_array($ext, $array_mime) && file_exists(($path)))
            {
               $file = new \CodeIgniter\Files\File($path);

               header("Cache-Control: no-cache, must-revalidate");
               header("Pragma: no-cache");
               header("Expires: ".gmdate('D, d M Y H:i:s \G\M\T', time() + (86400 * 7)));
               header('Content-Type: '.$file->getMimeType());

               echo file_get_contents($path);
               exit;
            }
         }
      }

      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
   }
}