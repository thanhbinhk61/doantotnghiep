<?php

namespace App\Jobs\Customer;

use App\Jobs\Job;
use App\Repositories\Contracts\CustomerRepository;
use File;
use Excel;
use Validator;

class Import extends Job
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(CustomerRepository $repository)
    {
        if (isset($this->attributes['file'])) {
            $results = array();
            \Excel::load($this->attributes['file']->getRealPath(), function ($reader) {
            })->chunk(250, function ($rows) use (&$results) {
                foreach ($rows as $row) {
                    array_push($results, $row->all());
                }
            }, false);
            $validator = $this->validatorResults($results);
            if ($validator->fails()) {     
                return $validator;
            }
            $this->importResults($results, $this->attributes['category_id']);
        }
    }

    public function validatorResults(array $results)
    {
        return Validator::make($results, [
                '*.name' => 'required',
                '*.email' => 'required|email|unique:customers',
                '*.password' => 'required',
                '*.amount' => 'integer'
            ]);
    }

    public function importResults(array $results, $categoryId)
    {
        foreach ($results as $row) {
            app(CustomerRepository::class)->create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => bcrypt($row['password']),
                'phone' => $row['phone'],
                'address' => $row['address'],
                'amount' => (int) $row['amount'],
                'category_id' => $categoryId
            ]);
        }
    }
}
