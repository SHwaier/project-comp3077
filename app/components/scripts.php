<!-- common scripts that are used site wide are added in here -->
<script>
    window.onload = function () {
        if (document.documentElement.hasAttribute('data-theme').valueOf !== "undefined") {
            document.getElementsByClassName('logo').setAttribute('src', '/estore/assets/logo/estore-logo-light.png');
        }
    };
</script>