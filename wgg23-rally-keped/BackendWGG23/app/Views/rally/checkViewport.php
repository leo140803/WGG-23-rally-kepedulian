<script>
function checkViewport(){
    let viewportWidth = window.innerWidth;
    let viewportHeight = window.innerHeight;
    let ratio = viewportWidth / viewportHeight;

    if(viewportWidth < 1024 || ratio < (1024/800) || ratio > (20/9) ){
        window.location.href = '<?= site_url('wrongDevice') ?>';
    }
}

checkViewport();
window.onresize = checkViewport;
</script>