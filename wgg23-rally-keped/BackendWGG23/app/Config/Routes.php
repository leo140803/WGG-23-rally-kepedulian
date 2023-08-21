<?php

namespace Config;

use App\Controllers\Kelompok\Kelompok;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

# Jangan diubah yang ini!
$routes->addPlaceholder('nrp', '[[:alpha:]][0-9]{8}');
$routes->addPlaceholder('pesertaAbsen', '(maba)|(panitia)');
$routes->get('/', 'Home::index');
// $routes->get('/home', 'Home::home', ['filter' => 'login']);

//login routes
$routes->get('/login', 'Login\Login::index');
$routes->get('/login/app', 'Login\Login::loginApp');
$routes->get('/login/(:any)', 'Login\Login::redirect/$1');
$routes->get('/logout', 'Login\Login::logout');
$routes->post('/auth2', "Login\Login::login2");

// games
$routes->group("/games",['filter' => 'device'], function($routes){
    // login
    $routes->get('login', 'Login\LoginGames::index');
    $routes->get('login/(:any)', 'Login\LoginGames::redirect/$1');
    $routes->get('logout', 'Login\LoginGames::logout');
    $routes->post('auth2', "Login\LoginGames::login");
    // faq
    $routes->get('faq', 'Rally\FaqController::user', ['filter' => 'games']);
    // rotasi day 6
    // $routes->get('rotasi', 'Rotasi\Rotasi::view', ['filter' => 'games'],);
    // games keped 
    // $routes->get('scene', 'Rally\Rally::index', ['filter' => 'games']);
    $routes->post('buy', 'Rally\Rally::buy', ['filter' => 'games']);
    // homepage
    $routes->get('/', 'Rally\Homepage::index', ['filter' => 'games']);
});

$routes->get('briefing', 'Briefing\Briefing::web');

$routes->group("/panitia", ['filter' => 'auth'], function($routes){
    $routes->get('/', 'panitia\Home::index');
    $routes->get('adminApp', 'panitia\Home::adminApp');


    $routes->group("photo", function ($routes) {
        $routes->get("/", "panitia\Home::photo");
        $routes->post("/", "panitia\Home::upPhoto");
    });

    $routes->group("rbac", function ($routes) {
        $routes->get("/", "RBAC\AssignRole::index");
        $routes->get("role", "RBAC\AssignRole::role");
        $routes->get("role/(:alphanum)", "RBAC\AssignRole::getRole/$1");
        $routes->post("role/(:alphanum)", "RBAC\AssignRole::setRole/$1");
        $routes->delete("role/(:alphanum)", "RBAC\AssignRole::delRole/$1");

        $routes->get("route", "RBAC\AssignRoute::route");
        $routes->get("route/(:num)", "RBAC\AssignRoute::getRoute/$1");
        $routes->post("route/(:num)", "RBAC\AssignRoute::setRoute/$1");
        $routes->delete("route/(:num)", "RBAC\AssignRoute::delRoute/$1");


        $routes->get("addRole", "RBAC\Role::index");
        $routes->post("addRole", "RBAC\Role::add");
        $routes->put("addRole/(:num)", "RBAC\Role::update/$1");
        $routes->delete("addRole/(:num)", "RBAC\Role::delete/$1");

        $routes->get("addRoute", "RBAC\Route::index");
        $routes->post("addRoute", "RBAC\Route::add");
        $routes->put("addRoute/(:num)", "RBAC\Route::update/$1");
        $routes->delete("addRoute/(:num)", "RBAC\Route::delete/$1");
    });


    $routes->group("data", function ($routes) {
        $routes->get("/", "Data\Data::index");
        $routes->get("panitia/view", "Data\Data::viewPanitia");
        $routes->get("panitia/edit", "Data\Data::editPanitia");
        $routes->put("panitia/edit/(:num)", "Data\Data::deletePanitia/$1");
        $routes->delete("panitia/edit/(:num)", "Data\Data::deletePanitia/$1");

        $routes->get("mahasiswa/view", "Data\Data::viewMahasiswa");
        $routes->get("mahasiswa/edit", "Data\Data::editMahasiswa");
        $routes->put("mahasiswa/edit/(:nrp)", "Data\Data::deleteMahasiswa/$1");
        $routes->delete("mahasiswa/edit/(:nrp)", "Data\Data::deleteMahasiswa/$1");

        $routes->get("mahasiswa/upload", "Data\UploadDataMahasiswa::index");
        $routes->post("mahasiswa/upload", "Data\UploadDataMahasiswa::upload");
        $routes->post("mahasiswa/upload/api", "Data\UploadDataMahasiswa::updateApp");
        $routes->get("fakultas/view", "Data\Master::viewFakultas");
        $routes->get("prodi/view", "Data\Master::viewProdi");
    });

    // absen
    $routes->group('absen', function ($routes) {
        $routes->get('/', 'Absen\Home::index'); 

        $routes->group('(:pesertaAbsen)', function ($routes) {
            $routes->get('/', 'Absen\Kegiatan::index/$1');
            
            $routes->get('(:num)', 'Absen\Home::coba2/$1/$4');
            $routes->get('kegiatan', 'Absen\Kegiatan::index/$1');
            $routes->post('kegiatan', 'Absen\Kegiatan::create/$1');
            $routes->delete('kegiatan/(:num)', 'Absen\Kegiatan::delete/$1/$4');
            $routes->get('kegiatan/(:num)', "Absen\Kegiatan::formEditKegiatan/$1/$4");
            $routes->put('kegiatan/(:num)', 'Absen\Kegiatan::update/$1/$4');
    
            $routes->match(['get', 'post'], 'regis-in/(:num)', 'Absen\Absen::regisIn/$1/$4');
            $routes->match(['get', 'post'], 'regis-out/(:num)', 'Absen\Absen::regisOut/$1/$4');
            
            $routes->get('dataAbsensi/(:num)', 'Absen\DataAbsensi::index/$1/$4');
            $routes->post('fetchDataAbsensi/(:num)', 'Absen\DataAbsensi::fetchDataAbsensi/$1/$4');
            $routes->get('customExport/(:num)', 'Absen\DataAbsensi::customExport/$1/$4');
        });

    });


    //datapoli
    $routes->group('datapoli', function ($routes) {
        $routes->get('/', 'DataPoli\Poli::index');
        $routes->match(['get', 'post'], 'tambahData', 'DataPoli\Poli::tambahdata');
        $routes->post('fillnama', 'DataPoli\Poli::fillnama');
        $routes->match(['get', 'put'], 'sunting/([\w]+)', 'DataPoli\Poli::sunting/$1');
        $routes->post('absenkeluar', 'DataPoli\Poli::absenkeluar');
        $routes->delete('hapus/([\w]+)', 'DataPoli\Poli::hapus/$1');
        $routes->match(['get', 'post'], 'outpoli', 'DataPoli\Poli::outpoli');
        $routes->post('redirtoupdate', 'DataPoli\Poli::redirkeupdate');
    });

    //ijin admin
    $routes->group('ijin', function ($routes) {
        $routes->get('/', 'ijin\Admin::index');
        $routes->post('aksi', 'ijin\Admin::aksi');
        $routes->get('ubah', 'ijin\Admin::ubahIndex');
        $routes->post('bukaTutup', 'ijin\Admin::bukaTutup');
        $routes->delete('deleteTanggal/(:num)', 'ijin\Admin::delete/$1');
        $routes->post('tambahTanggal', 'ijin\Admin::add');
    });

    //games
    $routes->group("games", function ($routes) {
        $routes->get('/','Rally\Rally::panitia');
        //rotasi rally
        $routes->group("rotasi", function ($routes) {
            $routes->get('/', 'Rotasi\Rotasi::view');
            $routes->match(['get', 'post'], 'add', 'Rotasi\Rotasi::add_data');
            $routes->match(['get', 'put'], 'edit/([\w]+)', 'Rotasi\Rotasi::edit_data/$1');
            $routes->delete('delete/([\w]+)', 'Rotasi\Rotasi::delete_data/$1');
            $routes->post('signUpAPI.php', '');
        });

        //faq
        $routes->group('faq', function ($routes) {
            $routes->get('/', 'Rally\FaqController::index');
            $routes->post('save', 'Rally\FaqController::save');
            $routes->get('edit/([\w]+)', 'Rally\FaqController::edit/$1');
            $routes->get('del/([\w]+)', 'Rally\FaqController::del/$1');
        });
        // admin games
        $routes->get('admin', 'Rally\Rally::add_point');
        $routes->post('update_point', 'Rally\Rally::update_point');
    });

    $routes->group('dispensasi', function ($routes) {
        $routes->get('/', 'ijin\Admin::index');
    });

    //Pelanggaran
    $routes->group('pelanggaran', function ($routes) {
        $routes->get('/', function () {
            return redirect()->to(site_url('panitia/pelanggaran/TambahPasal'));
        });
        //Pasal
        $routes->get('TambahPasal', 'Pelanggaran\TambahPasalControl::index');
        $routes->post('TambahPasals', 'Pelanggaran\TambahPasalControl::tambah');

        //Ayat
        $routes->get('TambahAyat', 'Pelanggaran\TambahAyatControl::index');
        $routes->post('TambahAyat', 'Pelanggaran\TambahAyatControl::tambah');

        //Daftar ayat
        $routes->get('list', 'Pelanggaran\ListControl::index');

        //Daftar pasal
        $routes->get('pasalList', 'Pelanggaran\ListControl::pasalIndex');

        //Edit pasal
        $routes->post('editPasal', 'Pelanggaran\TambahPasalControl::edit_data');
        $routes->match(['get', 'put'], 'pasalEdit([\w]+)', 'Pelanggaran\TambahPasalControl::edit/$1');
        $routes->match(['get', 'post'], 'pasalHapus([\w]+)', 'Pelanggaran\TambahPasalControl::hapus/$1');
        $routes->delete('pasalHapus/([\w]+)', 'Pelanggaran\TambahPasalControl::hapus/$1');

        //Edit ayat
        $routes->post('Edit', 'Pelanggaran\TambahAyatControl::edit_data');
        $routes->match(['get', 'put'], 'edit([\w]+)', 'Pelanggaran\TambahAyatControl::edit/$1');
        $routes->match(['get', 'post'], 'hapus([\w]+)', 'Pelanggaran\TambahAyatControl::hapus/$1');
        $routes->delete('hapus/([\w]+)', 'Pelanggaran\TambahAyatControl::hapus/$1');

        //Menginput pelanggaran
        $routes->get('TambahPelanggaran', 'Pelanggaran\TambahPelanggaranControl::index');
        $routes->post('TambahPelanggaran', 'Pelanggaran\TambahPelanggaranControl::tambah');
        $routes->match(['get', 'put'], 'TambahPelanggaran/getMahasiswa([\w]+)', 'Pelanggaran\TambahPelanggaranControl::getMahasiswa/$1');
        $routes->match(['get', 'put'], 'TambahPelanggaran/getAyat([\w]+)', 'Pelanggaran\TambahPelanggaranControl::getAyat/$1');

        //akumulasi poin
        $routes->get('akumulasiPoin', 'Pelanggaran\AkumulasiControl::index');
        $routes->match(['get', 'put'], 'detailSpesifik([\w]+)', 'Pelanggaran\AkumulasiControl::detail/$1');
        $routes->match(['get', 'post'], 'delPelanggaran/([\w]+)/([\w]+)', 'Pelanggaran\AkumulasiControl::hapusPelanggaran/$1/$2');
        $routes->match(['get', 'post'], 'delPeringatan/([\w]+)/([\w]+)', 'Pelanggaran\AkumulasiControl::hapusPeringatan/$1/$2');
        $routes->delete('delPelanggaran/([\w]+)/([\w]+)', 'Pelanggaran\AkumulasiControl::hapusPelanggaran/$1/$2');
        $routes->delete('delPeringatan/([\w]+)/([\w]+)', 'Pelanggaran\AkumulasiControl::hapusPeringatan/$1/$2');
    });
    // Pertanyaan Peserta
    $routes->get('qna-peserta', 'panitia\PertanyaanPeserta::index');

    //routing kelompok -i
    $routes->group('kelompok',function($routes){
        // peran
        $routes->get('/', function() {
            return redirect()->to(site_url('panitia/kelompok/main'));
        });
        $routes->get('main','Kelompok\Kelompok::index2');
        $routes->match(['get','post'],'tambah','Kelompok\Kelompok::tambah');
        $routes->match(['get','put'],'sunting/([\w]+)','Kelompok\Kelompok::sunting/$1');
        $routes->match(['get','delete'],'hapus','Kelompok\Kelompok::delete');
        $routes->match(['get','put'],'sunting/mahasiswa/hapus_kelompok','Kelompok\Kelompok::hapusKelompokMahasiswa');
        $routes->match(['get','put'],'sunting/frontline/hapus_kelompok','Kelompok\Kelompok::hapusKelompokFrontline');
        $routes->match(['get','put'],'sunting/mahasiswa/tambah','Kelompok\Kelompok::tambahAnggota');
        $routes->match(['get','put'],'sunting/frontline/tambah','Kelompok\Kelompok::tambahFrontline');
        $routes->match(['get','put'],'sunting/mahasiswa/set_ketua','Kelompok\Kelompok::setKetua');

        //try
        $routes->get('suggest/([\w]+)','Kelompok\Kelompok::suggest/$1');
        $routes->get('suggest/frontline/([\w]+)','Kelompok\Kelompok::suggestFrontline/$1');
        $routes->get('myteam','Kelompok\Kelompok::myteamIndex');
        $routes->get('list','Kelompok\Kelompok::listIndex');

        // regul
        $routes->group('ruangan', function($routes) {
            $routes->get('/','Kelompok\Kelompok::index');
            $routes->post('editRuang','Kelompok\Kelompok::update');
            $routes->post('editShowHide','Kelompok\Kelompok::hide');
        });
    });

});


// peserta
$routes->group('peserta', ['filter' => 'login'], function ($routes) {
    $routes->get('home', 'Home::peserta');


    // ijin
    $routes->group('ijin', function ($routes) {
        $routes->get('/', 'ijin\Ijin::index');
        $routes->get('insert', 'ijin\Ijin::insertIndex');
        $routes->post('insert', 'ijin\Ijin::insert');
    });

    // Pelanggaran
    $routes->group('pelanggaran', function ($routes) {
        $routes->get('/', 'Pelanggaran\DataPelanggaranControl::index');
    });

    // Pertanyaan Peserta
    $routes->group("qna", function ($routes) {
        $routes->get('/', 'PertanyaanPeserta::index');
        $routes->post('submit', 'PertanyaanPeserta::submit');
    });

    $routes->get('home', 'Home::peserta');

    $routes->get('briefing', 'Briefing\Briefing::index');
    
    $routes->group('kelompok', function($routes){
        $routes->get('/','Kelompok\Maba::index');
    });

    $routes->get('games', function () {
        return view('home/games', ['title' => 'Games']);
    });
});

// rally
// $routes->group('games', function($routes) {
//     $routes->get('/', 'Rally\Rally::index');
//     $routes->post('buy', 'Rally\Rally::buy');
// });

$routes->get('wrongDevice', 'Wrong::index');
$routes->get('assets/(.*)', 'Assets::index');
$routes->get('uploads/(.*)', 'Uploads::index');


# Buat routes kyk biasanya, dibawah!

// $routes->match(['get','post'], 'games/rotasi', 'Rotasi\Rotasi::view');
// $routes->match(['get','post'], 'panitia/games/rotasi', 'Rotasi\Rotasi::view');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
