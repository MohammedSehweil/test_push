<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use App\Transformers\CurrencyTransformer;
use Collective\Html\FormFacade;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CurrencyController extends Controller
{
    public function __construct()
    {

    }

    public function getAllCurrencies(Request $request){
        return CurrencyResource::collection(Currency::all());
    }



}
