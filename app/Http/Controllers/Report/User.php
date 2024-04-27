<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Services\User\GenerateReport;
use Illuminate\Http\Request;

class User extends Controller
{

  private $generateReport;

  public function __construct(GenerateReport $generateReport)
  {
    $this->generateReport = $generateReport;
  }


  public function getInfo()
  {
      return $this->generateReport->info();
  }
}
