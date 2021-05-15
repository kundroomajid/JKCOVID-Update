@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container">
            <!-- cards row start -->
            <div class="col-md-12 ">
                <div class="m-2">
                    <span class="badge bg-info text-dark"> Last Updated On: <i id="last_updated">
                            {{ $all_stats_jk['last_updated'] }} </i>
                    </span>
                </div>
                <div class="row ">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-orange-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-plus"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Postives</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            {{ number_format($all_stats_jk['postive_total']) }}
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span> {{ number_format($all_stats_jk['postive_new']) ?? 0 }} New <i
                                                class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-blue-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-chart-line"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Active</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            {{ number_format($all_stats_jk['total_active']) }}
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span> &nbsp;&nbsp; NA <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-green-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="far fa-smile"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Recovered</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            {{ number_format($all_stats_jk['recovered_total']) }}
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span> {{ number_format($all_stats_jk['recovered_new']) ?? 0 }} New <i
                                                class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-red">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-book-dead"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Deaths</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            {{ number_format($all_stats_jk['deaths_total']) }}
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span> {{ number_format($all_stats_jk['deaths_new']) ?? 0 }} New <i
                                                class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- cards row end -->

            <!-- chart starts here -->
            <section id="chart-body">
                <div class="col-12">
                    <div class="card text-center">

                        <div class="card-header">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item">
                                    <input type="button" class="nav-link active" id="button-daily" value="Daily" />
                                </li>
                                <li class="nav-item">
                                    <input type="button" class="nav-link" id="button-weekly" value="Weekly" />
                                </li>
                                <li class="nav-item">
                                    <input type="button" class="nav-link" id="button-monthly" value="Monthly" />
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="spinner" class="loader" style="display:none"></div>
                            <canvas class="my-4 w-100 chartjs-render-monitor" id="line-chart" width="1507" height="500"
                                style="display: block; height: 404px; width: 1005px;">
                            </canvas>

                        </div>
                    </div>
                </div>
            </section>
            <!-- chart ends here -->

            <!-- stats for divisions start  -->
            <div class="col-12">
                <div class="row">
                    <div class="card-group">
                        <div class="card text-white l-bg-cyan m-1">
                            <div class="card-header">Stats Kashmir Division (Updated :
                                {{ $all_stats_kashmir['last_updated'] }})</div>
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="card bg-light">
                                                <div class="card-header black">
                                                    Postive Cases
                                                </div>
                                                <div class="card-body text-center black">
                                                    <span>
                                                        <p>Total :
                                                            {{ number_format($all_stats_kashmir['postive_total']) ?? NA }}
                                                        </p>
                                                        <p> New :
                                                            {{ number_format($all_stats_kashmir['postive_new']) ?? NA }}
                                                        </p>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="card bg-light">
                                                <div class="card-header black">
                                                    Active Cases
                                                </div>
                                                <div class="card-body text-center black">
                                                    <span>
                                                        <p>Total :
                                                            {{ number_format($all_stats_kashmir['total_active']) ?? NA }}
                                                        </p>
                                                        <p>
                                                            &nbsp;
                                                        </p>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="card bg-light">
                                                <div class="card-header black">
                                                    Recovered
                                                </div>
                                                <div class="card-body text-center black">
                                                    <span>
                                                        <p>Total :
                                                            {{ number_format($all_stats_kashmir['recovered_total']) ?? NA }}
                                                        </p>
                                                        <p> New :
                                                            {{ number_format($all_stats_kashmir['recovered_new']) ?? NA }}
                                                        </p>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="card bg-light">
                                                <div class="card-header black">
                                                    Deaths
                                                </div>
                                                <div class="card-body text-center black">
                                                    <span>
                                                        <p>Total :
                                                            {{ number_format($all_stats_kashmir['deaths_total']) ?? NA }}
                                                        </p>
                                                        <p> New :
                                                            {{ number_format($all_stats_kashmir['deaths_new']) ?? NA }}
                                                        </p>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card text-white l-bg-green-dark m-1">
                            <div class="card-header">Stats Jammu Division (Updated :
                                {{ $all_stats_jammu['last_updated'] }})</div>
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="card bg-light">
                                                <div class="card-header black">
                                                    Postive Cases
                                                </div>
                                                <div class="card-body text-center black">
                                                    <span>
                                                        <p>Total :
                                                            {{ number_format($all_stats_jammu['postive_total']) ?? NA }}
                                                        </p>
                                                        <p> New :
                                                            {{ number_format($all_stats_jammu['postive_new']) ?? NA }}
                                                        </p>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="card bg-light">
                                                <div class="card-header black">
                                                    Active Cases
                                                </div>
                                                <div class="card-body text-center black">
                                                    <span>
                                                        <p>Total :
                                                            {{ number_format($all_stats_jammu['total_active']) ?? NA }}
                                                        </p>
                                                        <p>
                                                            &nbsp;
                                                        </p>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="card bg-light">
                                                <div class="card-header black">
                                                    Recovered
                                                </div>
                                                <div class="card-body text-center black">
                                                    <span>
                                                        <p>Total :
                                                            {{ number_format($all_stats_jammu['recovered_total']) ?? NA }}
                                                        </p>
                                                        <p> New :
                                                            {{ number_format($all_stats_jammu['recovered_new']) ?? NA }}
                                                        </p>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="card bg-light">
                                                <div class="card-header black">
                                                    Deaths
                                                </div>
                                                <div class="card-body text-center black">
                                                    <span>
                                                        <p>Total :
                                                            {{ number_format($all_stats_jammu['deaths_total']) ?? NA }}
                                                        </p>
                                                        <p> New :
                                                            {{ number_format($all_stats_jammu['deaths_new']) ?? NA }}
                                                        </p>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- stats for divisions end  -->
            <!-- detailed table starts -->
            <div class="col-12">
                <h2>Region Wise Data</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Header</th>
                                <th>Header</th>
                                <th>Header</th>
                                <th>Header</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1,001</td>
                                <td>random</td>
                                <td>data</td>
                                <td>placeholder</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>1,002</td>
                                <td>placeholder</td>
                                <td>irrelevant</td>
                                <td>visual</td>
                                <td>layout</td>
                            </tr>
                            <tr>
                                <td>1,003</td>
                                <td>data</td>
                                <td>rich</td>
                                <td>dashboard</td>
                                <td>tabular</td>
                            </tr>
                            <tr>
                                <td>1,003</td>
                                <td>information</td>
                                <td>placeholder</td>
                                <td>illustrative</td>
                                <td>data</td>
                            </tr>
                            <tr>
                                <td>1,004</td>
                                <td>text</td>
                                <td>random</td>
                                <td>layout</td>
                                <td>dashboard</td>
                            </tr>
                            <tr>
                                <td>1,005</td>
                                <td>dashboard</td>
                                <td>irrelevant</td>
                                <td>text</td>
                                <td>placeholder</td>
                            </tr>
                            <tr>
                                <td>1,006</td>
                                <td>dashboard</td>
                                <td>illustrative</td>
                                <td>rich</td>
                                <td>data</td>
                            </tr>
                            <tr>
                                <td>1,007</td>
                                <td>placeholder</td>
                                <td>tabular</td>
                                <td>information</td>
                                <td>irrelevant</td>
                            </tr>
                            <tr>
                                <td>1,008</td>
                                <td>random</td>
                                <td>data</td>
                                <td>placeholder</td>
                                <td>text</td>
                            </tr>
                            <tr>
                                <td>1,009</td>
                                <td>placeholder</td>
                                <td>irrelevant</td>
                                <td>visual</td>
                                <td>layout</td>
                            </tr>
                            <tr>
                                <td>1,010</td>
                                <td>data</td>
                                <td>rich</td>
                                <td>dashboard</td>
                                <td>tabular</td>
                            </tr>
                            <tr>
                                <td>1,011</td>
                                <td>information</td>
                                <td>placeholder</td>
                                <td>illustrative</td>
                                <td>data</td>
                            </tr>
                            <tr>
                                <td>1,012</td>
                                <td>text</td>
                                <td>placeholder</td>
                                <td>layout</td>
                                <td>dashboard</td>
                            </tr>
                            <tr>
                                <td>1,013</td>
                                <td>dashboard</td>
                                <td>irrelevant</td>
                                <td>text</td>
                                <td>visual</td>
                            </tr>
                            <tr>
                                <td>1,014</td>
                                <td>dashboard</td>
                                <td>illustrative</td>
                                <td>rich</td>
                                <td>data</td>
                            </tr>
                            <tr>
                                <td>1,015</td>
                                <td>random</td>
                                <td>tabular</td>
                                <td>information</td>
                                <td>text</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- detailed table ends-->



        </div>
        <!-- container close -->
    </div>
@endsection
@section('scripts')

    @parent

@endsection
