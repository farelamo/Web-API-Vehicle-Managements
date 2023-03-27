<?php

    namespace App\Services;

    use Exception;
    use App\Models\Vehicle;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Resources\BaseResource;
    use App\Http\Requests\VehicleRequest;
    use App\Http\Resources\VehicleCollection;
    
    class VehicleService {
        
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

                $vehicles = Vehicle::select('id', 'name', 'type', 'schedule_service')
                                ->paginate(5);

                return new VehicleCollection($vehicles);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function show(string $id)
        {
            try {
                
                $vehicle = Vehicle::select('id', 'name', 'type', 'schedule_service')
                            ->where('id', $id)
                            ->first();

                if(!$vehicle) return $this->returnCondition(false, 404, 'Data with id ' . $id . ' not found');

                return new BaseResource($vehicle);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function store(VehicleRequest $request)
        {
            try {

                Vehicle::create([
                    'name'              => $request->name,
                    'type'              => $request->type,
                    'schedule_service'  => $request->schedule_service,
                ]);
            
                return $this->returnCondition(true, 200, 'Successfully create data ' .  $request->name);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function update(VehicleRequest $request, string $id)
        {
            try {

                $data = Vehicle::where('id', $id)->first();
                if(!$data) return $this->returnCondition(false, 404, 'Data with id ' . $id . ' not found');

                $data->update([
                    'name'              => $request->name,
                    'type'              => $request->type,
                    'schedule_service'  => $request->schedule_service,
                ]);

                return $this->returnCondition(true, 200, 'Successfully update data ' .  $data->name);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }

        public function destroy(string $id)
        {
            try {

                $data = Vehicle::where('id', $id)->first();
                if(!$data) return $this->returnCondition(false, 400, 'data with id ' . $id . ' not found');

                $data->delete();

                return $this->returnCondition(true, 200, 'Successfully delete data ' .  $data->name);
            }catch(Exception $e){
                return $this->returnCondition(false, 500, 'Internal Service Error');
            }
        }
    }
?>