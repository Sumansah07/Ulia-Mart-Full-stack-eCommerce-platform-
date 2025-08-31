<?php
    $itemPrefix = null;
    for ($i = 0; $i < $subCategory->level; $i++) {
        $itemPrefix .= '▸';
    }
?>
<option value="<?php echo e($subCategory->id); ?>" <?php echo e($subCategory->id == $category->parent_id ? 'selected' : ''); ?>

    <?php if(isset($navbar_categories)): ?>
    <?php echo e(in_array($subCategory->id, $navbar_categories) ? 'selected' : ''); ?>

    <?php endif; ?>>
    <?php echo e($itemPrefix . ' ' . $subCategory->collectLocalization('name')); ?></option>

<?php if($subCategory->categories): ?>
    <?php $__currentLoopData = $subCategory->categories()->orderBy('sorting_order_level', 'desc')->where('id', '!=', $category->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('backend.pages.products.categories.subCategory', ['subCategory' => $childCategory], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH D:\Suman-ogani\uliaa.infiniteitsolutionsnepal.com\resources\views/backend/pages/products/categories/subCategory.blade.php ENDPATH**/ ?>