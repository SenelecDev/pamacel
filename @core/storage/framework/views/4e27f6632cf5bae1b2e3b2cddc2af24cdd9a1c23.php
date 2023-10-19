<script>
    $(document).on('click','#custom',function () {
        $(this).addClass("disabled")
        $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> <?php echo e($title); ?>');
    });
</script><?php /**PATH C:\laragon\www\pamacel\@core\resources\views/components/btn/custom.blade.php ENDPATH**/ ?>