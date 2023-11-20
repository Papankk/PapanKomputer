<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');

$routes->get('/home', 'Homepage::index');
$routes->post('/home/search', 'Homepage::search');
$routes->get('/kategori/(:segment)', 'Homepage::kategori/$1');
$routes->get('/brand/(:segment)', 'Homepage::brand/$1');

$routes->get('/produk/(:segment)', 'Item::detail/$1', ['filter' => 'role:user,admin']);
$routes->get('/produk', 'Homepage::index', ['filter' => 'role:user,admin']);

$routes->get('/keranjang', 'Cart::cek', ['filter' => 'role:user,admin']);
$routes->post('/cart/insert', 'Cart::insert', ['filter' => 'role:user,admin']);
$routes->delete('/cart/(:num)', 'Cart::delete/$1', ['filter' => 'role:user,admin']);

$routes->get('/search', 'Homepage::search', ['filter' => 'role:user,admin']);

$routes->get('/admin', 'Admin::index',  ['filter' => 'role:admin']);

$routes->get('/admin/produk/', 'Admin::produk',  ['filter' => 'role:admin']);
$routes->post('/admin/produk/insert', 'Produk::insert', ['filter' => 'role:admin']);
$routes->post('/admin/produk/update/(:num)', 'Produk::update/$1', ['filter' => 'role:admin']);
$routes->delete('/admin/produk/(:num)', 'Produk::delete/$1', ['filter' => 'role:admin']);

$routes->get('/admin/kategori/', 'Admin::kategori', ['filter' => 'role:admin']);
$routes->post('/admin/kategori/insert', 'Kategori::insert', ['filter' => 'role:admin']);
$routes->post('/admin/kategori/update/(:num)', 'Kategori::update/$1', ['filter' => 'role:admin']);
$routes->delete('/admin/kategori/(:num)', 'Kategori::delete/$1', ['filter' => 'role:admin']);

$routes->get('/admin/brand/', 'Admin::brand', ['filter' => 'role:admin']);
$routes->post('/admin/brand/insert', 'Brand::insert', ['filter' => 'role:admin']);
$routes->post('/admin/brand/update/(:num)', 'Brand::update/$1', ['filter' => 'role:admin']);
$routes->delete('/admin/brand/(:num)', 'Brand::delete/$1', ['filter' => 'role:admin']);

$routes->get('/admin/user/', 'Admin::user', ['filter' => 'role:admin']);
$routes->post('/admin/user/update/(:num)', 'User::update/$1', ['filter' => 'role:admin']);
$routes->delete('/admin/user/(:num)', 'User::delete/$1', ['filter' => 'role:admin']);

$routes->get('/payment', 'PaymentGateway::index');
$routes->get('/keranjang/checkout', 'Item::checkout');

$routes->post('/item/kabupaten', 'Item::kabupaten');
$routes->post('/item/kecamatan', 'Item::kecamatan');
