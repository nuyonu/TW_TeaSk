<?php

class StatisticsController extends Controller{
    public function show(){
        require_once(Constants::STATISTICS_VIEW);
    }
}
