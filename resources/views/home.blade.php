<x-app title="Welcome {{ auth()->user()->first_name }}" color="blue">
  <div class="flex flex-wrap">

    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
      <!--Metric Card-->
      <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
        <div class="flex flex-row items-center">
          <div class="flex-shrink pr-4">
            <div class="rounded-full p-5 bg-green-600"><i class="fas fa-user-friends fa-2x fa-inverse"></i></div>
          </div>
          <div class="flex-1 text-right md:text-center">
            <h5 class="font-bold uppercase text-gray-600">User Role</h5>
            <h3 class="font-bold text-3xl">{{ $role }}</h3>
          </div>
        </div>
      </div>
      <!--/Metric Card-->
    </div>

    {{-- FOR DEVELOPERS --}}
    @if ($role == 'Developer' || $role == 'Guest')
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
      <!--Metric Card-->
      <div class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
        <div class="flex flex-row items-center">
          <div class="flex-shrink pr-4">
            <div class="rounded-full p-5 bg-red-600"><i class="fas fa-tasks fa-2x fa-inverse"></i></div>
          </div>
          <div class="flex-1 text-right md:text-center">
            <h5 class="font-bold uppercase text-gray-600">Assigned Projects</h5>
            <h3 class="font-bold text-3xl">{{ $assignedProjects }}</h3>
          </div>
        </div>
      </div>
      <!--/Metric Card-->
    </div>
    @else
    {{-- FOR MANAGERS AND ADMINS --}}
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
      <!--Metric Card-->
      <div class="bg-gradient-to-b from-red-200 to-red-100 border-b-4 border-red-500 rounded-lg shadow-xl p-5">
        <div class="flex flex-row items-center">
          <div class="flex-shrink pr-4">
            <div class="rounded-full p-5 bg-red-600"><i class="fas fa-tasks fa-2x fa-inverse"></i></div>
          </div>
          <div class="flex-1 text-right md:text-center">
            <h5 class="font-bold uppercase text-gray-600">Projects Managing</h5>
            <h3 class="font-bold text-3xl">{{ $managingProjects }}</h3>
          </div>
        </div>
      </div>
      <!--/Metric Card-->
    </div>
    @endif

    @if ($role == 'Developer' || $role == 'Guest')
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
      <!--Metric Card-->
      <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
        <div class="flex flex-row items-center">
          <div class="flex-shrink pr-4">
            <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-inbox fa-2x fa-inverse"></i></div>
          </div>
          <div class="flex-1 text-right md:text-center">
            <h5 class="font-bold uppercase text-gray-600">Assigned Tickets</h5>
            <h3 class="font-bold text-3xl">{{ $assignedTickets }}</h3>
          </div>
        </div>
      </div>
      <!--/Metric Card-->
    </div>
    @else
    {{-- FOR MANAGERS AND ADMINS --}}
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
      <!--Metric Card-->
      <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
        <div class="flex flex-row items-center">
          <div class="flex-shrink pr-4">
            <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-inbox fa-2x fa-inverse"></i></div>
          </div>
          <div class="flex-1 text-right md:text-center">
            <h5 class="font-bold uppercase text-gray-600">Uncompleted Tickets</h5>
            <h3 class="font-bold text-3xl">{{ $uncompletedTickets }}</h3>
          </div>
        </div>
      </div>
      <!--/Metric Card-->
    </div>
    @endif

  </div>

  <!-- Chart Containers -->
  {{-- DEVELOPERS AND GUEST --}}
  @if ($role == 'Developer' || $role == 'Guest')
  <div class="flex flex-col lg:flex-row m-3 p-3">
    <div id="priority_chart" style="height: 400px;" class="w-full md:w-1/3"></div>
    <div id="type_chart" style="height: 400px;" class="w-full md:w-1/3"></div>
    <div id="status_chart" style="height: 400px;" class="w-full md:w-1/3"></div>
  </div>
  @else
  {{-- MANAGER AND ADMIN --}}
  <div class="flex flex-col lg:flex-row m-3 p-3">
    <div id="priority_chart_manager" style="height: 400px;" class="w-full md:w-1/2"></div>
    <div id="status_chart_manager" style="height: 400px;" class="w-full md:w-1/2"></div>
  </div>
  @endif


  <!-- Charting library -->
  <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>

  <!-- Chartisan -->
  <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

  @if ($role == 'Developer' || $role == 'Guest')
  {{-- Scripts for Developer Charts --}}
  <script>
    const priorityChartDeveloper = new Chartisan({
      el: '#priority_chart',
      url: '/priority_chart',
      hooks: new ChartisanHooks()
      .title('Projects/Tickets by Priority')
      .responsive()
      .beginAtZero()
      .colors()
    });

    const typeChartDeveloper = new Chartisan({
      el: '#type_chart',
      url: '/type_chart',
      hooks: new ChartisanHooks()
      .title('Tickets by Type')
      .datasets('doughnut')
      .responsive()
      .pieColors()
    });

    const statusChartDeveloper = new Chartisan({
      el: '#status_chart',
      url: '/status_chart',
      hooks: new ChartisanHooks()
      .title('Tickets by Status')
      .responsive()
      .beginAtZero()
      .colors()
    });
  </script>
  @else
  {{-- Scripts for Manager and Admin Charts --}}
  <script>
    const priorityChartManager = new Chartisan({
      el: '#priority_chart_manager',
      url: '/priority_chart_manager',
      hooks: new ChartisanHooks()
      .title('Projects by Priority')
      .responsive()
      .beginAtZero()
      .colors()
    });

    const statusChartManager = new Chartisan({
      el: '#status_chart_manager',
      url: '/status_chart_manager',
      hooks: new ChartisanHooks()
      .title('Tickets by Status')
      .responsive()
      .beginAtZero()
      .colors()
    });
  </script>
  @endif
</x-app>