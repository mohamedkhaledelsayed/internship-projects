<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface IAdminService
{
    public function findBy(Request $request); 
    public function store(Request $request); 
    public function list(); 
    public function show(); 
    public function destroy($id);
}
