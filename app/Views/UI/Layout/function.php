<?php
function phpAlert($alert_type, $alert_message, $slide_up_time = 4000){
    echo '
        <div id="phpAlertBox">
            <div id="alertBtn" data-bs-toggle="collapse" data-bs-target="#alert"></div>
            <div id="alert" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="card-alert-'.$alert_type.'">'.$alert_message.'</div>
                    <input id="alertTime" type="text" value="'.$slide_up_time.'" hidden>
                </div>
            </div>
        </div>
    ';
    ?>
<script>
$(document).ready(() => {
    $('#alertBtn').trigger('click');
    let alertTime = $('#alertTime').val();
    let removeElement = 1000;
    let totalTime = +alertTime + removeElement;

    setTimeout(() => {
        $('#alertBtn').trigger('click');
    }, $('#alertTime').val());

    setTimeout(() => {
        $('#phpAlertBox').remove();
    }, totalTime);
})
</script>
<?php
}
?>