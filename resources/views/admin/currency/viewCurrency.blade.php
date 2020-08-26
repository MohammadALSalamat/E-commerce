@extends('layouts.adminlayout.admin_desgin')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('/admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i
                        class="icon-home"></i>
                    Home</a> <a href="{{ url('/admin/view-currency') }}" title="Go to Currency"
                    class="tip-bottom">Currencies</a> <a href="#" class="current">View Currency</a> </div>
            <h1>View Currency</h1>
        </div>

        <div class="container-fluid">
            <hr>
            <!-- Display the error masseges from AdminController -->
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <!-- Display the logout masseges from AdminController -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>View Currency</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>Currency Id </th>
                                        <th>Currency Code</th>
                                        <th>Exchange Rate</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ViewCurrencyData as $category)
                                        <tr class="gradeX">
                                            <td style="line-height: 37px;text-align:center">{{ $category->id }}</td>
                                            <td style="line-height: 37px;text-align:center">{{ $category->currency_code }}
                                            </td>
                                            <td style="line-height: 37px;text-align:center">{{ $category->exchange_rate }}
                                            </td>
                                            <td style="line-height: 37px;text-align:center">
                                                @if ($category->status == 0)
                                                    <span style="color:red"> Not Active</span>
                                                @else
                                                    <span style="color:green">Active</span>
                                                @endif
                                            </td>
                                            <td style="width:25%">
                                                <a href="{{ url('admin/Editcurrency/' . $category->id) }}"><button
                                                        type="button" class="btn btn-success hvr-sweep-left"><i
                                                            class="fa fa-pencil" aria-hidden="true"></i>
                                                        Edit</button></a>
                                                <a <?php /*href="{{ url('admin/category/'. $category->id) }}"
                                                    */ ?> href="javascript:"><button
                                                        rel="{{ $category->id }}" rel1="Deletecurrency" type="button"
                                                        class="btn btn-danger hvr-sweep-right deleteRecord"><i
                                                            class="fa fa-window-close" aria-hidden="true"></i>
                                                        Delete</button></a>
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
@endsection
