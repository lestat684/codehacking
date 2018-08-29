<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminUsersController extends Controller
{
    private $usersPage = '/admin/users';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = User::all();
    	
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$roles = Role::lists('name', 'id')->all();
    	  
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUsersRequest $request)
    {
        $inputs = $this->getInputs($request);

        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file' => $name]);
            $inputs['photo_id'] = $photo->id;
        }

        User::create($inputs);

        return redirect($this->usersPage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::lists('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUsersRequest $request, $id)
    {
        /**
         * @var $user \App\User.
         */
        $user = User::findOrFail($id);
        $inputs = $this->getInputs($request);

        if (($file = $request->file('photo')) && ($file_id = $this->fileUpload($file))) {
            $inputs['photo_id'] = $file_id;
        }

        $user->update($inputs);

        return redirect($this->usersPage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Upload user avatar.
     *
     * @param UploadedFile $file
     * @param Photo $photo
     * @return bool|mixed
     */
    public function fileUpload(UploadedFile $file) {
        if (!is_object($file)) {
            return false;
        }

        $name = Carbon::now() . $file->getClientOriginalName();
        $file->move('images', $name);
        $photo = Photo::create(['file' => $name]);

        return $photo->id;
    }

    /**
     * Get users form inputs.
     *
     * @param AdminUsersRequest $request
     * @return array
     */
    public function getInputs(AdminUsersRequest $request) {
        if (trim($request->password == '')) {
            $inputs = $request->except('password');
        }
        else {
            $inputs = $request->all();
            $inputs['password'] = bcrypt($request->password);
        }

        return $inputs;
    }
}
