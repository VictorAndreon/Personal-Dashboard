<?php

namespace App\Http\Controllers;

use App\Services\FinancialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FinancialService $financialService)
    {
        $balance = $financialService->getBalance(Auth::id());
        $monthBalance = $financialService->getMonthBalance(Auth::id());
        $categoryCardData = $financialService->getMostExpensiveCategoryMonth(Auth::id());
        $categoryValue = $categoryCardData->max();
        $categoryName = $categoryCardData->search($categoryValue);
        
        return view('dashboard', compact('balance', 'monthBalance', 'categoryName','categoryValue'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
