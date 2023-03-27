<?php

    namespace App\Services;

    use Exception;
    use App\Models\Employee;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Resources\BaseResource;
    use App\Http\Requests\EmployeeRequest;
    use App\Http\Resources\EmployeeCollection;
    
    class EmployeeService {
        
        public function returnCondition($condition, $errorCode, $message)
        {
            return response()->json([
                'success' => $condition,
                'message' => $message,
            ], $errorCode);
        }

        public function index()
        {
            try {

                $employees = Employee::select('id', 'name', 'age', 'phone', 'address')
                                ->paginate(5);

                return new EmployeeCollection($employees);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function show(string $id)
        {
            try {
                
                $employee = Employee::select('id', 'name', 'age', 'phone', 'address')
                            ->where('id', $id)
                            ->first();

                if(!$employee) return $this->returnCondition(false, 404, 'Data with id ' . $id . ' not found');

                return new BaseResource($employee);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function store(EmployeeRequest $request)
        {
            try {

                Employee::create([
                    'name'       => $request->name,
                    'age'        => $request->age,
                    'phone'      => $request->phone,
                    'address'    => $request->address,
                ]);
            
                return $this->returnCondition(true, 200, 'Successfully create data ' .  $request->name);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function update(EmployeeRequest $request, string $id)
        {
            try {

                $data = Employee::where('id', $id)->first();
                if(!$data) return $this->returnCondition(false, 404, 'Data with id ' . $id . ' not found');

                $data->update([
                    'name'       => $request->name,
                    'age'        => $request->age,
                    'phone'      => $request->phone,
                    'address'    => $request->address,
                ]);

                return $this->returnCondition(true, 200, 'Successfully update data ' .  $data->name);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function destroy(string $id)
        {
             try {

                $data = Employee::where('id', $id)->first();
                if(!$data) return $this->returnCondition(false, 400, 'data with id ' . $id . ' not found');

                $data->delete();

                return $this->returnCondition(true, 200, 'Successfully delete data ' .  $data->name);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }
    }
?>