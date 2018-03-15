<?php
/**
 * Created by PhpStorm.
 * User: Sehweil
 * Date: 3/10/2018
 * Time: 3:10 PM
 */
namespace App\Transformers;

use App\Models\Currency;
use App\User;
use League\Fractal\TransformerAbstract;

class CurrencyTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['posts'];

    /**
     * @param \App\User $user
     * @return array
     */
    public function transform(Currency $currency)
    {
        return [
            'id'         => (int) $currency->id,
            'name'       => $currency->name,
            'symbol'       => $currency->symbol,
            'exchange_rate'      => $currency->exchange_rate,
            'created_at' => (string) $currency->created_at,
            'updated_at' => (string) $currency->updated_at,
            'actions' => 'sehweil',
        ];
    }


}
