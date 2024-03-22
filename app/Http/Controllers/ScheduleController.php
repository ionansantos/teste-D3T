<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Services\ScheduleService;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    public function __construct(protected ScheduleService $service)
    {}


    public function index(Request $request)
    {

        $schedule = $this->service->findAll();
        return response()->json($schedule, 200);

    }

    public function store(ScheduleRequest $request) {

        $data = $request->all();
        try {
            $schedule = $this->service->new($data);
            return response()->json(["message" => "schedule created successfully", "data" => $schedule], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['msg' =>  $e->getMessage()], 422);
        }
    }

    public function show($id): JsonResponse
    {
        $schedule = $this->service->findOne($id);
        if (!$schedule) {
            return response()->json(["error" => "schedule not found"], Response::HTTP_NOT_FOUND);
        }

        return response()->json(["data" => $schedule], Response::HTTP_OK);
    }

    public function update(ScheduleRequest $request, $id): JsonResponse
    {
        $schedule = $this->service->updateSchedule($request, $id);
        return response()->json(["message" => "schedule updated successfully", "data" => $schedule], Response::HTTP_OK);
    }

    public function destroy($id): JsonResponse
    {
        $schedule = $this->service->findOne($id);

        if (!$schedule) {
            return response()->json(["error" => "Task not found"], Response::HTTP_NOT_FOUND);
        }

        $this->service->destroy($id);

        return response()->json(["message" => "schedule deleted successfully"], Response::HTTP_OK);
    }

}
