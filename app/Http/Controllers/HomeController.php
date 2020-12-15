<?php

namespace App\Http\Controllers;

use Chartisan\PHP\Chartisan;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $role = auth()->user()->getRoleNames()->first();
        $role = ucfirst($role);

        $assignedProjects = auth()->user()->projects->count();
        $assignedTickets = auth()->user()->tickets->count();

        return view('home', compact('role', 'assignedProjects', 'assignedTickets'));
    }

    /**
     * Fetch ticket priority chart data
     * 
     * @return JSON
     */
    public function priorityChart()
    {
        $ticketLowPriority = auth()->user()->tickets->where('priority', 'low')->count();
        $ticketMediumPriority = auth()->user()->tickets->where('priority', 'medium')->count();
        $ticketHighPriority = auth()->user()->tickets->where('priority', 'high')->count();

        $projectLowPriority = auth()->user()->projects->where('priority', 'low')->count();
        $projectMediumPriority = auth()->user()->projects->where('priority', 'medium')->count();
        $projectHighPriority = auth()->user()->projects->where('priority', 'high')->count();

        $chart = Chartisan::build()
            ->labels(['Low', 'Medium', 'High'])
            ->dataset('Projects', [
                $projectLowPriority,
                $projectMediumPriority,
                $projectHighPriority
            ])
            ->dataset('Tickets', [
                $ticketLowPriority,
                $ticketMediumPriority,
                $ticketHighPriority,
            ])
            ->toJSON();

        return $chart;
    }

    /**
     * Fetch ticket type chart data
     * 
     * @return JSON
     */
    public function typeChart()
    {
        $bugType = auth()->user()->tickets->where('type', 'bug')->count();
        $featureType = auth()->user()->tickets->where('type', 'feature')->count();
        $otherType = auth()->user()->tickets->where('type', 'other')->count();

        $chart = Chartisan::build()
            ->labels(['Bug', 'Feature', 'Other'])
            ->dataset('Tickets', [
                $bugType,
                $featureType,
                $otherType
            ])
            ->toJSON();

        return $chart;
    }

    /**
     * Fetch ticket priority chart data
     * 
     * @return JSON
     */
    public function statusChart()
    {
        $ticketAssignedStatus = auth()->user()->tickets->where('status', 'assigned')->count();
        $ticketInProgressStatus = auth()->user()->tickets->where('status', 'in_progress')->count();
        $ticketSubmittedStatus = auth()->user()->tickets->where('status', 'submitted')->count();
        $ticketCompletedStatus = auth()->user()->tickets->where('status', 'completed')->count();

        $chart = Chartisan::build()
            ->labels(['Assigned', 'In Progress', 'Submitted', 'Completed'])
            ->dataset('Tickets', [
                $ticketAssignedStatus,
                $ticketInProgressStatus,
                $ticketSubmittedStatus,
                $ticketCompletedStatus
            ])
            ->toJSON();

        return $chart;
    }
}
