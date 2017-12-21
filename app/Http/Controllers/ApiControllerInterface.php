<?php
/**
 * Created by PhpStorm.
 * User: hasyim
 * Date: 12/21/17
 * Time: 3:29 PM
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

interface ApiControllerInterface
{
    public function index(Request $request);
    public function datatable();
    public function getAll();
    public function show($id);
    public function store(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}