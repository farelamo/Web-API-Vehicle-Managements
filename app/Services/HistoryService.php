<?php

    namespace App\Services;

    use Exception;
    use App\Models\History;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Resources\BaseResource;
    use App\Http\Requests\HistoryRequest;
    use App\Http\Resources\HistoryCollection;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\ValidationException;
    
    class HistoryService {
        
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

                $histories = History::select(
                                        'id', 'vehicle_id', 'employee_id', 'admin_id', 'spv_employee_id', 
                                        'spv_admin_id', 'start_date', 'end_date', 
                                        'fuel', 'distance', 'description',
                                    )
                                    ->paginate(5);

                return new HistoryCollection($histories);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function show(string $id)
        {
            try {
                
                $history = History::select(
                                        'id', 'vehicle_id', 'employee_id', 'admin_id', 'spv_employee_id', 
                                        'spv_admin_id', 'start_date', 'end_date', 
                                        'fuel', 'distance', 'description',
                                    )
                                    ->where('id', $id)
                                    ->first();

                if(!$history) return $this->returnCondition(false, 404, 'Data with id ' . $id . ' not found');

                return new BaseResource($history);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function store(HistoryRequest $request)
        {
            try {

                History::create([
                    'vehicle_id'        => $request->vehicle_id,
                    'employee_id'       => $request->employee_id,
                    'admin_id'          => auth()->user()->id,
                    'spv_admin_id'      => $request->spv_admin_id,
                    'spv_employee_id'   => $request->spv_employee_id,
                    'start_date'        => $request->start_date,
                    'end_date'          => $request->end_date,
                    'fuel'              => $request->fuel,
                    'distance'          => $request->distance,
                    'description'       => $request->description,
                ]);
            
                return $this->returnCondition(true, 200, 'Successfully create data history');
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function update(HistoryRequest $request, string $id)
        {
            try {

                $data = History::where('id', $id)->first();
                if(!$data) return $this->returnCondition(false, 404, 'Data with id ' . $id . ' not found');

                $data->update([
                    'vehicle_id'        => $request->vehicle_id,
                    'employee_id'       => $request->employee_id,
                    'admin_id'          => auth()->user()->id,
                    'start_date'        => $request->start_date,
                    'end_date'          => $request->end_date,
                    'fuel'              => $request->fuel,
                    'distance'          => $request->distance,
                    'description'       => $request->description,
                ]);

                return $this->returnCondition(true, 200, 'Successfully update data history');
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function destroy(string $id)
        {
            try {

                $data = History::where('id', $id)->first();
                if(!$data) return $this->returnCondition(false, 400, 'data with id ' . $id . ' not found');

                $data->delete();

                return $this->returnCondition(true, 200, 'Successfully delete data history');
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function spvAdminGet()
        {
            try {
                $data = History::select(
                                        'id', 'vehicle_id', 'employee_id', 'admin_id', 'spv_employee_id', 
                                        'spv_admin_id', 'start_date', 'end_date', 'spv_admin_approve',
                                        'fuel', 'distance', 'description', 'spv_employee_approve',
                                    )
                                    ->where('spv_admin_id', Auth::user()->id)
                                    ->whereNull('spv_admin_approve')
                                    ->paginate(5);

                return new HistoryCollection($data);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function spvAdminApprove(string $id)
        {
            try {

                $data = History::where('id', $id)->first();
                if(!$data) return $this->returnCondition(false, 400, 'data with id ' . $id . ' not found');
                
                $data->update(['spv_admin_approve' => true]);

                return $this->returnCondition(true, 200, 'Successfully approve data');
            }catch (ValidationException $th) {
                return $th->validator->errors();
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function spvEmployeeGet()
        {
            try {

                $data = History::select(
                                        'id', 'vehicle_id', 'employee_id', 'admin_id', 'spv_employee_id', 
                                        'spv_admin_id', 'start_date', 'end_date', 'spv_employee_approve',
                                        'fuel', 'distance', 'description', 'spv_admin_approve',
                                    )
                                    ->where('spv_employee_id', Auth::user()->id)
                                    ->whereNull('spv_employee_approve')
                                    ->paginate(5);

                return new HistoryCollection($data);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function spvEmployeeApprove(string $id)
        {
            try {

                $data = History::where('id', $id)->first();
                if(!$data) return $this->returnCondition(false, 400, 'data with id ' . $id . ' not found');
                
                $data->update(['spv_employee_approve' => true]);

                return $this->returnCondition(true, 200, 'Successfully approve data');
            }catch (ValidationException $th) {
                return $th->validator->errors();
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }
    }
?>