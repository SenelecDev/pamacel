<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Case Study Area')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/media-uploader.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('Case Study Area Settings')); ?></h4>
                        <form action="<?php echo e(route('admin.homeone.case.study.area')); ?>" method="post"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <ul class="nav nav-tabs " id="myTab" role="tablist">
                                <?php $__currentLoopData = get_all_language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if($key == 0): ?> active <?php endif; ?>" data-toggle="tab" href="#home_<?php echo e($key); ?>" role="tab" aria-selected="true"><?php echo e($lang->name); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="tab-content margin-top-30" id="myTabContent">
                                <?php $__currentLoopData = get_all_language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php if($key == 0): ?> show active <?php endif; ?>" id="home_<?php echo e($key); ?>" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="home_page_01_<?php echo e($lang->slug); ?>_case_study_title"><?php echo e(__('Title')); ?></label>
                                            <input type="text" name="home_page_01_<?php echo e($lang->slug); ?>_case_study_title" class="form-control"
                                                   value="<?php echo e(get_static_option('home_page_01_'.$lang->slug.'_case_study_title')); ?>"
                                                   id="home_page_01_<?php echo e($lang->slug); ?>_case_study_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_01_<?php echo e($lang->slug); ?>_case_study_description"><?php echo e(__('Description')); ?></label>
                                            <textarea name="home_page_01_<?php echo e($lang->slug); ?>_case_study_description" class="form-control max-height-120" id="home_page_01_<?php echo e($lang->slug); ?>_case_study_description" cols="30" rows="10"><?php echo e(get_static_option('home_page_01_'.$lang->slug.'_case_study_description')); ?></textarea>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="form-group">
                                <label for="home_page_01_case_study_items"><?php echo e(__('Case Study Items')); ?></label>
                                <input type="text" name="home_page_01_case_study_items" class="form-control max-height-120" id="home_page_01_case_study_items" value="<?php echo e(get_static_option('home_page_01_case_study_items')); ?>">
                            </div>
                            <?php if(get_static_option('home_page_variant') == '02'): ?>
                                <div class="form-group">
                                    <label><?php echo e(__('Background Image')); ?></label>
                                    <?php $background_image_upload_btn_label = 'Upload Background Image'; ?>
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            <?php
                                                $background_img = get_attachment_image_by_id(get_static_option('home_page_02_case_study_background_image'),null,false);
                                            ?>
                                            <?php if(!empty($background_img)): ?>
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="<?php echo e($background_img['img_url']); ?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $background_image_upload_btn_label = 'Change Image'; ?>
                                            <?php endif; ?>
                                        </div>
                                        <input type="hidden" name="home_page_02_case_study_background_image" value="<?php echo e(get_static_option('home_page_02_case_study_background_image')); ?>">
                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="<?php echo e(__('Select Background Image')); ?>" data-modaltitle="<?php echo e(__('Upload Background Image')); ?>" data-imgid="<?php echo e(get_static_option('home_page_02_case_study_background_image')); ?>" data-toggle="modal" data-target="#media_upload_modal">
                                            <?php echo e(__($background_image_upload_btn_label)); ?>

                                        </button>
                                    </div>
                                    <small><?php echo e(__('recommended image size is 1920x980 pixel')); ?></small>
                                </div>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Settings')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('backend.partials.media-upload.media-upload-markup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <?php echo $__env->make('backend.partials.media-upload.media-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\pamacel\@core\resources\views/backend/pages/home/home-01/case-study.blade.php ENDPATH**/ ?>