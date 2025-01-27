<x-app-layout title="Treatment Plans">
    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Treatment Plans</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" style="width:100%;">
                                <thead>
                                    <tr role="row">
                                        <th>Name</th>
                                        <th>Patient</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plans as $plan)
                                        <tr>
                                            <td>{{ $plan->name }}</td>
                                            <td>{{ $plan->patient->name }}</td>
                                            <td>{{ $plan->start_date }}</td>
                                            <td>{{ $plan->end_date }}</td>
                                            <td>
                                                @if ($plan->status == 'open')
                                                    <span class="badge badge-pill badge-success">open</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">closed</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="mr-1 btn btn-sm btn-primary" href="javascript:;">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="mr-1 btn btn-sm btn-warning" href="javascript:;">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-sm btn-danger" href="javascript:;">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
