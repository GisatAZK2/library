<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../core/Request.php";

class UserController extends Controller {

   public function __construct() {
    if (!$_SESSION['id_user']) {
        redirect('/');
        exit;
    }
   }
    public function index() {
        view('users');
    }

       public function store()
    {
       
        if (Request::isEmpty()) {
            return redirect('/users');
        }

        $user = new User();
        $user->create(Request::all());

        return redirect('/users');
    }

   public function show($id)
{
    $user = new User();
    $data = $user->find($id);

    return view('users.edit', compact('data'));
}

public function update($id)
{
    if (Request::isEmpty()) {
        return redirect('/users');
    }

    $user = new User();
    $user->update($id, Request::all());

    return redirect('/users');
}

public function delete($id)
{
    $user = new User();
    $user->delete($id);

    return redirect('/users');
}

public function bulkDelete($body)
{
    if (empty($body['ids'])) {
        return redirect('/users');
    }

    $user = new User();
    $user->deleteMany($body['ids']);

    return redirect('/users');
}


}