<?php

namespace App\Http\Controllers;

use App\Models\CustomerService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkStatus;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::user()->employee;

        if (!$employee) {
            return view('dashboard.index', [
                'assignedCustomerCount' => 0,
                'serviceCounts' => [],
            ]);
        }

        $customers = $employee->customers;

        $serviceCounts = $customers->flatMap(function ($customer) {
            return $customer->services;
        })->groupBy('name')->map->count();

        return view('dashboard.index', [
            'assignedCustomerCount' => $customers->count(),
            'serviceCounts' => $serviceCounts,
        ]);
    }

    public function tasks(Request $request, $type)
    {
        $type = $request->query('type', $type);
        $currentMonth = now()->format('F');
        $currentYear = now()->year;
        $years = range($currentYear - 5, $currentYear + 5);
        $customers = \App\Models\Customer::all();

        $service_id = Service::where('name', $type)->value('id');
        $customer_ids = CustomerService::where('service_id', $service_id)->pluck('customer_id');
        $selectedCustomerId = $request->input('customer');
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');

        $tasksQuery = WorkStatus::whereIn('customer_id', $customer_ids)
            ->where('service_id', $service_id);

        if ($selectedCustomerId) {
            $tasksQuery->where('customer_id', $selectedCustomerId);
        }

        if ($selectedMonth && $selectedYear) {
            $startDate = \Carbon\Carbon::createFromFormat('F Y', $selectedMonth . ' ' . $selectedYear)->startOfMonth();
            $endDate = \Carbon\Carbon::createFromFormat('F Y', $selectedMonth . ' ' . $selectedYear)->endOfMonth();
            $tasksQuery->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('from_date', [$startDate, $endDate])
                    ->orWhereBetween('to_date', [$startDate, $endDate]);
            });
        }

        $tasks = $tasksQuery->get();
        $completedTasks = $tasks->filter(function ($task) {
            return $task->status === 'done';
        });

        return view('dashboard.tasks', [
            'type' => $type,
            'tasks' => $tasks,
            'completedTasks' => $completedTasks,
            'customers' => $customers,
            'currentMonth' => $currentMonth,
            'years' => $years,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $tasks = $request->input('tasks', []);

        foreach ($tasks as $taskId => $taskData) {
            $task = WorkStatus::find($taskId);
            if ($task) {
                $task->status = $taskData['status'];
                $task->status_remarks = $taskData['remarks'] ?? '';
                $task->save();
            }
        }

        return redirect()->route('dashboard.tasks', ['type' => $request->query('type')])->with('success', 'Tasks updated successfully!');
    }
}