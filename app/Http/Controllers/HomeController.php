<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
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

        // developers
        $assignedProjects = auth()->user()->projects->count();
        $assignedTickets = auth()->user()->tickets->count();

        // managers and admins
        $managingProjects = Project::where('manager_id', auth()->user()->id)->count();
        $uncompletedTickets = Ticket::whereIn('status', ['assigned', 'in_progress', 'submitted'])->count();

        return view('home', compact('role', 'assignedProjects', 'assignedTickets', 'managingProjects', 'uncompletedTickets'));
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

    /**
     * Fetch ticket priority chart data
     * 
     * @return JSON
     */
    public function priorityChartManager()
    {
        $projects = Project::where('manager_id', auth()->user()->id)->get();

        $projectLowPriority = $projects->where('priority', 'low')->count();
        $projectMediumPriority = $projects->where('priority', 'medium')->count();
        $projectHighPriority = $projects->where('priority', 'high')->count();

        $chart = Chartisan::build()
            ->labels(['Low', 'Medium', 'High'])
            ->dataset('Projects', [
                $projectLowPriority,
                $projectMediumPriority,
                $projectHighPriority
            ])
            ->toJSON();

        return $chart;
    }

    /**
     * Fetch ticket priority chart data
     * 
     * @return JSON
     */
    public function statusChartManager()
    {
        $projects = Project::where('manager_id', auth()->user()->id)->get();

        $projectAssignedStatus = $projects->where('status', 'assigned')->count();
        $projectInProgressStatus = $projects->where('status', 'in_progress')->count();
        $projectSubmittedStatus = $projects->where('status', 'submitted')->count();
        $projectCompletedStatus = $projects->where('status', 'completed')->count();

        $chart = Chartisan::build()
            ->labels(['Assigned', 'In Progress', 'Submitted', 'Completed'])
            ->dataset('Projects', [
                $projectAssignedStatus,
                $projectInProgressStatus,
                $projectSubmittedStatus,
                $projectCompletedStatus
            ])
            ->toJSON();

        return $chart;
    }
}
