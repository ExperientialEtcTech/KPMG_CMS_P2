        var timeoutTimer;
        var expireTime = 1000*60*15;
        function expireSession(){
            clearTimeout(timeoutTimer);
            timeoutTimer = setTimeout("IdleTimeout()", expireTime);
        }
        function IdleTimeout() {
            localStorage.setItem("logoutMessage", true);
            window.location.href="login.php";
        }
        $(document).on('click mousemove scroll keypress', function() {
            expireSession();
        });
        expireSession();