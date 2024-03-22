<?php

namespace App\Services;

use App\Repository\ScheduleRepository;

class ScheduleService {
    public function __construct(protected ScheduleRepository $scheduleRepository)
    {}

    public function findAll() {
        return $this->scheduleRepository->findAll();
    }

    public function findOne($id) {
        return $this->scheduleRepository->findOne($id);
    }

    public function new($data) {
        if ($data) {
            $schedule = $this->scheduleRepository->new($data);
            return true;
        }
    }

    public function updateSchedule($request, $id) {
        $schedule = $this->scheduleRepository->findOne($id);
        if (!$schedule) {
            throw new \Exception('schedule not found!');
        }

        $requestAttributes = $request->all();


        $this->scheduleRepository->update($id, $requestAttributes);

        if (isset($requestAttributes['quantity'])) {
            $schedule->quantity = $requestAttributes['quantity'];
            $schedule->save();
        }
    }

    public function destroy($id) {
        if($id) {
            $schedule = $this->scheduleRepository->findOne($id);
            if ($schedule) {
                $this->scheduleRepository->delete($id);

                return redirect()->back();
            }
        }

        return redirect()->back();
    }
}
