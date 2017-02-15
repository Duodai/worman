<?php
/**
 * Created by PhpStorm.
 * User: janus
 * Date: 15.02.17
 * Time: 17:04
 */

namespace app\worman\interfaces;


interface SystemScannerInterface
{

    public function init();

    public function getFreeRam();

    public function getTotalRam();

    public function getFreeCpu();

    public function getTotalCpu();


}
