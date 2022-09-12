<?php
namespace App\Controllers;

require "../bootstrap.php";



use Exception;
use App\Models\User;
use App\Lib\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;

class UserController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
    )
    {
    }

    /**
     * Display a listing of the Model.
     *
     * @param 
     * @return Response
     */
    public function index($req, $res)
    {
        $users = User::get()->toArray();
        return $res->toJSON($users);
    }
    
    /**
     * Store a newly created Model in storage.
     *
     * @param 
     *
     * @return Response
     */
    public function store($req, $res)
    {
        $input = $req->getJSON();

        $filesystem = new Filesystem();
        $fileLoader = new FileLoader($filesystem, '');
        $translator = new Translator($fileLoader, 'en_US');
        $factory = new Factory($translator);

        $messages = [
            'required' => 'The :attribute field is required.',
        ];

        $rules = [
            'name' => 'required|max:250',
            'email' => 'required|email|max:200', // |unique:users,email (error)
            'password' => 'required|max:150'
        ];

        $validator = $factory->make($input, $rules, $messages);

        if($validator->fails()){
            $errors = $validator->errors();
            return $res->status(404)->toJSON(["Error" => $errors->all()]);
        }

        try {
            $user = User::create(['name' => $input['name'], 'email' => $input['email'], 'password' => password_hash($input['password'],PASSWORD_BCRYPT)]);
            return $res->status(200)->toJSON($user);
        }  catch (Exception $e) {
            return $res->status(404)->toJSON(["Error" => $e->getMessage(), "Line" => $e->getLine()]);
        } 
    }

    /**
     * Display the specified Model.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($req, $res)
    {
        $user = User::find($req->params[0]);
        if(!$user) return $res->status(404)->toJSON(['error' => "El usuario no existe"]);
        return $res->status(200)->toJSON($user);
    }

    /**
     * Update the specified Model in storage.
     *
     * @param  int $id
     * @param 
     *
     * @return Response
     */
    public function update($req, $res)
    {
        $input = $req->getJSON();
        $filesystem = new Filesystem();
        $fileLoader = new FileLoader($filesystem, '');
        $translator = new Translator($fileLoader, 'en_US');
        $factory = new Factory($translator);

        $messages = [
            'required' => 'The :attribute field is required.',
        ];

        $rules = [
            'name' => 'max:250',
            'email' => 'email|max:200', // |unique:users,email (error)
            'password' => 'max:150'
        ];

        $validator = $factory->make($input, $rules, $messages);

        if($validator->fails()){
            $errors = $validator->errors();
            return $res->status(404)->toJSON(["Error" => $errors->all()]);
        }

        try {
            $user = User::find($req->params[0]);
            if(!$user) return $res->status(404)->toJSON(['error' => "El usuario no existe"]);
            $user->fill($input);
            if ($user->isClean()) {
                return $res->status(200)->toJSON("No se realizó ningún cambio");
            }
            $user->save();
            return $res->status(200)->toJSON($user);
        }  catch (Exception $e) {
            return $res->status(404)->toJSON(["Error" => $e->getMessage(), "Line" => $e->getLine()]);
        } 
    }

    /**
     * Remove the specified Model from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($req, $res)
    {
        try {
            $user = User::find($req->params[0]);
            if(!$user) return $res->status(404)->toJSON(['error' => "El usuario no existe"]);
            $user->delete();
            return $res->status(200)->toJSON("Eliminado correctamente");
        }  catch (Exception $e) {
            return $res->status(404)->toJSON(["Error" => $e->getMessage(), "Line" => $e->getLine()]);
        } 
    }
    
}
