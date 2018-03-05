<?php
/**
 * Created by PhpStorm.
 * User: baichou
 * Date: 2018/2/22
 * Time: 15:41
 */

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function index()
    {
        return $this->view('/admin/home')->render();
    }
}