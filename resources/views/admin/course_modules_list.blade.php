@extends('admin.layouts.layout')
@section('content')
<link href="{{url('/assets/plugins/data-tables/DT_bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="screen"/>
<!-- BEGIN PAGE CONTAINER-->
<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="clearfix"></div>
    <div class="content">
        <div class="col-md-6">
            <div class="row">
                <div class="page-title">
                    <h3>Course Modules - <a href="{{url('admin/course/edit')}}/<?= $data['course_details']['id']?>"><?= $data['course_details']['course_name']?></a></h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <ul class="breadcrumb">
                    <li>
                        <p>Dashboard</p>
                    </li>
                    <li><a href="javascript:void(0);" class="active">Course Modules</a> </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-body no-border form_wrap_col">
                        <div class="buttons_div"><a class="btn btn-primary pull-right" href="{{url('admin/course_module/add')}}/<?= $data['course_details']['id']?>">Add New</a></div>
                        @if(Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                        @endif
                        @if(Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Module Name</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(sizeof($data['all_course_modules']) > 0)
                            {
                                foreach ($data['all_course_modules'] as $key => $value)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $value['module_name']?></td>
                                        <td><?= $value['status'] == 1 ? 'Active' : 'Inactive' ?></td>
                                        <td>
                                            <a href="{{url('admin/course_module/edit')}}/<?= $data['course_details']['id'] . '/' . $value['id']; ?>" class="btn btn-small btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" onclick="confirm_delete(this)" rel="{{url('admin/course_module/delete')}}/<?= $data['course_details']['id'] . '/' . $value['id']; ?>" class="btn btn-small btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{url('/assets/plugins/data-tables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{url('/assets/js/backend/courses.js')}}" type="text/javascript"></script>

@stop