<?php $__env->startSection('content'); ?>
<!-- BEGIN PAGE CONTAINER-->
<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="clearfix"></div>
    <div class="content">
        <div class="col-md-6">
            <div class="row">
                <div class="page-title">
                    <h3>Courses</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <ul class="breadcrumb">
                    <li>
                        <p>Dashboard</p>
                    </li>
                    <li><a href="javascript:void(0);" class="active">Courses</a> </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="grid simple">
                    <div class="grid-body no-border form_wrap_col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Course Name</td>
                                    <td>Price</td>
                                    <td>Expiry Date</td>
                                    <td>Certification</td>
                                    <td>Full Access</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($data['all_courses'])
                            {
                                foreach ($data['all_courses'] as $key => $value)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $value['course_name']?></td>
                                        <td><?= $value['price']?></td>
                                        <td><?= date('Y-m-d', strtotime($value['expiry_date']))?></td>
                                        <td><?= $value['is_certification'] == 1 ? 'Yes' : 'No' ?></td>
                                        <td><?= $value['is_full_access'] == 1 ? 'Yes' : 'No'?></td>
                                        <td><?= $value['status'] == 1 ? 'Active' : 'Disabled' ?></td>
                                        <td>
                                            <a href="<?php echo e(url('admin/course/edit')); ?>/<?= $value['id'] ?>" class="btn"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo e(url('admin/course/delete')); ?>/<?= $value['id'] ?>" class="btn"><i class="fa fa-trash"></i></a>
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
        <!-- END PAGE -->
    </div>
</div>
<script src="<?php echo e(url('/assets/plugins/data-tables/jquery.dataTables.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('/assets/js/backend/courses.js')); ?>" type="text/javascript"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>