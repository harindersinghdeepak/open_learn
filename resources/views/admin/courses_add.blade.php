@extends('admin.layouts.layout')
@section('content')
<div class="page-content">
    <div class="clearfix"></div>
    <div class="content">
        <div class="col-md-6">
            <div class="row">
                <div class="page-title">
                    <h3>Create A Course</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <ul class="breadcrumb">
                    <li><p>Dashboard</p></li>
                    <li><a href="javascript:void(0);" class="active">Create A Course</a> </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-body no-border form_wrap_col">
                        <div data-wizard-init>
                            <ul class="steps">
                                <li data-step="1">Create A Course</li>
                                <li data-step="2">Course Media</li>
                            </ul>
                            <div class="steps-content">
                                <form action="{{url('admin/course/save')}}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="cid" value="<?php echo isset($data['course_details']) ? base64_encode($data['course_details']['id']) : ''; ?>">
                                    <div data-step="1">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <div class="form-group">
                                                    <label class="form-label">Course Name</label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control" name="course_name" value="<?php echo isset($data['course_details']) ? $data['course_details']['course_name'] : ''; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Course Price</label>
                                                    <div class="controls">
                                                        <input type="text" class="form-control" name="course_price" value="<?php echo isset($data['course_details']) ? $data['course_details']['price'] : ''; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Course Short Description</label>
                                                    <div class="controls">
                                                        <textarea id="course_short_description" placeholder="Enter Short Description" name="course_short_description" class="form-control" rows="10"><?php echo isset($data['course_details']) ? $data['course_details']['short_description'] : ''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Course Description</label>
                                                    <div class="controls">
                                                        <textarea id="course_description" placeholder="Enter Description" name="course_description" class="form-control" rows="10"><?php echo isset($data['course_details']) ? $data['course_details']['description'] : ''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Course Requirements</label>
                                                    <div class="controls">
                                                        <textarea id="course_requirements" placeholder="Enter Course Requirements" name="course_requirements" class="form-control" rows="10"><?php echo isset($data['course_details']) ? $data['course_details']['requirements'] : ''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">What Will Learn</label>
                                                    <div class="controls">
                                                        <textarea id="what_will_learn" placeholder="Enter What Will Learn" name="what_will_learn" class="form-control" rows="10"><?php echo isset($data['course_details']) ? $data['course_details']['what_will_learn'] : ''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Course Category</label>
                                                    <div class="controls">
                                                        <select id="source" style="width:100%" name="category_id">
                                                            <option value="">-- Select Course Category --</option>
                                                            <?php
                                                            foreach ($data['all_course_categories'] as $keyCC => $valueCC)
                                                            {
                                                            ?>
                                                                <option <?php echo isset($data['course_details']) && $data['course_details']['category_id'] == $valueCC['id'] ? "selected" : ''; ?> value="<?php echo $valueCC['id'];?>"><?php echo $valueCC['course_category_name'];?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="input-append success date col-md-10 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Expiry Date</label>
                                                        <div class="controls">
                                                            <input name="expiry_date" type="text" class="form-control" id="sandbox-advance" value="<?php echo isset($data['course_details']) ? date('Y-m-d', strtotime($data['course_details']['expiry_date'])) : ''; ?>">
                                                            <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Is Certification?</label>
                                                    <div class="controls">
                                                        <input name="is_certification" type="checkbox" class="form-control" <?php echo isset($data['course_details']) && $data['course_details']['is_certification'] ? "checked" : ''; ?>>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Is Full Access?</label>
                                                    <div class="controls">
                                                        <input name="is_full_access" type="checkbox" class="form-control" <?php echo isset($data['course_details']) && $data['course_details']['is_full_access'] ? "checked" : ''; ?>>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Status</label>
                                                    <div class="controls">
                                                        <select name="course_status">
                                                            <option <?php echo isset($data['course_details']) && $data['course_details']['status'] == 1 ? "selected" : ''; ?> value="1">Active</option>
                                                            <option <?php echo isset($data['course_details']) && $data['course_details']['status'] == 0 ? "selected" : ''; ?> value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div data-step="2">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Upload Background Image</label>  
                                                                <div class="form-group">
                                                                    <div class="controls col-lg-6"> 
                                                                        <div class="row">
                                                                            <input name="course_image" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" type="file">
                                                                            <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file…</span></label>
                                                                        </div>
                                                                    </div> 
                                                                    <?php
                                                                    if(sizeof(($data['course_details']['attachments'])) > 0)
                                                                    {
                                                                        foreach ($data['course_details']['attachments'] as $keyCA => $valueCA)
                                                                        {
                                                                            if ($valueCA['attachment_type'] == 1)
                                                                            {
                                                                    ?>
                                                                                <div class="col-lg-6">
                                                                                    <img src="{{url('/')}}<?php echo $valueCA['attachment_path']?>">
                                                                                </div>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Upload Video</label>  
                                                                <div class="form-group">
                                                                    <div class="controls col-lg-6"> 
                                                                        <div class="row">
                                                                            <input name="course_video" id="file-2" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" type="file">
                                                                            <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file…</span></label>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    if(sizeof(($data['course_details']['attachments'])) > 0)
                                                                    {
                                                                        foreach ($data['course_details']['attachments'] as $keyCA => $valueCA)
                                                                        {
                                                                            if ($valueCA['attachment_type'] == 2)
                                                                            {
                                                                    ?>
                                                                                <div class="col-lg-6">
                                                                                    <video width="100%" controls>
                                                                                        <source src="{{url('/')}}<?php echo $valueCA['attachment_path']; ?>" type="video/mp4">
                                                                                        Your browser does not support the video tag.
                                                                                    </video>
                                                                                </div>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-next final-step btn-success pull-right" name="submit">Complete</button>
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