<?php

    namespace App\Services;

    use Exception;
    use App\Models\User;
    use Illuminate\Http\Request;
    use App\Http\Requests\UserRequest;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Resources\BaseResource;
    use App\Http\Resources\UserCollection;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\ValidationException;
    
    class UserService {
        
        public function returnCondition($condition, $errorCode, $message)
        {
            return response()->json([
                'success' => $condition,
                'message' => $message,
            ], $errorCode);
        }

        public function checkEmailAndPass($request, $action = true)
        {
            $emailRule    = $action ? 'required|' : '';
            $passwordRule = $action ? 'required|' : '';

            $rules = [
                'email'    => $emailRule . 'email|unique:users,email',
                'password' => $passwordRule . 'max:8'
            ];

            if($action):
                $rules['role'] = 'required|in:admin,spv_employee,spv_admin';
            endif;

            Validator::make($request->all(), $rules, $messages = 
            [
                'email.required'    => 'email must be filled',
                'email.email'       => 'invalid email format',
                'email.unique'      => 'email has already been taken',
                'password.required' => 'password must be filled',
                'password.max'      => 'maximal password is 8 character',
                'role.required'     => 'role must be filled',
                'role.in'           => 'no type found for that role',
            ])->validate();
        }

        public function checkAccess($request)
        {
            if(auth()->user()->role == 'superadmin')
                if($request->role != 'admin')
                    return $this->returnCondition(false, 401, 'Invalid role access');

            if(auth()->user()->role == 'admin')
                if($request->role == 'admin')
                    return $this->returnCondition(false, 401, 'Invalid role access');
        }

        public function index(Request $request)
        {
             try {
                if(!$request->role)
                    return $this->returnCondition(false, 400, 'role params must be filled');

                $roles = ['admin', 'spv_employee', 'spv_admin'];
                if(!in_array($request->role, $roles))
                    return $this->returnCondition(false, 404, 'Data with role ' . $request->role . ' not found');

                $users = User::select('id', 'name', 'email', 'age', 'username', 'phone', 'role')
                                ->where('role', $request->role)
                                ->paginate(5);

                return new UserCollection($users);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function show(string $id)
        {
            try {
                
                $user = User::select('id', 'name', 'email', 'age', 'username', 'phone', 'role')
                            ->where('id', $id)
                            ->first();

                if(!$user) return $this->returnCondition(false, 404, 'Data with id ' . $id . ' not found');

                return new BaseResource($user);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function store(UserRequest $request)
        {
            try {

                if ($this->checkAccess($request))
                    return $this->checkAccess($request);

                $this->checkEmailAndPass($request);
                 
                User::create([
                    'name'       => $request->name,
                    'role'       => $request->role,
                    'age'        => $request->age,
                    'phone'      => $request->phone,
                    'email'      => $request->email,
                    'username'   => $request->username,
                    'password'   => bcrypt($request->password),
                ]);
               
                return $this->returnCondition(true, 200, 'Successfully create data ' .  $request->role);
            }catch (ValidationException $th) {
                return $th->validator->errors();
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function update(UserRequest $request, string $id)
        {
            try {

                if ($this->checkAccess($request))
                    return $this->checkAccess($request);

                $data = User::where('id', $id)->first();
                if(!$data) return $this->returnCondition(false, 404, 'Data with id ' . $id . ' not found');

                if($request->email || $request->password)
                    $this->checkEmailAndPass($request, false);
                
                $updateData = [
                    'name'      => $request->name,
                    'phone'     => $request->phone,
                    'age'       => $request->age,
                    'username'  => $request->username,
                ];

                if($request->email) $updateData['email'] = $request->email;
                if($request->password) $updateData['password'] = bcrypt($request->password);

                $data->update($updateData);

                return $this->returnCondition(true, 200, 'Successfully update data ' .  $data->role);
            }catch (ValidationException $th) {
                return $th->validator->errors();
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function destroy(string $id)
        {
             try {

                if ($this->checkAccess($request))
                    return $this->checkAccess($request);
                    
                if (Auth::user()->id == $id)
                    return $this->returnCondition(false, 400, "Invalid, user can't remove them self");

                $data = User::where('id', $id)->first();
                if(!$data) return $this->returnCondition(false, 400, 'data with id ' . $id . ' not found');

                $data->delete();

                return $this->returnCondition(true, 200, 'Successfully delete data ' .  $data->name);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }
    }
?>