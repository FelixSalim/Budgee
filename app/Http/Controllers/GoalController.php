<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function storeGoal(Request $request)
    {
        $validated = $request->validate([
            'goalName' => 'required|string|max:255',
            'targetDate' => 'required|date|after_or_equal:today',
            'goalAmount' => 'required|numeric|min:1',
            'icon' => 'required|string',
            'color' => 'required|string',
        ]);

        Goal::create([
            'name' => $validated['goalName'], // <-- pastikan ini sesuai
            'target_date' => $validated['targetDate'],
            'target_amount' => $validated['goalAmount'],
            'icon' => $validated['icon'],
            'color' => $validated['color'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('goalslist')->with('success', 'Goal created successfully!');
    }


    public function addMoneyToGoal(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $goal = Goal::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $goal->increment('current_amount', $request->amount);

        return redirect()->route('goalslist')->with('success', 'Money added to goal successfully.');
    }

    public function index()
    {
        $goals = Goal::where('user_id', Auth::id())->get();
        $totalSaved = $goals->sum('current_amount');

        return view('goals.index', compact('goals', 'totalSaved'));
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'current_amount' => 'nullable|numeric|min:0'
        ]);

        Goal::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'target_amount' => $request->target_amount,
            'current_amount' => $request->current_amount ?? 0
        ]);

        return redirect()->route('goals.index')->with('success', 'Goal added successfully!');
    }

    public function edit(Goal $goal)
    {
        $this->authorizeGoal($goal);
        return view('goals.edit', compact('goal'));
    }

    public function update(Request $request, Goal $goal)
    {
        $this->authorizeGoal($goal);

        $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'current_amount' => 'nullable|numeric|min:0'
        ]);

        $goal->update($request->only(['name', 'target_amount', 'current_amount']));

        return redirect()->route('goals.index')->with('success', 'Goal updated successfully!');
    }

    public function destroy(Goal $goal)
    {
        $this->authorizeGoal($goal);
        $goal->delete();
        return redirect()->route('goals.index')->with('success', 'Goal deleted successfully!');
    }

    private function authorizeGoal(Goal $goal)
    {
        if ($goal->user_id !== Auth::id()) {
            abort(403);
        }
    }

    public function editGoal($id)
    {
        $goal = Goal::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('editgoals', compact('goal'));
    }

    public function updateGoal(Request $request, $id)
    {
        $request->validate([
            'goalName' => 'required|string',
            'targetDate' => 'required|date',
            'goalAmount' => 'required|numeric',
        ]);

        $goal = Goal::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $goal->update([
            'name' => $request->goalName,
            'target_date' => $request->targetDate,
            'target_amount' => $request->goalAmount,
        ]);

        return redirect()->route('goalslist')->with('success', 'Goal updated successfully!');
    }

    public function deleteGoal($id)
    {
        $goal = Goal::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $goal->delete();

        return redirect()->route('goalslist')->with('success', 'Goal deleted successfully!');
    }
}
