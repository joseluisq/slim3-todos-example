<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

// GET /category
$app->get('/category', function (Request $req, Response $res) {
    $category = $this->db->table('category')->get();
    return respond($res)->ok($category);
});

// GET /category/id
$app->get('/category/{id}', function (Request $req, Response $res, array $args) {
    $id = (int) $args['id'];
    $category = $this->db->table('category')->find($id);
    return respond($res)->ok($category);
});

// POST /category
$app->post('/category', function (Request $req, Response $res) {
    $input = $req->getParams();
    $only = ['name'];

    if (!array_has($input, $only)) {
        return respond($res)->error('`name` field is required!', 400);
    }

    $params = array_only($input, $only);
    $params['created_at'] = time();

    $id = $this->db->table('category')->insertGetId($params);
    $category = ['id' => $id] + $params;

    return respond($res)->ok($category);
});

// PUT /category/id
$app->put('/category/{id}', function (Request $req, Response $res, array $args) {
    $id = $args['id'];

    $input = $req->getParams();
    $only = ['name'];

    if (!array_has($input, $only)) {
        return respond($res)->error('`name` fields are required!', 400);
    }

    $category = $this->db->table('category')->find((int) $id);

    if (empty($category)) {
        return respond($res)->error('The category was not found!', 404);
    }

    $params = array_only($input, $only);
    $params['updated_at'] = time();

    $this->db->table('category')->where('id', $id)->update($params);

    return respond($res)->ok($params);
});

// DELETE /category/id
$app->delete('/category/{id}', function (Request $req, Response $res, array $args) {
    $id = (int) $args['id'];

    $category = $this->db->table('category')->find($id);

    if (empty($category)) {
        return respond($res)->error('The category was not found!', 404);
    }

    $this->db->table('category')->where('id', $id)->delete();

    return respond($res)->ok($category);
});
