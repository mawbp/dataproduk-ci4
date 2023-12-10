<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/form', 'Home::formData');
$routes->get('/showproduct', 'Home::showProduct');
$routes->post('/cobaform', 'Home::cobaForm');
$routes->post('/addproduct', 'Home::addProduct');
$routes->post('/getproduct', 'Home::getProduct');
$routes->post('/editproduct', 'Home::editProduct');
$routes->post('/deleteproduct', 'Home::deleteProduct');
$routes->post('/uploadimg', 'Home::uploadImage');

// API Routes
$routes->get('/api', 'Api::index');
$routes->post('/api/tambah', 'Api::tambah');
$routes->post('/api/cari', 'Api::cari');
$routes->post('/api/hapus',  'Api::hapus');
$routes->post('/api/edit',  'Api::edit');