<?php


namespace App\Repository;

use App\Models\Schedule;
use  App\Repository\Others\AbstractRepository;


class ScheduleRepository extends AbstractRepository {
    public function __construct()
    {
        $this->model = new Schedule();
    }

}
