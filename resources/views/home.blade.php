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
                    <div class="col-xl-3 col-lg-3 col-sm-6 col-xs-6 ">
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
                    <div class="col-xl-3 col-lg-3 col-sm-6 col-xs-6 ">
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

                    <div class="col-xl-3 col-lg-3 col-sm-6 col-xs-6">
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
                    <div class="col-xl-3 col-lg-3 col-sm-6 col-xs-6">
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
                        <div class="card-header mb-1">
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
                        <div class="card-body chart" style="margin-top:-35px;">
                            <canvas class="my-4 w-100 chartjs-render-monitor" id="line-chart" width=auto height=auto
                                style="display: block; height: 37vh; width: auto;">
                            </canvas>
                            <div id="spinner" class="loader" style="display:none"></div>
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

            <section>
                <div class="col-12">
                    <div class="card text-center">

                        <div class="card-header">
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <h6 class="ml-5 mr-5 mt-2"> Change View </h6>
                                <select onchange="preprocessDataAndshowMap.changeMapData(this)"
                                    class="btn btn-sm btn-outline-secondary dropdown-toggle ml-5">
                                    <option value="deaths_total">Deaths</option>
                                    <option value="recovered_total">Recovered</option>
                                    <option value="total_active">Active</option>
                                    <option value="postive_total">Postive</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="mapid" style="width: auto; height: 450px"></div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- detailed table starts -->
            <div class="col-12 mt-4">
                <h4 class="mb-3">Region Wise Data</h4>
                <div class="">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="12%">Date</th>
                                <th width="13%">Region</th>
                                <th>Postive New</th>
                                <th>Postive Total</th>
                                <th>Recovered New</th>
                                <th>Recovered Total</th>
                                <th>Total Active</th>
                                <th>Deaths New</th>
                                <th>Deaths Total</th>
                            </tr>
                        </thead>
                        <tbody>
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
    <script type="text/javascript">
        var BASE_API_URL = "{{ env('APP_URL') }}";
        $(function() {
            var table = $('.data-table').DataTable({
                processing: false,
                serverSide: true,
                scrollX: false,
                lengthMenu: [23, 46, 69],
                ajax: "/stats/allregions",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'date',
                        name: 'date',
                        render: function(data) {
                            date = new Date(data);
                            return `${date.getDate()}/${date.getMonth()}/${date.getFullYear()}`;
                        }
                    },

                    {
                        data: 'name',
                        name: 'name',
                        render: function(data) {
                            name = data.toUpperCase();
                            res = name.split("_");
                            if (res.length == 2) {
                                return res[0] + " " + res[1];
                            } else {
                                return name;
                            }

                        }
                    },
                    {
                        data: 'postive_new',
                        name: 'postive_new',
                        render: $.fn.dataTable.render.number(',')
                    },
                    {
                        data: 'postive_total',
                        name: 'postive_total',
                        render: $.fn.dataTable.render.number(',')
                    },
                    {
                        data: 'recovered_new',
                        name: 'recovered_new',
                        render: $.fn.dataTable.render.number(',')
                    },
                    {
                        data: 'recovered_total',
                        name: 'recovered_total',
                        render: $.fn.dataTable.render.number(',')
                    },
                    {
                        data: 'total_active',
                        name: 'total_active',
                        render: $.fn.dataTable.render.number(',')
                    },
                    {
                        data: 'deaths_new',
                        name: 'deaths_new',
                        render: $.fn.dataTable.render.number(',')
                    },
                    {
                        data: 'deaths_total',
                        name: 'deaths_total',
                        render: $.fn.dataTable.render.number(',')
                    }
                ]
            });

        });

    </script>

    <script>
        var casesTypeColors = {
            total_active: {
                hex: "#CC1034",
                multiplier: 200,
            },
            postive_total: {
                hex: "#FF0678",
                multiplier: 200,
            },
            recovered_total: {
                hex: "#7dd71d",
                multiplier: 100,
            },
            deaths_total: {
                hex: "#fb4443",
                multiplier: 400,
            },
        };
        var mymap = L.map('mapid').setView([33.2778, 75.3412], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);

        async function preprocessDataAndshowMap(data) {
            regions = await getRegionCoords();
            pre_data = await preprocessData(data.data);
            for (var region in regions) {
                reg = regions[region];
                reg = Object.keys(reg)[0];
                showDataOnMap(region, 'deaths_total', pre_data[reg], reg);
            }

            function changeMapData(selector) {
                mymap.eachLayer(function(layer) {
                    if (layer['options'].id == 'mapbox/streets-v11') {} else {
                        mymap.removeLayer(layer)
                    }
                });
                for (region in regions) {
                    reg = regions[region];
                    reg = Object.keys(reg)[0];
                    showDataOnMap(region, selector.value, pre_data[reg], reg);
                }
            }

            preprocessDataAndshowMap.changeMapData = changeMapData;
        }
        res = fetch('api/stats/detailed')
            .then(response => response.json())
            .then(data => preprocessDataAndshowMap(data));

        function showDataOnMap(region, caseType, data, reg_name) {
            lat = regions[region][reg_name].latitude;
            long = regions[region][reg_name].longitude;
            radius = Math.sqrt(data[caseType]) * casesTypeColors[caseType].multiplier;
            var circle = L.circle([lat, long], {
                color: casesTypeColors[caseType].hex,
                fillColor: casesTypeColors[caseType].hex,
                fillOpacity: 0.5,
                radius: radius
            }).addTo(mymap);

            circle.bindPopup("<b>" + reg_name.toUpperCase() + "</b><br> " + caseType + " : " + data[caseType]);

        }

        function preprocessData(data) {
            dat = data.reduce((obj, cur) => ({
                ...obj,
                [cur.name]: cur
            }), {});
            return dat;
        }

        async function getRegionCoords() {
            {{-- var regions = {
                anantnag: {
                    latitute: 33.7311,
                    longitude: 75.1487,
                },
                srinagar: {
                    latitute: 34.0837,
                    longitude: 74.7973,
                },
                jammu: {
                    latitute: 32.7266,
                    longitude: 74.8570,
                },
                bandipora: {
                    latitute: 34.5052,
                    longitude: 74.6869,
                },
                baramulla: {
                    latitute: 34.1595,
                    longitude: 74.3587,
                },
                budgam: {
                    latitute: 33.9349,
                    longitude: 74.6400,
                },
                pulwama: {
                    latitute: 33.8716,
                    longitude: 74.8946,
                },
                kupwara: {
                    latitute: 34.5262,
                    longitude: 74.2546,
                }

            }; --}}
            let res = await fetch('/api/regioncoords')

            let out = await res.json();
            return out['data'];
        }

    </script>
    @parent

@endsection
