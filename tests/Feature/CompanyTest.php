<?php

namespace Tests\Feature;

use App\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Company list showed on table.
     *
     * @return void
     */
    public function testShowCompanyList()
    {
        $this->loginAsAdmin();

        factory(Company::class)->create();

        $companies = Company::all();

        $response = $this->get(route('companies.index'));

        $response->assertOk()
            ->assertViewHas('companies', $companies);
    }

    /**
     * Can create new company
     *
     * @return void
     */
    public function testCreateCompany()
    {
        $this->loginAsAdmin();

        $response = $this->get(route('companies.create'));

        $response->assertOk();

        $company = factory(Company::class)->make();

        $response = $this->post(route('companies.store'), [
            'name' => $company->name,
            'confirm_sms_template' => $company->confirm_sms_template,
        ]);

        $this->assertDatabaseHas('companies', [
            'name' => $company->name,
            'confirm_sms_template' => json_encode($company->confirm_sms_template)
        ]);

        $response->assertRedirect(route('companies.index'));
    }

    /**
     * Can edit company data
     *
     * @return void
     */
    public function testEditCompany()
    {
        $this->loginAsAdmin();

        $company = factory(Company::class)->create();

        $response = $this->get(route('companies.edit', ['company' => $company]));

        $response->assertOk();

        $updatedCompany = factory(Company::class)->make();

        $response = $this->patch(route('companies.update', ['company' => $company]), [
            'name' => $updatedCompany->name,
            'confirm_sms_template' => $updatedCompany->confirm_sms_template
        ]);

        $this->assertDatabaseHas('companies', [
            'name' => $updatedCompany->name,
            'confirm_sms_template' => json_encode($company->confirm_sms_template)
        ])->assertDatabaseMissing('companies', [
            'name' => $company->name,
            'confirm_sms_template' => null
        ]);

        $response->assertRedirect(route('companies.index'));
    }

    /**
     * Can delete company
     *
     * @return void
     */
    public function testDeleteCompany()
    {
        $this->loginAsAdmin();

        $company = factory(Company::class)->create();

        $response = $this->delete(route('companies.destroy', ['company' => $company]));

        $this->assertDatabaseMissing('companies', ['name' => $company->name]);

        $response->assertRedirect(route('companies.index'));
    }
}
