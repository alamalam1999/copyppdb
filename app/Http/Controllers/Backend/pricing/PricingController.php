<?php

namespace App\Http\Controllers\Backend\Pricing;


use App\Models\Pricing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\ViewResponse;
use App\Models\RegistrationSchedule;
use Illuminate\Support\Facades\View;
use App\Repositories\Backend\PPDBRepository;
use App\Http\Responses\RedirectResponse;
use App\Http\Requests\Backend\Pricing\PricingPermissionRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PricingImport;

class PricingController extends Controller
{

    /**
     * @param \App\Http\Requests\Backend\PPDB\PPDBPermissionRequest $request
     *
     * @return ViewResponse
     */
    public function index(Request $request)
    {
        // $pricings = Pricing::all();
        // debug($pricings);


        $pricings = Pricing::where([
            ['price_group',      '=', 'gelombang 1'],
        ])->get();

        $pricings_wave2 = Pricing::where([
            ['price_group',      '=', 'gelombang 2'],
        ])->get();

        debug($pricings);

        $data = [
            'pricings' => $pricings,
            'pricings_wave2' => $pricings_wave2
        ];

        return new ViewResponse('backend.pricing.index', $data);
    }

    public function indexwave2(Request $request)
    {
         // $pricings = Pricing::all();
        // debug($pricings);


        $pricings_wave2 = Pricing::where([
            ['price_group',      '=', 'gelombang 2'],
        ])->get();

        $data = [
            'pricings_wave2' => $pricings_wave2
        ];

        return new ViewResponse('backend.pricing.indexwave2', $data);
    }


    /**
     * @param \App\Http\Requests\Backend\Pricing\PricingPermissionRequest $request
     *
     * @return ViewResponse
     */
    public function uploadPricing(PricingPermissionRequest $request)
    {

            $pricings = [];

            
            $pricings = Excel::toArray(new PricingImport, $request->file('file_pricing'));

            var_dump($pricings);

            $pricingInserts = [];
            foreach ($pricings[0] as $pricing) {
                array_push($pricingInserts, [
                    'price_group'       => $pricing['price_group'],
                    'price_code'        => $pricing['price_code'],
                    'discount_code'     => $pricing['discount_code'],
                    'school_code'       => $pricing['school_code'],
                    'school_stage'      => $pricing['school_stage'],
                    'school_class'      => $pricing['school_class'],
                    'price_value'       => $pricing['price_value'],
                    'percentage_value'  => $pricing['percentage_value'],
                    'description'       => $pricing['description'],
                ]);
            }

            debug($pricingInserts);


            
            // Pricing::query()->truncate();
            Pricing::insert($pricingInserts);

            

            
            
            // $data = [
            //     'pricings' => $pricings,
            // ];
    
            // return new ViewResponse('backend.pricing.index', $data);
            return redirect()->route('admin.pricing.index');

                

    }



}
