<?php

namespace App\Http\Controllers;

use App\Enums\ServiceTypeEnum;
use App\Models\Company;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;

class CompanyServiceController extends Controller
{
    /**
     * Store multiple services for a company.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'services' => 'required|array',
            'services.*.type' => ['required', new Enum(ServiceTypeEnum::class)],
            'services.*.description' => 'nullable|string',
            'services.*.is_active' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($request->services as $serviceData) {
            // dd($serviceData);
            $service = new Service();
            $service->type = (string)$serviceData['type'];
            $service->description = $serviceData['description'] ?? null;
            $service->is_active = $serviceData['is_active'];
            $service->company_id = $company->id;
            $service->save();
        }

        return redirect()->route('company.show', $company->id)
            ->with('success', 'Services ajoutés avec succès.');
    }
}