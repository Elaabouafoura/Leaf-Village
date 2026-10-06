@extends('layouts.admin')
@section('content')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Green Space Growth Overview</h5>
                        </div>
                        <div>
                            <select class="form-select">
                                <option value="1">Q1 2024</option>
                                <option value="2">Q2 2024</option>
                                <option value="3">Q3 2024</option>
                                <option value="4">Q4 2024</option>
                            </select>
                        </div>
                    </div>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Yearly Green Coverage -->
                    <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-9 fw-semibold">Green Coverage Area</h5>
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="fw-semibold mb-3">156 Hectares</h4>
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-arrow-up-left text-success"></i>
                                        </span>
                                        <p class="text-dark me-1 fs-3 mb-0">+12%</p>
                                        <p class="fs-3 mb-0">last year</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="me-4">
                                            <span class="round-8 bg-success rounded-circle me-2 d-inline-block"></span>
                                            <span class="fs-2">2024</span>
                                        </div>
                                        <div>
                                            <span class="round-8 bg-light-success rounded-circle me-2 d-inline-block"></span>
                                            <span class="fs-2">2023</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-center">
                                        <div id="breakup"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <!-- Trees Planted -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold">Trees Planted</h5>
                                    <h4 class="fw-semibold mb-3">8,450</h4>
                                    <div class="d-flex align-items-center pb-1">
                                        <span class="me-2 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-arrow-up-right text-success"></i>
                                        </span>
                                        <p class="text-dark me-1 fs-3 mb-0">+18%</p>
                                        <p class="fs-3 mb-0">this quarter</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-success rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-plant fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="earning"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2 - Environmental Metrics -->
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="fw-semibold mb-2">CO2 Absorbed</h6>
                            <h3 class="fw-bold mb-0">245 tons</h3>
                            <span class="fs-2 text-success">
                                <i class="ti ti-arrow-up"></i> +8%
                            </span>
                        </div>
                        <div class="rounded-circle bg-light-success p-3">
                            <i class="ti ti-leaf fs-6 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="fw-semibold mb-2">Active Parks</h6>
                            <h3 class="fw-bold mb-0">34</h3>
                            <span class="fs-2 text-success">
                                <i class="ti ti-arrow-up"></i> +3
                            </span>
                        </div>
                        <div class="rounded-circle bg-light-info p-3">
                            <i class="ti ti-tree fs-6 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="fw-semibold mb-2">Volunteers</h6>
                            <h3 class="fw-bold mb-0">1,284</h3>
                            <span class="fs-2 text-success">
                                <i class="ti ti-arrow-up"></i> +156
                            </span>
                        </div>
                        <div class="rounded-circle bg-light-warning p-3">
                            <i class="ti ti-users fs-6 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="fw-semibold mb-2">Biodiversity Index</h6>
                            <h3 class="fw-bold mb-0">7.8/10</h3>
                            <span class="fs-2 text-success">
                                <i class="ti ti-arrow-up"></i> +0.4
                            </span>
                        </div>
                        <div class="rounded-circle bg-light-primary p-3">
                            <i class="ti ti-bug fs-6 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3 - Charts -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Species Distribution</h5>
                    <div id="species-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Monthly Visitor Trends</h5>
                    <div id="visitor-chart"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 4 - Projects Table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Active Green Space Projects</h5>
                        <button class="btn btn-success btn-sm">
                            <i class="ti ti-plus"></i> New Project
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Project Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Location</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Manager</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Progress</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Status</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Budget</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Urban Forest Initiative</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Downtown District</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">Sarah Johnson</h6>
                                        <span class="fw-normal">Environmental Lead</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                                        </div>
                                        <span class="fs-2 mt-1">75%</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-success rounded-3 fw-semibold">On Track</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 fs-4">$125k</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Community Garden Expansion</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Riverside Park</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">Michael Chen</h6>
                                        <span class="fw-normal">Project Coordinator</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 45%"></div>
                                        </div>
                                        <span class="fs-2 mt-1">45%</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-warning rounded-3 fw-semibold">In Progress</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 fs-4">$68k</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Native Species Restoration</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Wetland Reserve</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">Emma Davis</h6>
                                        <span class="fw-normal">Ecologist</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 90%"></div>
                                        </div>
                                        <span class="fs-2 mt-1">90%</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-info rounded-3 fw-semibold">Completing</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 fs-4">$95k</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Pollinator Pathway</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">City Center Corridor</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1">James Wilson</h6>
                                        <span class="fw-normal">Urban Planner</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"></div>
                                        </div>
                                        <span class="fs-2 mt-1">25%</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-danger rounded-3 fw-semibold">Delayed</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 fs-4">$52k</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 5 - Events Table -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title fw-semibold mb-0">Upcoming Environmental Events</h5>
                        <button class="btn btn-success btn-sm">
                            <i class="ti ti-calendar-plus"></i> Schedule Event
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Event Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Date & Time</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Location</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Participants</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Type</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Status</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tree Planting Marathon</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Oct 15, 2024 - 8:00 AM</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Central Park</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold">245 / 300</span>
                                            <div class="progress ms-2" style="width: 60px; height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 82%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-success rounded-3 fw-semibold">
                                            <i class="ti ti-plant"></i> Planting
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-primary rounded-3 fw-semibold">Confirmed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Park Cleanup Day</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Oct 22, 2024 - 9:00 AM</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Riverside Park</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold">128 / 150</span>
                                            <div class="progress ms-2" style="width: 60px; height: 6px;">
                                                <div class="progress-bar bg-info" style="width: 85%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-info rounded-3 fw-semibold">
                                            <i class="ti ti-trash"></i> Cleanup
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-primary rounded-3 fw-semibold">Confirmed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Biodiversity Workshop</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Nov 5, 2024 - 2:00 PM</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Community Center</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold">45 / 80</span>
                                            <div class="progress ms-2" style="width: 60px; height: 6px;">
                                                <div class="progress-bar bg-warning" style="width: 56%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-warning rounded-3 fw-semibold">
                                            <i class="ti ti-book"></i> Education
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-warning rounded-3 fw-semibold">Registration Open</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Native Plant Sale</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Nov 12, 2024 - 10:00 AM</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Botanical Garden</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold">89 / 200</span>
                                            <div class="progress ms-2" style="width: 60px; height: 6px;">
                                                <div class="progress-bar bg-secondary" style="width: 45%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-secondary rounded-3 fw-semibold">
                                            <i class="ti ti-shopping-cart"></i> Sale
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-warning rounded-3 fw-semibold">Registration Open</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Wildlife Photography Tour</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Nov 18, 2024 - 6:00 AM</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Nature Reserve</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center">
                                            <span class="fw-semibold">20 / 20</span>
                                            <div class="progress ms-2" style="width: 60px; height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-primary rounded-3 fw-semibold">
                                            <i class="ti ti-camera"></i> Tour
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-danger rounded-3 fw-semibold">Full</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection