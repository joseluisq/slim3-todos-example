<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

// GET /todo
$app->get('/todo', function (Request $req, Response $res) {
    $todo = $this->db->table('todo')->get();
    return respond($res)->ok($todo);
});

// GET /todo/id
$app->get('/todo/{id}', function (Request $req, Response $res, array $args) {
    $id = (int) $args['id'];
    $todo = $this->db->table('todo')->find($id);
    return respond($res)->ok($todo);
});

// POST /todo
$app->post('/todo', function (Request $req, Response $res) {
    $input = $req->getParams();
    $only = ['subject', 'status'];

    if (!array_has($input, $only)) {
        return respond($res)->error('`subject` and `status` fields are required!', 400);
    }

    $params = array_only($input, $only);
    $params['created_at'] = time();

    $id = $this->db->table('todo')->insertGetId($params);
    $todo = ['id' => $id] + $params;

    return respond($res)->ok($todo);
});

// PUT /todo/id
$app->put('/todo/{id}', function (Request $req, Response $res, array $args) {
    $id = $args['id'];

    $input = $req->getParams();
    $only = ['subject', 'status'];

    if (!array_has($input, $only)) {
        return respond($res)->error('`subject` and `status` fields are required!', 400);
    }

    $todo = $this->db->table('todo')->find((int) $id);

    if (empty($todo)) {
        return respond($res)->error('The todo was not found!', 404);
    }

    $params = array_only($input, $only);
    $params['updated_at'] = time();

    $this->db->table('todo')->where('id', $id)->update($params);

    return respond($res)->ok($params);
});

// DELETE /todo/id
$app->delete('/todo/{id}', function (Request $req, Response $res, array $args) {
    $id = (int) $args['id'];

    $todo = $this->db->table('todo')->find($id);

    if (empty($todo)) {
        return respond($res)->error('The todo was not found!', 404);
    }

    $this->db->table('todo')->where('id', $id)->delete();

    return respond($res)->ok($todo);
});

// GET /todo/id/category
$app->get('/todo/{id}/category', function (Request $req, Response $res, array $args) {
    $id = (int) $args['id'];

    $todo = $this->db->table('todo')->find($id);

    if (empty($todo)) {
        return respond($res)->error('The todo was not found!', 404);
    }

    $categories = $this->db->table('category')
        ->select('category.*')
        ->join('todo_category', 'todo_category.category_id', '=', 'category.id')
        ->where('todo_category.todo_id', $id)
        ->get();

    return respond($res)->ok($categories);
});

// POST /todo/id/category
$app->post('/todo/{todo_id}/category/{category_id}', function (Request $req, Response $res, array $args) {
    $todo_id = (int) $args['todo_id'];
    $category_id = (int) $args['category_id'];

    $todo = $this->db->table('todo')->find($todo_id);
    
    if (empty($todo)) {
        return respond($res)->error('The todo was not found!', 404);
    }

    $category = $this->db->table('todo')->find($category_id);

    if (empty($category)) {
        return respond($res)->error('The category was not found!', 404);
    }

    $params = [
        'todo_id' => $todo_id,
        'category_id' => $category_id,
        'created_at' => time(),
    ];

    $id = $this->db->table('todo_category')->insertGetId($params);
    $todo_category = ['id' => $id] + $params;

    return respond($res)->ok($todo_category);
});
