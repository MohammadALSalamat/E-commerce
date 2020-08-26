@extends('layouts.adminlayout.admin_desgin')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i
                    class="icon-home"></i>
                Home</a> <a href="{{url('/admin/category/viewCategory')}}" title="Go to Category" class="tip-bottom">Categories</a> <a
                href="#" class="current">View Categories</a> </div>
        <h1>View Categories</h1>
    </div>
    <div class="container-fluid">
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
            @endif
        </div>
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Category</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th> Category ID </th>
                                    <th>Categoey Name</th>
                                    <th>Description</th>
                                    <th>Category Level</th>
                                    <th>Url</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Categories as $category)
                                <tr class="gradeX">
                                    <td>{{$category-> id}}</td>
                                    <td>{{$category-> name}}</td>
                                    <td>{{$category-> descrption}}</td>
                                    <td>
                                        @if($category-> parent_id == 0)
                                            {{'Main Category'}}

                                        @else {{'Sub-Catgory to ' . $category->parent_id}}
                                        @endif
                                        </td>
                                    <td>{{$category-> url}}</td>
                                    <td class="center">{{$category -> status}}</td>
                                    <td>
                                        <a href="{{url('admin/category/'. $category-> id .'/edit')}}"><button type="button"
                                                class="btn btn-success hvr-sweep-left"><i class="fa fa-pencil" aria-hidden="true"></i>
                                                Edit</button></a>
                                        <a <?php /*href="{{url('admin/category/'. $category-> id)}}"*/ ?> href="javascript:"><button
                                               rel="{{$category-> id}}" rel1="category" type="button" class="btn btn-danger hvr-sweep-right deleteRecord"><i class="fa fa-window-close"
                                                    aria-hidden="true"></i> Delete</button></a>
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
