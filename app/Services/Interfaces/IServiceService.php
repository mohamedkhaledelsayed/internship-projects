<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface IServiceService
{
    public function findBy(Request $request);
    public function store(Request $request);
    public function list();
    public function show($id);
    public function update(Request $request, $id);
}
