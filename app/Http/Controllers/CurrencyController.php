<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
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
        $this->middleware('auth');

    }

    public function index(CurrencyRequest $request){

        if (request()->ajax()) {

            $model = Currency::all();
            $model->each(function ($currency){
                $currency->cat_id =$currency->id;
            });
            return datatables()->of($model)
                ->toJson();
        }

        return view('currency.currency');
    }

    public function getAllCurrencies(CurrencyRequest $request){
        $access_key = config('currency.access_key');
        $api_link = config('currency.api_link');
        $json = json_decode(file_get_contents("$api_link?access_key=$access_key"), true)['quotes'];
        $result = [];
        $all_cur = [];
        foreach ($json as $key => $value){
            $result = [
                'name' => $key,
                'symbol' => $key,
                'exchange_rate' => $value,
            ];
            $all_cur[] = $result;
        }
        Currency::query()->insert($all_cur);
    }


    public function destroy(Currency $currency){
//        $data = 'sehweil';
//        event(new \App\Events\Currency($currency,$data));
        $currency->delete();
    }

}
