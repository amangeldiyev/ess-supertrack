<?php

namespace App\Traits;

trait FilterByCompanyScope
{
    public function scopeFilterByCompany($query, $company_id = null)
    {
        if(is_null($company_id)) $company_id = auth()->user()->company_id;
        
        if($company_id) {
            $query->where('company_id', $company_id);
        }
    }
}