@extends('admin.layouts.layout')
@section('content')
<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
        <div class="col-md-6">
            <div class="row">
                <div class="page-title">
                    <h3>Create Course Module(s)</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <ul class="breadcrumb">
                    <li><p>Dashboard</p></li>
                    <li><a href="javascript:void(0);" class="active">Create Course Module(s)</a></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-body no-border form_wrap_col">
                        <div class="buttons_div">
                            <a class="pull-right btn btn-default" href="{{url('admin/course_modules')}}/<?php echo $data['cid']; ?>">View All Modules</a>
                        </div>

                        @if(Session::has('success'))
                            <p class="alert alert-success">{{ Session::get('success') }}</p>
                        @endif

                        @if(Session::has('error'))
                            <p class="alert alert-danger">{{ Session::get('error') }}</p>
                        @endif

                        <div data-wizard-init>
                            <div class="steps-content">
                                <form action="{{url('admin/course_module/save')}}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="cid" value="<?php echo base64_encode($data['cid']); ?>">
                                    <input type="hidden" name="mid" value="<?php echo base64_encode($data['mid']); ?>">

                                    <div data-step="3">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <div id="module_container">
                                                    <div id="module-0" class="courses_module">
                                                        <div class="form-group">
                                                            <label class="form-label">Module Name</label>
                                                            <div class="controls">
                                                                <input type="text" class="form-control" name="module_name" value="<?php echo isset($data['course_module_details']) ? $data['course_module_details']['module_name'] : ''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Module Description</label>
                                                            <div class="controls">
                                                                <textarea id="" placeholder="Enter Description" name="module_description" class="form-control" rows="10"><?php echo isset($data['course_module_details']) ? $data['course_module_details']['module_description'] : ''; ?></textarea>
                                                            </div>
                                                        </div>

                                                        <?php
                                                        if(isset($data['course_module_details']) && sizeof($data['course_module_details']['attachment'])> 0)
                                                        {
                                                        ?>
                                                            <div class="form-group">
                                                                <label class="form-label">Module Video</label>
                                                                <div class="controls">
                                                                    <video width="320" height="240" controls>
                                                                        <source src="{{url('/')}}<?php echo $data['course_module_details']['attachment']['attachment_path']; ?>" type="video/mp4">
                                                                        Your browser does not support the video tag.
                                                                    </video>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="form-label">Upload Video</label>  
                                                            <div class="controls">
                                                                <input name="module_video" id="module_file" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" type="file">
                                                                <label for="module_file"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file…</span></label>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-next final-step btn-success" name="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    a.remove_module {
        position: absolute;
        right: 0;
        font-size: 16px;
        cursor: pointer;
    }
    div.courses_module:not(:first-child) {
        border-top: 1px solid #d6d6d6;
        padding-top: 20px;
    }
</style>
<script src="{{url('/assets/plugins/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script src="{{url('/assets/js/backend/courses.js')}}" type="text/javascript"></script>
@stop