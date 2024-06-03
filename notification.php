<style>
/* notifocation */


.notification {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #ebffda;
    color: #252525;
    font-family: Inter;
    font-size: 18px;
    text-align: center;
    border-radius: 25px;
    border: 3px solid #d0fdaa;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
}

.notification.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 1.5s;
    animation: fadein 0.5s, fadeout 0.5s 1.5s;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}



</style>
<div id="notification" class="notification">
    Notification message
</div>


<script>
    function showNotification(message) {
        var notification = $('#notification');
        notification.text(message);
        notification.addClass('show');
        setTimeout(function() {
            notification.removeClass('show');
        }, 2000);
    }
</script>