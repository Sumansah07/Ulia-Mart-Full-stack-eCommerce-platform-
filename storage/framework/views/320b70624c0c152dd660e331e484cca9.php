<div id="all-delete-modal" class="modal fade">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e(localize('Delete Confirmation')); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body text-center">
                <div class="display-4 text-danger"> <i data-feather="x-octagon"></i></div>
                <h6 class="my-0"><?php echo e(localize('Are you sure to delete all data?')); ?></h6>
                <p><?php echo e(localize('All data related to this may get deleted.')); ?></p>
                <div class="justify-content-center pb-3">
                    <a href="" id="all-delete-link" class="btn btn-danger mt-2"><?php echo e(localize('Proceed')); ?></a>
                    <button type="button" class="btn btn-secondary mt-2"
                        data-bs-dismiss="modal"><?php echo e(localize('Cancel')); ?></button>
                </div>
            </div>

        </div>
    </div>
</div>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/backend/inc/deleteAllModal.blade.php ENDPATH**/ ?>