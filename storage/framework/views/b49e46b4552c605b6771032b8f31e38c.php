<?php $__env->startSection('title'); ?>
    <?php echo e(localize('Website Header Configuration')); ?> <?php echo e(getSetting('title_separator')); ?> <?php echo e(getSetting('system_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <section class="tt-section pt-4">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card tt-page-header">
                        <div class="card-body d-lg-flex align-items-center justify-content-lg-between">
                            <div class="tt-page-title">
                                <h2 class="h5 mb-lg-0"><?php echo e(localize('Website Header Configuration')); ?></h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!--left sidebar-->
                <div class="col-xl-9 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" enctype="multipart/form-data"
                        class="pb-650">
                        <?php echo csrf_field(); ?>

                        <!--Topbar-->
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4"><?php echo e(localize('Topbar Information')); ?></h5>

                                <div class="mb-3">
                                    <label for="topbar_welcome_text"
                                        class="form-label"><?php echo e(localize('Welcome Text')); ?></label>
                                    <input type="hidden" name="types[]" value="topbar_welcome_text">
                                    <input type="text" name="topbar_welcome_text" id="topbar_welcome_text"
                                        class="form-control" placeholder="<?php echo e(localize('Welcome to our organic store')); ?>"
                                        value="<?php echo e(getSetting('topbar_welcome_text')); ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="topbar_email" class="form-label"><?php echo e(localize('Topbar Email')); ?></label>
                                    <input type="hidden" name="types[]" value="topbar_email">
                                    <input type="email" name="topbar_email" id="topbar_email" class="form-control"
                                        placeholder="<?php echo e(localize('grostore@support.com')); ?>"
                                        value="<?php echo e(getSetting('topbar_email')); ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="topbar_location"
                                        class="form-label"><?php echo e(localize('Topbar Location')); ?></label>
                                    <input type="hidden" name="types[]" value="topbar_location">
                                    <input type="text" name="topbar_location" id="topbar_location" class="form-control"
                                        placeholder="<?php echo e(localize('Washington, New York, USA - 254230')); ?>"
                                        value="<?php echo e(getSetting('topbar_location')); ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="facebook_link" class="form-label"><?php echo e(localize('Facebook Link')); ?></label>
                                    <input type="hidden" name="types[]" value="facebook_link">
                                    <input type="url" name="facebook_link" id="facebook_link" class="form-control"
                                        placeholder="https://facebook.com/example"
                                        value="<?php echo e(getSetting('facebook_link')); ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="twitter_link" class="form-label"><?php echo e(localize('Twitter Link')); ?></label>
                                    <input type="hidden" name="types[]" value="twitter_link">
                                    <input type="url" name="twitter_link" id="twitter_link" class="form-control"
                                        placeholder="https://twitter.com/example" value="<?php echo e(getSetting('twitter_link')); ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="linkedin_link" class="form-label"><?php echo e(localize('LinkedIn Link')); ?></label>
                                    <input type="hidden" name="types[]" value="linkedin_link">
                                    <input type="url" name="linkedin_link" id="linkedin_link" class="form-control"
                                        placeholder="https://linkedin.com/example"
                                        value="<?php echo e(getSetting('linkedin_link')); ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="youtube_link" class="form-label"><?php echo e(localize('Youtube Link')); ?></label>
                                    <input type="hidden" name="types[]" value="youtube_link">
                                    <input type="url" name="youtube_link" id="youtube_link" class="form-control"
                                        placeholder="https://youtube.com/example"
                                        value="<?php echo e(getSetting('youtube_link')); ?>">
                                </div>


                                <div class="mb-3">
                                    <label for="about_us" class="form-label"><?php echo e(localize('About Us')); ?></label>
                                    <input type="hidden" name="types[]" value="about_us">
                                    <textarea name="about_us" id="about_us" class="form-control"><?php echo e(getSetting('about_us')); ?></textarea>
                                </div>

                            </div>
                        </div>


                        <!--Navbar-->
                        <div class="card mb-4" id="section-2">
                            <div class="card-body">
                                <h5 class="mb-4"><?php echo e(localize('Navbar Information')); ?></h5>

                                <div class="mb-3">
                                    <label class="form-label"><?php echo e(localize('Navbar Logo')); ?></label>
                                    <input type="hidden" name="types[]" value="navbar_logo">
                                    <div class="tt-image-drop rounded">
                                        <span class="fw-semibold"><?php echo e(localize('Choose Navbar Logo')); ?></span>
                                        <!-- choose media -->
                                        <div class="tt-product-thumb show-selected-files mt-3">
                                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                                onclick="showMediaManager(this)" data-selection="single">
                                                <input type="hidden" name="navbar_logo"
                                                    value="<?php echo e(getSetting('navbar_logo')); ?>">
                                                <div class="no-avatar rounded-circle">
                                                    <span><i data-feather="plus"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- choose media -->
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label"><?php echo e(localize('Categories')); ?></label>

                                        <input type="hidden" name="types[]" value="show_navbar_categories">
                                        <div class="form-check form-switch">
                                            <label class="form-check-label fw-medium text-primary"
                                                for="show_navbar_categories"><?php echo e(localize('Show Categories?')); ?></label>
                                            <input type="checkbox" class="form-check-input" id="show_navbar_categories"
                                                name="show_navbar_categories"
                                                <?php if(getSetting('show_navbar_categories') == 1): ?> checked <?php endif; ?>>
                                        </div>
                                    </div>

                                    <input type="hidden" name="types[]" value="navbar_categories">

                                    <?php
                                        $navbar_categories = getSetting('navbar_categories') != null ? json_decode(getSetting('navbar_categories')) : [];
                                    ?>
                                    <select class="form-control select2" name="navbar_categories[]" class="w-100"
                                        data-toggle="select2" data-placeholder="<?php echo e(localize('Select categories')); ?>"
                                        multiple>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"
                                                <?php if(in_array($category->id, $navbar_categories)): ?> selected <?php endif; ?>>
                                                <?php echo e($category->collectLocalization('name')); ?></option>
                                            <?php $__currentLoopData = $category->childrenCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo $__env->make('backend.pages.products.categories.subCategory', [
                                                    'subCategory' => $childCategory,
                                                    'navbar_categories' => $navbar_categories,
                                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="my-3 mt-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label"><?php echo e(localize('Active Themes')); ?></label>

                                        <input type="hidden" name="types[]" value="show_theme_changes">
                                        <div class="form-check form-switch">
                                            <label class="form-check-label fw-medium text-primary"
                                                for="show_theme_changes"><?php echo e(localize('Show Theme Changes?')); ?></label>
                                            <input type="checkbox" class="form-check-input" id="show_theme_changes"
                                                name="show_theme_changes" <?php if(getSetting('show_theme_changes') == 1): ?> checked <?php endif; ?>>
                                        </div>
                                    </div>

                                    <input type="hidden" name="types[]" value="active_themes">
                                    <?php
                                        $active_themes = getSetting('active_themes') != null ? json_decode(getSetting('active_themes')) : [1];
                                    ?>
                                    <select class="form-control select2" name="active_themes[]" class="w-100"
                                        data-toggle="select2" data-placeholder="<?php echo e(localize('Select themes')); ?>" multiple
                                        required>
                                        <?php $__currentLoopData = $themes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($theme->id); ?>"
                                                <?php if(in_array($theme->id, $active_themes)): ?> selected <?php endif; ?>>
                                                <?php echo e(localize($theme->name)); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                                <div class="mb-3">

                                    <input type="hidden" name="types[]" value="header_menu_labels">
                                    <input type="hidden" name="types[]" value="header_menu_links">

                                    <label for="navbar_contact_number"
                                        class="form-label"><?php echo e(localize('Header Nav Menu')); ?></label>

                                    <div class="header-menu-list">
                                        <?php
                                            $labels = json_decode(getSetting('header_menu_labels')) ?? [];
                                            $menus = json_decode(getSetting('header_menu_links')) ?? [];
                                        ?>
                                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuKey => $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div
                                                class="d-flex justify-content-between align-items-center each-menu-list mt-2">
                                                <input type="text" name="header_menu_labels[]"
                                                    class="form-control w-50 w-lg-25"
                                                    placeholder="<?php echo e(localize('Menu label')); ?>"
                                                    value="<?php echo e($labels[$menuKey]); ?>" required>
                                                <input type="url" name="header_menu_links[]"
                                                    class="form-control ms-2"
                                                    placeholder="https://grostore.themetags.com/"
                                                    value="<?php echo e($menuItem); ?>" required>

                                                <button type="button" data-toggle="remove-parent"
                                                    class="btn btn-link px-2 ms-2" data-parent=".each-menu-list">
                                                    <i data-feather="trash-2" class="text-danger"></i>
                                                </button>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>

                                    <button class="btn btn-link px-0 fw-medium fs-base" type="button"
                                        data-toggle="add-more"
                                        data-content='<div class="d-flex justify-content-between align-items-center each-menu-list mt-2">
                                            <input type="text" name="header_menu_labels[]"
                                                class="form-control w-50 w-lg-25"
                                                placeholder="<?php echo e(localize('Menu label')); ?>" required>
                                            <input type="url" name="header_menu_links[]" class="form-control ms-2"
                                                placeholder="https://grostore.themetags.com/" required>

                                            <button type="button" data-toggle="remove-parent"
                                                class="btn btn-link px-2 ms-2" data-parent=".each-menu-list">
                                                <i data-feather="trash-2" class="text-danger"></i>
                                            </button>
                                        </div>'
                                        data-target=".header-menu-list">
                                        <i data-feather="plus" class="me-1"></i>
                                        <?php echo e(localize('Add New')); ?>

                                    </button>

                                </div>



                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label"><?php echo e(localize('Pages')); ?></label>

                                        <input type="hidden" name="types[]" value="show_navbar_pages">
                                        <div class="form-check form-switch">
                                            <label class="form-check-label fw-medium text-primary"
                                                for="show_navbar_pages"><?php echo e(localize('Show Pages?')); ?></label>
                                            <input type="checkbox" class="form-check-input" id="show_navbar_pages"
                                                name="show_navbar_pages" <?php if(getSetting('show_navbar_pages') == 1): ?> checked <?php endif; ?>>
                                        </div>
                                    </div>

                                    <?php
                                        $navbar_pages = getSetting('navbar_pages') != null ? json_decode(getSetting('navbar_pages')) : [];
                                    ?>
                                    <input type="hidden" name="types[]" value="navbar_pages">
                                    <select class="form-control select2" name="navbar_pages[]" class="w-100"
                                        data-toggle="select2" data-placeholder="<?php echo e(localize('Select pages')); ?>" multiple>
                                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($page->id); ?>"
                                                <?php if(in_array($page->id, $navbar_pages)): ?> selected <?php endif; ?>>
                                                <?php echo e($page->collectLocalization('title')); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="navbar_contact_number"
                                        class="form-label"><?php echo e(localize('Contact Number')); ?></label>
                                    <input type="hidden" name="types[]" value="navbar_contact_number">
                                    <input type="text" name="navbar_contact_number" id="navbar_contact_number"
                                        class="form-control" placeholder="+80 157 058 4567"
                                        value="<?php echo e(getSetting('navbar_contact_number')); ?>">
                                </div>

                            </div>
                        </div>


                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">
                                <i data-feather="save" class="me-1"></i> <?php echo e(localize('Save Changes')); ?>

                            </button>
                        </div>
                    </form>
                </div>

                <!--right sidebar-->
                <div class="col-xl-3 order-1 order-md-1 order-lg-1 order-xl-2">
                    <div class="card tt-sticky-sidebar d-none d-xl-block">
                        <div class="card-body">
                            <h5 class="mb-4"><?php echo e(localize('Header Configuration')); ?></h5>
                            <div class="tt-vertical-step">
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#section-1" class="active"><?php echo e(localize('Topbar Information')); ?></a>
                                    </li>
                                    <li>
                                        <a href="#section-2"><?php echo e(localize('Navbar Information')); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        "use strict";

        // runs when the document is ready --> for media files
        $(document).ready(function() {
            getChosenFilesCount();
            showSelectedFilePreviewOnLoad();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/backend/pages/appearance/header.blade.php ENDPATH**/ ?>