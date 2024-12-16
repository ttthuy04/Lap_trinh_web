<?php


namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Computer;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::with('computer')->get(); // Lấy tất cả các vấn đề cùng với thông tin máy tính
        return view('issues.index', compact('issues'));
    }

    public function create()
    {
        $computers = Computer::all(); // Lấy tất cả máy tính
        return view('issues.create', compact('computers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'required|string|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|string',
            'status' => 'required|string',
        ]);

        Issue::create($request->all());
        session()->flash('success', 'Bạn đã thêm thành công.');
        return redirect()->route('issues.index');
    }

    public function edit($id)
    {
        $issue = Issue::findOrFail($id);
        $computers = Computer::all(); // Lấy tất cả máy tính
        return view('issues.edit', compact('issue', 'computers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'required|string|max:50',
            'reported_date' => 'required|date',
            'description' => 'required|string',
            'status' => 'required|string',
        ]);

        $issue = Issue::findOrFail($id);
        $issue->update($request->all());
        session()->flash('success', 'Bạn đã cập nhật thành công.');
        return redirect()->route('issues.index');
    }

    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();
        session()->flash('success', 'Bạn đã xóa thành công');
        return redirect()->route('issues.index');
    }
}
